<x-layout>
    <x-card class="p-10 max-w-5xl mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                CREATE QUIZ
            </h2>
            <p class="mb-4">Post a quiz for others to answer</p>
        </header>

        <form action="{{ route('quizzes.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" id="title"
                    placeholder="Ex. Planets" required />
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Description</label>
                <textarea class="block border border-gray-200 rounded p-2 w-full resize-none" id="description" name="description"
                    placeholder="Ex. This is a quiz on how well you know the planets." rows="3"></textarea>
            </div>

            @for ($i = 1; $i <= 5; $i++)
                <div class="mb-6">
                    <label for="question" class="inline-block text-lg mb-2">Question {{ $i }}</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full"
                        name="questions[{{ $i }}][question]" placeholder="Ex. What is Earth?" required />

                    <div class="flex flex-wrap -mx-2 my-3">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                OPTION 1
                            </label>
                            <input name="questions[{{ $i }}][options][1]"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-black"
                                id="grid-first-name" type="text" placeholder="Ex. Planet" required>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                OPTION 2
                            </label>
                            <input name="questions[{{ $i }}][options][2]"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-black"
                                id="grid-first-name" type="text" placeholder="Ex. Star" required>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                OPTION 3
                            </label>
                            <input name="questions[{{ $i }}][options][3]"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-black"
                                id="grid-first-name" type="text" placeholder="Ex. Comet" required>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                Correct Answer
                            </label>
                            <div class="relative">
                                <select name="questions[{{ $i }}][correct_option]" required
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-state" required>
                                    <option selected disabled>Select Correct Answer</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Create Quiz
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
