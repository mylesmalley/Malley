require('bootstrap');
// import { createApp, h } from 'vue'
// import { App, plugin } from '@inertiajs/inertia-vue3'
import  Inertia  from '@inertiajs/inertia';
import Mermaid from 'mermaid';
import Axios from 'axios';


window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};



const el = document.getElementById('app')
//
// createApp({
//     render: () => h(App, {
//         initialPage: JSON.parse(el.dataset.page),
//         resolveComponent: name => require(`.//${name}`).default,
//     })
// }).use(plugin)
//     .use( Mermaid , Inertia, Axios )
//     .mount(el)


import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";

// App.use( Inertia, Axios, Mermaid);


createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`.//${name}`).default,
        }),
})
  //  .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);


import Mermaid from 'mermaid';

Mermaid.initialize({
    startOnLoad:true ,
    securityLevel:'loose',
    flowchart:{
        useMaxWidth:false,
    }});


