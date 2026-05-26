<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourierRequest;
use App\Models\Courier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourierController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'regex:/^\d+(,\d+)*$/'],
            'sort' => ['nullable', 'in:name,registered_at'],
            'direction' => ['nullable', 'in:asc,desc'],
            'per_page' => ['nullable', 'integer', 'between:1,100'],
        ]);

        $sort = $validated['sort'] ?? 'name';
        $direction = $validated['direction'] ?? 'asc';

        $couriers = Courier::query()
            ->when($validated['search'] ?? null, function ($query, string $search): void {
                foreach (preg_split('/\s+/', trim($search)) ?: [] as $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                }
            })
            ->when($validated['level'] ?? null, function ($query, string $levels): void {
                $selectedLevels = collect(explode(',', $levels))
                    ->map(fn (string $level): int => (int) $level)
                    ->filter(fn (int $level): bool => $level >= 1 && $level <= 5)
                    ->unique()
                    ->values()
                    ->all();

                if ($selectedLevels !== []) {
                    $query->whereIn('level', $selectedLevels);
                }
            })
            ->orderBy($sort, $direction)
            ->orderBy('id')
            ->paginate($validated['per_page'] ?? 10)
            ->withQueryString();

        if ($request->expectsJson()) {
            return response()->json($couriers);
        }

        return view('couriers.index', [
            'couriers' => $couriers,
            'filters' => $request->only(['search', 'level', 'sort', 'direction', 'per_page']),
        ]);
    }

    public function create(): View
    {
        return view('couriers.create', [
            'courier' => new Courier(['level' => 1, 'is_active' => true]),
        ]);
    }

    public function store(CourierRequest $request): JsonResponse|RedirectResponse
    {
        $courier = Courier::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json($courier, 201);
        }

        return redirect()
            ->route('couriers.show', $courier)
            ->with('status', 'Courier berhasil ditambahkan.');
    }

    public function show(Request $request, Courier $courier): JsonResponse|View
    {
        if ($request->expectsJson()) {
            return response()->json($courier);
        }

        return view('couriers.show', compact('courier'));
    }

    public function edit(Courier $courier): View
    {
        return view('couriers.edit', compact('courier'));
    }

    public function update(CourierRequest $request, Courier $courier): JsonResponse|RedirectResponse
    {
        $courier->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json($courier->fresh());
        }

        return redirect()
            ->route('couriers.show', $courier)
            ->with('status', 'Courier berhasil diperbarui.');
    }

    public function destroy(Request $request, Courier $courier): JsonResponse|RedirectResponse
    {
        $courier->delete();

        if ($request->expectsJson()) {
            return response()->json(status: 204);
        }

        return redirect()
            ->route('couriers.index')
            ->with('status', 'Courier berhasil dihapus.');
    }
}
