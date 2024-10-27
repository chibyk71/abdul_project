<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the exam with the provided examId
        $exam = Exam::findOrFail(request('examId'));

        // Get the paginated questions for the exam
        $questions = $exam->questions()
            ->select('id', 'question', 'a', 'b', 'c', 'd') // Specify fields except 'answer'
            ->inRandomOrder()
            ->limit(50)->get();

        // Return the Inertia view and pass the questions as a prop
        return Inertia::render('Questions', [
            'questions' => $questions,  // Return as an array
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'a' => 'required|string|max:255',
            'b' => 'required|string|max:255',
            'c' => 'required|string|max:255',
            'd' => 'required|string|max:255',
            'answer' => 'required|string|in:a,b,c,d', // assuming the answer must be one of the options
            'exam_id' => 'required|exists:exams,id',  // exam_id must exist in the exams table
        ]);

        Question::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        Gate::authorize('is_admin');

        Inertia::render('Create/AddQuestion');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Question $question)
    {
        Gate::authorize('is_admin');

        Inertia::render('Create/AddQuestion', [
            'edit' => true,
            'question' => $question->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {

        Gate::allowIf(fn() => request()->user()->isAdmin());

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'a' => 'required|string|max:255',
            'b' => 'required|string|max:255',
            'c' => 'required|string|max:255',
            'd' => 'required|string|max:255',
            'answer' => 'required|string|in:a,b,c,d', // assuming the answer must be one of the options
            'exam_id' => 'required|exists:exams,id',  // exam_id must exist in the exams table
        ]);

        $question->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        Gate::allowIf(fn() => request()->user()->isAdmin());

        $question->delete();
    }
}
