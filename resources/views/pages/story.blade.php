<!-- Menghubungkan dengan view template master -->
@extends('master')
 
@section('seo')
<!-- HTML Meta Tags -->
<title>Baca {{ $story->type }} {{ $story->category->name }} {{ $story->title }} bahasa indonesia - ceritoon.xyz</title>

<meta name="description" content="{{ $story->type }} {{ $story->category->name }} {{ $story->title }} bahasa indonesia - {{$story->synopsis}}" />

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://ceritoon.xyz/story/{{$story->slug}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="baca {{ $story->type }} {{ $story->category->name }} {{ $story->title }} bahasa indonesia - ceritoon.xyz" />
<meta property="og:description" content="{{ $story->category->name }} {{ $story->title }} - {{$story->synopsis}}" />
<meta property="og:image" content="{{ $story->bg  }}" />

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image" />
<meta property="twitter:domain" content="ceritoon.xyz" />
<meta property="twitter:url" content="https://ceritoon.xyz/story/{{$story->slug}}" />
<meta name="twitter:title" content="baca {{ $story->type }} {{ $story->category->name }} {{ $story->title }} bahasa indonesia - ceritoon.xyz" />
<meta name="twitter:description" content="{{ $story->category->name }} {{ $story->title }} - {{$story->synopsis}}" />
<meta name="twitter:image" content="{{ $story->bg  }}" />

