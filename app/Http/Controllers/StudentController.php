<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students
    public function index(Request $request)
    {
        $students=Student::all();
        if ($request->ajax()) {
            return view('partials.table', compact('students'));
        }
        return view('index', compact('students'));
    }

    // Show the form to create a new student
    public function create()
    {
        return view('create');
    }

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);

        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('index')->with('success', 'Student added successfully!');
    }
    public function filter(Request $request)
    {
        $search = $request->get('search');
        $minAge = $request->get('min_age');
        $maxAge = $request->get('max_age');
    
        $students = Student::query();
    
        // Apply search filter
        if ($search) {
            $students->where('name', 'like', '%' . $search . '%');
        }
    
        // Apply age range filter
        if ($minAge) {
            $students->where('age', '>=', $minAge);
        }
        if ($maxAge) {
            $students->where('age', '<=', $maxAge);
        }
    
        // Get the filtered students
        $students = $students->get();
    
        return view('partials.table', compact('students'));
    }
    



    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
