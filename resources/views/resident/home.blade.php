@extends('resident.nav')

@section('title', 'Home')

@section('content')
<div class="relative h-5/6 w-screen flex flex-col items-center justify-center" style="background-image: url('{{asset('img/bbm.jpg')}}'); background-size: cover; background-position: center 90%; background-color: rgba(0, 0, 0, 0.5);">
    <div class="text-center mb-8 py-20 mt-2 bg-white pb-5" style="width: 50%;">
        <h1 class="text-black text-4xl font-bold mb-2 mt-5">Barangay Management System</h1>
        <p class="text-black  ">A barangay management system is a computerized platform designed to streamline and automate the administrative processes and functions within a barangay, the smallest administrative division in the Philippines. </p>
    </div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 lg:left-1/2 bg-white h-3/5 lg:w-1/2 text-center p-3 rounded shadow-md z-10" style="top: 30%; height: 55vh;">
        <p class="font-bold text-4xl mt-2 mb-4"><i class="fa-solid fa-bullhorn"></i> Announcements</p>
        <div id="carouselExampleInterval" class="carousel slide h-5/6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @php
                    $counter = 0;
                @endphp
                @foreach($announcements_data as $announcement)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$counter}}" class="{{$counter == 0 ? 'active' : ''}}" aria-current="{{$counter == 0 ? 'true' : ''}}" aria-label="Slide {{$counter + 1}}"></button>
                @endforeach
            </div>
            <div class="carousel-inner h-full">
                @foreach($announcements_data as $announcement)
                    <div class="carousel-item {{$counter == 0 ? 'active' : ''}} h-full">
                        <img src="{{asset('/storage/'.$announcement->image)}}" class="block rounded lg:h-auto h-full w-full object-cover" alt="...">
                        <div class="carousel-caption bg-white ">
                            <h5 class="font-semibold text-black">{{$announcement->title}}</h5>
                            <p class="text-black">{{$announcement->description}}</p>
                        </div>
                    </div>
                    @php
                        $counter++
                    @endphp
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    <div class="relative h-full">
        <div class="absolute top-0 left-0 w-full h-full bg-white"></div>
        {{-- <img class="object-contain h-full w-full" src="{{asset('img/logo.png')}}" alt="Landing Image"> --}}
    </div>
</div>

<div class="fixed bottom-0 w-full flex flex-col lg:flex-row gap-3 justify-between items-center py-5 lg:px-80 bg-white">
    <p class="text-sm">Barangay Management System</p>
    <p class="text-sm">2023</p>
</div>
@stop