<!-- Meta Tags Generated via https://www.opengraph.xyz -->
@endsection
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
<!-- section 1 -->
<section class="w-full relative mt-[64px] flex-col items-center justify-center bg-[#f5f5f5] pb-48">
    <div class="bg-cover text-center w-full flex-col py-5 min-h-[400px] relative" style="background-image: url('{{ $story->bg }}');">
        <div class="absolute m-auto w-full top-0 h-3/4 z-0">
            <svg  class="w-full h-full"  xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 600 600" opacity="1"><path d="M64.00524506893487 396.5968602365218C-13.874335110915396 356.5445022449854 -16.492139320306663 218.84816231985516 58.50786195125909 178.2722447580062C133.50786322282482 137.69632719615723 426.17802542375256 128.40313465058432 514.0052526983294 153.14135486542807C601.8324799729062 177.87957508027182 583.5078772100482 282.4607264067692 585.47122559872 326.7015660470687C587.4345739873919 370.9424056873682 612.6963397853249 406.93717700898276 525.7853430303607 418.58639270722495C438.8743462753965 430.23560840546713 141.88482524878515 436.64921822805826 64.00524506893487 396.5968602365218C-13.874335110915396 356.5445022449854 -16.492139320306663 218.84816231985516 58.50786195125909 178.2722447580062 " fill="url(&quot;#SvgjsLinearGradient1002&quot;)"></path><defs><linearGradient id="SvgjsLinearGradient1002"><stop stop-color="hsl(147, 100%, 43%)" offset="0"></stop><stop stop-color="hsl(147, 62%, 51%)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1003" gradientTransform="rotate(202, 0.5, 0.5)"><stop stop-color="hsl(105, 69%, 40%)" offset="0"></stop><stop stop-color="hsl(105, 69%, 60%)" offset="1"></stop></linearGradient><radialGradient id="SvgjsRadialGradient1004"><stop stop-color="hsl(340, 45%, 50%)" offset="0"></stop><stop stop-color="hsl(340, 45%, 80%)" offset="1"></stop></radialGradient></defs><path d="M-13.743446689622942 364.397916584118C-91.62302686947321 324.34555859258154 -94.24083107886447 186.64921866745132 -19.240829807298724 146.07330110560235C55.75917146426703 105.49738354375339 348.42933366519475 96.20419099818048 436.2565609397716 120.94241121302423C524.0837882143484 145.68063142786798 505.75918545149034 250.26178275436536 507.7225338401622 294.50262239466485C509.6858822288341 338.74346203496435 534.9476480267671 374.7382333565789 448.03665127180284 386.3874490548211C361.12565451683867 398.0366647530633 64.13613349022732 404.4502745756544 -13.743446689622942 364.397916584118C-91.62302686947321 324.34555859258154 -94.24083107886447 186.64921866745132 -19.240829807298724 146.07330110560235 " fill-opacity="0.77" fill="url(&quot;#SvgjsLinearGradient1003&quot;)" opacity="1" stroke-opacity="1" stroke-width="0" stroke="hsl(340, 45%, 30%)" transform="matrix(-1,0,0,1,513.7579956054688,75)"></path></svg>
            
        </div>
        <h1 class="text-5xl font-semibold mt-16 text-gray-100 relative z-10">{{ $story->title }}</h1>
        <h2 class="font-semibold  relative z-10">{{ $story->category->name }}</h2>
        <div class="flex justify-center mb-20 mt-3  relative z-10">
            <span class="text-white mr-3"><i class="fas fa-eye text-primary"></i> <span class="number-convert">{{ $story->reader_count }} </span> Reader</span>
            <span class="text-white"><i class="fas fa-star text-yellow-400"></i> Rating {{ $story->rating }}/10</span>
        </div>
    </div>
    <div class="container mx-auto w-full border -m-36 bg-white shadow-sm rounded-md relative z-10">
        <div class="flex flex-wrap md:flex-row-reverse">
            <div class="flex-col w-full md:w-1/4 p-3">
                <div class="has-text-left mb-3 mt-2 flex flex-wrap w-full justify-start">
                    <a class="px-2 py-1 m-1 w-auto bg-[#4267B2] rounded-sm text-white text-sm" href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"><i class="fa-brands fa-facebook"></i> Facebook</a>
                    <a class="px-2 py-1 m-1 w-auto bg-[#1da1f2] rounded-sm text-white text-sm" href="https://twitter.com/intent/tweet?url={{Request::url()}}"><i class="fa-brands fa-twitter"></i> Twitter</a>
                    <a class="px-2 py-1 m-1 w-auto bg-[#25D366] rounded-sm text-white text-sm" href="https://api.whatsapp.com/send?text={{Request::url()}}"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
                </div>
                <div class="w-full">
                    <img src="{{ $story->thumbnail }}" alt="" class="w-full md:w-3/4" />
                </div>
                <div class="my-4 flex flex-wrap">
                    @foreach ($story->tags as $tag) 
                        <a class="px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs" href="/tag/{{ $tag->slug }}">{{$tag->name}}</a>
                    @endforeach 
                </div>
                <div class="mt-5 text-sm flex flex-wrap">
                    <div class="w-1/2">Status:</div>
                    <div class="w-1/2">: ON GOING</div>
                </div>
                <div class="mt-1 text-sm flex flex-wrap">
                    <div class="w-1/2">Jenis Komik</div>
                    <div class="w-1/2">: <a href="/{{ $story->category->slug }}">{{ $story->category->name }}</a></div>
                </div>
                <div class="mt-1 text-sm flex flex-wrap">
                    <div class="w-1/2">Artist</div>
                    <div class="w-1/2">: <a href="/artist/{{ $story->artist->slug }}">{{ $story->artist->name }}</a></div>
                </div>
                <div class="mt-1 text-sm flex flex-wrap">
                    <div class="w-1/2">Author</div>
                    <div class="w-1/2">: <a href="/artist/{{ $story->author->slug }}">{{ $story->author->name }}</a></div>
                </div>
                <div class="mt-1 text-sm flex flex-wrap">
                    <div class="w-1/2">Cara baca</div>
                    <div class="w-1/2">: {{ $story->how_to_read }}</div>
                </div>
                <div class="mt-1 text-sm flex flex-wrap">
                    <div class="w-1/2">Terbit terakhir</div>
                    <div class="w-1/2">: {{  date('d-M-Y', strtotime($story->chapters[0]->created_at)) }}</div>
                </div>
                <div class="mt-1 text-sm flex flex-wrap">
                    <div class="w-1/2">Chapter terakhir</div>
                    <div class="w-1/2">
                        :
                        <a class="bg-slate-500 rounded-sm p-1 text-white underline" href="/chapter/{{ $story->chapters[0]->slug }}">{{ $story->last_chapter }}</a>
                    </div>
                </div>

                <div class="mt-4 text-sm">
                    <p>{{ $story->synopsis }}</p>
                </div>
            </div>
            <div class="flex w-full md:w-3/4 border-r">
                <!-- The wrapper of tabs -->
                <div class="w-full">
                    <!-- Tab Buttons -->
                    <div id="tab-buttons" class="flex border-b">
                        <div class="flex-grow p-3 text-center border-r rounded-tl-md bg-gray-800 text-white cursor-pointer" data-target="chapters">
                            <span>Chapter</span>
                        </div>
                        <div class="flex-grow p-3 text-center rounded-tr-md cursor-pointer" data-target="forums">
                            <span>Forums</span>
                        </div>
                    </div>

                    <!-- Tab Panels -->
                    <div id="tab-panels" class="bg-white px-8 pt-6 pb-8">
                        <div id="chapters"  >
                            <ul> 
                                @foreach ($story->chapters as $chapter) 
                                    <li class="border-b py-2">
                                        <a href="/chapter/{{ $chapter->slug }}">
                                            <div class="flex jus">
                                                <div class="w-14 aspect-square overflow-hidden">
                                                    <img src="{{ $chapter->story->thumbnail }}" alt="" class="object-cover" />
                                                </div>
                                                <div class="flex items-center pl-4 justify-between w-full">
                                                    <div>
                                                        Chapter {{ $chapter->order }} 
                                                    </div>
                                                    <span>{{ date('d-M-Y', strtotime($chapter->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach 
                            </ul>
                        </div>

                        <div id="forums" class="hidden">
                            <!-- comment section  -->
                            <section class="bg-white  py-8 lg:py-16">
                                <div class="max-w-2xl mx-auto px-4">
                                    <div class="flex justify-between items-center mb-6">
                                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900  ">Komentar ({{$chapter->comments->count()}})</h2>
                                    </div>
                                    @auth
                                        <form class="mb-6"  method="post" action="/comment/story">
                                            @csrf
                                            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 ">
                                                <label for="comment" class="sr-only">Your comment</label>
                                                <textarea id="comment" rows="6" name="body"
                                                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none placeholder-gray-400  "
                                                    placeholder="Write a comment..." required></textarea>
                                                <input type="hidden" name="story_id" value="{{ $story->id }}" />
                                            </div>
                                            <button type="submit"
                                                class="inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-primary rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                Post comment
                                            </button>
                                        </form>
                                    @endauth
                                    @include("component.commentstory", ['comments' => $story->comments, 'story_id' => $story->id ])
                    
                                </div>
                            </section>
                            <!-- comment section : e -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section 1 : e -->
@endsection


@section('script') 
<script type="module"> 
    const chapterTab = document.querySelector("[data-target='chapters']")
    const forumsTab = document.querySelector("[data-target='forums']")
    
    chapterTab.addEventListener("click", (e) => {
        chapterTab.classList.add("bg-gray-800", "text-white")
        forumsTab.classList.remove("bg-gray-800", "text-white")
        const forums = document.querySelector("#forums")
        forums.classList.add("hidden")
        const chapters = document.querySelector("#chapters")
        chapters.classList.remove("hidden")
    })
    
    forumsTab.addEventListener("click", (e) => {
        chapterTab.classList.remove("bg-gray-800", "text-white")
        forumsTab.classList.add("bg-gray-800", "text-white")
        const chapters = document.querySelector("#chapters")
        chapters.classList.add("hidden")
        const forums = document.querySelector("#forums")
        forums.classList.remove("hidden")
    })
 
    $(document).ready(() => {
        // comment reply 
        $(document).on('click', '.reply-button',  (e) => {
            console.log(e)
            $(e.target).addClass("hidden")
            $(e.target).next().removeClass("hidden")
        });
    });
</script>
@endsection
