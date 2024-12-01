@extends('layouts.app')
@section('content')
    <div class=" m-5 py-2 font-extrabold">
        <h1 class="text-5xl">Leave Request</h1>
    </div>



    <div class="">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date Filed </th>
                    <th scope="col" class="px-6 py-3">
                        Date Ended </th>
                    <th scope="col" class="px-6 py-3">
                        Reason </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @isset($request)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                    </tr>
                @endisset


            </tbody>
        </table>
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
