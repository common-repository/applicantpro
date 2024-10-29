(function ($) {
    'use strict';

    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0; ) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
        }
        return url;
    }

    function removeHash() {
        var scrollV, scrollH, loc = window.location;
        if ("pushState" in history)
            history.pushState("", document.title, loc.pathname + loc.search);
        else {
            // Prevent scrolling by storing the page's current scroll offset
            scrollV = document.body.scrollTop;
            scrollH = document.body.scrollLeft;

            loc.hash = "";

            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scrollV;
            document.body.scrollLeft = scrollH;
        }
    }

    $('.city_list input[type=checkbox]').click(function (e) {
        var seasoning = '', tempArray = [];
        $('input[name="cities[]"]:checked').each(function () {
            tempArray.push($(this).val());
        });
        if (tempArray.length !== 0) {
            seasoning += '&cities=' + tempArray.toString();
            tempArray = [];
        }

        var domain = window.location.href;
        var domain = domain.split('#')[0];
        var domain = removeURLParameter(domain, 'cities');
        window.location.href = domain + seasoning + '#applicantpro';
    });

    $('#Layer_1 path.map_active,.states_with_openings').click(function (e) {
        var state_id = $(this).data('state-id');
        if (state_id.length == 2) {
            removeHash();
            var domain = window.location.href;
            var domain = domain.split('#')[0];
            var domain = removeURLParameter(domain, 'state');
            var separator = (domain.indexOf("?") === -1) ? "?" : "&";
            
            var url = domain + separator + 'state=' + state_id;
            window.location.href = url + '#applicantpro';
        }
    });

    $('#applicant_job_search_form').on('submit', function (e) {
        e.preventDefault();
        removeHash();
        
        var domain = window.location.href;
        var domain = domain.split('#')[0];
        var domain = removeURLParameter(domain, 'state');
        var domain = removeURLParameter(domain, 'keyword');
        var domain = removeURLParameter(domain, 'src');
        var domain = removeURLParameter(domain, 'city');
        
        var formData = $('#applicant_job_search_form').serialize();
        var separator = (domain.indexOf("?") === -1) ? "?" : "&";
        var url = domain + separator + formData;
        window.location.href = url + '#applicantpro';
    });


})(jQuery);