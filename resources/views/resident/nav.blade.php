<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{asset('css/modal.css')}}" rel="stylesheet">
    <script src="{{asset('js/modal.js')}}"></script>
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
</head>
<body class="bg-blue-500 h-screen">
<div class="lg:flex justify-between items-center w-full py-6 px-80 bg-grey hidden">
    <div class="flex items-center gap-3">
        <img class="h-12 w-12 rounded-full bg-white " src="{{asset('img/logo1.png')}}">
        {{-- <p class="font-black text-3xl">Barangay Management System</p> --}}
    </div>
    <div class="flex gap-3">
        <a href="/home"><button class="{{ Request::is('home') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-white' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Home</button></a>
        <a href="/request/document" ><button class="{{ Request::is('request/document') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-white' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Transactions</button></a>
        <a href="/about" ><button class="{{ Request::is('about') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-white' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">About</button></a>
        @if(!empty(session('user_id')))
        <a href="/profile" ><button class="{{ Request::is('profile') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Hello, {{session('username')}}</button></a>
        @endif
        @if(empty(session('user_id')))
        <a href="/login" ><button class="text-white hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Log In</button></a>
        <a href="/signup" ><button class="text-white hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Sign Up</button></a>
        @else
        <a href="/logout" ><button class="text-white hover:bg-red-100 hover:text-red-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Log Out</button></a>
        @endif
    </div>
</div>
<div class="flex px-6 justify-between items-center bg-white h-20 lg:hidden">
    <button id="sidenav_btn" type="button"><i class="fa-solid fa-bars"></i></button>
    <p class="font-bold">Brgy. Capaoay</p>
</div>
@yield('content')
<div id="overlay" class="fixed top-0 left-0 h-screen w-screen bg-black bg-opacity-60 hidden z-10">
    <div id="sidenav" class="flex flex-col justify-between bg-white w-2/3 h-full z-10 p-3">
        <div>
            <div class="flex justify-end w-full mb-3">
                <button id="close_sidenav" type="button"><i class="fa-solid fa-bars"></i></button>
            </div>
            <div class="flex flex-col">
                <a href="/home"><button class="{{ Request::is('home') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Home</button></a>
                <a href="/request/document" ><button class="{{ Request::is('request/document') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Documents</button></a>
                <a href="/about" ><button class="{{ Request::is('about') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">About</button></a>
                @if(!empty(session('user_id')))
                    <a href="/profile" ><button class="{{ Request::is('profile') ? 'bg-blue-100 text-blue-600 font-bold' : 'bg-white text-gray-700' }} hover:bg-blue-100 hover:text-blue-600 px-2 py-1 mb-2 w-full rounded flex justify-start items-center">Hello, {{session('username')}}</button></a>
                @endif
            </div>
        </div>
        <div>
        @if(empty(session('user_id')))
        <a href="/login" ><button class="bg-blue-600 text-white px-2 py-1 mb-2 w-full rounded flex justify-center items-center">Log In</button></a>
        <a href="/signup" ><button class="bg-blue-600 text-white px-2 py-1 mb-2 w-full rounded flex justify-center items-center">Sign Up</button></a>
        @else
        <a href="/logout"><button class="bg-red-600 px-2 py-1 text-white w-full rounded shadow">Log Out</button></a>
        @endif
        </div>
    </div>
</div>
<!-- SWEET ALERTS SCRIPT -->
@if(session('wait-verification'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'Please wait to be verified before you can request document',
    showConfirmButton: false,
    timer: 2500,
    heightAuto: false
    })
</script>

@endif

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
