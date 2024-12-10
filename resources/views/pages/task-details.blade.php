@extends('layouts.app')
@section('content')
    <div class="p-4 border-b-2 border-black">
        <div class="flex gap-5">
            <button onclick="window.location.href = '{{ route('tasks') }}'" class="bg-green-400 px-4 rounded-lg text-white">

                <i class="fa fa-arrow-left" aria-hidden="true"></i>

            </button>
            <h1 class="font-bold text-4xl">Task Overview</h1>

        </div>
    </div>


    @error('file')
        <div class="p-4 my-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Danger alert!</span> {{ $message }}
        </div>
    @enderror

    <div class="bg-white p-4 flex my-5 rounded-lg min-h-full ">
        <aside class="basis-1/4 flex flex-col justify-between max-w-[40%]">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">{{ $task->task_name }}</h2>
                <span class="text-gray-400">Start Date: {{ $task->start_date }}</span><br>
                <span class="text-gray-400">End Date: {{ $task->end_date }}</span><br>
            </div>


            <div class="basis-3/4 pe-9">
                <span class="font-bold">
                    Submissions
                </span>

                <ul>
                    <li id="fileSubmitted" class="bg-green-400 px-1 rounded-lg">
                    </li>
                </ul>


            </div>

        </aside>
        <div class="basis-3/4">
            <div class="mb-3 max-h-[35%] h-full">
                {{ $task->description }}
            </div>

            <div class="mb-3">
                <span class="font-bold text-lg"><i class="fa-solid fa-folder text-2xl mx-2"></i> File</span>
                <form class="flex items-center justify-center w-full h-[50%]" action="{{ route('task-detail', $task->id) }}"
                    id="submitTask" hidden method="post" enctype="multipart/form-data">

                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                    upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>


                        {{-- HIDDEN INPUTS --}}
                        <input id="dropzone-file" type="file" class="hidden" name="file" onchange="fileUpdate()" />
                        <input type="text" name="employee_id" value="{{ auth()->user()->id }}" hidden>
                        <input type="text" name="task_id" value="{{ $task->id }}" hidden>
                        @if ($task->require_submission)
                            <input type="text" name="require_submission" hidden id="require_submission" value="1">
                        @endif
                        <input type="text" name="status" value="submitted" hidden>
                        @csrf
                        <input type="text" name="file" hidden id="task_file" value="">

                    </label>
                </form>
                <div>

                    @if ($task->require_submission)
                        <p class="text-lg font-bold text-gray-600">This task requires file submission</p>
                    @endif

                </div>
                <button type="button" onclick="submitForm()"
                    class="my-5 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">


                    Submit</button>

            </div>


        </div>

    </div>
    @if ($comments)
        <div class="mb-3 bg-white rounded-lg p-2">
            <h3 class="text-2xl font-bold">Comments</h3>

            <div class="mb-3">
                <p class="italic">
                    {{ $comments->text }} - <span class="font-bold ">Admin</span>
                </p>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        function fileUpdate() {
            const file = document.getElementById('dropzone-file');
            document.getElementById('task_file').value = file.value;
            console.log('is working?');
            console.log(file.value)
            document.getElementById('fileSubmitted').textContent = file.files[0].name;
        }

        function submitForm() {
            document.getElementById('submitTask').submit();
        }
    </script>
@endsection
