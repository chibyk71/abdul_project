<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        // Assuming $students is a paginated collection of Student models
        $students = Student::with('department:id,department')->filter()->paginate(50);

        return Inertia::render('Students', [
            'students' => $students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'l_name' => $student->l_name,
                    'f_name' => $student->f_name,
                    'email' => $student->email,
                    'phone' => $student->phone,
                    'gender' => $student->gender,
                    'religion' => $student->religion,
                    'olevel' => $student->olevel,
                    'dob' => $student->dob,
                    'user_id' => $student->user_id,
                    'admission_number' => $student->admission_number,
                    'level' => $student->level,
                    'department' => [
                        'id' => $student->department->id,
                        'department' => $student->department->department,
                    ],
                ];
            }),
            'pagination' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'total' => $students->total(),
                'next_page_url' => $students->nextPageUrl(),
                'prev_page_url' => $students->previousPageUrl(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        return Inertia::render('Create/AddStudent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'l_name' => 'required|string|max:255',
            'f_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Ensure email is unique for users
            'phone' => 'required|string|max:15|unique:students,phone', // Ensure phone is unique for students
            'gender' => 'required|string|in:male,female,other', // Gender must be male, female, or other
            'religion' => 'nullable|string|max:50', // Optional field
            'olevel' => 'nullable|string|max:255', // Optional field for education or qualifications
            'dob' => 'required|date|before:today', // Ensure dob is valid and before today // Set role as 'student'
            'department_id' => 'required'
        ]);

        // Generate a unique admission number (this could be based on your logic, e.g., timestamp)
        $admissionNumber = $this->generateAdmissionNumber();

        // Create the corresponding user first
        $user = User::create([
            'name' => $validatedData['f_name'] . ' ' . $validatedData['l_name'], // Combine first and last name
            'email' => $validatedData['email'],
            'password' => bcrypt('password'), // Hash the password
            'role' => 'Student', // Set the role as 'student'
        ]);


        $validatedData['admission_number'] = $admissionNumber;
        // Now create the student with the user_id
        $student = Student::create($validatedData);

        return response()->json(['message' => 'Student created successfully!', 'student' => $student], 201);
    }

    private function generateAdmissionNumber()
    {
        // Generate a random unique admission number
        // You could change this logic to meet your specific requirements
        $currentYear = now()->year; // Get the current year
        $randomNumber = rand(1000, 9999); // Generate a random 4-digit number

        return 'ADM/' . $currentYear . '/' . $randomNumber;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        // Load the department relationship
        $student->load('department:id,department');

        return Inertia::render('Create/AddStudent', [
            "edit" => true,
            'student' => [
                'l_name' => $student->l_name,
                'f_name' => $student->f_name,
                'email' => $student->email,
                'phone' => $student->phone,
                'gender' => $student->gender,
                'religion' => $student->religion,
                'olevel' => $student->olevel,
                'dob' => $student->dob,
                'id' => $student->id,
                'department' => [
                    'id' => $student->department->id,
                    'department' => $student->department->department,
                ],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        // Validate the incoming request
        $validatedData = $request->validate([
            'l_name' => 'required|string|max:255',
            'f_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Ensure email is unique for users
            'phone' => 'required|string|max:15|unique:students,phone', // Ensure phone is unique for students
            'gender' => 'required|string|in:male,female,other', // Gender must be male, female, or other
            'religion' => 'nullable|string|max:50', // Optional field
            'olevel' => 'nullable|string|max:255', // Optional field for education or qualifications
            'dob' => 'required|date|before:today', // Ensure dob is valid and before today // Set role as 'student'
            'department_id' => 'required'
        ]);

        $student->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        $student->delete();
    }
}
