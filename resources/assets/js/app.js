/*
*  Active-BArs
*  hide top bar on scroll & toggle side bar on toggle button clicking
*/
(function(){
    'use strict';
    var h = document.getElementById('active-header'); // header
    var hAClass = '--hide-head'; // header activate class
    //var hs = true; // status of header
    var shadow = h.getElementsByClassName('overlay-shadow')[0];// shadow
    var a = document.getElementById('active-aside'); // aside
    var aAClass = '--show-bar'; // aside activated class
    var as = false; // status of aside
    var Y = window.pageYOffset; // current Y position

    window.onscroll = function() {
        if(!as){
            if(window.pageYOffset-Y>0){h.classList.add(hAClass);}
            else {h.classList.remove(hAClass);}
            Y = window.pageYOffset;
        }
    };

    var t = document.getElementById('aside-toggler'); // aside-toggler
    // Return if no toggle button
    if(t){
        t.onclick = function(){
            a.classList.toggle(aAClass);
            if(!as){
                shadow.style.width = "100%";
                document.body.classList.add('--noscroll');
            } else {
                shadow.style.width = "0px";
                document.body.classList.remove('--noscroll');
            }
            as = !as;
        };
    } else {return;}

})();

/*
*  Forms toggle labels
*  'focused' labels on radio inputs checked
*/
(function(){
    var togglerClass = '.slider-toggler ';
    var togglerFocusClass = 'focus';
    var logId = 'login'; var regId = 'register';
    var login = document.getElementById(logId);
    var logLabel = document.querySelector(togglerClass + "label[for="+ logId +"]");
    var register = document.getElementById(regId);
    var regLabel = document.querySelector(togglerClass + "label[for="+ regId +"]");

    if(!login||!register||!logLabel||!regLabel){
        return;
    }
    //add focus to login label first by default
    logLabel.classList.add(togglerFocusClass);

    login.onchange = function(){
        logLabel.classList.toggle(togglerFocusClass);
        regLabel.classList.toggle(togglerFocusClass);
    };
    register.onchange = function(){
        regLabel.classList.toggle(togglerFocusClass);
        logLabel.classList.toggle(togglerFocusClass);
    };
})();


/*
* Forms labels interaction with inputs
* Animate labels for inputs when it focused and value is set
*/
(function(){
    var formGroups = document.querySelectorAll('form.res-form .res-form-group');
    formGroups.forEach(function(group){
        var input = group.getElementsByTagName('input')[0];
        var label = group.querySelector('label[for='+ input.id +']');
        if(input.value){
            label.classList.add('focus');
        }
        input.onfocus= function(){
            label.classList.add('focus');
        };
        input.onblur = function(){
            if(this.value === undefined || this.value === ''){
                label.classList.remove('focus');
            }
        };
    });
})();
