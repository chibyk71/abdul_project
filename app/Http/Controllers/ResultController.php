<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // The request contains selected options with question IDs as keys
        $userAnswers = $request->input('answers'); // Example: ['question_id' => 'selected_option']

        // Get all the question IDs from the user's answers
        $questionIds = array_keys($userAnswers);

        // Fetch all the questions with their correct answers in a single query
        $questions = Question::whereIn('id', $questionIds)->get(['id', 'answer']);

        // Initialize variables for results
        $correctAnswers = 0;
        $totalQuestions = $request->input('total');

        // Loop through the fetched questions and compare with user's answers
        foreach ($questions as $question) {
            if (isset($userAnswers[$question->id]) && $userAnswers[$question->id] === $question->answer) {
                // Correct answer
                $correctAnswers++;
            }
        }

        // Calculate the percentage score
        $score = ($correctAnswers / $totalQuestions) * 100;

        // Optionally store the result in the database
        Result::create([
            'student_id' => auth()->id(),
            'exam_id' => $request->exam,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
        ]);

        // Return the result to the frontend
        return response()->json([
            'message' => 'Exam completed successfully!',
            'score' => $score,
            'total' => $totalQuestions,
            'correct' => $correctAnswers,
        ]);
    }

    public function show()
    {
        // Get the exam with its associated course and any related results for the student
        $exams = Exam::with('course')
            ->whereHas('results', function ($query) {
                $query->where('student_id', auth()->user()->student->id);
            })
            ->get();

        // Map each exam to the expected output format
        $result = $exams->map(function ($exam) {
            // Attempt to get the student's result for this exam
            $studentResult = $exam->results()->where('student_id', auth()->user()->student->id)->first();

            return [
                'title' => $exam->course->course_title,               // Get course title
                'score' => $studentResult->score ?? 0,                // Default to 0 if no result
                'total' => $studentResult->total_questions ?? 0, // Default to 0 if no result
                'correct' => $studentResult->correct_answers ?? 0, // Default to 0 if no result
            ];
        });

        // Return as JSON
        return response()->json($result);

    }
}
