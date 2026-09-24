<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    public function index()
    {
        Log::info('ActivityController@index dipanggil');

        $activities = Activity::query()
            ->orderBy('activity_date')
            ->get();

        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(StoreActivityRequest $request)
    {
        Activity::create($request->validated());

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activity berhasil ditambahkan.');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity
    ) {
        $activity->update($request->validated());

        return redirect()
            ->route('activities.show', $activity)
            ->with('success', 'Activity berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activity berhasil dihapus.');
    }
}