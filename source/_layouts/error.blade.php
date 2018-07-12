@extends('_layouts.master')

@section('body')

    <div class="container content min-h-64 py-16">

        @if($page->has('illustration'))
            @include('_svg.' . $page->illustration)
        @endif

        @yield('content')
    </div>

@endsection
