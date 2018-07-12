<div class="js-search search mt-8 md:mt-5">
    
    <form action="{{ $page->baseUrl }}/search.html" class="js-search-form flex md:w-2/3 border border-transparent focus:bg-white focus:border-blue-light rounded bg-grey-lighter block appearance-none leading-normal" method="get">
        <input type="text" class="js-search-input transition focus:outline-none flex-grow border border-grey-lighter focus:bg-white bg-grey-lighter py-2 px-4 block appearance-none leading-normal" aria-label="Search..." placeholder="Search..." name="s" autocomplete="off" required id="s">
        <input type="hidden" class="js-search-filters-input" name="filters" autocomplete="false" id="filters">

        @if($page->hasTemplate('_layouts.index'))
            <button type="button" class="hidden md:inline-block js-filter-button search__button transition bg-grey-lighter text-blue hover:text-white hover:bg-blue-darker focus:text-white focus:bg-blue-darker active:bg-blue-darkest focus:outline-none px-4 whitespace-no-wrap">
                @include('_svg.filter')
                Filters
            </button>
        @endif
        <button type="submit" class="search__button transition px-2 md:px-4 focus:outline-none text-blue-lightest bg-blue-dark hover:text-white hover:bg-blue-darker focus:text-white focus:bg-blue-darker active:bg-blue-darkest  whitespace-no-wrap">
            @include('_svg.search')
            Search
        </button>
    </form>
        
    <div class="js-filter-dialog @if($page->hasTemplate('_layouts.index')) hidden bg-grey-lighter @endif">

        <script type="text/html" id="filters-template">
            @verbatim
            {{#filters}}
            <div class="filter py-4">
                <label for="" class="inline-block mb-2 text-grey-darkest">{{{ label }}}</label>
                    
                <div class="filter__values">
                    {{#values}}
                        {{#label}}
                        <button type="button" class="js-filter-button button-filter mb-1" data-filter="{{{ name }}}" data-value="{{{ value }}}">
                            @endverbatim
                            <span class="checked">@include('_svg.check-marked')</span>
                            <span class="unchecked">@include('_svg.check-empty')</span>
                            @verbatim
                            {{{ label }}}
                        </button>
                        {{/label}}
                    {{/values}}
                    {{^values}}
                        No filters for this type
                    {{/values}}
                </div>
            </div>
		    {{/filters}}
            @endverbatim
        </script>

        <div class="js-search-filters p-4 flex flex-col justify-between">

            <div class="mb-4 js-search-filter-values min-h-32">

                <span class="text-grey-dark">Figuring out what filters you could use...</span>
                
            </div>
            <div class="flex justify-between">
                <button class="js-filter-clear px-4 py-2 focus:outline-none text-red bg-red-lightest hover:text-white focus:text-white hover:bg-red focus:bg-red active:bg-red-darker" type="button">Clear filters</button>
            </div>
        </div>
    </div>

    <div class="search__hint mt-2px ">
        <a href="{{ $page->baseUrl }}/search-help/" class="no-underline text-sm text-grey-dark hover:text-blue focus:text-blue active:text-blue-darker"> 
            @include('_svg.help')
            Type a keyword or a phrase and press enter to search
        </a>
    </div>
</div>
