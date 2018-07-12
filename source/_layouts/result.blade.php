@extends('_layouts.master')

@section('body')

    <div class=" js-result pb-8">

        <div class="bg-grey-dark h-48">

        </div>

        <div class="container">

            <span class="text-grey">Loading details...</span>
    
            <div class="flex  flex-wrap ">
                
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
                <div class="h-16 w-full bg-grey mb-8"></div>
        
            </div>
        </div>

    </div>

@push('scripts')
    <script>
        var app = new window.App({"url": "{{ $page->klink_url }}", "token": "{{ $page->klink_token }}"});
        app.Browse(document.querySelector('.js-result'));
    </script>
@endpush

@endsection