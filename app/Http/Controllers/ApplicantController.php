<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        return response()->json(Applicant::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'email'          => 'required|email|unique:applicants',
            'contact_number' => 'required|string',
            'address'        => 'required|string',
            'birthdate'      => 'required|date',
            'school'         => 'required|string',
            'course'         => 'required|string',
            'gpa'            => 'required|numeric',
        ]);
        $applicant = Applicant::create($request->all());
        return response()->json($applicant, 201);
    }

    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);
        return response()->json($applicant, 200);
    }

    public function update(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);
        $request->validate([
            'first_name'     => 'sometimes|required|string',
            'last_name'      => 'sometimes|required|string',
            'email'          => 'sometimes|required|email|unique:applicants,email,' . $applicant->id,
            'contact_number' => 'sometimes|required|string',
            'address'        => 'sometimes|required|string',
            'birthdate'      => 'sometimes|required|date',
            'school'         => 'sometimes|required|string',
            'course'         => 'sometimes|required|string',
            'gpa'            => 'sometimes|required|numeric',
        ]);
        $applicant->update($request->all());
        return response()->json($applicant, 200);
    }

    public function applications($id)
    {
        $applicant = Applicant::with(['applications.scholarshipProgram'])->findOrFail($id);
        return response()->json($applicant, 200);
    }

    public function destroy($id)
    {
        Applicant::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}