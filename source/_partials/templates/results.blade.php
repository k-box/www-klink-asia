@verbatim

    {{#results.total}}
    
        <div class="flex items-baseline justify-between border-b-2 border-grey-light mb-10 px-4 md:px-0">
            <h2 class="text-base font-bold py-4">Search <span class="text-blue">{{{ term }}}</span></h2>
            <p class="text-base py-4">Number of results:  {{{ results.total }}}</p>
        </div>

	{{/results.total}}

	<div class="items flex flex-wrap md:-mx-3">
		{{#data}}
			
            <div class="md:w-1/2 lg:w-1/3 md:px-3 flex flex-col mb-8 items__item item--{{ type }}">
                <a href="item.html?d={{{id}}}" class="no-underline group transition outline-none text-black focus:bg-blue-light rounded-lg shadow-md hover:shadow-raised hover:translateY-2px active:shadow flex-1 flex flex-col overflow-hidden">
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="item__preview aspect-16x9 bg-center bg-cover bg-no-repeat -mx-4" style="background-image: url('{{{ thumbnail }}}');"></div>
                        </div>
                        <h2 class="text-base font-bold py-4">{{{title}}}</h2>
                        <div class="item__abstract text-grey-dark mb-4">
                            {{#abstract}}
                                {{{ abstract }}}
                            {{/abstract}}
                        </div>
                        <p class="inline-flex items-center">
                            <div class="meta"><span class="meta__label">Language</span> {{{ language }}}</div>
                            <div class="meta"><span class="meta__label">Source</span> {{{ raw.uploader.url }}}</div>
                            {{#video.duration}}
                                <div class="meta"><span class="meta__label">Duration</span> {{{ video.duration }}}</div>
                            {{/video.duration}}

                            <div class="item__fileicon"></div>
                        </p>
                    </div>
                </a>
            </div>
			
		{{/data}}

		{{^data}}
			<div class="info">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>

				
					No results for the specified terms
				
			</div>
		{{/data}}
	</div>

	{{#results.total}}
	{{#pagination}}
	<div class="pagination">
		{{#pagination.prev}}
		<a href="search.html?s={{{term}}}&page={{{pagination.prev}}}" class="link-button" data-prev="{{{pagination.prev}}}"> Previous </a>
		{{/pagination.prev}}
		<span class="pagination__current">{{{pagination.current}}} / {{{pagination.total}}}</span>
		{{#pagination.next}}
		<a href="search.html?s={{{term}}}&page={{{pagination.next}}}" class="link-button" data-next="{{{pagination.next}}}"> Next </a>
		{{/pagination.next}}
	</div>
	{{/pagination}}
	{{/results.total}}

@endverbatim