@extends('layouts.admin')

@section('content')
    <div class="m-3 border-b-2 border-green-300 flex justify-between">
        <h1 class="text-3xl font-bold">
            Submissions
        </h1>
    </div>
    <div class="my-3 bg-white rounded-lg p-3">
        Task Title: {{ $task->task_name }} <br>
        Task Status: {{ $task->status }} <br>
        Description: {{ $task->description }} <br>



    </div>
    <div class="my-2 bg-slate-300 rounded-lg max-w-[300px] p-3 flex items-center">
        <svg class="max-h-[100px]" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path
                    d="M18.505 22H5.495C5.225 22 4.995 21.78 4.995 21.5V3.5C4.995 3.23 5.215 3 5.495 3H18.505C18.775 3 19.005 3.22 19.005 3.5V21.51C18.995 21.78 18.775 22 18.505 22Z"
                    stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12.995 19H15.995" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.995 10H14.995" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.995 12H14.995" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.995 8H15.995" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.995 6H15.995" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.995 14H13.425" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </g>
        </svg>
        <div class="m-1">
            <span class="text-3xl font-bold">
                {{ $submissions->count() }}
            </span> <br>

            <span class="font-bold text-lg text-gray-500">
                Submissions
            </span>
        </div>



    </div>
    {{-- Comment Modal --}}


    <!-- Modal toggle -->


    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Comments
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    {{-- POST COMMETS --}}
                    <form action="{{ route('task-details', $task->id) }}" method="post" id="postComments">
                        @csrf
                        <input type="text" hidden id="submission_id" name="id">
                        <div class="mb-6">
                            <label for="large-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment</label>
                            <input type="text" id="comments" name="comment"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="document.getElementById('postComments').submit()" data-modal-hide="static-modal"
                        type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Post Comment
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Upate FORM --}}
    <form action="" method="post" hidden id="updateForm">
        @csrf
        @method('patch')
        <input type="text" hidden name="id" id="submission_id">
        <input type="text" hidden name="status" id="submission_status">
    </form>



    <div class="bg-white my-1 rounded-lg p-3">
        <ul>
            @foreach ($submissions as $submission)
                <li class="flex justify-between">
                    <div class="p-2">

                        <span class="font-bold text-2xl">
                            Name: {{ $submission->firstname }} {{ $submission->lastname }}
                        </span> <br>
                        <span class="text-xl">
                            Date Submitted: {{ date_format($submission->created_at, 'M d, Y') }}
                        </span> <br>
                        <span class="text-lg">
                            Status: {{ $submission->status }}
                        </span>

                    </div>"
                    <div class="p-2 flex flex-col gap-4">


                        @if ($submission->file)
                            <button onclick="window.location.href= '{{ route('download-file', $submission->file) }}'"
                                class="bg-blue-400 rounded-md px-2 py-1">Download Submitted File</button>
                        @endif

                        <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                            class="bg-green-400 rounded-md px-2 py-1" onclick="commentModal({{ $submission->id }})">
                            Add Comment
                        </button>
                        <button onclick="updateSubmission('reject',{{ $submission->id }})"
                            class="bg-red-600 text-white rounded-md px-2 py-1">
                            Reject
                        </button>
                        <button onclick="updateSubmission('accept',{{ $submission->id }})"
                            class="bg-green-600 text-white rounded-md px-2 py-1">
                            Accept
                        </button>
                    </div>

                </li>
            @endforeach

        </ul>
    </div>

    <script>
        function commentModal(id) {
            document.getElementById('submission_id').value = id;

        }
    </script>
@endsection
