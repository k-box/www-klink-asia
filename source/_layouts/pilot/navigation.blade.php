
<div class="bg-grey-lighter">
    
    <div class="container py-2 flex justify-between">

        <span class="inline-block py-2 font-bold">K-Link Pilot</span>
    
        <nav class="bg-grey-lighter">
        
            @if($page->language('en'))
            
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('story', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/en/story/">Our Story</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('users', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/en/users/">K-Link Users</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('how', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/en/how/">How it Works</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('dms', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/en/dms/">K-DMS</a>
                
            @elseif($page->language('ru'))
 
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('story', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/ru/story/">Наша история</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('users', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/ru/users/">Пользователи</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('how', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/ru/how/">Как это работает</a>
                <a class="inline-block py-2 px-4 text-grey-darker transition no-underline hover:text-blue active:text-blue-darker hover:translateY-2px {{ $page->selected('dms', 'font-bold') }}" href="{{ $page->baseUrl }}/pilot/ru/dms/">K-DMS</a>

            @endif

                <a href="{{ $page->urlForLanguage('en') }}" class="link-button @unless($page->language('en')) bg-grey-dark @endunless">EN</a>
                <a href="{{ $page->urlForLanguage('ru') }}" class="link-button @unless($page->language('ru')) bg-grey-dark @endunless">RU</a>
        </nav>
    </div>
</div>