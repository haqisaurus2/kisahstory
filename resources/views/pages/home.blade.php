<!-- Menghubungkan dengan view template master -->
@extends('master')
 
@section('seo')
 <!-- HTML Meta Tags -->
 <title>Situs baca manga, manhua, manhwa dan cerita online bahasa indonesia - ceritoon</title>
 <meta name="description" content="situs baca komik, manga, manhua, manhwa online bahasa indonesia. dengan fitur bookmark untuk menandai kapan terakhir dibaca dan juga forum ">

 <!-- Facebook Meta Tags -->
 <meta property="og:url" content="https://ceritoon.xyz">
 <meta property="og:type" content="website">
 <meta property="og:title" content="ceritoon">
 <meta property="og:description" content="situs baca komik, manga, manhua, manhwa online bahasa indonesia. dengan fitur bookmark untuk menandai kapan terakhir dibaca dan juga forum ">
 <meta property="og:image" content="https://ceritoon.xyz/static/favicon.ico">

 <!-- Twitter Meta Tags -->
 <meta name="twitter:card" content="summary_large_image">
 <meta property="twitter:domain" content="ceritoon.xyz">
 <meta property="twitter:url" content="https://ceritoon.xyz">
 <meta name="twitter:title" content="ceritoon">
 <meta name="twitter:description" content="situs baca komik, manga, manhua, manhwa online bahasa indonesia. dengan fitur bookmark untuk menandai kapan terakhir dibaca dan juga forum ">
 <meta name="twitter:image" content="https://ceritoon.xyz/static/favicon.ico">
