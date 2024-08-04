<!DOCTYPE html>
<html lang="id-ID">
<head> 
	<meta charset="UTF-8" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width " />
	<link rel="icon" href="{{Vite::asset('resources/images/favicon.ico')}}" />
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
		integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer"
	/>
	<meta name="google-site-verification" content="lZXyJKiLtv0eKAgRdKFjoyoUT1NMxHK6YchrtMknXF8" />
	<meta name="msvalidate.01" content="6C4FAC8EE0CB5AC55533DE284828DEFD" />
	<script src="https://unpkg.com/dexie/dist/dexie.js"></script>
	@yield('seo')

	@vite(['resources/css/app.css', 'resources/js/jquery.min.js', 'resources/js/rate.min.js', 'resources/js/app.js'])
	<script>
		!(function () { 
			if (window.location.origin === 'https://ceritoon.xyz') {
				document.oncontextmenu = function () {
					return false;
				};
				document.onkeydown = function (e) {
					if (event.keyCode == 123) {
						return false;
					}
					if (e.ctrlKey && e.shiftKey && e.keyCode == "I".charCodeAt(0)) {
						return false;
					}
					if (e.ctrlKey && e.shiftKey && e.keyCode == "C".charCodeAt(0)) {
						return false;
					}
					if (e.ctrlKey && e.shiftKey && e.keyCode == "J".charCodeAt(0)) {
						return false;
					}
					if (e.ctrlKey && e.keyCode == "U".charCodeAt(0)) {
						return false;
					}
				};
				function detectDevTool(allow) {
					if (isNaN(+allow)) allow = 100;
					var start = +new Date(); // Validation of built-in Object tamper prevention.
					debugger;
					var end = +new Date(); // Validates too.
					if (isNaN(start) || isNaN(end) || end - start > allow) {
						// input your code here when devtools detected.
						debugger;
					}
				}
				if (window.attachEvent) {
					if (document.readyState === "complete" || document.readyState === "interactive") {
						detectDevTool();
						window.attachEvent("onresize", detectDevTool);
						window.attachEvent("onmousemove", detectDevTool);
						window.attachEvent("onfocus", detectDevTool);
						window.attachEvent("onblur", detectDevTool);
					} else {
						setTimeout(argument.callee, 0);
					}
				} else {
					window.addEventListener("load", detectDevTool);
					window.addEventListener("resize", detectDevTool);
					window.addEventListener("mousemove", detectDevTool);
					window.addEventListener("focus", detectDevTool);
					window.addEventListener("blur", detectDevTool);
				}

			}
		})();
	</script>
