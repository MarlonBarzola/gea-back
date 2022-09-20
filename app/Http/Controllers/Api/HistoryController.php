<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $search = request('search');

        $histories = History::orderBy('id', 'desc')
                ->when($search, function ($query, $search) {
                    $query->where('reason', 'LIKE', "%$search%");
                })
                ->included()
                ->paginate(10);

        return HistoryResource::collection($histories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|max:255',
            'personal_history' => 'required',
            'family_history' => 'required',
            'vital_signs' => 'required',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $patient = History::create($request->all());

        return HistoryResource::make($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $history = History::included()->findOrFail($id);
        return HistoryResource::make($history);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        $request->validate([
            'reason' => 'required|max:255',
            'personal_history' => 'required',
            'family_history' => 'required',
            'vital_signs' => 'required',
        ]);

        $history->update($request->all());

        return HistoryResource::make($history);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        $history->delete();

        return HistoryResource::make($history);
    }

    public function historyByPatient( $patientId ) {

        $histories = History::included()->where('patient_id', $patientId)->get();
        return HistoryResource::collection($histories);

    }
}
