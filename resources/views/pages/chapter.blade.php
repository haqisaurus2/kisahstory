<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('seo')
<!-- HTML Meta Tags -->
<title>Baca {{ $chapter->story->type }} {{ $chapter->story->category->name }} {{ $chapter->title }} bahasa indonesia - ceritoon.xyz</title>
<meta name="description" content="baca {{ $chapter->story->type  }} {{ $chapter->story->category->name }} {{ $chapter->title }} bahasa indonesia - {{ $chapter->story->synopsis }}" />
<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://ceritoon.xyz/chapter/{{$chapter->slug}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="baca {{ $chapter->story->type  }} {{ $chapter->story->category->name }} {{ $chapter->title }} bahasa indonesia - ceritoon.xyz" />
<meta property="og:description" content="{{ $chapter->story->category->name }} {{ $chapter->title }} bahasa indonesia - {{ $chapter->story->synopsis }}" />
<meta property="og:image" content="{{ $chapter->story->bg }}" />

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image" />
<meta property="twitter:domain" content="ceritoon.xyz" />
<meta property="twitter:url" content="https://ceritoon.xyz/chapter/{{$chapter->slug}}" />
<meta name="twitter:title" content="baca {{ $chapter->story->type }} {{ $chapter->story->category->name }} {{ $chapter->title }} bahasa indonesia - ceritoon.xyz" />
<meta name="twitter:description" content="{{ $chapter->story->category->name }} {{ $chapter->title }} bahasa indonesia - {{ $chapter->story->synopsis }}" />
<meta name="twitter:image" content="{{ $chapter->story->bg }}" />

<!-- Meta Tags Generated via https://www.opengraph.xyz -->
@endsection
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
 
