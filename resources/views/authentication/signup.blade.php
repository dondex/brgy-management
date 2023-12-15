<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
</head>
<body>
<div class="h-screen lg:flex">
    <div class="flex-1 flex flex-col lg:justify-center items-center h-full p-3">
        <img class="w-20 h-20" src="{{asset('img/logo.png')}}">
        <p class="font-black text-5xl mb-3">Sign Up</p>
        <form action="/gosignup" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Firstname</p>
                    <input type="text" name="firstname" placeholder="Juan" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('firstname')}}" required>
                    @error('firstname')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Middlename</p>
                    <input type="text" name="middlename" placeholder="Luna" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('middlename')}}" required>
                    @error('middlename')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Lastname</p>
                    <input type="text" name="lastname" placeholder="Dela Cruz" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('lastname')}}" required>
                    @error('lastname')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Address</p>
                    <input type="text" name="address" placeholder="123 Purok Dos, Capaoayan" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('address')}}" required>
                    @error('address')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Birthdate</p>
                    <input type="date" name="birthdate" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('birthdate')}}" required>
                    @error('birthdate')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Nationality</p>
                    <input type="text" name="nationality" placeholder="Filipino" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('nationality')}}" required>
                    @error('nationality')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Gender</p>
                    <select name="gender" class="bg-slate-300 h-8 px-2 w-full rounded">
                        <option value="0">Select a gender</option>
                        <option value="male" {{old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="lgbt" {{old('gender') == 'lgbt' ? 'selected' : '' }}>LGBTQIA+</option>
                    </select>
                </div>
                @error('gender')
                    <p class=" text-red-600 text-sm">{{$message}}</p>
                @enderror
                <div class="flex-1 lg:py-3">
                    <p>Civil Status</p>
                    <select name="civil_status" class="bg-slate-300 h-8 px-2 w-full rounded">
                        <option>Select civil status</option>
                        <option value="single" {{old('civil_status') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{old('civil_status') == 'single' ? 'married' : '' }}>Married</option>
                        <option value="widowed" {{old('civil_status') == 'single' ? 'widowed' : '' }}>Widowed</option>
                        <option value="separated" {{old('civil_status') == 'single' ? 'separated' : '' }}>Separated</option>
                    </select>
                </div>
                @error('civil_status')
                    <p class=" text-red-600 text-sm">{{$message}}</p>
                @enderror
                <div class="flex-1 lg:py-3">
                    <p>Occupation</p>
                    <input type="text" name="occupation" placeholder="Teacher" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('occupation')}}" required>
                    @error('occupation')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Phone</p>
                    <input type="tel" name="phone" placeholder="09123456789" pattern="[0-9]{11}" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('phone')}}" required>
                    @error('phone')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>4Ps Member</p>
                    <div class="flex justify-around items-center w-full">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="four_ps" class="bg-slate-300 h-8 px-2" value="yes" {{old('four_ps') == 'yes' ? 'checked' : '' }}>Yes
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="four_ps" class="bg-slate-300 h-8 px-2" value="no" {{old('four_ps') == 'no' ? 'checked' : '' }}>No
                        </div>
                    </div>
                    @error('four_ps')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Valid ID</p>
                    <input type="file" name="valid_id" class="bg-slate-300 h-8 px-2 w-full rounded" required>
                    @error('valid_id')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Email</p>
                    <input type="text" name="email" placeholder="jdelacruz@gmail.com" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('email')}}" required>
                    @error('email')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Username</p>
                    <input type="text" name="username" placeholder="jdelacruz123" class="bg-slate-300 h-8 px-2 w-full rounded" value="{{old('username')}}" required>
                    @error('username')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex lg:flex-row flex-col gap-3">
                <div class="flex-1 lg:py-3">
                    <p>Password</p>
                    <input type="password" name="password" class="bg-slate-300 h-8 px-2 w-full rounded">
                    @error('password')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-1 lg:py-3">
                    <p>Confirm Password</p>
                    <input type="password" name="c_password" class="bg-slate-300 h-8 px-2 w-full rounded">
                    @error('c_password')
                        <p class=" text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-6 pb-3 text-center">
                <input type="submit" name="submit" value="Sign Up" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600">
            </div>
        </form>
        <div class="flex flex-row items-center justify-center w-full">
            <hr class="border-1 w-1/3">
            <p class="px-3">or</p>
            <hr class="border-1 w-1/3">
        </div>
        <div class="lg:py-3">
            <a href="/login"><button class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded lg:mb-0 mb-6 hover:bg-blue-600">Log In</button></a>
        </div>
    </div>
    <div class="flex-1 lg:flex lg:justify-center lg:items-center bg-blue-600 hidden">
        <img class="h-2/3 object-cover" src="{{asset('img/bbm.jpg')}}" alt="Image Alt Text">
    </div>
</div>

</body>
</html>
