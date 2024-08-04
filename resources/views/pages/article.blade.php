<!-- Menghubungkan dengan view template master -->
@extends('master')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
<!-- article 1 -->
<article class="container mx-auto w-full p2 mt-[75px]">
    <div class="container max-w-4xl mx-auto w-full bg-white shadow-sm rounded-md p-5">
        <h1 class="font-semibold text-xl md:text-3xl mb-5">{{ $article->title}}</h1>
        <div class="flex ml-3">
            <div class="mr-3 w-12">
                <img src="{{ $article->user->photo }}" alt="{{ $article->user->first_name }}" class="rounded-full" />
            </div>
            <div class="flex-col justify-center">
                <h1 class="font-semibold">{{ $article->user->first_name }} </h1>
                <p class="text-xs text-gray-500">{{ date('d-M-Y', strtotime($article-> created_at)) }}</p>
            </div>
        </div> 
        <img src="{{$article->thumbnail}}" alt="{{ $article->title}}" class="w-full max-w-3xl mx-auto my-4">
        <div class="max-w-4xl mx-auto">
            {!!$article->content!!}
        </div>
        <div class="my-3">
            Kategory : {{$article->category->name }} 
        </div>
        Baca Komiknya di : <a href="/story/{{$article->comic->slug}}" class="underline">{{$article->comic->title}} </a>
        <div class="my-4 flex flex-wrap"> 
            @foreach ($article->tags as $tag)
                <a class="p-1 m-1 bg-[#25D366] rounded-sm text-white text-sm" href="/article-tag/{{  $tag->slug }}">{{ $tag->name}}</a>
            @endforeach 
        </div>
        <!-- next prev  -->
        <div class="w-full flex justify-between">
            @if ($prevArticle == null)
                <div class=""></div>
            @else
                <div class="">
                    <a href="/article/{{$prevArticle->slug}}" class="is-primary has-text-info underline" style="max-width: 350px;">
                        <span class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span>{{ $prevArticle->title}}</span>
                    </a>
                </div>
            @endif
            @if ($nextArticle == null)
                <div class="text-right"></div>
            @else
                <div class="text-right">
                    <a href="/article/{{$nextArticle->slug}}" class="is-primary has-text-info underline" style="max-width: 350px;"
                        >
                        <span>{{ $nextArticle->title}}</span>
                        <span class="icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            @endif 
        </div>
        <!-- next prev : e -->
        <!-- comment section  -->
        <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 mt-5">
            <div class="max-w-2xl mx-auto px-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Komentar ({{$article->comments->count()}})</h2>
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
                @include("component.commentarticle", ['comments' => $article->comments, 'article_id' => $article->id ])

            </div>
        </section>
        <!-- comment section : e -->
    </div>
</article>
<!-- article 1 : e -->
@endsection