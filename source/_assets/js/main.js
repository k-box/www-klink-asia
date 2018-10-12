// website application code

/* global String */
/* eslint new-cap: 'off', require-jsdoc: 'warn' */
'use strict';

import Renderer from './render.js';
import assignIn from 'lodash.assignin';
import forEach from 'lodash.foreach';
import pull from 'lodash.pull';
import map from 'lodash.map';
import transform from 'lodash.transform';
import flattenDeep from 'lodash.flattendeep';
import indexOf from 'lodash.indexof';
import Oembed from './utils/oembed.js';
import Dom from './utils/dom.js';
import KLink from 'k-search-js';

window.App = function (config) {

    var ENTITY_MAP = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
        '/': '&#x2F;',
        '`': '&#x60;',
        '=': '&#x3D;'
    };

    /**
     * Mapping between mime type and label for aggregation values
     */
    var DOCUMENT_TYPE_MAP = {
		'application/msword': 'Word 2003 document',
		'application/vnd.ms-excel': 'Excel 2003 spreadsheet',
		'application/vnd.ms-powerpoint': 'Powerpoint 2003 presentation',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'Excel spreadsheet',
		'application/vnd.openxmlformats-officedocument.presentationml.presentation': 'Powerpoint presentation',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'Word document',
		'application/pdf': 'Pdf document',
		'image/jpg': 'Jpg image',
		'image/jpeg': 'Jpg image',
		'image/gif': 'Gif image',
		'image/png': 'Png image',
		'image/tiff': 'Tiff image',
		'text/plain': 'Text document',
		'application/rtf': 'Rtf document',
		'text/x-markdown': 'Markdown document',
		'application/vnd.google-apps.document': 'Google Document',
		'application/vnd.google-apps.drawing': 'Google Drawing',
		'application/vnd.google-apps.form': 'Google Form',
		'application/vnd.google-apps.fusiontable': 'Google Table',
		'application/vnd.google-apps.presentation': 'Google Slides',
		'application/vnd.google-apps.spreadsheet': 'Google Sheets',
        'video/x-ms-wmv': 'Windows Media video',
        'video/avi': 'Avi video',
        'video/divx': 'Divx video',
        'video/x-flv': 'FLV video',
        'video/quicktime': 'Quicktime video',
        'video/mpeg': 'MPEG video',
        'video/mp4': 'MP4 video',
        'video/ogg': 'OGG video',
        'video/webm': 'WebM video',
        'video/x-matroska': 'video',
        'video/3gpp': '3GPP video',
        'video/3gpp2': '3GPP2 video',
        'application/vnd.oasis.opendocument.text': 'ODT Document',
		'application/vnd.oasis.opendocument.presentation': 'ODP Document',
		'application/vnd.oasis.opendocument.spreadsheet': 'ODS Document',
		'application/vnd.oasis.opendocument.graphics': 'ODG Document',
		'application/vnd.oasis.opendocument.chart': 'ODC Document',
		'application/vnd.oasis.opendocument.database': 'ODB Document',
		'application/vnd.oasis.opendocument.formula': 'ODF Document',
    };

    var AGGREGATION_LABELS_MAPPING = {
        "language": {
            "label" : "Language",
            "values" : {
                "en" : "English",
                "tg" : "Tajik",
                "ru" : "Russian",
                "de" : "German",
                "fr" : "French",
                "__" : "Not specified"
            }
        },
        "mime_type" : { 
            "label": "Type",
            "values": DOCUMENT_TYPE_MAP
        }
    };

    var defaultOptions = {
        /**
         * The K-Link compatible endpoint to use for searching 
         * @type {string}
         */
        url: null,
        /**
         * The API token to obtain access to the Search
         * @type {string}
         */
        token: null,

        compatibility: false
    };

    var options = assignIn(defaultOptions, config);

    if (typeof document.querySelector === undefined) {
        throw new Error("App: Browser not supported, cause: querySelector not supported");
    }

    if (!options.url) {
        throw new Error("App: Url not specified.");
    }

    if (!options.token) {
        throw new Error("App: API Token/Secret not specified.");
    }


    var _search = new KLink(options);
