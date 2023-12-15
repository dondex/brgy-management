@extends('resident.nav')

@section('title', 'Profile')

@section('content')
<div class="flex justify-center items-center h-5/6 lg:mt-0 mt-44">
    <div class="flex-1 flex-col justify-center items-center lg:px-52 p-3">
    <p class="font-black text-5xl mb-3">Profile</p>
        <form action="/goupdateprofile" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="flex lg:flex-row flex-col gap-3">
                @foreach($profile_data as $profile)
                <input type="text" name="resident_id" value="{{$profile->resident_id}}" class="hidden">
                <div class="flex-1 lg:py-3">
                    <p>Firstname</p>
                    <input type="text" id="firstname" name="firstname" placeholder="Juan" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->firstname}}" readonly required>
                    @error('firstname')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Middlename</p>
                    <input type="text" id="middlename" name="middlename" placeholder="Luna" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->middlename}}" readonly required>
                    @error('middlename')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Lastname</p>
                    <input type="text" id="lastname" name="lastname" placeholder="Dela Cruz" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->lastname}}" readonly required>
                    @error('lastname')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Address</p>
                    <input type="text" id="address" name="address" placeholder="123 Purok Dos, Capaoayan" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->address}}" readonly required>
                    @error('address')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Birthdate</p>
                    <input type="date" id="birthdate" name="birthdate" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->birthdate}}" readonly required>
                    @error('birthdate')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Nationality</p>
                    <input type="text" id="nationality" name="nationality" placeholder="Filipino" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->nationality}}" readonly required>
                    @error('nationality')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Gender</p>
                    <select id="gender" name="gender" class="bg-gray-200 h-8 px-2 w-full rounded" disabled>
                        <option value="0">Select a gender</option>
                        <option value="male" {{$profile->gender == 'male' ? 'selected' : ''}}>Male</option>
                        <option value="female" {{$profile->gender == 'female' ? 'selected' : ''}}>Female</option>
                        <option value="lgbt" {{$profile->gender == 'lgbt' ? 'selected' : ''}}>LGBTQIA+</option>
                    </select>
                </div>
                @error('gender')
                    <p class="text-red-600 text-sm">{{$message}}</p>
                @enderror
                <div class="flex-1 lg:py-3">
                    <p>Civil Status</p>
                    <select id="civil_status" name="civil_status" class="bg-gray-200 h-8 px-2 w-full rounded" disabled>
                        <option value="0">Select civil status</option>
                        <option value="single" {{$profile->civil_status == 'single' ? 'selected' : ''}}>Single</option>
                        <option value="married" {{$profile->civil_status == 'married' ? 'selected' : ''}}>Married</option>
                        <option value="widowed" {{$profile->civil_status == 'widowed' ? 'selected' : ''}}>Widowed</option>
                        <option value="separated" {{$profile->civil_status == 'separated' ? 'selected' : ''}}>Separated</option>
                    </select>
                </div>
                @error('civil_status')
                    <p class="text-red-600 text-sm">{{$message}}</p>
                @enderror
                <div class="flex-1 lg:py-3">
                    <p>Occupation</p>
                    <input type="text" id="occupation" name="occupation" placeholder="Teacher" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->occupation}}" readonly required>
                    @error('occupation')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Phone</p>
                    <input type="tel" id="phone" name="phone" placeholder="09123456789" pattern="[0-9]{11}" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->phone}}" readonly required>
                    @error('phone')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>4Ps Member</p>
                    <div class="flex justify-around items-center w-full">
                        <div class="flex items-center gap-2">
                            <input type="radio" id="four_ps" name="four_ps" class=" h-8 px-2" value="yes" {{$profile->four_ps == 'yes' ? 'checked' : ''}} disabled>Yes
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" id="four_ps" name="four_ps" class=" h-8 px-2" value="no" {{$profile->four_ps == 'no' ? 'checked' : ''}} disabled>No
                        </div>
                    </div>
                    @error('four_ps')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Valid ID</p>
                    <input type="file" id="valid_id" name="valid_id" class=" h-8 px-2 w-full rounded" disabled>
                    @error('valid_id')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Email</p>
                    <input type="text" id="email" name="email" placeholder="jdelacruz@gmail.com" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{$profile->email}}" readonly required>
                    @error('email')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Username</p>
                    <input type="text" id="username" name="username" placeholder="jdelacruz123" class="bg-gray-200 h-8 px-2 w-full rounded" value="{{session('username')}}" readonly required>
                    @error('username')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-6 pb-3 text-center hidden" id="savebtn">
                <button type="button" id="cancelbtn" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600">Cancel</button>
                <input type="submit" name="submit" value="Save Changes" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600">
            </div>
            @endforeach
            <div class="pt-6 pb-3 text-center" id="editbtn">
                <button type="button" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600">Edit Profile</button>
            </div>
            <p id="warning-msg" class="text-sm text-red-600 hidden">*Once you update your profile, you will undergo verification process before you can request a new document.</p>
        </form>
        <div id="divider" class="flex flex-row items-center justify-center w-full">
            <hr class="border-1 w-1/3">
            <p class="px-3">or</p>
            <hr class="border-1 w-1/3">
        </div>
        <div id="changepass" class="w-full flex justify-center items-center pt-3">
            <a href="/changepass"><button class="bg-blue-500 lg:h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600">Change Password</button></a>
        </div>
    </div>  
    <img class="flex-1 lg:flex max-h-full hidden" src="{{asset('img/profile.png')}}">
</div>
<div class="bottom-0 w-full flex flex-col gap-3 justify-between items-center py-5 mt-48 bg-white lg:hidden">
    <p class="text-sm">Barangay Management System</p>
    <p class="text-sm">2023</p>
</div>
<div class="fixed bottom-0 w-full lg:flex justify-between items-center py-5 lg:px-80 bg-white hidden">
    <p class="text-sm">Barangay Management System</p>
    <p class="text-sm">2023</p>
</div>


<!-- EDIT PROFILE SCRIPT -->
<script>
$(document).ready(function() {
    $('#editbtn').on('click', function() {
        $('#savebtn').removeClass('hidden');
        $('#editbtn').addClass('hidden');
        $("#warning-msg").removeClass('hidden');
        $('#changepass').addClass('hidden');
        $('#divider').addClass('hidden');
        
        $('#firstname, #middlename, #lastname, #address, #birthdate, #nationality, #gender, #civil_status, #occupation, #phone, #four_ps, #valid_id, #email, #username')
            .removeClass('bg-gray-200')
            .prop('readonly', false)
            .prop('disabled', false);
    });

    $('#cancelbtn').on('click', function() {
        $('#savebtn').addClass('hidden');
        $('#editbtn').removeClass('hidden');
        $("#warning-msg").addClass('hidden');
        $("#changepass").removeClass('hidden');
        $("#divider").removeClass('hidden');
        
        $('#firstname, #middlename, #lastname, #address, #birthdate, #nationality, #gender, #civil_status, #occupation, #phone, #four_ps, #valid_id, #email, #username')
            .addClass('bg-gray-200')
            .prop('readonly', true)
            .prop('disabled', true);
    });
});
</script>

<!-- SWEET ALERTS SCRIPT -->
@if(session('update-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Profile has been updated successfully.',
    showConfirmButton: false,
    timer: 2500,
    heightAuto: false
    })
</script>

@endif

@stop