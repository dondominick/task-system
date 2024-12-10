@extends('layouts.admin')
@section('head')
@endsection
@section('content')
    <div class="m-3 border-b-2 border-green-300 flex justify-between">
        <h1 class="text-3xl font-bold">
            Home </h1>


    </div>
    <div class="flex ">
        <div class="mb-2 w-full">
            <div class="mb-2">
                <h1 class="text-xl font-bold bg-white p-2 rounded-lg">Welcome, Administrator</h1>

            </div>
            <div class="relative overflow-x-auto bg-white p-2">
                <span class="font-bold text-lg">
                    Task Progress

                </span>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Task NAME
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $task->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $task->task_name }}
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
                                    <button type="button" onclick="window.location.href = '{{ route('create-task') }}'"
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        View Task </button>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <div class="m-2 w-full max-w-[400px]" id="graphs">
            <h2 class="text-2xl font-bold">Graph</h2>
            <div class="bg-white rounded-lg p-4 my-2">
                <canvas id="myChart"></canvas>
            </div>
            <h2 class="text-2xl font-bold">Leaderboards</h2>
            <div class="my-4 bg-white rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Employee Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee as $user)
                            @php
                                $user = json_decode($user);
                            @endphp
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->dept_name }}
                                </td>
                                <td class="px-6 py-4">
                                    <button type="button" onclick="window.location.href = '{{ route('create-task') }}'"
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        View Task </button>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pass data from Laravel to JavaScript
        const labels = @json($labels);
        const data = @json($data);

        // Create the Chart.js chart
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie', // or 'bar', 'pie', 'doughnut', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: 'Task Status',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: ['rgba(75,192,192,0.1)', 'rgba(10,192,192,0.5)',
                        'rgba(20,192,192,1)'
                    ],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });
    </script>
@endsection
