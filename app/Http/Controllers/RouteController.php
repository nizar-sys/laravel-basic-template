<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTrackingRecord;
use App\Models\TrackingRecord;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $trackingRecordCount = TrackingRecord::count();

        return view('dashboard.index', compact('userCount', 'trackingRecordCount'));
    }

    public function scan()
    {
        return view('scan.index');
    }

    public function scanStore(RequestTrackingRecord $request)
    {
        $validated = $request->validated();

        TrackingRecord::create($validated);

        return response()->json([
            'message' => 'Nomor resi berhasil ditambahkan.',
        ]);
    }
}
