@extends('layouts.admin')
@section('content')
    <div class="p-4 border-b-2 border-black">
        <h1 class="font-bold text-4xl">Task Overview</h1>
    </div>

    <div class="p-4">
        <div class="flex justify-between mb-2">
            <h1 class="text-2xl font-bold">
                Task Progress
            </h1>
            <button type="button" onclick="window.location.href = '{{ route('create-task') }}'"
                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Add Task </button>

        </div>



        <div class="relative overflow-x-auto shadow-md sm:rounded-lg overflow-y-scroll max-h-100vh">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="max-w-[50px] px-2 py-3">
                            Task No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Task Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-2 text-center py-4 max-w-[50px] font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $task->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $task->task_name }}
                            </td>
                            <td class="px-4 py-4 capitalize">
                                {{ $task->start_date }} - {{ $task->end_date }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ $task->status }}

                            </td>
                            <td class="px-6 py-4">
                                <button type="button"
                                    onclick="window.location.href = '{{ route('task-details', $task->id) }}'"
                                    class="bg-green-700 px-4 rounded-lg p-2 font-medium text-white hover:bg-blue-500 transition-all  ">View</button>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
