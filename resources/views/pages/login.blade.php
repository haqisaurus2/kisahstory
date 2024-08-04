<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="/static/favicon.ico" /> 
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
        @vite(['resources/css/app.css', 'resources/js/jquery.min.js', 'resources/js/app.js'])
        <style>
            .tile {
                height: 100vh;

            }
            .content.has-text-centered {

                margin-top: 20vh;
            }
            #buttonDiv iframe {
                margin: auto!important;
            }
        </style>
    </head>
    <body class="dark">
        <div class="bg-gradient-to-br from-primary to-blue-500 min-h-screen flex flex-col justify-center items-center text-center">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-md">
                <h1 class="text-4xl font-bold text-center text-primary mb-8">Selamat Datang di Ceritoon.xyz</h1>
                <p class="dark:text-gray-400">Silahkan login dengan tombol di bawah</p>
                <form class="space-y-6"> 
                    <div> 
                        <a href="/auth/google" class="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                             
                               
                               <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-6 h-6" alt="">
                               <span class="text-gray-800">
                                   Login with Google
                               </span> 
                        </a>
                    </div>
                </form>
            </div>
            <div class="py-5 text-center">
                 
                    <div class="text-center sm:text-left whitespace-nowrap">
                        <a href="/">
                            <button class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-white  focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                <span class="inline-block ml-1 underline">Kembali ke halaman utama</span>
                            </button> 
                        </a>
                </div>
            </div>
        </div>
         
          
    </body>
</html>