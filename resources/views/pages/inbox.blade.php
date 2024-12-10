@extends('layouts.app')

@section('content')
    <div class="m-3 border-b-2 border-green-300">
        <h1 class="text-3xl font-bold">
            Inbox
        </h1>
    </div>
    <div class="mb-3">

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
                        Date Created: {{ $notif->created_at }}
                    </div>
                </li>
            @endforeach

        </ul>
    </div>
@endsection
