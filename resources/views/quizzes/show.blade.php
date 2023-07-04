<x-layout>

    <x-card class="w-3/4 mx-auto">
        <h1 class="text-3xl font-bold text-center">{{ $quiz->title }}</h1>
        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="post">
            @csrf

            @foreach ($quiz->questions as $question)
                <div class="my-4 ml-4 border-b-2 border-slate-400 p-2">
                    <h3 class="text-lg font-medium">{{ $loop->index + 1 }}. {{ $question->question }}</h3>

                    @foreach ($question->options as $option)
                        <div class="flex items-center my-2">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                class="mr-2 h-4 w-4" id="question-{{ $question->id }}-{{ $option->id }}" required>
                            <label
                                for="question-{{ $question->id }}-{{ $option->id }}">{{ $option->description }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="mb-6">
                <button type="submit" class="bg-yellow-300 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded">
                    Submit
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