</head>
<body>  
	<header class="absolute top-0 w-full flex items-center z-50  h-[64px] navbar-fixed" id="page-header">
		<div class="w-full m-auto">
			<div class="flex items-stretch justify-between relative">
				<div class="px-4 flex border-r-2">
					<a href="/">
						<img src="{{ Vite::asset('resources/images/logo-square.png') }}" width="45px" alt="Logo" class="rounded-sm mt-1 lg:hidden" />
						<img src="{{ Vite::asset('resources/images/logo.png') }}" width="150px" alt="Logo" class="rounded-sm mt-1 hidden lg:block" />
					</a>
				</div>
				<div class="flex-auto px-3 lg:flex-2">
					<form action="/search" method="get" class="flex w-full lg:w-2/3 xl:w-1/2 my-2 border rounded-3xl">
						<input type="text" class="px-4 py-1 w-full rounded-l-3xl focus-visible:border-0" name="q" value="{{$q ?? ""}}" placeholder="Cari..." />
						<button class="flex items-center justify-center px-4 border-l-3xl" type="submit">
							<svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
							</svg>
						</button>
					</form>
				</div>
				<div class="px-4 flex border-l-2 lg:flex-auto lg:border-none">
					<button id="hamburger" name="hamburger" class="block right-4 lg:hidden">
						<span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
						<span class="hamburger-line transition duration-300 ease-in-out"></span>
						<span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
					</button>
					<nav id="mobile-menu" class="fixed shadow-xl mt-[57px] right-0 lg:hidden">
						<div class="backdrop transition duration-300 ease-in-out relative hidden"></div>
						<ul class="flex flex-col fixed z-10 bg-white h-[calc(100vh-42px)] w-3/4 md:w-1/2 transition duration-300 ease-in-out right-full">
							@auth 
								<li class="px-5 py-2 mt-2 text-neutral-900 font-semibold tracking-wide flex items-center border-l-2"> 
									<a href="#">Hi, {{Auth::user()->first_name}}!</a>
								</li>
								<li>
									<hr>
								</li>
							@endauth
								<li class="px-5 py-2 mt-1 text-neutral-900 font-semibold tracking-wide">
									<a href="/">Beranda</a>
								</li>
								<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide flex">
									<a href="/articles">Artikel</a>
								</li>
								<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide">
									<a href="/category/manga">Manga</a>
								</li>
								<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide">
									<a href="/category/manhua">Manhua</a>
								</li>
								<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide">
									<a href="/category/manhwa">Manwa</a>
								</li>
							
								<li>
									<hr>
								</li>
							@auth 
								<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide">
									<a href="/bookmarks">Bookmarks</a>
								</li>
								<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide">
									<form action="/logout" method="POST"  class="text-red-600 ">
										@csrf
										<button class="w-full">Keluar <i class="fa-solid fa-right-to-bracket"></i></button>
									</form>
								</li>
							@else
								<li class="px-5 py-2 font-semibold tracking-wide flex items-center border-l-2 text-primary">
									<a href="/login">
										<button class="px-3 py-1 bg-primary text-white rounded-lg">Login <i class="fa-solid fa-right-to-bracket"></i></button>
									</a>
								</li> 
							@endauth
						</ul>
					</nav>
					<nav id="desktop-menu" class="w-full items-center justify-end hidden pr-1 box-border lg:flex">
						<ul class="flex items-center justify-center">
							<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide flex">
								<a href="/">Beranda</a>
							</li>
							<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide flex">
								<a href="/articles">Artikel</a>
							</li>
	
							<li class="px-5 py-2 text-neutral-900 font-semibold tracking-wide flex">
								<div class="dropdown inline-block relative"> 
									<button class="pl-3 pr-2 py-1 bg-primary text-white rounded-lg flex items-center">
										<span class="mr-1">Komik</span>
										<svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
										</svg>
									</button>
	
									<div class="dropdown-menu hidden absolute min-w-[200px] right-0">
										<ul class="bg-white py-1 mt-6 rounded-sm shadow-lg tracking-normal font-medium">
											<li class="">
												<a class="rounded-t hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap text-gray-700" href="/category/manga"><i class="fa-solid fa-book"></i> Manga</a>
											</li>
											<li class="">
												<a class="hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap text-gray-700" href="/category/manhua"><i class="fa-solid fa-book-medical"></i> Manhua</a>
											</li>
											<li class="">
												<a class="rounded-b hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap text-gray-700" href="/category/manhwa"><i class="fa-solid fa-book-skull"></i> Manwa</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
							@auth
								<li class="px-5 py-2 font-semibold tracking-wide border-l-2 text-primary">
									<div class="flex items-center cursor-pointer" id="account">
										<img src="{{Auth::user()->photo}}" alt="photo" class="rounded-full mr-4 h-[40px]" />
										<a href="#">Hi, {{Auth::user()->first_name}} !</a>
									</div>
									<div
										id="account-menu"
										class="absolute hidden top-[64px] right-4 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-sm bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
										role="menu"
										aria-orientation="vertical"
										aria-labelledby="menu-button"
										tabindex="-1"
									>
										<div class="py-1" role="none"> 
											<a href="/bookmarks" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Bookmarks</a>
											<!-- <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Account</a> -->
										</div>
		
										<div class="py-1" role="none">
											<form action="/logout" method="POST"  class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
												@csrf
												<button class="w-full">Keluar <i class="fa-solid fa-right-to-bracket"></i></button>
											</form>
										</div>
									</div>
								</li>
							@else
								<li class="px-5 py-2 font-semibold tracking-wide flex items-center border-l-2 text-primary">
									<a href="/login">
										<button class="px-3 py-1 bg-primary text-white rounded-lg">Login <i class="fa-solid fa-right-to-bracket"></i></button>
									</a>
								</li> 
							@endauth
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header> 
	<!-- bagian konten blog -->
	@yield('contain')
 
 
	<!-- footer -->
	<footer class="w-full p2 bg-gray-600">
		<div class="container mx-auto flex flex-col items-center justify-center w-full">
			<nav class="flex items-center justify-center mt-12 w-full">
				<ul class="flex flex-wrap items-center justify-center">
					<li class="px-5 py-2 font-semibold tracking-wide flex justify-center border-b md:border-b-0 md:border-r-2 w-full md:w-auto ">
						<a href="/" class="text-primary ">Beranda</a>
					</li>
					<li class="px-5 py-2 font-semibold tracking-wide flex justify-center border-b md:border-b-0 md:border-r-2  w-full md:w-auto">
						<a href="/category/manga" class="text-primary">Manga</a>
					</li>
					<li class="px-5 py-2 font-semibold tracking-wide flex justify-center border-b md:border-b-0 md:border-r-2  w-full md:w-auto">
						<a href="/category/manwa" class="text-primary">Manwa</a>
					</li>
					<li class="px-5 py-2 font-semibold tracking-wide flex justify-center border-b md:border-b-0 md:border-r-2  w-full md:w-auto">
						<a href="/category/manhua" class="text-primary">Manhua</a>
					</li>
					<li class="px-5 py-2 font-semibold tracking-wide flex justify-center border-b md:border-b-0 md:border-r-2  w-full md:w-auto">
						<a href="/articles" class="text-primary">Artikel</a>
					</li>
					<li class="px-5 py-2 font-semibold tracking-wide flex justify-center  w-full md:w-auto">
						<a href="/feedback" class="text-primary">Saran dan Kritik</a>
					</li>
				</ul>
			</nav>
			<div class="flex w-full justify-center items-center mt-8">
				<a class="px-2 py-1 mx-1 bg-[#4267B2] rounded-lg text-white" href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"><i class="fa-brands fa-facebook"></i></a>
				<a class="px-2 py-1 mx-1 bg-[#1da1f2] rounded-lg text-white" href="https://twitter.com/intent/tweet?url={{Request::url()}}"><i class="fa-brands fa-twitter"></i></a>
				<a class="px-2 py-1 mx-1 bg-[#25D366] rounded-lg text-white" href="https://api.whatsapp.com/send?text={{Request::url()}}"><i class="fa-brands fa-whatsapp"></i></a>
			</div>
			<hr class="border-t-2 border-x-white mt-5 w-full" />
			<div class="flex w-full items-center justify-center mt-8 mb-20">
				<p class="text-center text-white">
					baca komik <strong>Manga</strong>, <strong>Manhua</strong>, <strong>Manhwa</strong>, online ber-bahasa indonesia <strong>?</strong> ya di
					<a href="" class="text-blue-500 underline">ceritoon.xyz</a><strong>.</strong>
				</p>
			</div>
		</div>
	</footer>
	<!-- footer:e -->
 

	<button id="go-to-top" type="button" class="fixed bottom-3 right-3 w-10 h-10 bg-primary shadow-md text-white px-2 py-1 text-lg z-50 rounded-full">
		<i class="fas fa-arrow-up"></i>
	</button>
	<button id="last-view" type="button" class="fixed bottom-16 right-3 w-10 h-10 bg-primary shadow-md text-white px-2 py-1 text-lg z-50 rounded-full">
		<i class="fas fa-clock-rotate-left"></i>
	</button>

	<!-- modal -->
	<div id="last-view-modal" class="modal z-500 pointer-events-none opacity-0 fixed w-full h-full top-0 left-0 flex items-center justify-center">
		<div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

		<div class="modal-container absolute top-20 bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
			<div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
				<svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
					<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
				</svg>
				<span class="text-sm">(Esc)</span>
			</div>

			<!-- Add margin if you want to see some of the overlay behind the modal-->
			<div class="modal-content py-4 text-left px-6">
				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">Terakhir dilihat</p>
					<div class="modal-close cursor-pointer z-50">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
					</div>
				</div>

				<!--Body-->
				<div class="h-[calc(100vh-220px)] overflow-y-auto" id="body-last-view"></div>

				<!--Footer-->
				<div class="flex justify-end pt-2">
					<button class="modal-close bg-primary px-3 py-2 rounded-lg text-white">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- modal: e -->


	@yield('script')
</body>
</html>