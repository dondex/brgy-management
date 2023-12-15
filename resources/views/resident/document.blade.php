@extends('resident.nav')

@section('title', 'Request Document')

@section('content')
<div class="flex justify-center items-center h-5/6 mt-10">
    <img class="flex-1 lg:flex max-h-full hidden" src="{{asset('img/request-doc.png')}}">
    <div class="flex-1 flex justify-center">
        <form action="/requestdoc" method="POST">
            @CSRF
            <input type="text" name="user_id" class="hidden" value="{{session('user_id')}}">
            <p class="font-black lg:text-5xl text-3xl mb-3">Request Document</p>
            <div class="py-3">
                <p>Document</p>
                <select name="doc_type" class="bg-white h-8 w-full px-2 rounded">
                    <option value="0">Select Document</option>
                    <option value="bc">Barangay Clearance</option>
                    <option value="cor">Certificate of Residency</option>
                    <option value="cli">Certificate of Indigency</option>
                </select>
                @error('doc_type')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="py-3">
                <p>Purpose</p>
                <input type="text" name="purpose" class="bg-white h-8 w-full px-2 rounded" value="{{old('purpose')}}" required>
                @error('purpose')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="py-3">
                <p>Delivery</p>
                <div class="flex justify-around">
                    <div class="flex items-center gap-x-2"><input type="radio" name="delivery" class="bg-white h-8 px-2 rounded" value="email">Email</div>
                    <div class="flex items-center gap-x-2"><input type="radio" name="delivery" class="bg-white h-8 px-2 rounded" value="pick-up">Pick Up</div>
                </div>
                @error('delivery')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="pt-6 pb-3 text-center">
                <input type="submit" name="submit" value="Submit" class="bg-blue-500 hover:bg-blue-600 cursor-pointer h-8 lg:w-56 w-36 text-white rounded">
            </div>
        </form>
    </div>
</div>
<div class="fixed bottom-0 w-full flex flex-col lg:flex-row gap-3 justify-between items-center py-5 lg:px-80 bg-white">
    <p class="text-sm">Barangay Management System</p>
    <p class="text-sm">2023</p>
</div>

<!-- SWEETALERTS SCRIPT -->

@if(session('request-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Document has been requested successfully and under review. Please wait for an email confirmation.',
    showConfirmButton: false,
    timer: 2500,
    heightAuto: false
    })
</script>

@endif

@stop