<!-- section 1 -->
<section class="w-full relative mt-[64px] flex-col items-center justify-center bg-slate-900 pb-48">
    <div class="bg-cover text-left w-full flex-col p-0 xl:pt-5 pb-5 min-h-[250px]" style="background-image: url('{{ $chapter->story->bg}}');">
        <div class="container mx-auto max-w-[1024px] bg-slate-900 py-3 px-5">
            <a href="/story/{{$chapter->story->slug}}">
                <h1 class="text-3xl md:text-5xl font-semibold mt-2 text-primary"><i class="fas fa-arrow-left text-gray-200 text-[28px] md:text-[43px]"></i> {{ $chapter->story->title}} {{ $chapter->order }}</h1>
            </a>
            <div class="flex justify-start mt-3">
                <span class="text-white mr-3"><i class="fas fa-book text-blue-600"></i> Cara baca : {{ $chapter->story->how_to_read }}</span>
                <span class="text-white mr-3"><i class="fas fa-star text-yellow-400"></i> {{ $chapter->rating }}/10</span>
                <span class="text-white mr-3"><i class="fas fa-eye text-primary"></i> <span class="number-convert">{{ $chapter->reader_count }} </span> Kali dibaca</span>
            </div>
            <div class="has-text-left mb-12 mt-2 flex w-full justify-start">
                <a class="px-2 py-1 mr-1 bg-[#4267B2] rounded-sm text-white text-sm" href=""><i class="fa-brands fa-facebook"></i> Facebook</a>
                <a class="px-2 py-1 mx-1 bg-[#1da1f2] rounded-sm text-white text-sm" href=""><i class="fa-brands fa-twitter"></i> Twitter</a>
                <a class="px-2 py-1 mx-1 bg-[#25D366] rounded-sm text-white text-sm" href=""><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
            </div>
        </div>
    </div>
    <div class="container mx-auto w-full border border-gray-700 -m-20 bg-slate-900 shadow-sm rounded-b-md max-w-[1024px]">
        <!-- next prev -->
        <div class="flex justify-between mb-2 p-4">
            @if ($previousChapter === null)
                <button class="px-3 py-1 bg-primary text-white rounded-md opacity-30" disabled><i class="fa-solid fa-arrow-left"></i></button>
            @else
                <a href="/chapter/{{ $previousChapter->slug}}" class="px-3 py-1 bg-primary text-white rounded-md"><i class="fa-solid fa-arrow-left"></i></a>
            @endif
           
            <button class="button-modal-chapter px-3 py-1 bg-blue-600 text-white rounded-md" data-target="modal-js-example"><i class="fas fa-book"></i> Chapters</button>

            @if ($nextChapter === null)
                <button class="px-3 py-1 bg-primary text-white rounded-md opacity-30" disabled><i class="fa-solid fa-arrow-right"></i></button>
            @else
                <a href="/chapter/{{ $nextChapter->slug}}" class="px-3 py-1 bg-primary text-white rounded-md"><i class="fa-solid fa-arrow-right"></i></a>
            @endif
        </div>
        <!-- next prev : e-->
        <!-- chapter image  -->
        <div> 
            <div class="text-center w-full">
                @foreach ($chapter->sections as $section)
                <div class="w-full image-wrapper mb-1 relative" id="section-{{ $section->id }}">
                    @auth
                    <div
                        class="button-bookmark absolute cursor-pointer right-3 bottom-3 text-blue-600"
                        data-story="{{ $chapter->story->id }}"
                        data-chapter="{{ $chapter->id }}"
                        data-section="{{ $section->id}}"
                    >
                        <span class="icon is-small">
                            <i class="fas fa-bookmark"></i>
                        </span>
                    </div>
                    @else
                    <a href="/login?redirect={{ Request::url() }}" class="button-bookmark absolute cursor-pointer right-3 bottom-3 text-blue-600">
                        <span class="icon is-small">
                            <i class="fas fa-bookmark"></i>
                        </span>
                    </a>
                    @endif
                     
                    <div data-id="{{$section->id}}" data-order="{{$section->order}}" class="image-view w-full bg-no-repeat bg-contain"></div>
                </div>
                @endforeach
                 
            </div>
        </div>
        <!-- chapter image :e -->
        <!-- next prev -->
       <div class="flex justify-between mb-2 p-4">
            @if ($previousChapter === null)
                <button class="px-3 py-1 bg-primary text-white rounded-md opacity-30" disabled><i class="fa-solid fa-arrow-left"></i></button>
            @else
                <a href="/chapter/{{ $previousChapter->slug}}" class="px-3 py-1 bg-primary text-white rounded-md"><i class="fa-solid fa-arrow-left"></i></a>
            @endif
           
            <button class="button-modal-chapter px-3 py-1 bg-blue-600 text-white rounded-md" data-target="modal-js-example"><i class="fas fa-book"></i> Chapters</button>
            
            @if ($nextChapter === null)
                <button class="px-3 py-1 bg-primary text-white rounded-md opacity-30" disabled><i class="fa-solid fa-arrow-right"></i></button>
            @else
                <a href="/chapter/{{ $nextChapter->slug}}" class="px-3 py-1 bg-primary text-white rounded-md"><i class="fa-solid fa-arrow-right"></i></a>
            @endif
        </div>
        <!-- next prev : e-->
        <!-- rating  -->
        <div class="my-5">
            <div class="text-center">
                <div class="w-2/3 mx-auto text-white">Nilai Komik :</div>
                <div class="rate-story" data-story-id="{{$chapter->story->id}}" data-story-slug="{{$chapter->story->slug}}"></div>
            </div>
            <div class="text-center">
                <div class="w-2/3 mx-auto text-white">Nilai Chapter :</div>
                <div class="rate-chapter" data-chapter-id="{{$chapter->id}}"></div>
            </div>
        </div>
        <!-- rating : e -->
        <!-- comment section  -->  
        <section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
            <div class="max-w-2xl mx-auto px-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Komentar ({{$chapter->comments->count()}})</h2>
                </div>
                @auth
                    <form class="mb-6"  method="post" action="/comment/chapter">
                        @csrf
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="6" name="body"
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                placeholder="Write a comment..." required></textarea>
                            <input type="hidden" name="chapter_id" value="{{ $chapter->id }}" />
                        </div>
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-primary rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Post comment
                        </button>
                    </form>
                @endauth
                @include("component.commentchapter", ['comments' => $chapter->comments, 'chapter_id' => $chapter->id ])

            </div>
        </section>
            
        <!-- comment section : e -->
    </div>
</section>
<!-- section 1 : e -->
 
