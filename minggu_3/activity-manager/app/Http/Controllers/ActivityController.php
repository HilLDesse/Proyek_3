<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }
}