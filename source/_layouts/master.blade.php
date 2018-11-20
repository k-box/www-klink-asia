<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="/manifest.json" />
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        
        <title>
            @if($page->has('title'))
                {{ $page->title }} - 
            @endif
            {{ $page->siteTitle }}
        </title>
        @if($page->has('description'))
            <meta name="description" value="{{ $page->description }}"/>
        @else
            <meta name="description" value="{{ $page->siteDescription }}"/>
        @endif

        {{-- <meta name="robots" content="{{ meta.robots }}"> --}}
        <link rel="apple-touch-icon" sizes="180x180" href="/static/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/static/favicon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/static/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/static/favicon-16x16.png">
        <link rel="icon" href="/static/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="{{ $page->siteTitle }}">
        <meta name="msapplication-TileColor" content="#283593">
        <meta name="msapplication-TileImage" content="/static/mstile-144x144.png">
        <meta name="application-name" content="{{ $page->siteTitle }}">
        
        @stack('head')
    </head>
    <body class="bg-grey-darkest font-sans text-black">

        <div class="bg-white min-h-calc-available">

        <header class="container h-16 px-4 py-4 md:px-0 flex items-center justify-between">
            <a href="{{ $page->baseUrl }}/" class="transition fill-current text-blue no-underline flex hover:flex items-center hover:text-blue-dark active:text-blue-darker hover:translateY-2px">
                @include('_layouts.partials.logo') 
                <span class="ml-2">K-Link Asia</span>
            </a>

            <nav>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:bg-blue-lightest hover:text-blue active:text-blue-darker hover:translateY-2px " href="{{ $page->baseUrl }}/#members">Members</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:bg-blue-lightest hover:text-blue active:text-blue-darker hover:translateY-2px " href="{{ $page->baseUrl }}/#join-learn">Join and learn</a>
                <a class="inline-block py-2 px-4 text-grey-darker {{ $page->selected('pilot', 'font-bold') }} transition no-underline hover:bg-blue-lightest hover:text-blue active:text-blue-darker hover:translateY-2px " href="{{ $page->baseUrl }}/pilot/{{ $page->language() }}/">Pilot</a>
            </nav>
        </header>

        @yield('body')

        </div>
        
        @stack('footer')

        <footer class="h-32 py-4 bg-grey-darkest text-grey-light px-4 md:px-0">

            <div class="container md:flex md:justify-between mb-4">
                
                <div class="md:w-2/3">
    
                    <p>
                        <a href="https://github.com/k-box/k-link/blob/master/LICENSE.txt" class="text-grey-light hover:text-white">
                            @include('_svg.agpl') K-Link is a Free and Open-Source technology
                        </a>
                    </p>
                    <p>
                        Icons from <a class="text-grey-light hover:text-white focus:text-white" href="https://github.com/feathericons/feather">FeatherIcons</a>
                    </p>
                    <p>
                        The image on the home page is courtesy of <a class="text-grey-light hover:text-white focus:text-white" href="http://camp.kg">Camp Alatoo</a>
                    </p>
                </div>
                
                <div id="privacy">
                    <a class="text-grey-light hover:text-white focus:text-white" href="{{ $page->baseUrl }}/privacy/">Privacy Policy</a>
                </div>

            </div>

        </footer>

        @include('_partials.templates')

        <script src="{{ mix('js/main.js') }}"></script>

        @stack('scripts')

    </body>
</html>
