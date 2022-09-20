<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');

        $patients = Patient::orderBy('name', 'asc')
                ->when($search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->included()
                ->paginate(10);

        return PatientResource::collection($patients);
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
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'dni' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:patients',
            'phone' => 'required|numeric|digits:10',
            'birthday' => 'required|date'
        ]);

        $patient = Patient::create($request->all());

        return PatientResource::make($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::included()->findOrFail($id);
        return PatientResource::make($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'dni' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'phone' => 'required|numeric|digits:10',
            'birthday' => 'required|date'
        ]);

        $patient->update($request->all());

        return PatientResource::make($patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return PatientResource::make($patient);
    }
}
