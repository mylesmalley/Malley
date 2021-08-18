require('bootstrap');
import { createApp } from 'vue';
import Search from './Search.vue';
import MenuSearch from './MenuSearch.vue';
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

createApp(Search).mount('#search' );
createApp(MenuSearch).mount('#menu-search' );
