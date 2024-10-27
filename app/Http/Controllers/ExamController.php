<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        Gate::allowIf(function (User $user): bool {
            return $user != null;
        });

        $data = when(
            $user->isAdmin(),
            fn() => Exam::filter()
                ->with('course:id,course_code,course_title,department_id')
                ->paginate(50),
            fn() => Exam::whereHas('course', function ($query) use ($user) {
                $query->where('department_id', $user->student->department_id);
            })
                ->when(!request('level'), fn($query) => $query->where('level', $user->student->level))
                ->filter()
                ->with('course:id,course_code,course_title,department_id') // Eager load course details
                ->paginate(50)
                ->through(function ($exam) use ($user) {
                    // Calculate start and end times for the exam
                    $examStart = Carbon::parse($exam->date . ' ' . $exam->time);
                    $examWithGracePeriod = $examStart->copy()->addMinutes(30); // Add 30 minutes grace period
        
                    // Check if a result has been submitted for this exam and this student
                    $hasResult = Result::where('exam_id', $exam->id)
                        ->where('student_id', $user->student->id)
                        ->exists();

                    // Add the is_written property: true if the result exists or current time is more than 30 mins after the start
                    $exam->is_written = $hasResult || Carbon::now()->greaterThan($examWithGracePeriod);

                    // Also include the has_result property separately for use if needed
                    $exam->has_result = $hasResult;

                    // Add course details to the exam object
                    if ($exam->course) {
                        $exam->course = [
                            'id' => $exam->course->id,
                            'course_code' => $exam->course->course_code,
                            'course_title' => $exam->course->course_title,
                        ];
                    } else {
                        $exam->course = null; // Handle case where course may not exist
                    }

                    return $exam;
                })
        );



        return Inertia::render('Exams', compact('data'));
    }

    public function create()
    {
        Gate::authorize('is_admin');

        return Inertia::render('Create/AddExam');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::allowIf(function (User $user): bool {
            return $user->isAdmin();
        });

        $validated = $request->validate([
            'session' => 'required string',
            'date' => 'required string',
            'course_id' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'semester' => 'required',
            'level' => 'required'
        ]);

        Exam::create($validated);

    }

    public function edit(Exam $exam)
    {
        Gate::authorize('is_admin');

        // Load the course relationship
        $exam->load('course:id,course_code');

        return Inertia::render('Create/AddExam', [
            'edit' => true,
            'exams' => $exam->select(['id', 'session', 'date', 'time', 'duration', 'semester', 'level'])
                ->get() // Make sure to get the collection
                ->map(function ($exam) {
                    return [
                        'id' => $exam->id,
                        'session' => $exam->session,
                        'date' => $exam->date,
                        'time' => $exam->time,
                        'duration' => $exam->duration,
                        'semester' => $exam->semester,
                        'level' => $exam->level,
                        'course' => [
                            'id' => $exam->course->id,
                            'course_code' => $exam->course->course_code,
                        ],
                    ];
                })
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        Gate::allowIf(function (User $user): bool {
            return $user->isAdmin();
        });

        $validated = $request->validate([
            'session' => 'required string',
            'date' => 'required string',
            'course_id' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'semester' => 'required',
            'level' => 'required'
        ]);

        $exam->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
    }
}
