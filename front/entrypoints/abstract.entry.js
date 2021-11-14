import SwaggerUI from '../../vendor/evrinoma/utils-bundle/src/Resources/public/js/SwaggerUI/init-swagger-ui.js';

import Vuex from "../plugins/vuex/vuex";
import Vue from 'vue';
import Vuetify from '../plugins/vuetify/vuetify';

import App from "../App.vue";

window.routes = require('../../public/js/fos_js_routes.json');

export { App, Vue, Vuetify, Vuex };