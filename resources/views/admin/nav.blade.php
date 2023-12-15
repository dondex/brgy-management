<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@1000&family=Poppins:wght@100;200;300;400;600;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <link href="{{asset('css/modal.css')}}" rel="stylesheet">
    <script src="{{asset('js/modal.js')}}"></script>
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
</head>
<body class="bg-slate-300">
<div class="h-screen flex lg:flex-row flex-col">
    <div class="md:flex flex-col justify-between bg-white p-2 w-52 hidden">
        <div class="flex flex-col">
            <a href="/dashboard" ><button class="{{ Request::is('dashboard') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-chart-line me-3"></i>Dashboard</button></a>
            <a href="/announcement"><button class="{{ Request::is('announcement') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-bullhorn me-3"></i>Announcements</button></a>
            <a href="/resident"><button class="{{ Request::is('resident') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-user me-3"></i>Residents</button></a>
            <a href="/document"><button class="{{ Request::is('document') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-file me-3"></i>Documents</button></a>
            <a href="/official"><button class="{{ Request::is('official') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-user-tie me-3"></i>Officials</button></a>
        </div>
        <a href="/logout" class="px-2 py-1 bg-red-600 text-white text-center w-full rounded shadow"><button ><i class="fa-solid fa-right-from-bracket"></i> Log Out</button></a>
    </div>
    <div class="flex flex-col w-screen h-screen">
        <div class="lg:flex bg-white h-20 hidden">
        </div>
        <div class="flex px-6 justify-between items-center bg-white h-20 lg:hidden">
            <button id="sidenav_btn" type="button"><i class="fa-solid fa-bars"></i></button>
            <p class="font-bold">Barangay Management System</p>
        </div>
        @yield('content')
    </div>
    <div id="overlay" class="fixed top-0 left-0 h-screen w-screen bg-black bg-opacity-60 hidden">
        <div id="sidenav" class=" flex flex-col justify-between bg-white w-2/3 h-full z-10 p-3">
            <div>
                <div class="flex justify-between w-full mb-3">
                    <p >Hello, Admin</p>
                    <button id="close_sidenav" type="button"><i class="fa-solid fa-bars"></i></button>
                </div>
                <div class="flex flex-col">
                    <a href="/dashboard" ><button class="{{ Request::is('dashboard') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-chart-line me-3"></i>Dashboard</button></a>
                    <a href="/announcement"><button class="{{ Request::is('announcement') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-bullhorn me-3"></i>Announcements</button></a>
                    <a href="/resident"><button class="{{ Request::is('resident') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-user me-3"></i>Residents</button></a>
                    <a href="/document"><button class="{{ Request::is('document') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-file me-3"></i>Documents</button></a>
                    <a href="/official"><button class="{{ Request::is('official') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center"><i class="fa-solid fa-user-tie me-3"></i>Officials</button></a>
                </div>
            </div>
            <a href="/logout" class="px-2 py-1 bg-red-600 text-white text-center w-full rounded shadow"><button ><i class="fa-solid fa-right-from-bracket"></i> Log Out</button></a>
        </div>
    </div>
</div>

<!-- SIDEBAR SCRIPT -->

<script>
let button = $("#sidenav_btn");
let close_btn = $("#close_sidenav");
let overlay = $("#overlay");

button.click(function() {
    overlay.toggleClass("flex");
    overlay.removeClass("hidden");
});

close_btn.click(function() {
    overlay.toggleClass("hidden");
    overlay.removeClass("flex");
});
</script>
</body>
</html>
