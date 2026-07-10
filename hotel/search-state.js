/**
 * search-state.js — bookHotel
 * Single source of truth for search parameters.
 * Saves params to sessionStorage on every page load,
 * so they persist across navigation even if URL changes.
 *
 * Keys stored:
 *   bh_city, bh_checkin, bh_checkout, bh_guests
 */

(function () {
  'use strict';

  var SS = window.sessionStorage;
  var params = new URLSearchParams(window.location.search);

  // Save any param that exists in the URL — don't overwrite with empty values
  function save(key, val) {
    if (val && val.trim && val.trim()) SS.setItem(key, val.trim());
    else if (val && !isNaN(val) && parseInt(val) > 0) SS.setItem(key, val);
  }

  save('bh_city',     params.get('city'));
  save('bh_checkin',  params.get('checkin'));
  save('bh_checkout', params.get('checkout'));
  save('bh_guests',   params.get('guests'));

  // Expose helpers globally
  window.bhSearch = {
    get: function (key) {
      return params.get(key) || SS.getItem('bh_' + key) || '';
    },
    city:     function () { return window.bhSearch.get('city'); },
    checkin:  function () { return window.bhSearch.get('checkin'); },
    checkout: function () { return window.bhSearch.get('checkout'); },
    guests:   function () { return parseInt(window.bhSearch.get('guests')) || 2; },
    nights:   function () {
      var ci = window.bhSearch.checkin(), co = window.bhSearch.checkout();
      if (!ci || !co) return 1;
      return Math.max(1, Math.round((new Date(co) - new Date(ci)) / 86400000));
    },
    qs: function (includeCity) {
      var parts = [];
      var city = window.bhSearch.city();
      var ci   = window.bhSearch.checkin();
      var co   = window.bhSearch.checkout();
      var g    = window.bhSearch.guests();
      if (includeCity && city) parts.push('city='     + encodeURIComponent(city));
      if (ci)                  parts.push('checkin='  + encodeURIComponent(ci));
      if (co)                  parts.push('checkout=' + encodeURIComponent(co));
      if (g)                   parts.push('guests='   + g);
      return parts.length ? '?' + parts.join('&') : '';
    },
    fmtDate: function (d) {
      if (!d) return '';
      var dt = new Date(d);
      if (isNaN(dt)) return d;
      return dt.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
    }
  };

  // On DOMContentLoaded: fill any input with data-bh-fill attribute
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bh-fill]').forEach(function (el) {
      var key = el.getAttribute('data-bh-fill');
      var val = window.bhSearch.get(key);
      if (!val) return;
      if (el.tagName === 'SELECT') {
        for (var i = 0; i < el.options.length; i++) {
          if (el.options[i].value == val) { el.selectedIndex = i; break; }
        }
      } else if (el.tagName === 'INPUT') {
        if (!el.value) el.value = val; // don't overwrite existing PHP-set value
      }
    });
  });

})();
