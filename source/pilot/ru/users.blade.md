---
extends: _layouts.pilot.page
section: content
title: Пользователи
description: The institutions that took part into the K-Link Pilot
users:
 one:
  title: Агенство лесного хозяйства Республики Таджикистан
  link: https://forestry-tj.klink.asia/dms/
  image: /assets/images/pilot/seller-card.png
 two:
  title: Межгосударственный комитет по устойчивому развитию
  link: http://ec-ifas.waterunites-ca.org/aral_basin/institutions/mkur/index.html
  image: /assets/images/pilot/icsd_card.JPG
 three:
  title: Camp Alatoo
  link: http://camp.kg
  image: /assets/images/pilot/camp.jpg
 four:
  title: Институт исследований горных сообществ Университета Центральной Азии (ИИГС УЦА)
  link: http://msri-hub.ucentralasia.org
  image: /assets/images/pilot/uca.jpg
 five:
  title: Региональный экологический центр Центральной Азии
  link: http://www.led-ca.net
  image: /assets/images/pilot/carec.jpg
 six:
  title: Экомузей
  link:  https://ecomuseum.klink.asia/dms/
  image: /assets/images/pilot/ecomuseum.jpg

projects:
 one:
  title: Сохранение биоразнообразия и сокращение бедности с привлечением местных сообществ к управлению орехово-плодовыми лесами и пастбищами на юге КР
  link: https://eba.klink.asia/dms/klink/09517c/document?preview=true
  image: /assets/images/pilot/walnut-card.png
 two:
  title: Экосистемный подход адаптации к изменению климата
  link: https://eba.klink.asia/dms/klink/ab1f75/document?preview=true
  image: /assets/images/pilot/eba-card.png

networks:
 one:
  title: Региональная Пастбищная Сеть
  link: https://pasture.klink.asia/dms/projects/pasture-network/en
  image: /assets/images/pilot/pasture-card.png
 two:
  title: Рабочая группа SELLER по окружающей среде и биоразнообразию
  link: https://eba.klink.asia/dms/documents/groups/130
  image: /assets/images/pilot/seller-card.png
---

На сегодняшний день к открытой сети K-Link присоединились частные организации, университет и НПО. Несколько организаций выбрали K-Link для управления документами, относящимися к проекту.


<div class="container">

  <div class="flex items-baseline justify-between border-b-2 border-grey-light mb-10 px-4 md:px-0">
      <h2 class="text-base font-bold py-4">Организации</h2>
  </div>

  <div class="flex flex-wrap md:-mx-3">

    @foreach ($page->users as $member)
        <div class="md:w-1/2 lg:w-1/3 md:px-3 flex flex-col mb-8">
            <div class="group transition bg-white rounded-lg md:shadow-md hover:shadow-raised hover:translateY-2px flex-1 flex flex-col overflow-hidden outline-none focus:bg-blue-lightest ">
                <div class="p-4 flex-1 flex flex-col justify-between">
                    @if($member->has('image') || $member->has('background'))
                        <div class="overflow-hidden -mx-6 -mt-4 mb-4">
                            
                            
                            @if($member->has('image'))
                                <div class="h-0 aspect-16x9 bg-cover" style="background-image: url('{{$member->image}}')"></div>
                            @endif
                        </div>
                    @endif
                    
                    <h4 class="font-normal flex-grow text-black mb-4">{!! $page->markdownRender($member->title) !!}</h4>
                    <p class="inline-flex items-center">
                        @if($member->has('link'))
                            <a href="{{ $member->link }}" class="transition text-grey-dark mr-4 no-underline group-hover:text-blue">
                                <span class="mr-2">Веб-сайт</span>
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

<div class="container">

  <div class="flex items-baseline justify-between border-b-2 border-grey-light mb-10 px-4 md:px-0">
      <h2 class="text-base font-bold py-4">Проекты на K-DMS</h2>
  </div>

  <div class="flex flex-wrap md:-mx-3">

    @foreach ($page->projects as $member)
        <div class="md:w-1/2 lg:w-1/3 md:px-3 flex flex-col mb-8">
            <div class="group transition bg-white rounded-lg md:shadow-md hover:shadow-raised hover:translateY-2px flex-1 flex flex-col overflow-hidden outline-none focus:bg-blue-lightest ">
                <div class="p-4 flex-1 flex flex-col justify-between">
                    @if($member->has('image') || $member->has('background'))
                        <div class="overflow-hidden -mx-6 -mt-4 mb-4">
                            
                            
                            @if($member->has('image'))
                                <div class="h-0 aspect-16x9 bg-cover" style="background-image: url('{{$member->image}}')"></div>
                            @endif
                        </div>
                    @endif
                    
                    <h4 class="font-normal flex-grow text-black mb-4">{!! $page->markdownRender($member->title) !!}</h4>
                    <p class="inline-flex items-center">
                        @if($member->has('link'))
                            <a href="{{ $member->link }}" class="transition text-grey-dark mr-4 no-underline group-hover:text-blue">
                                <span class="mr-2">Веб-сайт</span>
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

<div class="container">

  <div class="flex items-baseline justify-between border-b-2 border-grey-light mb-10 px-4 md:px-0">
      <h2 class="text-base font-bold py-4">Сети на K-DMS</h2>
  </div>

  <div class="flex flex-wrap md:-mx-3">

    @foreach ($page->networks as $member)
        <div class="md:w-1/2 lg:w-1/3 md:px-3 flex flex-col mb-8">
            <div class="group transition bg-white rounded-lg md:shadow-md hover:shadow-raised hover:translateY-2px flex-1 flex flex-col overflow-hidden outline-none focus:bg-blue-lightest ">
                <div class="p-4 flex-1 flex flex-col justify-between">
                    @if($member->has('image') || $member->has('background'))
                        <div class="overflow-hidden -mx-6 -mt-4 mb-4">
                            
                            
                            @if($member->has('image'))
                                <div class="h-0 aspect-16x9 bg-cover" style="background-image: url('{{$member->image}}')"></div>
                            @endif
                        </div>
                    @endif
                    
                    <h4 class="font-normal flex-grow text-black mb-4">{!! $page->markdownRender($member->title) !!}</h4>
                    <p class="inline-flex items-center">
                        @if($member->has('link'))
                            <a href="{{ $member->link }}" class="transition text-grey-dark mr-4 no-underline group-hover:text-blue">
                                <span class="mr-2">Веб-сайт</span>
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











