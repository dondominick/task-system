@extends('layouts.admin')
@section('content')
    <div class="m-3 border-b-2 border-green-300">
        <h1 class="text-3xl font-bold">
            Leave Requests
        </h1>
    </div>
    <div class="w-full mx-5">
        <button type="button"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">All</button>
        <button type="button"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Pending</button>
        <button type="button"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Approved</button>
        <button type="button"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Declined</button>

    </div>
    <div>
        <ul class="my-3">
            @foreach ($requests as $request)
                <li class="flex bg-white p-3">
                    <div class="basis-3/4">
                        <h3 class="text-3xl font-bold mb-1">{{ $request->leave_title }}</h3>
                        <span class="text-gray-400">{{ $request->start_date }} - {{ $request->end_date }}</span><br>
                        <span class="text-gray-400">{{ $request->email }}</span><br>
                        Status: <span class="text-black capitalize">{{ $request->leave_status }}</span>
                        <br>
                    </div>
                    <div class="basis-1/4 gap-2 justify-center flex-col flex items-center">
                        <div class="w-full  flex justify-center">
                            <button onclick="viewModal({{ $request }})" data-modal-toggle="view-modal"
                                data-modal-target="view-modal"
                                class="bg-green-500 p-2 text-white text-lg rounded-lg w-full">
                                Open Request
                            </button>
                        </div>
                        <div class="w-full flex gap-3">
                            <button onclick="acceptRequest({{ $request->id }})"
                                class="p-1 rounded-lg basis-1/2 bg-green-700 text-white">
                                Approve
                            </button>
                            <button onclick="declineRequest({{ $request->id }})"
                                class="p-1 rounded-lg basis-1/2 bg-red-600 text-white">
                                Reject
                            </button>
                        </div>
                    </div>

                </li>
            @endforeach

        </ul>
    </div>
    {{-- Modal Viewing Leave Request --}}


    <!-- Modal toggle -->

    <!-- Main modal -->
    <div id="view-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Leave Request
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="view-modal">
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
                    <div class="mb-2 text-xl">
                        Title: <span class="font-bold" id="view-title">Sample</span>
                    </div>
                    <div class="mb-2 text-xl">
                        From: <span class="font-bold" id="view-user">Patricia Cabelin</span>
                    </div>
                    <div class="mb-2 text-xl">
                        Email: <span class="font-bold" id="view-email">sample@gmail.com</span>
                    </div>
                    <div class="mb-2 text-xl">
                        Status: <span class="font-bold" id="view-status">Pending</span>
                    </div>
                    <div class="mb-2 text-lg">
                        <p class="font-light" id="view-text">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit doloremque quibusdam autem est
                            natus eum numquam aliquid maiores. Reiciendis reprehenderit molestiae et officiis aperiam nulla
                            possimus porro laboriosam distinctio libero?
                        </p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

                    <button data-modal-hide="view-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Update Leave Request --}}
    <form action="{{ route('admin-request') }}" hidden id="requestUpdate" method="POST">
        @csrf
        @method('patch')
        <input type="text" hidden id="request_id" name="request_id">
        <input type="text" hidden id="request_status" name="request_status">
    </form>
@endsection
@section('scripts')
    <script>
        function viewModal(obj) {
            document.getElementById('view-email').textContent = obj.email;
            document.getElementById('view-title').textContent = obj.leave_title;
            document.getElementById('view-status').textContent = obj.leave_status;
            document.getElementById('view-user').textContent = obj.firstname + " " + obj.lastname;
            document.getElementById('view-text').textContent = obj.leave_text;

        }

        function acceptRequest(id) {
            console.log('accepted');
            document.getElementById('request_id').value = id;
            document.getElementById('request_status').value = "approved";
            document.getElementById('requestUpdate').submit();
        }

        function declineRequest(id) {
            console.log('rejected')
            document.getElementById('request_id').value = id;
            document.getElementById('request_status').value = "rejected";
            document.getElementById('requestUpdate').submit();
        }
    </script>
@endsection
