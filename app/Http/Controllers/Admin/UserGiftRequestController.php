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

        $requestsQuery = UserGiftRequest::with('category')->latest();

        if ($selectedCategory) {
            $requestsQuery->where('category_id', $selectedCategory);
        }

        $requests = $requestsQuery->paginate(8)->withQueryString();

        return view('admin.gift-requests.index', compact(
            'requests',
            'categories',
            'selectedCategory'
        ));
    }

    public function show(UserGiftRequest $userGiftRequest)
    {
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

        $fileName .= '-' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UserGiftRequestsExport($categoryId), $fileName);
    }
}