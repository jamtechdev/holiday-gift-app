<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftRequestController extends Controller
{
    public function store(Request $request)
    {
        // Always block order submissions in demo mode
        return response()->json([
            'success' => false,
            'error' => 'demo_mode',
            'message' => 'For more information about this holiday gifting experience, contact us at info@thinkgraphtech.com.'
        ], 403);
    }
}