//     var _errorTemplate = Hogan.compile(document.querySelector('#error-template').innerHTML);
//     var _infoTemplate = Hogan.compile(document.querySelector('#info-template').innerHTML);
//     var resourceCounter = document.querySelector(".js-publications-counter");
    var searchBlock = document.querySelector(".js-search");
    var searchInputBlock = document.querySelector(".js-search-input");
    var filtersInputBlock = document.querySelector(".js-search-filters-input");
    var filtersBlock = document.querySelector(".js-filter-dialog");

    var _renderer = new Renderer();

    var _searchStatus = {
        dialogOpened: false,
        selectedFilters: {
            language: [],
            mime_type: [],
        }
    };

    /**
     * Escape a string
     * 
     * @param {string} value 
     * @return {string}
     */
    function e(value) {
        /* eslint no-useless-escape: 'off' */
        return String(value).replace(/[&<>"'`=\/]/g, function (s) {
            return ENTITY_MAP[s];
        });
    }

    /**
     * Extract parameters from a query string
     * 
     * @param {string} locationSearch the window.location.search
     * @return {URLSearchParams} 
     */
    function processLocationSearch(locationSearch) {
        if (('URLSearchParams' in window)) {
            return new URLSearchParams(locationSearch);
        }

        // fallback in case URLSearchParams is not supported

        var normalized = locationSearch.replace('?', '').split('&');
        var parameters = {}

        forEach(normalized, function (param) {
            var pair = param.split('=');
            
            if (pair.length === 2) {
                parameters[decodeURI(pair[0])] = decodeURIComponent(pair[1].replace(/\+/g, ' '));
            }
        })

        // let's output an object with the methods we use
        return {
            has: function (key) {
                return parameters[key] !== undefined;
            },
            get: function (key) {
                return parameters[key];
            }
        }
    }



    function handleFilterSelection(evt){

        if(Dom.matches(evt.target, ".js-filter-button")){
            var filterName = Dom.data(evt.target, 'filter');
            var filterValue = Dom.data(evt.target, 'value');

            if(_searchStatus.selectedFilters[filterName] && filterValue && indexOf(_searchStatus.selectedFilters[filterName], filterValue) !== -1){
                // if is already inserted remove it
                pull(_searchStatus.selectedFilters[filterName], filterValue);
                Dom.classRemove(evt.target, 'button-filter--checked');
            }
            else if(_searchStatus.selectedFilters[filterName] && filterValue) {
                // add it if missing
                _searchStatus.selectedFilters[filterName].push(filterValue);
                Dom.classAdd(evt.target, 'button-filter--checked');
            }
            else if(_searchStatus.selectedFilters[filterName] && !filterValue) {
                // this means all is selected
                _searchStatus.selectedFilters[filterName] = [];
            }

            var filterStrings = [];

            if(_searchStatus.selectedFilters.language.length > 0){

                filterStrings.push("language:" + _searchStatus.selectedFilters.language.join(","));
            }
            if(_searchStatus.selectedFilters.mime_type.length > 0){

                filterStrings.push("mime_type:" + _searchStatus.selectedFilters.mime_type.join(","));
            }

            filtersInputBlock.value = filterStrings.join(";");
        }

    }

    function handleClearFilterClick(){
        _searchStatus.selectedFilters.language = [];
        _searchStatus.selectedFilters.mime_type = [];
        filtersInputBlock.value = '';

        var elements = searchBlock.querySelectorAll(".button-filter--checked");

        forEach(elements, function(el){

            Dom.classRemove(el, "button-filter--checked");
        });

    }

    

    function handleFilterDialogOpen(evt) {
        if(!_searchStatus.dialogOpened){
            Dom.classRemove(filtersBlock, 'hidden');
            _searchStatus.dialogOpened = true;

            document.body.addEventListener('click', handleFilterDialogClose);
        }
        else {
            _searchStatus.dialogOpened = false;
            Dom.classAdd(filtersBlock, 'hidden');
            document.body.removeEventListener('click', handleFilterDialogClose);
        }
    }
    
    function handleFilterDialogClose(evt) {
        
        if(!Dom.parentMatching(evt.target, ".js-search") && _searchStatus.dialogOpened){
            _searchStatus.dialogOpened = false;
            Dom.classAdd(filtersBlock, 'hidden');
            document.body.removeEventListener('click', handleFilterDialogClose);
        }
    }

    function mapToFiltersObject(filterString) {
        
        if(filterString.indexOf(":") === -1 && filterString.indexOf(";") === -1){
            return '';
        }

        var parts = filterString.split(/;/);
        
        var mapped = transform(parts, function(result, v){
            var separation = v.split(/:/);

            if(separation.length === 2){
                result[separation[0]] = separation[1].indexOf(",") !== -1 ? separation[1].split(",") : [separation[1]];
            }
            
        }, {});
        
        return mapped;
    }

    function aggregationsViewModel(aggregations){

        if(!aggregations){
            return [];
        }

        var mapped = transform(aggregations, function(result, v, k){
            
            result.push({
                name: k,
                label: AGGREGATION_LABELS_MAPPING[k] ? AGGREGATION_LABELS_MAPPING[k].label : k,
                values: aggregationsValueViewModel(k, v),
            });
        }, []);

        return {filters: mapped};
    }

    function aggregationsValueViewModel(aggregation, values){

        if(!values){
            return [];
        }

        var aggregationMapping = AGGREGATION_LABELS_MAPPING[aggregation];

        if(!aggregationMapping){
            return [];
        }

        var mapped = transform(values, function(result, v, k){
            
            result.push({
                label: aggregationMapping.values && aggregationMapping.values[v.value] ? aggregationMapping.values[v.value] : null,
                value: (aggregation === "mime_type") ? v.value.replace("/", "-") :  v.value,
            });
        }, []);
        
        return mapped;
    }

    function initializeFilterUI(filtersSelector, searchFormSelector){

        var container = typeof filtersSelector === 'string' ? document.querySelector(filtersSelector) : filtersSelector;
        var valuesContainer = container.querySelector('.js-search-filter-values');
        var form = typeof searchFormSelector === 'string' ? document.querySelector(searchFormSelector) : searchFormSelector;
        var input = form.querySelector('.js-search-input');
        var clearFilterBtn = container.querySelector('.js-filter-clear');

        container.addEventListener('click', handleFilterSelection);
        clearFilterBtn.addEventListener('click', handleClearFilterClick);

        return _search.aggregations([
                "mime_type",
                "language"
            ]).then(function (results) {

                valuesContainer.innerHTML = _renderer.render('filters', aggregationsViewModel(results));

            }).
                catch(function (e) {
                    console.error("Search error", e);
                    container.innerHTML = _renderer.error({ message: "There was a problem in retriving the filters, please try again later." });
                    document.title = title;
                });

    }


    return {


        Search: function (resultsSelector, searchFormSelector) {

            var container = typeof resultsSelector === 'string' ? document.querySelector(resultsSelector) : resultsSelector;
            var form = typeof searchFormSelector === 'string' ? document.querySelector(searchFormSelector) : searchFormSelector;
            var input = form.querySelector('.js-search-input');
            var filters = document.querySelector('.js-search-filters');

            var urlParams = processLocationSearch(window.location.search);

            // select the active filters on the UI
            var activeFilters = null;
            if(urlParams.has('filters')){
                var processedFilters = mapToFiltersObject(urlParams.get('filters'));
                _searchStatus.selectedFilters.language = processedFilters.language || [];
                _searchStatus.selectedFilters.mime_type = processedFilters.mime_type || [];

                initializeFilterUI(filters, form).then(function(){

                    forEach(processedFilters.language, function(v){
                        Dom.classAdd(searchBlock.querySelector("[data-filter=language][data-value="+ v +"]"), "button-filter--checked");
                    })
                    forEach(processedFilters.mime_type, function(v){
                        Dom.classAdd(searchBlock.querySelector("[data-filter=mime_type][data-value="+ v +"]"), "button-filter--checked");
                    })

                });


                activeFilters = {};

                if(_searchStatus.selectedFilters.language && _searchStatus.selectedFilters.language.length > 0){
                    activeFilters.language = _searchStatus.selectedFilters.language;
                }
                
                if(_searchStatus.selectedFilters.mime_type && _searchStatus.selectedFilters.mime_type.length > 0){
                    activeFilters.mime_type = flattenDeep(map(processedFilters.mime_type, function(v){
                        return v.replace("-", "/");
                    }));
                }

            } 

            var request = {
                term: urlParams.has('s') ? e(urlParams.get('s')) : '',
                page: urlParams.has('page') ? e(urlParams.get('page')) : 1,
                filters: activeFilters,
                aggregations: [],
            };
            var title = document.title;

            if(request.term == ''){
                container.innerHTML = _renderInfo({ message: "Please specify at least a keyword to search for." });
                return;
            }

            document.title = "Searching... - " + document.title;

            if (request.term) {
                input.value = request.term;
                document.title = request.term + " - " + title;
            }

            _search.find(request).then(function (results) {


                container.innerHTML = _renderer.render('results', results);

            }).
                catch(function (e) {
                    console.error("Search error", e);
                    container.innerHTML = _renderer.error({ message: "Not able to load search results, please try again later." });
                    document.title = title;
                });

        },

        Browse: function (selector) {

            var container = typeof selector === 'string' ? document.querySelector(selector) : selector;
            var template = 'single';

            var urlParams = processLocationSearch(window.location.search);

            var uuid = urlParams.has('d') ? e(urlParams.get('d')) : false;

            if (!uuid || (uuid && uuid.length === 0)) {
                container.innerHTML = _renderer.error({ message: "Please specify the data to retrieve." });
                return;
            }

            var title = document.title;

            document.title = "Loading... - " + document.title;

            _search.get(uuid).
                then(function (result) {
                    if (result) {

                        var parts = result.url.split('/');
                        
                        if(parts.length >= 3){
                            result.app_url = parts[0] + "//" + parts[2];
                        }
                        else {
                            result.app_url = result.url;
                        }

                        var oembed = null;
                        
                        if(Oembed.hasProviderFor(result.originalUrl)){
                            oembed = result.originalUrl;
                        }

                        if (result.video && result.video.streaming && (result.video.streaming.dash || result.video.streaming.youtube || result.video.streaming.hls)) {
                            oembed = result.video.streaming.dash || result.video.streaming.youtube || result.video.streaming.hls || null;
                        }

                        if(oembed){
                            Oembed.resolve(oembed).then(function (embed) {
                                console.info('oEmbed resolved', embed);
                                result.hasEmbed = true;
                                result.embed = embed.html;
                                result.thumbnail = embed.thumbnail_url || result.thumbnail;
                                container.innerHTML = _renderer.render(template, { data: result });
                            }).
                            catch(function () {
                                result.hasEmbed = true;
                                result.embed = '<div class="error">Embed could not be loaded. <a class="inline-block no-underline p-2 bg-blue hover:bg-blue-dark focus:bg-blue-dark active:bg-blue-darker transition outline-none text-white shadow hover:shadow-raised hover:translateY-2px" href="' + result.url + '">Visit ' + result.url + '</a>.</div>';
                                container.innerHTML = _renderer.render(template, { data: result });
                            });
                        }
                        else {
                            container.innerHTML = _renderer.render(template, { data: result });
                        }

                        document.title = result.title + " - " + title;
                    }
                    else {
                        container.innerHTML = _renderer.error({ message: "The requested Data could not be found. Maybe it was deleted." });
                        document.title = "Not Found - " + title;
                    }
                }).
                catch(function () {
                    container.innerHTML = _renderer.error({ message: "Not able to load details, please try again later" });
                    document.title = title;
                });


        },

        Aggregations: function (filtersSelector, searchFormSelector) {

            initializeFilterUI(filtersSelector, searchFormSelector);

            

            if(searchBlock){
                var filterBtn = searchBlock.querySelector(".js-filter-button");
    
                if(filterBtn){
                    
                    filterBtn.addEventListener('click', handleFilterDialogOpen);
                }

            }

        },

    }

}

