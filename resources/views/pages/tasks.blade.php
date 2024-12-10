@extends('layouts.app')

@section('head')
    <style>
    </style>
@endsection
@section('content')
    <div class="m-5 border-b-black border-b-2 py-2">
        <p class="text-3xl font-extrabold ">My Tasks</p>
    </div>
    <div class="w-full my-5 bg-white p-3 rounded-lg">
        <div class="mb-2">
            <h2 class="text-2xl font-bold">
                Task Overview
            </h2>


        </div>

        <div class="my-3 px-5">
            <ul>
                @foreach ($tasks as $task)
                    <li class="flex">
                        <div class="basis-3/4">
                            <h3 class="text-xl">

                                {{ $task->task_name }}
                            </h3>

                            <span class="text-gray-400">
                                Date Assigned:
                                {{ $task->start_date }}
                            </span><br>
                            <span class="text-gray-400">
                                Due Date:
                                {{ $task->end_date }}
                            </span><br>
                            @if ($task->status == 'ongoing')
                                <span class="text-yellow-400">
                                    This task has not been submitted yet.
                                </span>
                            @endif
                            @if ($task->status == 'submitted')
                                <span class="text-green-400">
                                    This task has been submitted
                                </span>
                            @endif
                            @if ($task->status == 'overdue')
                                <span class="text-red-400">
                                    This task is past its deadline
                                </span>
                            @endif
                        </div>
                        <div class="basis-1/4 flex justify-center items-center">
                            <button onclick="window.location.href = '{{ route('task-detail', $task->id) }}'"
                                class="px-4 py-2 rounded-lg bg-green-600 hover:bg-green-800 transition-all text-white ">
                                View Task
                            </button>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>

    </div>
@endsection
