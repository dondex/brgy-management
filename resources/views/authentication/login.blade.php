<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
</head>
<body>
<div class="h-screen lg:flex">
    <div class="flex-1 lg:flex lg:justify-center lg:items-center bg-blue-600 hidden">
        <img class="h-2/3 object-cover" src="{{asset('img/bbm.jpg')}}" alt="Image Alt Text">
    </div>

    {{-- <div class="flex-1 lg:flex lg:justify-center lg:items-center bg-blue-600 hidden">
        <img class="h-2/3" src="{{asset('img/logo.png')}}">
    </div> --}}
    <div class="flex-1 flex flex-col justify-center items-center h-full">
        <img class="w-20 h-20" src="{{asset('img/logo.png')}}">
        <p class="font-black text-5xl mb-3">Log In</p>
        <form action="/gologin" method="POST">
            @CSRF
            <div class="py-3">
                <p>Username</p>
                <input type="text" name="username" class="bg-slate-300 h-8 lg:w-80 px-2 rounded" value="{{old('username')}}" required>
            </div>
            <div class="py-3">
                <p>Password</p>
                <input type="password" name="password" class="bg-slate-300 h-8 lg:w-80 px-2 rounded">
            </div>
            <div class="pt-6 pb-3 text-center">
                <input type="submit" name="submit" value="Log In" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600" required>
            </div>
            <div class="pt-6 pb-3 text-center">
                <a href="/forgot"><p class="hover:text-blue-600">Forgot Password?</p></a>
            </div>
        </form>
        <div class="flex flex-row items-center justify-center w-full">
            <hr class="border-1 w-1/3">
            <p class="px-3">or</p>
            <hr class="border-1 w-1/3">
        </div>
        <div class="py-3">
            <a href="/signup"><button class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:bg-blue-600">Sign Up</button></a>
        </div>
    </div>
</div>

@if(session('invalid-login'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'Invalid username or password.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('inactive-account'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'Your account is currently inactive. Please contact the administrator.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('registraion-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Your account is registered successfully. You can now log in.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('reset-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Password reset success.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

elseif(session('login-request'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'Please log in first before requesting a document',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('change-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Password changed successfully. Please log in again.',
    showConfirmButton: false,
    timer: 2500,
    heightAuto: false
    })
</script>

@endif

</body>
</html>
