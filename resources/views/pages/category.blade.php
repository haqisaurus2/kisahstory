<!-- Menghubungkan dengan view template master -->
@extends('master')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
<!-- section 1 -->
<section class="container mx-auto w-full p2 mt-[75px]">
    <div class="  text-3xl mb-5 mt-6 px-3">
         
        <ul class="flex items-center text-sm justify-center w-full  flex-wrap mb-2">
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=a" class="pagination-link" aria-label="Goto page 1">A</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=b" class="pagination-link" aria-label="Goto page 1">B</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=c" class="pagination-link" aria-label="Goto page 1">C</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=d" class="pagination-link" aria-label="Goto page 1">D</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=e" class="pagination-link" aria-label="Goto page 1">E</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=f" class="pagination-link" aria-label="Goto page 1">F</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=g" class="pagination-link" aria-label="Goto page 1">G</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=h" class="pagination-link" aria-label="Goto page 1">H</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=i" class="pagination-link" aria-label="Goto page 1">I</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=j" class="pagination-link" aria-label="Goto page 1">J</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=k" class="pagination-link" aria-label="Goto page 1">K</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=l" class="pagination-link" aria-label="Goto page 1">L</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=m" class="pagination-link" aria-label="Goto page 1">M</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=n" class="pagination-link" aria-label="Goto page 1">N</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=o" class="pagination-link" aria-label="Goto page 1">O</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=p" class="pagination-link" aria-label="Goto page 1">P</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=q" class="pagination-link" aria-label="Goto page 1">Q</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=r" class="pagination-link" aria-label="Goto page 1">R</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=s" class="pagination-link" aria-label="Goto page 1">S</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=t" class="pagination-link" aria-label="Goto page 1">T</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=u" class="pagination-link" aria-label="Goto page 1">U</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=v" class="pagination-link" aria-label="Goto page 1">V</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=w" class="pagination-link" aria-label="Goto page 1">W</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=x" class="pagination-link" aria-label="Goto page 1">X</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=y" class="pagination-link" aria-label="Goto page 1">Y</a></li>
            <li class="px-3 py-1 m-1 bg-white text-slate-900 border border-slate-500 rounded-md"><a href="/category/{{$slug}}?startWith=z" class="pagination-link" aria-label="Goto page 1">Z</a></li>
        </ul> 
        <form action="">
            <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
                <div class="w-full px-2 md:w-1/4">
                    <input type="hidden" name="startWith" value="{{$startWith}}">
                    <div class="relative inline-block w-full text-gray-700"> 
                        <select name="updateParam" class="w-full h-10 pl-3 pr-6 text-sm placeholder-gray-600 border rounded-lg appearance-none" placeholder="Regular input">
                            <option value="">-- Urutan --</option>
                            <option value="newest" @if ($updateParam === "newest") selected @endif>Terbaru</option>
                            <option value="rate"  @if ($updateParam === "rate") selected @endif >Rating</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full px-2 md:w-1/4">
                    <div class="relative inline-block w-full text-gray-700">
                        <select name="tagParam" class="w-full h-10 pl-3 pr-6 text-sm placeholder-gray-600 border rounded-lg appearance-none" placeholder="Regular input">
                            <option value="">-- Tag --</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" @if ($tagParam === strval($tag->id)) selected @endif   >{{ $tag->name }}</option> 
                            @endforeach 
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full px-2 md:w-1/4">
                    <div class="relative inline-block w-full text-gray-700">
                        <select name="statusParam" class="w-full h-10 pl-3 pr-6 text-sm placeholder-gray-600 border rounded-lg appearance-none" placeholder="Regular input">
                            <option value="">-- Status --</option>
                            <option value="ongoing"  @if ($statusParam === "ongoing") selected @endif>On Going</option>
                            <option value="complete" @if ($statusParam === "complete") selected @endif>Tamat</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full px-2 md:w-1/4">
                    <button class="bg-slate-500 pl-3 pr-6 border py-2 rounded-lg w-full text-white text-sm" type="submit">Cari <i class="fa-solid fa-magnifying-glass text-sm"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="flex-col pb-10 w-full">
        <div class="block px-3">
            @if ($stories->isEmpty())
                <div class="notification is-warning has-text-centered mb-5">Data tidak ditemukan</div>
            @else
                @foreach ($stories as $story)
                <div class="w-full min-h-48 mb-3 flex overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="flex w-36 min-h-[100px]">
                        <a href="/story/{{ $story->slug }}" > 
                            <img src="{{ $story->thumbnail }}" alt="" class="object-cover h-full w-full rounded-l-lg" />
                        </a>
                    </div>
                    <div class="flex flex-col w-full p-3 border-tborder-rborder-brounded-r-lg">
                        <a href="/story/{{ $story->slug }}" >
                            <div class="text-gray-900 font-bold text-md md:text-xl mb-1">{{ $story->title }} <span class="text-black"><i class="fas fa-star text-yellow-400"></i> {{ $story->rating }}/10</span></div>
                        </a>
                        <div class="text-sm">
                            <span class="icon-text">
                                <span class="text-primary">
                                    <i class="fas fa-eye"></i>
                                </span>
                                <span><span class="number-convert">{{ $story->reader_count }}</span> Reader</span>
                            </span>
                            <p class="text-gray-900 leading-none">Bab Terakhir: <a href="#">{{ $story->last_chapter }}</a></p> 
                            <p class="text-gray-600">{{date('d-M-Y', strtotime($story->chapters[0]->created_at)) }}</p>
                        </div>
                          
                        <div class="my-1 block ">
                            @foreach ($story->tags as $tag) 
                                <span class="px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs" >
                                    <a href="/tag/{{ $tag->slug }}" class="px-1 py-2 box-border">{{$tag->name}}</a>
                                </span>
                            @endforeach 
                        </div>
                    </div>
                </div>
                @endforeach
            @endif 
        </div>
    </div>

    {{ $stories->links('pagination::default') }}
</section>
<!-- section 1: e -->
@endsection