<!-- modal -->
<div id="chapter-modal" class="modal z-50 pointer-events-none opacity-0 fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container absolute top-20 bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-close-chapter absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">{{ $chapter->story->title }}</p>
                <div class="modal-close-chapter cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <div class="h-[calc(100vh-220px)] overflow-y-auto">
                @foreach ($chapter->story->chapters as $ch)
                    <div class="border-b py-2">
                        <a href="/chapter/{{ $ch->slug }}">
                            <div class="flex jus">
                                <div class="w-14 aspect-square overflow-hidden"> 
                                    <img src="{{ $ch->story->thumbnail }}" alt="" class="object-cover" />
                                </div>
                                <div class="flex items-center px-3 justify-between w-full">
                                    <div>Chapter {{ $ch->order }}</div>
                                    <span>{{  date('d-M-Y', strtotime($ch->created_at))   }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach 
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button class="modal-close bg-primary px-3 py-2 rounded-lg text-white">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal: e -->  
@endsection

@section('script') 
<script type="module">
    // open modal
    var openmodal = document.querySelectorAll(".button-modal-chapter");
    for (var i = 0; i < openmodal.length; i++) {
        openmodal[i].addEventListener("click", function (event) {
            const modal = document.getElementById("chapter-modal");
            event.preventDefault();
            modal.classList.toggle("z-50");
            modal.classList.toggle("opacity-0");
            modal.classList.toggle("pointer-events-none");
        });
    }
    const overlay = document.querySelector(".modal-overlay");
    overlay.addEventListener("click", () => {
        const modal = document.getElementById("chapter-modal");
        modal.classList.toggle("z-50");
        modal.classList.toggle("opacity-0");
        modal.classList.toggle("pointer-events-none");
    });

    var closemodal = document.querySelectorAll(".modal-close-chapter");
    for (var i = 0; i < closemodal.length; i++) {
        closemodal[i].addEventListener("click", () => {
            const modal = document.getElementById("chapter-modal");
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
            const modal = document.getElementById("chapter-modal");
            modal.classList.toggle("opacity-0");
            modal.classList.toggle("pointer-events-none");
        }
    };
    // open modal : e

    // loading image
    const b64toBlob = (b64Data, contentType = "", sliceSize = 512) => {
        const byteCharacters = atob(b64Data);
        const byteArrays = [];

        for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            const slice = byteCharacters.slice(offset, offset + sliceSize);

            const byteNumbers = new Array(slice.length);
            for (let i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            const byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        const blob = new Blob(byteArrays, { type: contentType });
        return blob;
    };
     
    $(document).ready(() => {
        $(document).on('click', '.button-bookmark.absolute.cursor-pointer', (e) => {
            const btn = $(e.currentTarget); 

            let storyId = btn.data("story");
            let chapterId = btn.data("chapter");
            let sectionId = btn.data("section");
           
            let userId =  @auth {{Auth::user()->id}} @else undefined  @endauth 
           
            $.ajax({
                method: "POST",
                url: "/api/bookmark",
                // headers: { "X-CSRF-Token": csrftoken },
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({ storyId: Number(storyId), chapterId: Number(chapterId), sectionId: Number(sectionId), uid: userId }),
            }).done(function (msg) {
                alert("Bookmarked!");
            });
        })
        // comment reply 
        $(document).on('click', '.reply-button',  (e) => {
            console.log(e)
            $(e.target).addClass("hidden")
            $(e.target).next().removeClass("hidden")
        });
        const images = $(document)
            .find(".image-wrapper .image-view")
            .each((i, e) => {
                const id = $(e).data("id");
                $(e).html(`
                <div class="lds-facebook">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                `);

                $.ajax("/image/" + id, {
                    beforeSend: function (xhr) {
                        xhr.overrideMimeType("text/plain; charset=x-user-defined");
                    },
                })
                    .done((result, status, xhr) => {
                        var binary = "";
                        var responseText = xhr.responseText;
                        var responseTextLen = responseText.length;

                        for (i = 0; i < responseTextLen; i++) {
                            binary += String.fromCharCode(responseText.charCodeAt(i) & 255);
                        }

                        var i = new Image();
                        i.src = "data:" + xhr.getResponseHeader("content-type") + ";base64," + btoa(binary);
                        i.onload = function () {
                            const ratio = i.height / i.width;
                            const width = $(".image-wrapper").width();
                            const height = width * ratio;
                            const blob = b64toBlob(btoa(binary), xhr.getResponseHeader("content-type"));
                            const blobUrl = URL.createObjectURL(blob);
                            $(e).css({
                                "background-image": "url(" + blobUrl + ")",
                                height: height,
                            });
                            $(e).html("");
                        };
                    })
                    .fail((err) => {
                        console.log(err);
                        $(e).html(`<button class='px-3 py-1 bg-gray-600 text-white rounded-md retry-button'>
                            <span class="icon mr-4">
                                <i class="fa  fa-refresh"></i>
                              </span>
                            Retry</button>`);
                    });
            });
    });

    // klik regry button 
    $(document).on("click", ".retry-button", (e) => {
        const parent = $(e.target).parent();
        const id = $(parent).data("id");
        $(parent).html(`
                <div class="lds-facebook">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                `);
        $.ajax("/image/" + id, {
            mimeType: "text/plain; charset=x-user-defined",
        })
            .done((result, status, xhr) => {
                var binary = "";
                var responseText = xhr.responseText;
                var responseTextLen = responseText.length;

                for (i = 0; i < responseTextLen; i++) {
                    binary += String.fromCharCode(responseText.charCodeAt(i) & 255);
                }

                var i = new Image();
                i.src = "data:" + xhr.getResponseHeader("content-type") + ";base64," + btoa(binary);
                i.onload = function () {
                    const ratio = i.height / i.width;
                    const width = $(".image-wrapper").width();
                    const height = width * ratio;
                    const blob = b64toBlob(btoa(binary), xhr.getResponseHeader("content-type"));
                    const blobUrl = URL.createObjectURL(blob);
                    $(parent).css({
                        "background-image": "url(" + blobUrl + ")",
                        height: height,
                        width: "100%",
                    });
                    $(parent).html("");
                };
            })
            .fail(() => {
                $(parent).html(`<button class='px-3 py-1 bg-gray-600 text-white rounded-md retry-button'>
                            <span class="icon mr-4">
                                <i class="fa  fa-refresh"></i>
                              </span>
                            Retry</button>`);
            });
    });

    // loading image : e

    // rating
    // simpan yang terakhir di lihat kalo tidak ada ya create baru  berdasarkan storyId
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
     
    const storyId = `{{ $chapter->story->id }}`; 
              
    db.lastview
        .where("storyId")
        .equals(storyId)
        .first()
        .then((res) => {
            // console.log(res);
            const chapterId = `{{ $chapter->id }}`;
            const title = `{{ $chapter->title }}`;
            const url = window.location.href;
            const chapter = `{{ $chapter->order }}`;
            const thumbnail = `{{ $chapter->story->thumbnail }}`;
            if (res) {
                db.lastview
                    .update(storyId, {
                        pathname: window.location.pathname,
                        storyId: storyId,
                        chapterId: chapterId,
                        title,
                        url: url,
                        chapter: chapter,
                        thumbnail,
                        date: new Date(),
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            } else {
                console.log("add");
                const chapterId = `{{ $chapter->id }}`;
                const title = `{{ $chapter->title }}`;
                const url = window.location.href;
                const chapter = `{{ $chapter->order }}`;
                const thumbnail = `{{ $chapter->story->thumbnail }}`;
                db.lastview.add({
                    pathname: window.location.pathname,
                    storyId: storyId,
                    chapterId: chapterId,
                    title,
                    url: url,
                    thumbnail,
                    chapter: chapter,
                    date: new Date(),
                });
            }
        })
        .catch(() => {
            console.log("add");
            const chapterId = `{{ $chapter->id }}`;
            const title = `{{ $chapter->title }}`;
            const url = window.location.href;
            const chapter = `{{ $chapter->order }}`;
            const thumbnail = `{{ $chapter->story->thumbnail }}`;
            db.lastview.add({
                pathname: window.location.pathname,
                storyId: storyId,
                chapterId: chapterId,
                title,
                url: url,
                thumbnail,
                chapter: chapter,
                date: new Date(),
            });
        });
    const storySlug = $(".rate-story").data("story-slug");
    db.stories
        .where("pathname")
        .startsWith("/story/" + storySlug)
        .first()
        .then((res) => {
            $(".rate-story").starRating({
                initialRating: 0,
                strokeColor: "#894A00",
                strokeWidth: 10,
                starSize: 50,
                readOnly: true,
                initialRating: res.rate,
            });
        })
        .catch(() => {
            $(".rate-story").starRating({
                initialRating: 0,
                strokeColor: "#894A00",
                strokeWidth: 10,
                starSize: 50,
                callback: function (currentRating, $el) {
                    // make a server call here
                    const storyId = $(".rate-story").data("story-id");
                    $.ajax({
                        method: "POST",
                        url: "/action/rate-story",
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify({ rate: currentRating, storyId }),
                    }).done(function (res) {
                        db.stories.add({ pathname: "/story/" + storySlug, rate: currentRating, date: new Date() });
                    });
                },
            });
        });

    db.chapters
        .where("pathname")
        .startsWith(window.location.pathname)
        .first()
        .then((res) => {
            $(".rate-chapter").starRating({
                initialRating: 0,
                strokeColor: "#894A00",
                strokeWidth: 10,
                starSize: 50,
                readOnly: true,
                initialRating: res.rate,
            });
        })
        .catch(() => {
            $(".rate-chapter").starRating({
                initialRating: 0,
                strokeColor: "#894A00",
                strokeWidth: 10,
                starSize: 50,
                callback: function (currentRating, $el) {
                    // make a server call here
                    const chapterId = $(".rate-chapter").data("chapter-id");
                    $.ajax({
                        method: "POST",
                        url: "/action/rate-chapter",
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify({ rate: currentRating, chapterId }),
                    }).done(function (res) {
                        db.chapters.add({ pathname: window.location.pathname, rate: currentRating, date: new Date() });
                    });
                },
            });
        });
    // rating : e

    
</script>
@endsection
