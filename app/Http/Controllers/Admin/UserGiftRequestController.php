<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserGiftRequestsExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserGiftRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class UserGiftRequestController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $selectedCategory = $request->query('category');
        $search = $request->query('search');

        $requestsQuery = UserGiftRequest::with('category')->latest();

        if ($selectedCategory) {
            $requestsQuery->where('category_id', $selectedCategory);
        }

        // Full search across multiple fields
        if ($search) {
            $requestsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('street_address', 'like', "%{$search}%")
                    ->orWhere('street_address2', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('zip', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $requests = $requestsQuery->paginate(20)->withQueryString();

        // Return JSON only for actual AJAX requests (not direct URL visits with ajax=1)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.gift-requests.partials.table', compact('requests'))->render(),
                'pagination' => view('partials.admin.pagination', [
                    'paginator' => $requests,
                    'itemLabel' => 'gift requests',
                    'range' => 1
                ])->render(),
            ]);
        }

        return view('admin.gift-requests.index', compact(
            'requests',
            'categories',
            'selectedCategory',
            'search'
        ));
    }

    public function show(UserGiftRequest $userGiftRequest)
    {
        $userGiftRequest->load('category', 'user');
        return view('admin.gift-requests.show', compact('userGiftRequest'));
    }

    public function destroy(UserGiftRequest $userGiftRequest)
    {
        $userGiftRequest->delete();
        return redirect()->route('admin.gift-requests.index')->with('status', 'Request deleted successfully.');
    }

    public function export(Request $request)
    {
        $categoryId = $request->query('category');
        $search = $request->query('search');
        $category = null;

        if ($categoryId) {
            $category = Category::findOrFail($categoryId);
        }

        $fileName = 'gift-requests';

        if ($category) {
            $fileName .= '-' . Str::slug($category->name);
        } else {
            $fileName .= '-all';
        }

        if ($search) {
            $fileName .= '-search-' . Str::slug(substr($search, 0, 20));
        }

        $fileName .= '-' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UserGiftRequestsExport($categoryId, $search), $fileName);
    }
}