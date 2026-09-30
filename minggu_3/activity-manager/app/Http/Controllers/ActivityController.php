<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    public function index()
    {
        Log::info('ActivityController@index dipanggil');

        $search = request('search');
        $categoryId = request('category_id');
        $status = request('status');
        $sort = request('sort', 'newest');

        $validStatuses = ['draft', 'published', 'completed'];
        $validSorts = ['newest', 'oldest'];

        $activities = Activity::query()
            ->with('category')
            ->when(
                $search,
                fn ($query) => $query->where(function ($query) use ($search) {
                    $query->where('code', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
                })
            )
            ->when(
                $categoryId,
                fn ($query) => $query->where('category_id', $categoryId)
            )
            ->when(
                in_array($status, $validStatuses, true),
                fn ($query) => $query->where('status', $status)
            )
            ->when(
                in_array($sort, $validSorts, true),
                fn ($query) => $query->orderBy(
                    'start_at',
                    $sort === 'oldest' ? 'asc' : 'desc'
                )
            )
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view(
            'activities.index',
            compact(
                'activities',
                'categories',
                'search',
                'categoryId',
                'status',
                'sort'
            )
        );
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.create', compact('categories'));
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ) {
        $activity = $service->create($request->validated());

        return $this->redirectToActivity(
            $activity,
            'Activity berhasil ditambahkan.'
        );
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ) {
        try {
            $service->update($activity, $request->validated());
        } catch (DomainException $exception) {
            return back()
                ->withErrors(['status' => $exception->getMessage()])
                ->withInput();
        }

        return $this->redirectToActivity(
            $activity,
            'Activity berhasil diperbarui.'
        );
    }

    public function publish(
    Activity $activity,
    ActivityService $service
    ) {
        try {
            $service->publish($activity);
        } catch (DomainException $exception) {
            return back()
                ->withErrors(['status' => $exception->getMessage()]);
        }

        return $this->redirectToActivity(
            $activity,
            'Activity berhasil dipublikasikan.'
        );
    }

    public function complete(
        Activity $activity,
        ActivityService $service
    ) {
        try {
            $service->complete($activity);
        } catch (DomainException $exception) {
            return back()
                ->withErrors(['status' => $exception->getMessage()]);
        }

        return $this->redirectToActivity(
            $activity,
            'Activity berhasil diselesaikan.'
        );
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activity berhasil dihapus.');
    }

    private function redirectToActivity(
        Activity $activity,
        string $message
    ) {
        return redirect()
            ->route('activities.show', $activity)
            ->with('success', $message);
    }
}
