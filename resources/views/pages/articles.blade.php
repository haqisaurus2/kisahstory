<!-- Menghubungkan dengan view template master -->
@extends('master')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
<!-- section 1 -->
<section class="container mx-auto w-full p2 mt-[75px]">
    

    <div class="flex-col pb-10 w-full">
        <div class="block px-3">
            @if ($articles->isEmpty())
                <div class="notification is-warning has-text-centered mb-5">Data tidak ditemukan</div>
            @else
                @foreach ($articles as $article) 
                    <div class="w-full h-52 md:h-44 mb-3 flex overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out ">
                        <div class="flex w-96 min-h-[10px]">
                            <a href="/article/{{ $article->slug }}"  >
                                <img src="{{ $article->thumbnail }}" alt="" class="object-cover h-full w-full rounded-l-lg" />
                            </a>
                        </div>
                        <div class="flex flex-col w-full p-3 border-tborder-rborder-brounded-r-lg relative after:absolute after:content-[' '] after:w-full after:h-1/2 after:bottom-0 after:bg-gradient-to-t after:from-white after:to-transparent">
                            <a href="/article/{{  $article->slug  }}"  >
                                <div class="text-gray-900 font-bold text-xl mb-2">{{ $article->title }} </div>
                            </a>
                            <div class="text-gray-600 text-sm">{{ date('d-M-Y', strtotime($article-> created_at))}}</div>
                            <div class="my-2 ">
                                <p>{{ $article->meta }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
             
 
            
            {{$articles->links('pagination::default')}}
        </div>
    </div>
</section>
<!-- section 1: e -->
@endsection