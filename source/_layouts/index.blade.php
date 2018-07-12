@extends('_layouts.master')

@section('body')

    <div class="hero h-third-screen">

    </div>

    <div class="container shadow-none md:shadow-lg md:rounded md:-mt-16 mb-8 p-4 bg-white">

        <div class="">
            @if(is_a($page->tagline, 'TightenCo\Jigsaw\IterableObject'))
                <h2 class="text-grey-darkest font-normal leading-normal">{!! $page->tagline->implode('<br/>') !!}</h2>
            @else 
                <h2 class="text-grey-darkest font-normal">{{ $page->tagline }}</h2>
            @endif
        </div>
        
        <div class="container search">
            @include('_layouts.partials.search-form')
        </div>
    </div>

    <div class="container content">
        @yield('content')
    </div>

    <div class="container" id="members">

        <div class="flex items-baseline justify-between border-b-2 border-grey-light mb-10 px-4 md:px-0">
            <h2 class="text-base font-bold py-4">Members contributing information to K-Link Asia</h2>
        </div>

        <div class="flex flex-wrap md:-mx-3">

            @foreach ($page->members as $member)
                <div class="md:w-1/2 lg:w-1/3 md:px-3 flex flex-col mb-8">
                    <div class="group transition bg-white rounded-lg md:shadow-md hover:shadow-raised hover:translateY-2px flex-1 flex flex-col overflow-hidden outline-none focus:bg-blue-lightest ">
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            @if($member->has('image') || $member->has('background'))
                                <div class="overflow-hidden -mx-6 -mt-4 mb-4">
                                    @if($member->has('background'))
                                        <div class="bg-cover aspect-16x9 cover-{{$member->background}}"></div>
                                    @elseif($member->has('image'))
                                        <img class="h-0 aspect-16x9" src="{{$member->image}}">
                                    @endif
                                </div>
                            @endif
                            
                            <h4 class="font-normal flex-grow text-black mb-4">{!! $page->markdownRender($member->name) !!}</h4>
                            <p class="inline-flex items-center">
                                @if($member->has('website'))
                                    <a target="_blank" rel="noopener noreferrer" href="{{ $member->website }}" class="transition text-grey-dark mr-4 no-underline group-hover:text-blue">
                                        <span class="mr-2">Website</span>
                                        @include('_svg.outlink')
                                    </a>
                                @endif
                                @if($member->has('kbox'))
                                    <a target="_blank" rel="noopener noreferrer" href="{{ $member->kbox }}" class="transition text-grey-dark no-underline group-hover:text-blue">
                                        <span class="mr-2">K-Box</span>
                                        @include('_svg.outlink')
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        
    </div>

    <div class="bg-blue-darker text-white" id="join-learn">

        <div class="container">
            <div class="flex items-baseline justify-between border-b-2 border-blue-darkest mb-10  px-4 md:px-0">
                <h2 class="text-base text-blue-lightest font-bold py-8">Join or know more</h2>
            </div>

            <div class="flex flex-wrap md:-mx-3">

                @foreach ($page->interests as $interest)
                    <div class="md:w-1/2 lg:w-1/3 md:px-3 flex flex-col mb-8">
                    <a target="_blank" rel="noopener noreferrer" href="{{ $interest->has('link') ? $interest->link : ($interest->has('mail') ? "mailto:$interest->mail" : '#') }}" class="no-underline group transition outline-none md:bg-blue-darkest focus:bg-blue-dark text-white rounded-lg shadown-md  hover:shadow-raised hover:translateY-2px flex-1 flex flex-col overflow-hidden">
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                @if($interest->has('icon'))
                                    <div class="mb-3 text-blue-lighter fill-current">
                                        @include('_svg.' . $interest->icon)
                                    </div>
                                @endif

                                <h3 class="font-normal mb-4">{!! $page->markdownRender($interest->text) !!}</h3>
                                <p class="inline-flex items-center">
                                    @if($interest->has('link'))
                                        <span class="transition text-blue-lighter mr-4 no-underline group-hover:text-blue">
                                            <span class="mr-2">Explore</span>
                                            @include('_svg.outlink')
                                        </span>
                                    @elseif($interest->has('mail'))
                                        <span class="transition text-blue-lighter no-underline group-hover:text-blue">
                                            <span class="mr-2">Contact Us</span>
                                            @include('_svg.outlink')
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@push('footer')

    <div class="bg-grey-darker text-white">
        <div class="container py-8 text-center md:text-left">Looking for the <strong>K-Link Pilot</strong> website? <a href="{{ $page->baseUrl }}/pilot/en/" class="link-button mt-4 md:mt-0">Browse the <strong>Pilot</strong> section</a></div>
    </div>

@endpush

@push('scripts')
    <script>
        var app = new window.App({"url": "{{ $page->klink_url }}", "token": "{{ $page->klink_token }}"});
        app.Aggregations(document.querySelector('.js-search-filters'), document.querySelector('.js-search-form'));
    </script>
@endpush