@endsection

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
    <h1>situs baca komik bahasa indonesia</h1>
    <!-- section hero -->
    <section class="w-full relative py-5 mt-[70px] flex items-center justify-center">
        <div class="bg-image"></div>
        <div class="container mx-auto w-full p-2">
            <div class="flex h-60 md:h-96 lg:h-[500px] relative">
                <div class="bg-blue-300 main-grid w-full">
                    <img src="{{ $top3[0]->bg }}" alt="{{ $top3[0]->title }}" class="object-cover h-full w-full" />
                    <div class="absolute w-full h-full top-0 left-0 flex-col items-center justify-center p-3 bg-[#9ab710] text-white opacity-0 hover:opacity-100 transition duration-300 ease-in-out">
                        <a href="/story/{{ $top3[0]->slug }}" class="text-3xl mb-2">
                            <h2>{{ $top3[0]->title }}</h2>
                        </a>
                        <div class="flex text-white">
                            <span class="text-white mr-3"><i class="fas fa-eye"></i> <span class="number-convert">{{ $top3[0]->reader_count }}</span></span>
                            <span class="text-white"><i class="fas fa-star"></i> {{ $top3[0]->rating }}/10</span>
                        </div>
                        <div class="max-w-[70%] text-sm">{{$top3[0]->Synopsis}}</div>
                    </div>
                </div>
                <div class="second-grid relative w-3/4 h-full">
                    <div class="bg-red-200 h-1/2 mb-3 relative up-grid">
                        <img src="{{ $top3[1]->bg }}" alt="{{ $top3[1]->title }}" class="object-cover h-full w-full" />
                        <div class="absolute w-full h-full top-0 left-0 flex-col items-center justify-center p-3 bg-[#eea800] text-white opacity-0 hover:opacity-100 transition duration-300 ease-in-out">
                            <div  class=" md:text-3xl rounded-lg max-w-[70%] text-right mb-2 ml-auto">
                                <a href="/story/{{ $top3[1]->slug }}">
                                    <h2>{{ $top3[1]->title }}</h2>
                                </a>
                            </div>
                            <div class="flex-col items-center justify-end text-white text-right">
                                <span class="text-white mr-3"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $top3[1]->reader_count }}</span></span>
                                <span class="text-white"><i class="fas fa-star"></i> {{ $top3[1]->rating }}/10</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-300 h-1/2 relative bottom-grid">
                        <img src="{{ $top3[2]->bg }}" alt="{{ $top3[2]->title }}" class="object-cover h-full w-full" />
                        <div class="absolute w-full h-full top-0 left-0 text-right flex-col items-end justify-end p-3 bg-[#fd337f] text-white opacity-0 hover:opacity-100 transition duration-300 ease-in-out">
                            <div class=" md:text-3xl rounded-lg w-72 mb-2 max-w-[87%] relative mt-[10%] ml-auto">
                                <a href="/story/{{ $top3[2]->slug }}" >
                                    <h2>{{ $top3[2]->title }}</h2>
                                </a>
                            </div>
                            <div class="flex-col items-center justify-end text-white">
                                <span class="text-white mr-3"><i class="fas fa-eye"></i> <span class="number-convert">{{ $top3[2]->reader_count }}</span></span>
                                <span class="text-white"><i class="fas fa-star"></i> {{ $top3[2]->rating }}/10</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section hero : e -->
     
    <hr class="container mx-auto my-3" />
    <!-- section 1 Populer -->
    <section class="container mx-auto w-full p2">
        <h2 class="font-bold text-3xl mb-5 mt-6 px-3">Populer <span class="text-primary">Komik</span></h2>
        <div class="flex overflow-x-scroll pb-10 scrollbar-hide">
            <div class="flex flex-nowrap">
                @foreach ($populars as $popular)
                    <div class="inline-block px-3">
                        <div class="w-80 h-44 lg:h-64 max-w-xs flex overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <div class="flex min-w-[142px] min-h-[130px]">
                                <a href="/story/{{$popular->slug}}" class="w-full"> 
                                    <img src="{{$popular->thumbnail}}" alt="{{$popular->title}}" class="w-full object-cover h-full rounded-l-lg" />
                                </a>
                            </div>
                            <div class="flex-auto flex-col p-3 border-t border-r border-b rounded-r-lg">
                                <a href="/story/{{$popular->slug}}">  
                                    <h2 class="text-gray-900 font-bold text-lg md:text-xl mb-2">{{$popular->title}} <span class="text-gray-300 text-sm"> ({{  $popular->category->name }})</span></h2>
                                </a>
                                <div class="text-sm">
                                    @if (count($popular->chapters) > 0)
                                        <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$popular->chapters[0]->slug}}">{{$popular->last_chapter}}</a></p>
                                        <p class="text-gray-600">{{date('d-M-Y', strtotime($popular->chapters[0]->created_at)) }}</p>
                                    @endif
                                    
                                </div>
                                <div class="flex">
                                    <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $popular->reader_count }}</span>  </span>
                                    <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $popular->rating }}/10</span> 
                                </div> 
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- section 1 Populer: e -->
    <!-- section 1 Rekomen -->
    <section class="container mx-auto w-full p2">
        <h2 class="font-bold text-3xl mb-5 mt-6 px-3">Rekomendasi <span class="text-primary">Komik</span></h2>
        <div class="flex overflow-x-scroll pb-10 scrollbar-hide">
            <div class="flex flex-nowrap">
                @foreach ($recommendations as $recommend)
                    <div class="inline-block px-3">
                        <div class="w-80 h-44 lg:h-64 max-w-xs flex overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <div class="flex min-w-[142px] min-h-[130px]">
                                <a href="/story/{{$recommend->slug}}" class="w-full"> 
                                    <img src="{{$recommend->thumbnail}}" alt="{{$recommend->title}}" class="w-full object-cover h-full rounded-l-lg" />
                                </a>
                            </div>
                            <div class="flex-auto flex-col p-3 border-t border-r border-b rounded-r-lg">
                                <a href="/story/{{$recommend->slug}}">  
                                    <h2 class="text-gray-900 font-bold text-lg md:text-xl mb-2">{{$recommend->title}} <span class="text-gray-300 text-sm"> ({{  $recommend->category->name }})</span></h2>
                                </a>
                                <div class="text-sm">
                                    @if (count($recommend->chapters) > 0)
                                        <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$recommend->chapters[0]->slug}}">{{$recommend->last_chapter}}</a></p>
                                        <p class="text-gray-600">{{date('d-M-Y', strtotime($recommend->chapters[0]->created_at)) }}</p>
                                    @endif
                                    
                                </div>
                                <div class="flex">
                                    <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $recommend->reader_count }}</span>  </span>
                                    <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $recommend->rating }}/10</span> 
                                </div> 
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- section 1 Rekomen: e -->
    <hr class="container mx-auto my-3" />

    <!-- section list update and new -->
    <section class="w-full">
        <div class="container mx-auto flex flex-wrap md:justify-between">
            <div class="flex p-2 w-full md:w-1/2">
                <div class="w-full">
                    <h4 class="font-bold text-3xl mb-5 mt-6 px-3"><span class="text-primary"> Update </span>Terbaru</h4>
                    <div class="flex-col w-full">
                        @foreach ($updatedComics as $comic)
                        <div class="block px-3 pb-2 mt-2 border-b-2">
                            <div class="h-20 flex overflow-hidden bg-white w-full">
                                <a href="/story/{{$comic->slug}}" class="flex w-20">
                                    <img src="{{$comic->thumbnail}}" alt="{{$comic->title}}}" class="object-cover h-full w-full" />
                                </a>
                                <div class="flex flex-col pl-2">
                                    <a href="/story/{{$comic->slug}}">
                                        <h3 class="text-gray-900 font-bold text-sm mb-2">{{$comic->title}} <span class="text-gray-300 text-sm"> ({{  $comic->category->name }})</span></h3> 
                                    </a>
                                    @if (count($recommend->chapters) > 0) 
                                        <div class="text-sm">
                                            <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$comic->chapters[0]->slug}}">{{$comic->last_chapter}}</a></p>
                                            <p class="text-gray-600">{{date('d-M-Y', strtotime($comic->updated_at)) }}</p>
                                        </div>
                                    @endif 
                                    <div class="flex">
                                        <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $comic->reader_count }} </span></span>  
                                        <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $comic->rating }}/10</span> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                        @endforeach  
                    </div>
                </div>
            </div>
            <div class="flex p-2 w-full md:w-1/2">
                <div class="w-full">
                    <h4 class="font-bold text-3xl mb-5 mt-6 px-3"><span class="text-primary"> Judul </span>Baru</h4>
                    <div class="flex-col w-full">
                        @foreach ($newComics as $comic)
                        <div class="block px-3 pb-2 mt-2 border-b-2">
                            <div class="h-20 flex overflow-hidden bg-white w-full">
                                <a href="/story/{{$comic->slug}}" class="flex w-20">
                                    <img src="{{$comic->thumbnail}}" alt="{{$comic->title}}}" class="object-cover h-full w-full" />
                                </a>
                                <div class="flex flex-col pl-2">
                                    <a href="/story/{{$comic->slug}}">
                                        <h3 class="text-gray-900 font-bold text-sm mb-2">{{$comic->title}} <span class="text-gray-300 text-sm"> ({{  $comic->category->name }})</span></h3> 
                                    </a>
                                    @if (count($recommend->chapters) > 0) 
                                        <div class="text-sm">
                                            <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$comic->chapters[0]->slug}}">{{$comic->last_chapter}}</a></p>
                                            <p class="text-gray-600">{{date('d-M-Y', strtotime($comic->created_at)) }}</p>
                                        </div>
                                    @endif 
                                    <div class="flex">
                                        <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $comic->reader_count }} </span></span>  
                                        <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $comic->rating }}/10</span> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                        @endforeach  
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section list update and new: e -->

    <!-- Manga section -->
    <section class="w-full mt-8">
        <div class="container mx-auto flex flex-wrap px-3">
            <div class="flex-col w-full md:w-1/4 mb-3 px-1">
                <h5 class="font-bold text-3xl mb-5 mt-6">Manga</h5>
                <p class="mb-5 mt-6">Manga adalah komik atau novel grafik yang dibuat di Jepang atau menggunakan bahasa Jepang, sesuai dengan gaya yang dikembangkan di sana pada akhir abad ke-19. Manga memiliki
                    sejarah awal yang panjang dan kompleks dalam seni Jepang terdahulu.
                </p>
                <a href="/category/manga" class="underline text-blue-500">Lebih Lanjut...</a>
            </div>
            @foreach ($mangas as $manga)
                <div class="px-2 box-border w-full md:w-1/4">
                    <div class="flex-col mb-3 bg-white shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out rounded-lg">
                        <div class="flex md:h-44">
                            <a href="/story/{{$manga->slug}}" class="w-full">
                                <img src="{{$manga->thumbnail}}" alt="" class="object-cover h-full w-full rounded-t-lg" />
                            </a>
                        </div>
                        <div class="flex flex-col p-3">
                            <a href="/story/{{$manga->slug}}">
                                <div class="text-gray-900 font-bold text-xl mb-2">{{$manga->title}}</div>
                            </a>  
                            @if (count($manga->chapters) > 0) 
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$manga->chapters[0]->slug}}">{{$manga->last_chapter}}</a></p>
                                    <p class="text-gray-600">{{date('d-M-Y', strtotime($manga->chapters[0]->created_at)) }}</p>
                                </div>
                            @endif 
                            <div class="flex">
                                <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $manga->reader_count }} </span></span>  
                                <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $manga->rating }}/10</span> 
                            </div>  
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
    </section>
    <!-- Manga section: e -->
    <hr class="container mx-auto my-3" />
    <!-- Manhwa section -->
    <section class="w-full mt-8">
        <div class="container mx-auto flex flex-col-reverse md:flex-row flex-wrap px-3">
            @foreach ($manhwas as $manga)
                <div class="px-2 box-border w-full md:w-1/4">
                    <div class="flex-col mb-3 bg-white shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out rounded-lg">
                        <div class="flex md:h-44">
                            <a href="/story/{{$manga->slug}}" class="w-full">
                                <img src="{{$manga->thumbnail}}" alt="" class="object-cover h-full w-full rounded-t-lg" />
                            </a>
                        </div>
                        <div class="flex flex-col p-3">
                            <a href="/story/{{$manga->slug}}">
                                <div class="text-gray-900 font-bold text-xl mb-2">{{$manga->title}}</div>
                            </a>  
                            @if (count($manga->chapters) > 0) 
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$manga->chapters[0]->slug}}">{{$manga->last_chapter}}</a></p>
                                    <p class="text-gray-600">{{date('d-M-Y', strtotime($manga->chapters[0]->created_at)) }}</p>
                                </div>
                            @endif 
                            <div class="flex">
                                <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $manga->reader_count }} </span></span>  
                                <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $manga->rating }}/10</span> 
                            </div>  
                        </div>
                    </div>
                </div>
            @endforeach  
            <div class="flex-col w-full md:w-1/4 mb-3 px-1">
                <h5 class="font-bold text-3xl mb-5 mt-6 text-primary">Manhwa</h5>
                <p class="mb-5 mt-6">Manhwa adalah istilah yang digunakan untuk komik atau buku komik yang berasal dari Korea Selatan. Manhwa umumnya memiliki gaya dan format yang berbeda dengan manga (komik Jepang) dan komik Barat.</p>
                <a href="/category/manhwa" class="underline text-blue-500">Lebih Lanjut...</a>
            </div>
        </div>
    </section>
    <!-- Manhwa section: e -->
  
	
    <hr class="container mx-auto my-3" />

    <!-- Manhua section -->
    <section class="w-full mt-8">
        <div class="container mx-auto flex-wrap md:flex">
            <div class="flex-col w-full md:w-1/4 mb-3 ">
                <h5 class="font-bold text-3xl mb-5 mt-6 px-3">Manhua</h5>
                <p class="mb-5 mt-6 px-3">Manhua adalah sebutan untuk komik-komik berbahasa Mandarin yang dibuat di Tiongkok Daratan, Hong Kong, dan Taiwan.</p>
                <a href="/category/manhua" class="px-3 underline text-blue-500">Lebih Lanjut...</a>
            </div>
            @foreach ($manhuas as $manga)
                <div class="px-2 box-border w-full md:w-1/4">
                    <div class="flex-col mb-3 bg-white shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out rounded-lg">
                        <div class="flex md:h-44">
                            <a href="/story/{{$manga->slug}}" class="w-full">
                                <img src="{{$manga->thumbnail}}" alt="" class="object-cover h-full w-full rounded-t-lg" />
                            </a>
                        </div>
                        <div class="flex flex-col p-3">
                            <a href="/story/{{$manga->slug}}">
                                <div class="text-gray-900 font-bold text-xl mb-2">{{$manga->title}}</div>
                            </a>  
                            @if (count($manga->chapters) > 0) 
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none ">Bab Terakhir: <a class="bg-slate-500 rounded-sm p-1 text-white underline"  href="/chapter/{{$manga->chapters[0]->slug}}">{{$manga->last_chapter}}</a></p>
                                    <p class="text-gray-600">{{date('d-M-Y', strtotime($manga->chapters[0]->created_at)) }}</p>
                                </div>
                            @endif 
                            <div class="flex">
                                <span class="text-gray-900 text-sm mr-2"><i class="fas fa-eye"></i> <span class="number-convert"> {{ $manga->reader_count }} </span></span>  
                                <span class="text-gray-900 text-sm"><i class="fas fa-star"></i> {{ $manga->rating }}/10</span> 
                            </div>  
                        </div>
                    </div>
                </div>
            @endforeach  
        </div>
    </section>
    <!-- Manhua section: e -->
    <hr class="container mx-auto my-3" />
@endsection