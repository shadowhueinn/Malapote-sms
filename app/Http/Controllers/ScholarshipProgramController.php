<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipProgram;
use Illuminate\Http\Request;

class ScholarshipProgramController extends Controller
{
    public function index()
    {
        return response()->json(ScholarshipProgram::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string',
            'grant_amount' => 'required|numeric',
            'slots'        => 'required|integer',
            'deadline'     => 'required|date',
        ]);
        $program = ScholarshipProgram::create($request->all());
        return response()->json($program, 201);
    }

    public function show($id)
    {
        $program = ScholarshipProgram::findOrFail($id);
        return response()->json($program, 200);
    }

    public function update(Request $request, $id)
    {
        $program = ScholarshipProgram::findOrFail($id);
        $program->update($request->all());
        return response()->json($program, 200);
    }

    public function destroy($id)
    {
        ScholarshipProgram::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}