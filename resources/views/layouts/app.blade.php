@extends('layouts.base')

@section('body')
    <div class="flex flex-col min-h-screen">
        <x-nav/>
        <div class="flex-grow">
            @yield('content')

            @isset($slot)
                {{ $slot }}
            @endisset
        </div>
        <x-footer/>
    </div>
@endsection
