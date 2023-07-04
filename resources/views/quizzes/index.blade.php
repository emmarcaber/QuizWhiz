<x-layout>
    @auth
        @include('partials._search')
    @else
        @include('partials._hero')
        @include('partials._search')
    @endauth

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless (count($quizzes) == 0)
            @foreach ($quizzes as $quiz)
                <x-quiz-card :quiz="$quiz" />
            @endforeach
        @else
            <p>No quizzes found</p>
        @endunless
    </div>
</x-layout>
