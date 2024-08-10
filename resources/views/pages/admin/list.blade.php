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
	@vite(['resources/css/app.css', 'resources/js/jquery.min.js'])
</head>
<body>
    
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 ">
    <div class="relative mx-auto text-gray-600 border rounded-lg h-12 mb-5">
        <input class=" h-full bg-white  rounded-lg    px-4  text-sm focus:outline-none w-[95%]"
          type="search" name="search" placeholder="Search">
        <button type="submit" class="absolute right-0 top-0 p-4 border-blue-700 bg-blue-700 h-full color-white rounded-r-lg">
          <svg class="text-white h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
            width="512px" height="512px">
            <path
              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>
        </button>
      </div>
      <div class="relative mx-auto text-gray-600 border rounded-lg h-10 mb-5">
        <input class="input-url h-full bg-white  rounded-lg px-4  text-sm focus:outline-none w-[95%]"
          type="text" name="url" placeholder="URL">
        <button type="submit" class="button-add-comic absolute right-0 top-0 py-1 px-4 border-blue-700 bg-blue-700 h-full color-white rounded-r-lg text-white">
          add
        </button>
      </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Judul
                </th>
                <th scope="col" class="px-6 py-3">
                    Chapter
                </th>
                <th scope="col" class="px-6 py-3">
                    Source
                </th>
                <th scope="col" class="px-6 py-3">
                    UUID
                </th>
                <th scope="col" class="px-6 py-3">
                    update
                </th>
                <th scope="col" class="px-6 py-3">
                    sync
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comics as $comic) 
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap  ">
                        {{$comic->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$comic->last_chapter}}
                    </td>
                    <td class="px-6 py-4">
                        {{$comic->url}}
                    </td>
                    <td class="px-6 py-4">
                        {{$comic->uuid}}
                    </td>
                    <td class="px-6 py-4">
                        @if ($comic->scrap_date !== null) {{ date('d M Y h:i A', strtotime($comic->scrap_date)) }}@endif
                    </td>
                    <td class="px-6 py-4">
                        @if ($comic->sync_date !== null){{date('d M Y h:i A', strtotime($comic->sync_date))}} @endif
                    </td>
                    <td class="px-6 py-4">
                        <button type="button" data-comic-uuid="{{$comic->uuid}}" class="update-button px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs mr-2">update</button>
                        <button type="button" data-comic-uuid="{{$comic->uuid}}" class="sync-button px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs mr-2">sync to web</button>
                        <a href="/mimin/list/{{$comic->id}}" class="px-2 py-1 m-1 bg-[#25D366] rounded-sm text-white text-xs mr-2">view</a>
                        <button type="button" data-comic-id="{{$comic->id}}" class="delete-button px-2 py-1 m-1 bg-red-800 rounded-sm text-white text-xs mr-2">delete</button>
                    </td>
                </tr>
            @endforeach

            
        </tbody>
    </table>
    {{ $comics->links('pagination::default') }}

</div>

<script type="module">
    $(document).ready(() => {
        $(document).on('click', '.sync-button', (e) => {
           const uuid = $(e.target).data("comic-uuid")
           console.log(uuid)
           $.ajax({
                method: "GET",
               url: window.location.origin +"/api/sync-comic/" + uuid,
               // headers: { "X-CSRF-Token": csrftoken },
               contentType: "application/json; charset=utf-8",
                data: JSON.stringify({uuid}),
           }).done(function (msg) {
               window.location.reload()
           });
       })
        $(document).on('click', '.update-button', (e) => {
           const uuid = $(e.target).data("comic-uuid")
           console.log(uuid)
           $.ajax({
                method: "POST",
               url: window.location.origin +"/api/update-comic",
               // headers: { "X-CSRF-Token": csrftoken },
               contentType: "application/json; charset=utf-8",
                data: JSON.stringify({uuid}),
           }).fail(function (e) {
            console.log(e);
            alert("Error!")
           }).then(function (msg) {
               window.location.reload()
           });
       })
       $(document).on('click', '.button-add-comic', (e) => {
            const url = $(".input-url").val()
            if (url!=="") {
                $(e.target).text("loading...")
                $(e.target).prop('disabled', true)
                $(".input-url").prop('disabled', true)
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/api/add-comic", 
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({url}),
                }).done(function (msg) {
                    window.location.reload();
                }).always(function() {
                    $(e.target).text("add")
                    $(e.target).prop('disabled', false)
                    $(".input-url").prop('disabled', false)
                });
            } 
       })
       $(document).on('click', '.delete-button', (e) => {
           const id = $(e.target).data("comic-id")
           console.log(id)
           $.ajax({
                method: "POST",
               url: window.location.origin + "/api/delete-comic",
               // headers: { "X-CSRF-Token": csrftoken },
               contentType: "application/json; charset=utf-8",
                data: JSON.stringify({id}),
           }).done(function (msg) {
               window.location.reload()
           });
       })
   })
</script>
</body>
</html>