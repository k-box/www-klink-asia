@extends('_layouts.master')

@section('body')

    <div class="container search">
        @include('_layouts.partials.search-form')
    </div>

    <div class="container js-search-results mt-4 pb-8">

        <span class="text-grey">Searching...</span>

        <div class="flex  flex-wrap ">
            
            <div class="h-16 w-full bg-grey mb-8"></div>
            <div class="h-16 w-full bg-grey mb-8"></div>
            <div class="h-16 w-full bg-grey mb-8"></div>
            <div class="h-16 w-full bg-grey mb-8"></div>
            <div class="h-16 w-full bg-grey mb-8"></div>
            <div class="h-16 w-full bg-grey mb-8"></div>
    
        </div>
    </div>



@endsection

@push('scripts')
    <script>
        var app = new window.App({"url": "{{ $page->klink_url }}", "token": "{{ $page->klink_token }}"});
        app.Search(document.querySelector('.js-search-results'), document.querySelector('.js-search-form'));
    </script>
@endpush