/**
 * Render module. Compile and renders Hogan templates
 */

'use strict';

import Hogan from 'hogan.js';
import forEach from 'lodash.foreach';


export default (function(){

    var _templates = {
        error: '<div class="border-l-2 border-red bg-red-lightest p-4 flex content-center"><svg xmlns="http://www.w3.org/2000/svg" class="text-red mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>{{{message}}}</div>',
        info: '<div class="border-l-2 border-blue bg-blue-lightest p-4 flex content-center"><svg xmlns="http://www.w3.org/2000/svg" class="text-blue mr-4" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>{{{message}}}</div>',
        results: document.querySelector("#results-template").innerHTML,
        single: document.querySelector("#single-template").innerHTML,
        filters: document.querySelector("#filters-template") ? document.querySelector("#filters-template").innerHTML : ''
    };

    var _compiled = {
        error: null,
        info: null,
        results: null,
        single: null,
        filters: null
    }


    function _precompileTemplates(){
        forEach(_templates, function(template, key){
            if(!_compiled[key]){
                _compiled[key] = Hogan.compile(template || "");
            }
        })
    }

    function _getTemplate(template){
        if(_compiled[template]){
            return _compiled[template];
        }

        _compiled[template] = Hogan.compile(_templates[template]);
        return _compiled[template];
    }

    function _render(template, data) {
        var compiled = _getTemplate(template);
        var output = compiled.render(data);

        return output;
    }

    function _renderError(error) {
        return _compiled.error.render(error);
    }
    
    function _renderInfo(message) {
        return _compiled.info.render(message);
    }

    _precompileTemplates();

    return {
        render: _render,
        error: _renderError,
        info: _renderInfo,
    }
});
