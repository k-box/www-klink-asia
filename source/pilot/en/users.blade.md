---
extends: _layouts.pilot.page
section: content
title: K-Link Users
description: The institutions that took part into the K-Link Pilot
users:
 one:
  title: Agency of Forestry under the Government of Tajikistan
  link: https://forestry-tj.klink.asia/dms/
  image: /assets/images/pilot/seller-card.png
 two:
  title: Interstate Commission for Sustainable Development in Central Asia
  link: http://ec-ifas.waterunites-ca.org/aral_basin/institutions/mkur/index.html
  image: /assets/images/pilot/icsd_card.JPG
 three:
  title: Camp Alatoo
  link: http://camp.kg
  image: /assets/images/pilot/camp.jpg
 four:
  title: UCA-MSRI University of Central Asia - Mountains Research Institute
  link: http://msri-hub.ucentralasia.org
  image: /assets/images/pilot/uca.jpg
 five:
  title: CAREC
  link: http://www.led-ca.net
  image: /assets/images/pilot/carec.jpg
 six:
  title: EcoMuseum
  link:  https://ecomuseum.klink.asia/dms/
  image: /assets/images/pilot/ecomuseum.jpg

projects:
 one:
  title: Community-based Walnut Forest and Pasture Management in Southern Kyrgyzstan
  link: https://eba.klink.asia/dms/klink/09517c/document?preview=true
  image: /assets/images/pilot/walnut-card.png
 two:
  title: Ecosystem-based Adaptation to Climate Change in High-mountainous Regions of Central Asia
  link: https://eba.klink.asia/dms/klink/ab1f75/document?preview=true
  image: /assets/images/pilot/eba-card.png

networks:
 one:
  title: Regional Pasture Network
  link: https://pasture.klink.asia/dms/projects/pasture-network/en
  image: /assets/images/pilot/pasture-card.png
 two:
  title: SELLER Environment and Biodiversity Working Group
  link: https://eba.klink.asia/dms/documents/groups/130
  image: /assets/images/pilot/seller-card.png
---

K-Link is used by NGOs, University, Private Companies. Groups of organization chose K-Link also as the solution for managing project related documents.


<div class="container">

  <div class="flex items-baseline justify-between border-b-2 border-grey-light mb-10 px-4 md:px-0">
      <h2 class="text-base font-bold py-4">Institutions</h2>
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
                                <span class="mr-2">Website</span>
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
      <h2 class="text-base font-bold py-4">Projects on K-DMS</h2>
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
                                <span class="mr-2">Website</span>
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
      <h2 class="text-base font-bold py-4">Networks on K-DMS</h2>
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
                                <span class="mr-2">Website</span>
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











