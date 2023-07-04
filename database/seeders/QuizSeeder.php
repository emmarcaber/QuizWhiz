<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Create a user
        $user = User::create([
            'username' => 'emmarcaber',
            'name' => 'Emmar Caber',
            'email' => 'caberemmar@example.com',
            'password' => bcrypt('password123'), // Include a password field
        ]);

        // Create a quiz
        $quiz = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Sample Quiz',
            'description' => 'The quick brown fox jumps over the lazy dog.'
        ]);

        // Generate 10 questions
        for ($i = 1; $i <= 5; $i++) {
            $correct_option = fake()->randomElement([1, 2, 3]);
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => "Question {$i}",
                'correct_option' => $correct_option,
            ]);

            for ($j = 1; $j <= 3; $j++) {
                Option::create([
                    'question_id' => $question->id,
                    'option' => $j,
                    'description' => "Option {$j} for Question {$i}",
                    'is_correct' => $j == $correct_option ? true : false,
                ]);
            }
        }
    }
}
