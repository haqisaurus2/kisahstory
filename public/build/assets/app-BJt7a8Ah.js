var r=new Dexie("ceritoon");r.version(1).stores({chapters:`
    pathname,
    rate,
    date`,stories:`
    pathname,
    rate,
    date`,lastview:`
    storyId,
    pathname,
    chapterId,
    title,
    thumbnail,
    url, 
    chapter,
    date`});r.lastview.limit(5).reverse().sortBy("date").then(o=>{const a=`

    <article class="message is-info"> 
        <div class="message-body">
            <div class="columns">
                ${o.map(s=>`
    <div class="column is-one-fifth">
        <div class="card">
            <div class="card-image">
                <a href="${s.url}">
            <figure class="image is-4by3">
                <img src="${s.thumbnail}" alt="Placeholder image" class="w-full">
            </figure>
            </div>
            <div class="card-content text-center">
                <p class="title is-4">${s.title}</p>
                <div>
                    <p class="subtitle is-6">Bab ${s.chapter}</p>
                </div>
            </div>
        </a>
        </div>
    </div>
    `)}
                </div>
        </div>
    </article>
`;o.length&&$("#body-last-view").append(a)});$(document).on("click","#go-to-top",function(){return $("html,body").animate({scrollTop:0},"slow"),!1});$(document).on("click","#last-view-btn",o=>{$(".last-view").is(":visible")?$(".last-view").slideUp(400):$("html, body").animate({scrollTop:0},{easing:"swing",duration:500,complete:()=>{$(".last-view").slideDown(400)}})});$(document).on("click",".close-button",o=>{$(".last-view").slideUp(400)});$(document).ready(function(){$(window).scroll(function(){var e=$("#page-header"),t=$(window).scrollTop();t>=65?e.addClass("bg-white"):e.removeClass("bg-white")}),$(document).on("click","#last-view",e=>{console.log("buka");const t=document.getElementById("last-view-modal");e.preventDefault(),t.classList.toggle("z-50"),t.classList.toggle("opacity-0"),t.classList.toggle("pointer-events-none")}),document.querySelector(".modal-overlay").addEventListener("click",()=>{const e=document.getElementById("last-view-modal");e.classList.toggle("z-50"),e.classList.toggle("opacity-0"),e.classList.toggle("pointer-events-none")});for(var c=document.querySelectorAll(".modal-close"),a=0;a<c.length;a++)c[a].addEventListener("click",()=>{const e=document.getElementById("last-view-modal");e.classList.toggle("z-50"),e.classList.toggle("opacity-0"),e.classList.toggle("pointer-events-none")});document.onkeydown=function(e){e=e||window.event;var t=!1;if("key"in e?t=e.key==="Escape"||e.key==="Esc":t=e.keyCode===27,t&&document.body.classList.contains("modal-active")){const l=document.getElementById("last-view-modal");l.classList.toggle("opacity-0"),l.classList.toggle("pointer-events-none")}};function s(e,t){const l=[{value:1,symbol:""},{value:1e3,symbol:"K"},{value:1e6,symbol:"M"},{value:1e9,symbol:"G"},{value:1e12,symbol:"T"},{value:1e15,symbol:"P"},{value:1e18,symbol:"E"}],n=/\.0+$|(\.[0-9]*[1-9])0+$/;var i=l.slice().reverse().find(function(m){return e>=m.value});return i?(e/i.value).toFixed(t).replace(n,"$1")+i.symbol:"0"}$(".number-convert").each((e,t)=>{const l=$(t).text(),n=s(l,2);$(t).text(n)})});const d=document.querySelector("#hamburger"),u=document.querySelector("#mobile-menu");d.addEventListener("click",()=>{d.classList.toggle("hamburger-active"),u.classList.toggle("menu-active")});const v=document.querySelector("#account"),g=document.querySelector("#account-menu");v.addEventListener("click",()=>{console.log("asdf"),g.classList.toggle("hidden")});
