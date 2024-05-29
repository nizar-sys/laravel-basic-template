<?php

namespace App\Http\Controllers;

use App\Models\TrackingRecord;
use App\Http\Requests\RequestTrackingRecord;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TrackingRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trackingRecords = TrackingRecord::orderByDesc('id')
            ->when($request->start_date && !$request->end_date, function ($query) use ($request) {
                $startDateTime = $request->start_date . ' 00:00:00';
                $query->where('created_at', '>=', $startDateTime);
            })
            ->when($request->end_date && !$request->start_date, function ($query) use ($request) {
                $endDateTime = $request->end_date . ' 23:59:59';
                $query->where('created_at', '<=', $endDateTime);
            })
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $startDateTime = $request->start_date . ' 00:00:00';
                $endDateTime = $request->end_date . ' 23:59:59';
                $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
            });
        $trackingRecords = $trackingRecords->paginate(50);

        return view('dashboard.tracking_records.index', compact('trackingRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tracking_records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestTrackingRecord $request)
    {
        $validated = $request->validated();

        $trackingRecord = TrackingRecord::create($validated);

        return redirect(route('tracking-records.index'))->with('success', 'Nomor resi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TrackingRecord::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trackingRecord = TrackingRecord::findOrFail($id);

        return view('dashboard.tracking_records.edit', compact('trackingRecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestTrackingRecord $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $trackingRecord = TrackingRecord::findOrFail($id);

        $trackingRecord->update($validated);

        return redirect(route('tracking-records.index'))->with('success', 'Nomor resi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trackingRecord = TrackingRecord::findOrFail($id);

        $trackingRecord->delete();

        return redirect(route('tracking-records.index'))->with('success', 'Nomor resi berhasil dihapus.');
    }

    public function reports(Request $request)
    {
        Carbon::setLocale('id');
        $startDate = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : null;
        $endDate = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;

        $trackingRecords = TrackingRecord::orderByDesc('id')
            ->when($startDate && !$endDate, function ($query) use ($startDate) {
                $query->where('created_at', '>=', $startDate);
            })
            ->when($endDate && !$startDate, function ($query) use ($endDate) {
                $query->where('created_at', '<=', $endDate);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get(); // Sesuaikan jumlah halaman yang diinginkan

        $pdf = PDF::loadView('dashboard.tracking_records.reports', compact('trackingRecords', 'startDate', 'endDate'));

        return $pdf->stream('laporan-nomor-resi.pdf');
    }
}
