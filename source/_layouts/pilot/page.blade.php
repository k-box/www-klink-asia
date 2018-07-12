@extends('_layouts.pilot.master')

@section('pilotbody')

    <div class="container content">

        @if($page->has('title'))
            <h1>{{ $page->title }}</h1>
        @endif

        @yield('content')
    </div>
    
@endsection

