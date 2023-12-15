<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
</head>
<body>
<div class="h-screen lg:flex">
    <div class="flex-1 flex flex-col justify-center items-center h-full">
        <p class="font-black text-5xl mb-3 text-center">Change Password</p>
        <form action="/changepass/new" method="POST">
            @CSRF
            <div class="py-3">
                <p>Current Password</p>
                <input type="password" name="ct_password" class="bg-slate-300 h-8 lg:w-80 px-2 rounded" required>
                @error('ct_password')
                    <p class=" text-red-600 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="py-3">
                <p>New Password</p>
                <input type="password" name="new_password" class="bg-slate-300 h-8 lg:w-80 px-2 rounded" required>
                @error('new_password')
                    <p class=" text-red-600 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="py-3">
                <p>Confirm Password</p>
                <input type="password" name="co_password" class="bg-slate-300 h-8 lg:w-80 px-2 rounded" required>
                @error('co_password')
                    <p class=" text-red-600 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="py-3 text-center">
                <button type="submit" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600">Confirm Changes</button>
            </div>
        </form>
    </div>
    <div class="flex-1 lg:flex lg:justify-center lg:items-center bg-blue-600 hidden">
        <img class="h-2/3" src="{{asset('img/change-pass.png')}}">
    </div>
</div>

@if(session('wrong-pass'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'The current password you entered is wrong. Please try again',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@endif

</body>
</html>