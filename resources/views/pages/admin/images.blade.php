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
     
      <a href="/mimin/list/{{$id}}">
        <button class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg   focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="inline-block ml-1 underline">Kembali ke halaman utama</span>
        </button> 
    </a>
    @foreach ($images as $image) 
        <img src="{{$image->src}}" alt="{{$image->order}}">
    @endforeach

</div>

</body>
</html>