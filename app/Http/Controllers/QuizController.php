<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizScore;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function check_quizzes($quizzes)
    {
        foreach ($quizzes as $quiz) {
            $is_quiz_taken = QuizScore::where('quiz_id', $quiz->id)
                ->where('user_id', auth()->id())
                ->exists();

            if ($is_quiz_taken) {
                $quiz['is_taken'] = false;
            } else {
                $quiz['is_taken'] = true;
            }
        }
    }

    public function empty_quizzes()
    {
        return Quiz::with('user')->with('quiz_scores')->where('title', 'like', '%' . request()->search . '%')
            ->orWhere('description', 'like', '%' . request()->search . '%')->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = "";
        if (auth()->check()) {
            $quizzes = Quiz::where('user_id', "=", auth()->id())->with('quiz_scores')->where('title', 'like', '%' . request()->search . '%')
                ->orWhere('description', 'like', '%' . request()->search . '%')->get();
            // dd($quizzes);

            if ($quizzes) {
                $quizzes = self::empty_quizzes();
            }

            self::check_quizzes($quizzes);
        } else {
            $quizzes = self::empty_quizzes();
            // dd(Quiz::with('user')->with('quiz_scores')->get());

            self::check_quizzes($quizzes);
        }

        return view('quizzes.index', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

        $user_id = auth()->id();

        $quiz = Quiz::create([
            'title' => request()->input('title'),
            'description' => request()->input('description'),
            'user_id' => $user_id,
        ]);


        // Iterate over the questions data
        foreach (request()->input('questions') as $questionData) {
            $question = $quiz->questions()->create([
                'question' => $questionData['question'],
                'correct_option' => $questionData['correct_option'],
            ]);

            $count = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option' => $count,
                    'description' => $optionData,
                    'is_correct' => $count == $questionData['correct_option'] ? true : false,
                ]);

                $count++;
            }
        }

        return redirect(route('quizzes.index'))->with('message', 'Quiz created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('questions.options'); // Eager load questions and options

        // dd($quiz);

        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Store and verify the submitted quiz data
     */
    public function submit(Quiz $quiz)
    {
        $selected_answers = request()->input('answers');
        $questions = $quiz->questions()->with('options')->get();
        $score = 0;

        foreach ($questions as $question) {
            $correct_option = $question->options()->where('is_correct', true)->first();

            if (isset($selected_answers[$question->id]) && $selected_answers[$question->id] == $correct_option->id) {
                $score++;
            }
        }

        QuizScore::create([
            'score' => $score,
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id()
        ]);

        return redirect(route('quizzes.index'))->with('message', 'Quiz answered successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}
