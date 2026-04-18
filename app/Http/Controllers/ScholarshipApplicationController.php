<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipApplication;
use Illuminate\Http\Request;

class ScholarshipApplicationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Only students may view their own applications.'], 403);
        }

        $applications = ScholarshipApplication::where('user_id', $user->id)->latest()->get();

        return response()->json($applications, 200);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Only students may submit applications.'], 403);
        }

        $data = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'maiden_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'sex' => 'required|in:male,female,other',
            'civil_status' => 'required|in:single,married,widowed,separated,other',
            'contact_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'street' => 'nullable|string|max:500',
            'street_address' => 'nullable|string|max:500',
            'barangay' => 'nullable|string|max:255',
            'municipality' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'school_id' => 'nullable|string|max:100',
            'year_level' => 'nullable|string|max:100',
            'tribal_membership' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'household_income' => 'nullable|numeric|min:0',
            'is_indigent' => 'required|boolean',
            'has_cor' => 'required|boolean',
        ]);

        if (empty($data['street']) && !empty($data['street_address'])) {
            $data['street'] = $data['street_address'];
        }

        unset($data['street_address']);

        $application = ScholarshipApplication::create(array_merge($data, [
            'user_id' => $user->id,
            'status' => 'pending',
        ]));

        return response()->json($application, 201);
    }

    public function show(Request $request, $id)
    {
        $application = ScholarshipApplication::findOrFail($id);
        $user = $request->user();

        if ($user->role === 'student' && $application->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized to view this application.'], 403);
        }

        return response()->json($application, 200);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        $application = ScholarshipApplication::findOrFail($id);

        if ($user->role === 'student' && $application->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized to update this application.'], 403);
        }

        if ($user->role === 'secretary' && $application->user_id !== $user->id) {
            return response()->json(['message' => 'Secretaries may only change status, not edit applications.'], 403);
        }

        if ($user->role === 'student') {
            $data = $request->validate([
                'last_name' => 'sometimes|required|string|max:255',
                'first_name' => 'sometimes|required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'maiden_name' => 'nullable|string|max:255',
                'birthdate' => 'sometimes|required|date',
                'sex' => 'sometimes|required|in:male,female,other',
                'civil_status' => 'sometimes|required|in:single,married,widowed,separated,other',
                'contact_number' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'street' => 'nullable|string|max:500',
                'street_address' => 'nullable|string|max:500',
                'barangay' => 'nullable|string|max:255',
                'municipality' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'region' => 'nullable|string|max:255',
                'school_id' => 'nullable|string|max:100',
                'year_level' => 'nullable|string|max:100',
                'tribal_membership' => 'nullable|string|max:255',
                'father_name' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'household_income' => 'nullable|numeric|min:0',
                'is_indigent' => 'sometimes|boolean',
                'has_cor' => 'sometimes|boolean',
            ]);

            if (empty($data['street']) && !empty($data['street_address'])) {
                $data['street'] = $data['street_address'];
            }

            unset($data['street_address']);
            $application->update($data);

            return response()->json($application, 200);
        }

        if ($user->role === 'admin') {
            $data = $request->validate([
                'last_name' => 'sometimes|required|string|max:255',
                'first_name' => 'sometimes|required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'maiden_name' => 'nullable|string|max:255',
                'birthdate' => 'sometimes|required|date',
                'sex' => 'sometimes|required|in:male,female,other',
                'civil_status' => 'sometimes|required|in:single,married,widowed,separated,other',
                'contact_number' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'street' => 'nullable|string|max:500',
                'street_address' => 'nullable|string|max:500',
                'barangay' => 'nullable|string|max:255',
                'municipality' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'region' => 'nullable|string|max:255',
                'school_id' => 'nullable|string|max:100',
                'year_level' => 'nullable|string|max:100',
                'tribal_membership' => 'nullable|string|max:255',
                'father_name' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'household_income' => 'nullable|numeric|min:0',
                'is_indigent' => 'sometimes|boolean',
                'has_cor' => 'sometimes|boolean',
                'status' => 'sometimes|required|in:pending,approved,rejected',
                'remarks' => 'sometimes|nullable|string|max:2000',
            ]);

            if (empty($data['street']) && !empty($data['street_address'])) {
                $data['street'] = $data['street_address'];
            }

            unset($data['street_address']);
            $application->update($data);

            return response()->json($application, 200);
        }

        return response()->json(['message' => 'Unable to process the update.'], 403);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $application = ScholarshipApplication::findOrFail($id);

        if ($user->role === 'student' && $application->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized to delete this application.'], 403);
        }

        if ($user->role === 'secretary') {
            return response()->json(['message' => 'Secretaries cannot delete applications.'], 403);
        }

        $application->delete();

        return response()->json(['message' => 'Application deleted successfully.'], 200);
    }

    public function indexAll(Request $request)
    {
        $query = ScholarshipApplication::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        return response()->json($query->get(), 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'remarks' => 'sometimes|nullable|string|max:2000',
        ]);

        $application = ScholarshipApplication::findOrFail($id);
        $application->update($request->only(['status', 'remarks']));

        return response()->json($application->load(['user']), 200);
    }
}
