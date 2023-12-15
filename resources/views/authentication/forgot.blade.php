<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    <div class="flex-1 lg:flex lg:justify-center lg:items-center bg-blue-600 hidden">
        <img class="h-2/3 object-cover" src="{{asset('img/bbm.jpg')}}" alt="Image Alt Text">
    </div>
    <div class="flex-1 flex flex-col justify-center items-center h-full">
        @if(!session('code-success'))
        <p class="font-black text-5xl mb-3">Forgot Password</p>
        @else
        <p class="font-black text-5xl mb-3">Reset Password</p>
        @endif
        @if(!session('code-success'))
            <form action="/code" method="POST">
                @CSRF
                <div class="py-3">
                    <div class="flex items-end lg:w-96 gap-1">
                        <div class="flex-grow">
                            <p>Email</p>
                            <input type="text" name="email" class="bg-slate-300 h-8 px-2 rounded w-full" value="{{ old('email') ?? (isset($email) ? $email : '') }}" required>
                        </div>
                        <button type="submit" class="bg-blue-500 h-8 text-white rounded hover:bg-blue-600 text-sm px-2"><i class="fa-regular fa-paper-plane"></i> Code</button>
                    </div>
                </div>
            </form>
            @if(session('send-success'))
            <form action="/reset" method="POST">
                @CSRF
                <input type="text" name="email" class="hidden" value="{{$email}}">
                <div class="py-3">
                    <p>Code</p>
                    <input type="text" name="code" class="bg-slate-300 h-8 lg:w-96 px-2 rounded" value="{{old('code')}}" required>
                </div>
                <div class="pt-6 pb-3 text-center">
                    <input type="submit" name="submit" value="Reset Password" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600" required>
                </div>
            </form>
            @endif
        @else
        <form action="/newpass" method="POST">
            @CSRF
            <input type="text" name="email" class="hidden" value="{{$email}}">
            <div class="py-3">
                <p>New Password</p>
                <input type="password" name="password" class="bg-slate-300 h-8 lg:w-96 px-2 rounded" required>
            </div>
            <div class="py-3">
                <p>Confirm Password</p>
                <input type="password" name="c_password" class="bg-slate-300 h-8 lg:w-96 px-2 rounded" required>
            </div>
            <div class="pt-6 pb-3 text-center">
                <input type="submit" name="submit" value="Reset" class="bg-blue-500 h-8 lg:w-56 w-36 text-white rounded hover:cursor-pointer hover:bg-blue-600" required>
            </div>
        </form>
        @endif
    </div>
</div>

@if(session('send-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Password reset code has been sent. Please check your email address.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('email-notexist'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'Email is not registered.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('code-expired'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: 'Code is expired. Please request a new code.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@endif

</body>
</html>
