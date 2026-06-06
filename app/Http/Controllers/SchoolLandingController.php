<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolLandingController extends Controller
{
    public function index()
    {
        $school = School::first();

        if (!$school) {
            return view('welcome');
        }

        return view('school-landing', compact('school'));
    }
}
