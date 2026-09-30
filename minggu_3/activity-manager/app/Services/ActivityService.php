<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;

class ActivityService
{
    public function create(array $data): Activity
    {
        $data['status'] = 'draft';
        $data['activity_date'] = $data['start_at'];

        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        if (
            array_key_exists('status', $data)
            && $data['status'] !== $activity->status
        ) {
            throw new DomainException(
                'Perubahan status harus dilakukan melalui aksi publish atau complete.'
            );
        }

        unset($data['status']);

        $data['activity_date'] = $data['start_at'];

        $activity->update($data);

        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw new DomainException(
                'Hanya activity dengan status draft yang dapat dipublikasikan.'
            );
        }

        if (
            ! $activity->category_id ||
            ! $activity->code ||
            ! $activity->title ||
            ! $activity->start_at ||
            ! $activity->end_at ||
            ! $activity->location ||
            ! $activity->capacity
        ) {
            throw new DomainException(
                'Activity belum lengkap untuk dipublikasikan.'
            );
        }

        $activity->status = 'published';
        $activity->save();

        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw new DomainException(
                'Hanya activity yang sudah published yang dapat diselesaikan.'
            );
        }

        $activity->status = 'completed';
        $activity->save();

        return $activity->refresh();
    }
}