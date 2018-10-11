'use strict';

var forEach = require('lodash.foreach');

/**
 * OEmbed.
 * 
 * Given a URL check if exposes OEmbed alternatives and return the OEmbed code, if available
 */
module.exports = (function(){

    var _fetch = window.fetch || require('./fetch.js');

    var Promise = window.Promise;
    
    if (!Promise) {
        Promise = require('promise-polyfill');
    }

    var providers = [
        {
            "provider_name": "K-Link Streaming service",
            "provider_url": "https://public.klink.asia/video/",
            "schemes": [
                "https://public.klink.asia/video/play/*",
            ],
            "url": "https://public.klink.asia/video/oembed"
        },
        {
            "provider_name": "K-Box on klink.asia",
            "provider_url": "https://klink.asia/",
            "schemes": [
                "https://*.klink.asia/d/show/*",
            ],
            "url": "https://{d}.klink.asia/api/oembed"
        },
        {
            "provider_name": "K-Box on k-box.net",
            "provider_url": "https://k-box.net/",
            "schemes": [
                "https://*.k-box.net/d/show/*",
            ],
            "url": "https://{d}.k-box.net/api/oembed"
        },
        {
            "provider_name": "YouTube",
            "provider_url": "https://www.youtube.com/",
            "url": "https://www.youtube.com/oembed",
            "schemes": [
                "http://*youtube.com/watch*",
                "http://*.youtube.com/v/*",
                "https://*youtube.com/watch*",
                "https://*.youtube.com/v/*",
                "http://youtu.be/*",
                "https://youtu.be/*"
            ]
        }
    ]

    /**
     * Verify if the response was completed without errors.
     * If the response was an error or a redirect it throws an error, so 
     * the promise will be rejected
     * @param {Response} response the fetch Response object
     * @return {Response} the fetch Response object
     * @throws {Error} in case the response status code is not between [200, 300)
     */
    function checkStatus(response) {
        if (response.status >= 200 && response.status < 300) {
            return response;
        }
        else {
            var error = new Error(response.statusText);
            error.response = response;
            throw error;
        }
    }

    /**
     * Decodes the response from JSON into an object
     * @param {Response} response the fetch Response object
     * @return {Object} the resulting object from the JSON decoding of the response body text
     */
    function parseJSON(response) {
        return response.json ? response.json() : JSON.parse(response);
    }

    /**
     * Perform a JSON GET request
     * @param {string} url the URL for the request
     * @param {object} data the data to send.
     * @return {Promise} The Promise of the request to be made. In case of success the promise will be 
     *   resolved with the response data as first parameter, otherwise will be rejected with the error as first parameter
     */
    function httpGet(url, data) {
            
        var paramString = [];

        forEach(data, function(value, key){
            paramString.push(key+"="+value);
        });

        return _fetch(url + "?" + paramString.join("&"), {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                }).
                then(checkStatus).
                then(parseJSON);
    }

    /**
     * 
     * @param {*} url 
     */
    function findProviderFor(url){

        var providerUrl = null;

        forEach(providers, function(provider){

            for (var index = 0; index < provider.schemes.length; index++) {
                var scheme = provider.schemes[index];
                
                var reg = new RegExp(scheme.replace(/\*/g, '(.*)'), 'i');
                if(url.match(reg)){
                    providerUrl = {
                        provider_name: provider.provider_name,
                        provider_url: provider.provider_url,
                        scheme: scheme,
                        url: provider.url,
                    };
                }
            }

        });

        return providerUrl;
    }

    /**
     * Inner object to return as the module Public API
     */
    var inner = {

        findProvider: function(url){
            return findProviderFor(url);
        },
        
        hasProviderFor: function(url){
            return findProviderFor(url) !== null;
        },

        resolve: function(url){

            return new Promise(function(resolve, reject){

                var oembedURL = findProviderFor(url);

                if(!oembedURL){
                    reject(new TypeError("Embed not supported"));
                }

                var reg = new RegExp(oembedURL.scheme.replace(/\*/g, '(.*)'), 'i');

                var matches = url.match(reg);

                if(matches.length === 3){
                    // we have to replace the domain in the url

                    resolve(oembedURL.url.replace(/{d}/g, matches[1]));
                }
    
                resolve(oembedURL.url);

            }).then(function(oembedURL){
                return httpGet(oembedURL, {
                    format: "json",
                    url: encodeURIComponent(url)
                });
            });
        }

    };

    return inner;
})();