<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user(); // Assuming you get the current user like this

        // Base query
        $query = Course::query()->filter();

        // Apply department and level filters for non-admin users
        if (!$user->isAdmin()) {
            $query->where('department_id', $user->student->department_id)
                ->when(request()->input('level'), function ($query) use ($user) {
                    return $query->where('level', $user->student->level);
                });
        }

        // Paginate the results
        $courses = $query->with('department:id,department')->paginate(50);

        // Format the returned data
        $formattedData = $courses->map(function ($course) {
            return [
                'id' => $course->id,
                'course_code' => $course->course_code,
                'course_title' => $course->course_title,
                'lecturer' => $course->lecturer,
                'department' => [
                    'id' => $course->department->id,
                    'department' => $course->department->department
                ],
                'level' => $course->level,
            ];
        });

        // Return the formatted data with pagination metadata
        return Inertia::render('Course', [
            'courses' => $formattedData,
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('is_admin');

        return Inertia::render('Create/AddSubject');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => "required string",
            'course_title' => "required string",
            'lecturer' => 'required string',
            'department_id' => "required ",
        ]);

        Course::create($validated);

        return redirect()->back()->withInput();
    }

    public function fetch() {
        return response()->json(['data'=>Course::filter()->get(['id','course_code'])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        Gate::authorize('is_admin');

        // Load the department relationship
        $course->load('department');

        return Inertia::render('Create/AddSubject', [
            "edit" => true,
            'course' => $course->only(['course_code', 'course_title', 'lecturer', 'id']) + [
                'department' => $course->department->only(['id', 'department'])
            ]
        ]);
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => "required string",
            'course_title' => "required string",
            'lecturer' => 'required string',
            'department_id' => "required",
        ]);

        $course->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
    }
}
