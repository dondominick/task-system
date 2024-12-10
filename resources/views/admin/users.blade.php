@extends('layouts.admin')
@section('content')
    <div class="m-3 border-b-2 border-green-300 flex justify-between">
        <h1 class="text-3xl font-bold">
            Users
        </h1>
        <div class="flex-1/2 ">
            <span class="text-black mx-2 text-xl">Add Users</span>
            <button data-modal-target="addUsers" data-modal-toggle="addUsers"
                class="bg-green-500 w-[60px] h-[40px] mb-3 rounded-full text-white hover:bg-green-300 transition-all ">
                <i class="fa-solid fa-plus"></i> </button>
        </div>

    </div>

    {{-- Alerts and Popovers --}}
    @if (session('unsuccessful'))
        <div id="alert-2"
            class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('unsuccessful') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    @session('success')
        <div id="alert-3"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endsession
    {{--  --}}
    <div class="w-full p-5 my-5">


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xl text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                    <tr class="gap-4 my-5 pb-4 ">
                        <th scope="col" class="pb-4  px-2 text-xl text-bolder text-black ">
                            <div class="p-2 border-2 rounded-2xl border-green-400">
                                Id No.

                            </div>
                        </th>
                        <th scope="col" class="pb-4 px-2 text-xl text-bolder text-black ">
                            <div class="p-2 border-2 rounded-2xl border-green-400">

                                Full Name
                            </div>
                        </th>
                        <th scope="col" class="pb-4  px-2 text-xl text-bolder text-black ">
                            <div class="p-2 border-2 rounded-2xl border-green-400">

                                Email
                            </div>
                        </th>
                        <th scope="col" class="pb-4  px-2 w-1/4">
                            <div class="p-2 border-2 rounded-2xl border-green-400">

                                Action
                            </div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-2 font-medium  text-gray-900 whitespace-nowrap ">
                                <div class="py-2 px-5 bg-white">
                                    {{ $user->id }}

                                </div>
                            </td>
                            <td scope="row" class="px-2 font-medium text-black whitespace-nowrap">
                                <div class="py-2 px-5 bg-white">

                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-2 font-medium text-black whitespace-nowrap">
                                <div class="py-2 px-5 bg-white">

                                    {{ $user->email }}
                                </div>
                            </td>

                            <td class="px-2 w-1/4">
                                <button type="button" onclick="updateUser({{ $user }})"
                                    data-modal-target="updateUsers" data-modal-toggle="updateUsers"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                                <button type="button" onclick="deleteForm({{ $user->id }})"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

    {{-- Hidden Forms   --}}
    {{-- Delete Form --}}
    <form action="{{ route('admin-users') }}" method="post" hidden id="deleteForm">
        @csrf
        @method('delete')
        <input type="text" name="userid" id="delete_user">
    </form>

    {{-- Update Modal --}}
    <div id="updateUsers" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Update Users
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="updateUsers">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('admin-users') }}" class="p-4 md:p-5 space-y-4" method="POST" id="updateUser">
                    @csrf
                    @method('patch')
                    <input type="text" hidden id="update_user" name="user_id">
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            First Name
                        </label>

                        <input type="text" id="update_fname" name="firstname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="First Name" />
                        @error('fname')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Last Name </label>

                        <input type="text" id="update_lname" name="lastname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Last Name" />
                        @error('lname')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>

                        <input type="text" id="update_email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Email Address" />
                        @error('email')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Department
                        </label>

                        <select id="update_dept" name="department_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Choose a Department</option>
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                            @endforeach

                        </select>
                        @error('department_id')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>



                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="updateUsers" type="button"
                        onclick="document.getElementById('updateUser').submit()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update
                    </button>
                    <button data-modal-hide="updateUsers" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Close</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Script for Modal --}}
    <script></script>
    {{-- Add Modal --}}
    <div id="addUsers" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white z-50 rounded-lg shadow  dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b-2 border-green-600 rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add Users
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="addUsers">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('admin-users') }}" class="p-4 md:p-5 space-y-4" method="POST" id="addUser">
                    @csrf
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            First Name
                        </label>
                        i
                        <input type="text" id="update_dept" name="firstname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="First Name" />
                        @error('fname')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Last Name </label>

                        <input type="text" id="update_dept" name="lastname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Last Name" />
                        @error('lname')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>

                        <input type="text" id="update_dept" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Email Address" />
                        @error('email')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Department
                        </label>

                        <select id="update_dept" name="department_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Choose a Department</option>
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                            @endforeach

                        </select>
                        @error('department_id')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Password
                        </label>

                        <input type="text" id="update_dept" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Password" />
                        @error('password')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>
                    <div class="mb-5">
                        <label for="update_dept" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Confirm Password
                        </label>

                        <input type="text" id="confirmation_password" name="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Confirm Password" />

                        @error('password_confirmation')
                            <small class="text-red-800 text-md text-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>



                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="addUsers" type="button"
                        onclick="document.getElementById('addUser').submit()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add User
                    </button>
                    <button data-modal-hide="addUsers" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateUser(obj) {
            const fname = document.getElementById('update_fname');
            const lname = document.getElementById('update_lname')
            document.getElementById('update_email').value = obj.email;

            fname.value = obj.firstname;
            lname.value = obj.lastname;

        }

        function deleteForm(id) {
            document.getElementById('delete_user').value = id;
            document.getElementById('deleteForm').submit();
        }
    </script>
@endsection
