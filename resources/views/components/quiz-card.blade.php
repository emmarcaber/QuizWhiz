@props(['quiz'])

<div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
    <div class="flex justify-between">
        <h5 class="mb-2 text-2xl font-medium leading-tight text-neutral-800s">
            {{ $quiz->title }}
        </h5>
        @auth
            {{-- @dd($quiz->quiz_scores) --}}
            @if ($quiz->is_taken)
                <p class="uppercase font-bold text-yellow-700 text-lg">Not taken</p>
            @else
                <p class="font-bold text-yellow-700 text-lg">{{ $quiz->quiz_scores[0]->score }} / 5 </p>
            @endif
        @endauth

    </div>

    <p class=" tracking-wide text-sm font-bold -mt-1 mb-3 text-laravel">{{ '@' }}{{ $quiz->user->username }}
    </p>
    <p class="mb-4 text-base text-neutral-600">
        {{ $quiz->description }}
    </p>
    <a href="{{ route('quizzes.show', $quiz->id) }}"
        class="inline-block mb-2 rounded bg-laravel px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
        Take Quiz
    </a>
</div>
