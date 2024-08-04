<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
		integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer"
	/>
	<script src="https://unpkg.com/dexie/dist/dexie.js"></script>
	@vite(['resources/css/app.css', 'resources/js/jquery.min.js', 'resources/js/rate.min.js', 'resources/js/app.js'])
</head>
<body>
    
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 ">
     
      <a href="/mimin/list/">
        <button class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg   focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="inline-block ml-1 underline">Kembali ke halaman utama</span>
        </button> 
    </a>
    <h1 class="text-xxl">{{$comic->title}}</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Chapter 
                </th>
                <th scope="col" class="px-6 py-3">
                    Gambar
                </th>
                <th scope="col" class="px-6 py-3">
                    Sumber
                </th>
                 
                 
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chapters as $chapter) 
                <tr class="border-b @if (count($chapter->images) === 0) bg-red-500 @endif">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap  ">
                        {{$chapter->order}}
                    </th>
                    <td class="px-6 py-4 image-count">
                        {{count($chapter->images)}}
                    </td>
                    <td class="px-6 py-4">
                        {{$chapter->link}}
                    </td>
                    
                     
                    <td class="px-6 py-4"> 
                        <button type="button" data-chapter-id={{$chapter->id}} class="scrap-button px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs mr-2">scrap again</button>
                        <a href="/mimin/images/{{$chapter->id}}" class="px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs mr-2">lihat</a>
                    </td>
                </tr>
            @endforeach

            
        </tbody>
    </table>
    {{ $chapters->links('pagination::default') }}

</div>
 
<script type="module">
     $(document).ready(() => {
        $(document).on('click', '.scrap-button', (e) => {
            const id = $(e.target).data("chapter-id")
            console.log(id)
            $.ajax({
                method: "GET",
                url: "/api/rescrap-chapter/"+id,
                // headers: { "X-CSRF-Token": csrftoken },
                contentType: "application/json; charset=utf-8",
            }).done(function (msg) {
                console.log(msg)
                if (msg.data.image_count > 0) {
                    $(e.target).closest("tr").removeClass("bg-red-500")
                }
                $(e.target).closest("tr").find(".image-count").text( msg.data.image_count);
                alert("updated! Image count " + msg.data.image_count );
            });
        })
    })
</script>
</body>
</html>