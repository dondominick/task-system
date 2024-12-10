@extends('layouts.admin')

@section('content')
    <div class="p-2 border-b-2 mx-3 border-green-400">
        <h1 class="text-3xl">

            Notification
        </h1>
    </div>
    <div class="my-3">
        <ul>
            @foreach ($notifications as $notif)
                <li class="bg-white p-4 rounded-lg">
                    <span class="font-bold text-2xl">
                        Title: {{ $notif->notif_title }}

                    </span>
                    <p class="text-gray-800 px-3">
                        {{ $notif->notif_body }}
                    </p>
                    <div class="w-full text-sm text-right mt-3 text-gray-400">
                        Date Created: {{ date_format($notif->created_at, 'M d, Y') }}
                    </div>
                </li>
            @endforeach

        </ul>
    </div>
@endsection
