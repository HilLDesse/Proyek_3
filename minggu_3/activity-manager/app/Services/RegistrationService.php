<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use DomainException;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function register(
        Activity $activity,
        array $data
    ): Registration {
        if ($activity->status !== 'published') {
            throw new DomainException(
                'Pendaftaran hanya dapat dilakukan pada activity yang published.'
            );
        }

        if ($activity->start_at->isPast()) {
            throw new DomainException(
                'Pendaftaran ditolak karena activity sudah dimulai.'
            );
        }

        if ($activity->registrations()
            ->where('email', $data['email'])
            ->exists()) {
            throw new DomainException(
                'Email tersebut sudah terdaftar pada activity ini.'
            );
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw new DomainException(
                'Pendaftaran ditolak karena kapasitas activity sudah penuh.'
            );
        }

        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }
}