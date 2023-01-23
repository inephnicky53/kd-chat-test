/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/app.css';

// start the Stimulus application
import '../bootstrap';

import React from 'react';
import { createRoot } from 'react-dom/client';
import NephtaliChatBook from "./views/NephtaliChatBook";

let $ = window.$ = global.$ = window.jQuery = global.jQuery = require("jquery")

const container = document.getElementById('app');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<NephtaliChatBook name="NephtaliChatBook"/>);

$(function () {
    $(document).ajaxError(async function (event, jqxhr, settings, exception) {
        if (jqxhr.status === 0) app.toastDanger(`Echec de connexion, assurez-vous que vous êtes connectés à internet`)
    })

    $(document).ajaxComplete(function (event, xhr, settings) {
        let url = new URL(settings.url).pathname
        let responseData = null
        try {
            responseData = JSON.parse(xhr.responseText)
        } catch (e) {
        }
        let data = null
        if(settings.data instanceof FormData){
            data = {}
            for(const key of settings.data.keys()){
                // let value = settings.data.get(key)
                data[key] = settings.data.get(key)
            }
        }
        console.warn('[ajax]', url, '\n', settings.type, settings.url, '\nData : ', data || settings.data, '\nHeaders : ', JSON.stringify(settings.headers),
            '\nResponse : ', xhr.status, xhr.statusText, '\n', responseData/*xhr.responseJSON*/)
    })
})