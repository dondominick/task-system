@extends('layouts.app')


@section('content')
    <div class="m-3 border-b-2 border-green-300">
        <h1 class="text-3xl font-bold">
            Home
        </h1>
    </div>
    <div class="flex min-h-screen">
        <div class="basis-3/5 min-h-full">

            <div class="table">
                <span class="text-2xl font-bold">Task Progress</span>
                <table class="my-2">
                    <tr class="border-2 border-y-black">
                        <th class="px-2 py-4">#</th>
                        <th class="px-6-py-4">Task</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                    @foreach ($tasks->take(4) as $task)
                        <tr>
                            <td class="px-2 py-4">{{ $task->id }} </td>
                            <td class="px-6 py-4">
                                {{ $task->task_name }}
                                <br>
                                <span class="text-sm text-gray-400">Due Date: {{ $task->end_date }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($task->status == 'In Progress')
                                    <span class="bg-yellow-400 p-2 rounded-lg text-white capitalize">
                                        In Progress
                                    </span>
                                @endif
                                @if ($task->status == 'pending')
                                    <span class="bg-red-700 p-2 rounded-lg text-white capitalize">

                                        Pending
                                    </span>
                                @endif
                                @if ($task->status == 'completed')
                                    <span class="bg-green-700 p-2 rounded-lg text-white capitalize">

                                        Completed

                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="window.location.href = '{{ route('task-detail', $task->id) }}'"
                                    class="bg-green-700 text-white px-6 py-1 rounded-xl">View Task</button>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

            <div class="my-3  bg-slate-300 opacity-85 rounded-xl flex items-center gap-8 p-5 ">
                <svg class="max-h-[150px] object-cover
                " fill="#28a207" viewBox="0 0 16 16"
                    xmlns="http://www.w3.org/2000/svg" stroke="#28a207">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M0 10l8 4 8-4v2l-8 4-8-4v-2zm0-4l8 4 8-4v2l-8 4-8-4V6zm8-6l8 4-8 4-8-4 8-4z"
                            fill-rule="evenodd"></path>
                    </g>
                </svg>
                <p class="text-lg text-gray-600 font-bold">
                    <span class="text-3xl font-bold text-black">{{ $tasks->count() }}</span>
                    <br> Total Tasks

                </p>
            </div>

        </div>
        <div class="basis-2/5  min-h-full">
            <h2 class="text-xl font-bold">Notifications</h2>
            <div class="mt-4">
                <ul class="mb-2">
                    @foreach ($notifications as $notif)
                        <li class="bg-white  justify-between rounded-lg py-3 px-4 flex items-center gap-5 h-[130px] ">

                            <div class=" overflow-hidden max-h-[90%] py-2">
                                <span class="text-lg font-bold">{{ $notif->notif_title }}</span> <br>
                                <p class="text-justify text-sm text-slate-500">
                                    {{ $notif->notif_summary }}
                                </p>

                            </div>
                            <div class="">
                                <i class="fa fa-arrow-circle-right text-3xl" aria-hidden="true"></i>
                            </div>

                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
@endsection
