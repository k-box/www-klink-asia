@extends('_layouts.pilot.master')

@section('pilotbody')

    <div class="hero h-third-screen flex items-center">
        <div class="container">
            @if($page->language('en'))
                <blockquote class="text-xl shadow-md pilot-quote block w-1/2 md:w-1/3 p-4"><strong>K-Link</strong><br/>Linking knowledge<br/>Sharing and Managing</br>information</blockquote>
            @elseif($page->language('ru'))
                <blockquote class="text-xl shadow-md pilot-quote block w-1/2 md:w-1/3 p-4"><strong>K-Link</strong><br/>Объединение знаний<br/>Совместный доступ и управление</br>информацией</blockquote>
            @endif
        </div>
    </div>
    
    @yield('content')
    
@endsection
