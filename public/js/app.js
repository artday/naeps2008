!function(){"use strict";var e=document.getElementById("active-header"),t="--hide-head",s=e.getElementsByClassName("overlay-shadow")[0],o=document.getElementById("active-aside"),d=!1,n=document.getElementById("aside-toggler"),a=window.pageYOffset;n.onclick=function(){o.classList.toggle("--show-bar"),d?(s.style.width="0px",document.body.classList.remove("--noscroll")):(s.style.width="100%",document.body.classList.add("--noscroll")),d=!d},window.onscroll=function(){d||(window.pageYOffset-a>0?e.classList.add(t):e.classList.remove(t),a=window.pageYOffset)}}();