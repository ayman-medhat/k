<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function show(): JsonResponse
    {
        $school = School::first();

        return response()->json([
            'data' => $school,
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $school = School::first();

        if (!$school) {
            $school = School::create($request->all());
        } else {
            $data = $request->validate([
                'nameEn' => 'sometimes|string|max:255',
                'nameAr' => 'sometimes|string|max:255',
                'address' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|email',
                'website' => 'nullable|string',
                'logo' => 'nullable|string',
                'principal_name' => 'nullable|string',
                'mission' => 'nullable|string',
                'vision' => 'nullable|string',
                'social_facebook' => 'nullable|string',
                'social_twitter' => 'nullable|string',
                'social_instagram' => 'nullable|string',
                'social_linkedin' => 'nullable|string',
                'established_year' => 'nullable|integer',
            ]);

            $school->update($data);
        }

        return response()->json([
            'message' => 'School updated successfully',
            'data' => $school->fresh(),
        ]);
    }
}
