@extends('resident.nav')

@section('title', 'About')

@section('content')
<div class="flex justify-center items-center bg-white" >
    <div class="flex flex-col justify-start w-full py-10 lg:px-80 px-3">
        <p class="font-black lg:text-4xl mb-3 text-black">Barangay Officials</p><hr class="border-slate-400">
        <div class="grid lg:grid-cols-4 gap-3 mt-3">
        @foreach($officials_data as $official)
            <div class="bg-white rounded overflow-hidden lg:h-64 h-80 shadow">
                <div class="relative bg-slate-700 w-full h-2/3 overflow-hidden">
                    <div class="h-full flex justify-center">
                        <img src="{{ $official->img != '' ? '/storage/' . $official->img : asset('img/default-profile.jpg') }}">
                    </div>
                </div>
                <div class="flex flex-col justify-between p-3 h-1/3 text-center">
                    <p class="font-semibold">{{$official->name}}</p>
                    <p>
                    @switch($official->position)
                        @case('captain')
                            Barangay Captain
                            @break
                        @case('secretary')
                            Barangay Secretary
                            @break
                        @case('treasurer')
                            Barangay Treasurer
                            @break
                        @case('councilor')
                            Barangay Councilor
                            @break
                        @case('sk')
                            Barangay SK Chairman
                            @break
                    @endswitch
                    </p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
<div class="w-full flex flex-col lg:flex-row gap-3 justify-between items-center py-5 lg:px-80 bg-white">
    <p class="text-sm">Barangay Management System</p>
    <p class="text-sm">2023</p>
</div>
@stop
