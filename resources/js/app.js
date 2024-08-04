 

import.meta.glob([
    '../images/**', 
]);
var db = new Dexie("ceritoon");
db.version(1).stores({
    chapters: `
    pathname,
    rate,
    date`,
    stories: `
    pathname,
    rate,
    date`,
    lastview: `
    storyId,
    pathname,
    chapterId,
    title,
    thumbnail,
    url, 
    chapter,
    date`,
});

// tampilkan lastview
// console.log(db.lastview);
db.lastview
    .limit(5)
    .reverse()
    .sortBy("date")
    .then((res) => {
        // console.log(res);
        const cards = res.map((e) => {
            return `
    <div class="column is-one-fifth">
        <div class="card">
            <div class="card-image">
                <a href="${e.url}">
            <figure class="image is-4by3">
                <img src="${e.thumbnail}" alt="Placeholder image" class="w-full">
            </figure>
            </div>
            <div class="card-content text-center">
                <p class="title is-4">${e.title}</p>
                <div>
                    <p class="subtitle is-6">Bab ${e.chapter}</p>
                </div>
            </div>
        </a>
        </div>
    </div>
    `;
        });
        const a = `

    <article class="message is-info"> 
        <div class="message-body">
            <div class="columns">
                ${cards}
                </div>
        </div>
    </article>
`;
        if (res.length) {
            $("#body-last-view").append(a);
        }
    });
$(document).on('click', "#go-to-top", function () {
    $("html,body").animate({ scrollTop: 0 }, "slow");
    return false;
})
$(document).on("click", "#last-view-btn", (e) => {
    if ($(".last-view").is(":visible")) {
        $(".last-view").slideUp(400);
    } else {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            {
                easing: "swing",
                duration: 500,
                complete: () => {
                    $(".last-view").slideDown(400);
                },
            }
        );
    }
});
$(document).on("click", ".close-button", (e) => {
    $(".last-view").slideUp(400);
});

// open modal
$(document).ready(function () {
    

    $(window).scroll(function () {
        var sticky = $("#page-header"),
            scroll = $(window).scrollTop();

        if (scroll >= 65) sticky.addClass("bg-white");
        else sticky.removeClass("bg-white");
    });
    $(document).on("click", "#last-view", (event) => {
        console.log("buka");
        const modal = document.getElementById("last-view-modal");
        event.preventDefault();
        modal.classList.toggle("z-50");
        modal.classList.toggle("opacity-0");
        modal.classList.toggle("pointer-events-none");
    });

    const overlay = document.querySelector(".modal-overlay");
    overlay.addEventListener("click", () => {
        const modal = document.getElementById("last-view-modal");
        modal.classList.toggle("z-50");
        modal.classList.toggle("opacity-0");
        modal.classList.toggle("pointer-events-none");
    });

    var closemodal = document.querySelectorAll(".modal-close");
    for (var i = 0; i < closemodal.length; i++) {
        closemodal[i].addEventListener("click", () => {
            const modal = document.getElementById("last-view-modal");
            modal.classList.toggle("z-50");
            modal.classList.toggle("opacity-0");
            modal.classList.toggle("pointer-events-none");
        });
    }
    document.onkeydown = function (evt) {
        evt = evt || window.event;
        var isEscape = false;
        if ("key" in evt) {
            isEscape = evt.key === "Escape" || evt.key === "Esc";
        } else {
            isEscape = evt.keyCode === 27;
        }
        if (isEscape && document.body.classList.contains("modal-active")) {
            const modal = document.getElementById("last-view-modal");
            modal.classList.toggle("opacity-0");
            modal.classList.toggle("pointer-events-none");
        }
    };
    // open modal : e

    function nFormatter(num, digits) {
        const lookup = [
            { value: 1, symbol: "" },
            { value: 1e3, symbol: "K" },
            { value: 1e6, symbol: "M" },
            { value: 1e9, symbol: "G" },
            { value: 1e12, symbol: "T" },
            { value: 1e15, symbol: "P" },
            { value: 1e18, symbol: "E" },
        ];
        const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var item = lookup
            .slice()
            .reverse()
            .find(function (item) {
                return num >= item.value;
            });
        return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
    }
    $(".number-convert").each((i, e) => {
        const text = $(e).text()
        const formatted = nFormatter(text, 2)
        // console.log(formatted)
        $(e).text(formatted )
    });
});

// burger manu 
const burger = document.querySelector("#hamburger")
const mobileMenu = document.querySelector("#mobile-menu")
burger.addEventListener("click", () => { 
    burger.classList.toggle("hamburger-active")
    mobileMenu.classList.toggle("menu-active")
})
// burger manu : e

// menu desktop 
const desktopMenu = document.querySelector("#account")
const desktopMenuPopup = document.querySelector("#account-menu")
desktopMenu.addEventListener("click", () => { 
    console.log('asdf')
    desktopMenuPopup.classList.toggle("hidden") 
})
// menu desktop : e 
