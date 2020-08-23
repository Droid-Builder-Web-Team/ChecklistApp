/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal/dist/ssr.nocss'

import 'vue-js-modal/dist/styles.css'

Vue.use(VModal, {
    dynamicDefaults: {
        draggable: false,
        resizable: false,
        height: 'auto',
        adaptive: true,
        dialog: true,
        dynamic: true,
    }
})

if (!HTMLCanvasElement.prototype.toBlob)
{
    Object.defineProperty(HTMLCanvasElement.prototype, 'toBlob', {
        value: function (callback, type, quality)
        {
            var binStr = atob(this.toDataURL(type, quality).split(',')[1]),
                len = binStr.length,
                arr = new Uint8Array(len);
            for (var i = 0; i < len; i++)
            {
                arr[i] = binStr.charCodeAt(i);
            }
            callback(new Blob([arr], { type: type || 'image/png' }));
        }
    });
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

// Custom components
Vue.component('stl-viewer', require('./components/StlViewer.vue').default);

Vue.component('avatar-cropper', require('./components/AvatarCropper.vue').default);

import Toasted from 'vue-toasted';

Vue.use(Toasted)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

"use strict";
$(document).ready(function ()
{

    var rows = 6; //change this also in css
    var cols = 4; //change this also in css
    var staggerTime = 150;


    //---------
    //Get Images from files
    var filePath = "/img/BuilderImg/imagelist.txt"; //list of file names
    var result = null;                              //Store names from files
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", filePath, false);           //open file
    xmlhttp.send();
    if (xmlhttp.status == 200)
    {
        result = xmlhttp.responseText;
    }

    var imagename = result.split("\n");               //sepert
    var urls = [];

    //Copy names into URL - could just use image names!
    for (let i = 0; i < imagename.length; i++)
    {
        urls[i] = "/img/BuilderImg/" + imagename[i];
    }

    //Shuffle images
    var rndNum = 0;
    for (let i = 0; i < urls.length - 1; i++)
    {
        rndNum = Math.floor(Math.random() * urls.length)
        var tempUrl = urls[rndNum];
        urls[rndNum] = urls[i];
        urls[i] = tempUrl;
    }


    var $gallery = $(".demo__gallery");
    var $help = $(".demo__help");
    var partsArray = [];

    var reqAnimFr = (function ()
    {
        return window.requestAnimationFrame || function (cb)
        {
            setTimeout(cb, 1000 / 60);
        }
    })();

    $gallery.html('');
    for (let row = 1; row <= rows; row++)
    {
        partsArray[row - 1] = [];
        for (let col = 1; col <= cols; col++)
        {
            $gallery.append(`<div class="show-front demo__part demo__part-${row}-${col}" row="${row}" col="${col}"><div class="demo__part-back"><div class="demo__part-back-inner"></div></div><div class="demo__part-front"></div></div>`);
            partsArray[row - 1][col - 1] = new Part();
        }
    }

    var $parts = $(".demo__part");
    var $image = $(".demo__part-back-inner");
    var help = true;

    for (let i = 0; i < $parts.length; i++)
    {
        $parts.find(".demo__part-front").eq(i).css("background-image", `url(${urls[i]})`);
    }

    $gallery.on("click", ".demo__part-front", function ()
    {

        $image.css("background-image", $(this).css("background-image"));
        if (help)
        {
            $help.html("Click any of the tiles to get back");
            help = false;
        }

        let row = +$(this).closest(".demo__part").attr("row");
        let col = +$(this).closest(".demo__part").attr("col");
        waveChange(row, col);
    });

    $gallery.on("click", ".demo__part-back", function ()
    {
        if (!isShowingBack()) return;

        $help.html(`Check out my other <a target="blank" href="https://codepen.io/kiyutink/">pens</a> and follow me on <a target="_blank" href="https://twitter.com/kiyutin_k">twitter</a>`);

        setTimeout(function ()
        {
            for (let row = 1; row <= rows; row++)
            {
                for (let col = 1; col <= cols; col++)
                {
                    partsArray[row - 1][col - 1].showing = "front";
                }
            }
        }, staggerTime + $parts.length * staggerTime / 10);


        showFront(0, $parts.length);

    });

    function showFront(i, maxI)
    {
        if (i >= maxI) return;
        $parts.eq(i).addClass("show-front");

        reqAnimFr(function ()
        {
            showFront(i + 1);
        });
    }

    function isShowingBack()
    {
        return partsArray[0][0].showing == "back" && partsArray[0][cols - 1].showing == "back" && partsArray[rows - 1][0].showing == "back" && partsArray[rows - 1][cols - 1].showing == "back";
    }

    function Part()
    {
        this.showing = "front";
    }

    function waveChange(rowN, colN)
    {
        if (rowN > rows || colN > cols || rowN <= 0 || colN <= 0) return;
        if (partsArray[rowN - 1][colN - 1].showing == "back") return;
        $(".demo__part-" + rowN + "-" + colN).removeClass("show-front");
        partsArray[rowN - 1][colN - 1].showing = "back";
        setTimeout(function ()
        {
            waveChange(rowN + 1, colN);
            waveChange(rowN - 1, colN);
            waveChange(rowN, colN + 1);
            waveChange(rowN, colN - 1);
        }, staggerTime);
    }
});
jQuery(function ($)
{

    $(".sidebar-dropdown > a").click(function ()
    {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
                .parent()
                .hasClass("active")
        )
        {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else
        {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function ()
    {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function ()
    {
        $(".page-wrapper").addClass("toggled");
    });




});
