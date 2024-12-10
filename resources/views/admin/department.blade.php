@extends('layouts.admin')


@section('content')
    <div class="m-3 border-b-2 border-green-300 flex justify-between">
        <h1 class="text-3xl font-bold">
            List of Departments
        </h1>
        <div class="flex-1/2 ">
            <span class="text-black mx-2">Add Departments</span>
            <button data-modal-target="addDepartment" data-modal-toggle="addDepartment"
                class="bg-green-500  text-white w-[60px] h-[40px] mb-3 rounded-full hover:bg-green-300 transition-all ">
                <i class="fa-solid fa-plus"></i> </button>
        </div>

    </div>
    <div class="w-full p-5 my-5">


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xl text-bolder text-black ">
                            Department name
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/4">
                            Action </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($dept as $dept)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $dept->dept_name }}
                            </th>
                            <td class="px-6 py-4 w-1/4">
                                <button type="button" onclick="updateForm({{ $dept }})"
                                    data-modal-target="updateDepartment" data-modal-toggle="updateDepartment"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                                <button type="button" onclick="deleteForm({{ $dept->id }})"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    {{-- Hidden Forms --}}
    {{-- Delete Form --}}
    <form action="{{ route('department') }}" hidden method="post" id="deleteForm">
        @csrf
        @method('delete')
        <input type="text" name="dept_id" id="delete_dept">
    </form>

    {{-- Update Form --}}



    <!-- Add modal -->
    <div id="addDepartment" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add Department
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="addDepartment">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('department') }}" class="p-4 md:p-5 space-y-4" method="POST" id="addDept">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Department Name
                        </label>
                        <input type="text" id="dept_text" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Department Name" />
                    </div>


                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="addDepartment" type="button"
                        onclick="document.getElementById('addDept').submit()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add Department
                    </button>
                    <button data-modal-hide="addDepartment" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="updateDepartment" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Update Department
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="updateDepartment">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('department') }}" class="p-4 md:p-5 space-y-4" method="POST" id="updateDept">
                    @csrf
                    @method('patch')
                    <input type="text" name="dept_id" hidden id="dept_id">
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Department Name
                        </label>

                        <input type="text" id="update_dept" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Department Name" />
                    </div>


                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="updateDepartment" type="button"
                        onclick="document.getElementById('updateDept').submit()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update
                    </button>
                    <button data-modal-hide="updateDepartment" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Script for Hidden Forms --}}
    <script>
        function deleteForm(id) {
            console.log('is working');
            const form = document.getElementById('deleteForm');
            const deletex = document.getElementById('delete_dept');

            deletex.value = id;
            form.submit();
        }

        function updateForm(obj) {
            console.log('Hello world');

            const update = document.getElementById('update_dept');
            const form = document.getElementById('updateForm');
            const id = document.getElementById('dept_id');

            id.value = obj.id;
            update.value = obj.name;
        }
    </script>
    {{-- end of code block --}}
@endsection
