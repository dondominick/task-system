@extends('layouts.app')
@section('content')
    <div class="m-3 border-b-2 border-green-300">
        <h1 class="text-3xl font-bold">
            Leave Requests
        </h1>
    </div>


    <div class="mx-auto p-3">

        @foreach ($request as $request)
            <div class="my-2 bg-white p-2 rounded-lg">
                <span class="font-bold text-2xl">Title: {{ $request->leave_title }}</span><br>
                <span class="font-bold text-2xl">Status: {{ $request->leave_status }}</span> <br>
                <span class="font-bold text-2xl">Start Date: {{ $request->start_date }}</span> <br>
                <span class="font-bold text-2xl">End Date: {{ $request->end_date }}</span><br>
                <span class="text-lg font-bold">Date Requested: {{ $request->created_at }} </span><br>

                <span class="text-lg font-bold">Reason for Leave Request:</span><br>
                <p class="px-2 py-1 text-justify">
                    {{ $request->leave_text }}
                </p>

            </div>
        @endforeach

        @empty($request)
            <p class="text-gray-500 text-2xl w-full text-center my-6">
                You haven't made a request yet
            </p>
        @endempty
    </div>
    <button onclick="window.location.href = '{{ route('create-leave') }}'"
        class="fixed bottom-0 end-0 m-10 w-[60px] h-[60px] z-50 transition-all duration-75  bg-transparent hover:w-[70px] hover:h-[70px]">
        <img src="{{ asset('assets/images/plus.png') }}" alt="plus">
    </button>
@endsection
