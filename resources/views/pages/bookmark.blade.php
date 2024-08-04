<!-- Menghubungkan dengan view template master -->
@extends('master')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('contain')
<!-- section 1 -->
<section class="container mx-auto  p2 mt-[75px]"> 
    <div class="flex-col pb-10 w-full mt-36">
        <div class="block px-3">
            <article class=" ">
                <h1 class="text-2xl font-bold">Bookmarks : </h1>
                @if ($bookmarks->isEmpty())
                    <div class="notification is-warning has-text-centered mb-5">Data tidak ditemukan</div>
                @else 
                    <table class="text-center border" width="100%">
                        <thead>
                            <tr>
                                <th class="border"><abbr title="Judul">Judul</abbr></th>
                                <th class="border"><abbr title="Chapter">Chapter</abbr></th>
                                <th class="border"><abbr title="Gambar">Gambar</abbr></th>
                                <th class="border"><abbr title="Tanggal">Tanggal</abbr></th>
                            </tr>
                        </thead>
            
                        <tbody>
                            @foreach ($bookmarks as $bookmark) 
                            <tr>
                                <td class="border" class="">
                                    <div class="flex items-center justify-center">
                                        <div class="column is-narrow" style="width: 70px">
                                            <figure class="overflow-hidden aspect-square">
                                                <img src="{{  $bookmark->story->thumbnail }}" class="object-cover object-center"/>
                                            </figure>
                                        </div>
                                        <div class="column">
                                            <a href="/chapter/{{  $bookmark->chapter->slug }}#section-{{ $bookmark->section->id}}" class="ml-3 underline text-blue-600">{{ $bookmark->story->title }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="border">
                                    <a class="underline text-blue-600" href="/chapter/{{  $bookmark->chapter->slug }}" title="Leicester City F.C."><strong>{{ $bookmark->chapter->order}}</strong></a>
                                </td>
                                <td class="border"><a class="underline text-blue-600" href="/chapter/{{  $bookmark->chapter->slug }}#section-{{ $bookmark->section->id }}">{{ $bookmark->section->order }}</a></td>
                                <td class="border">{{ date('d-M-Y', strtotime($bookmark-> created_at)) }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif 

            </article>
            <br />
            {{ $bookmarks->links('pagination::default') }}

            </div>
        </div>
    </div>
</section>

<!-- section 1 : e -->
@endsection