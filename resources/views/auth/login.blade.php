<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - UniFAST-TDP SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .glass { backdrop-filter: blur(10px); background: rgba(255,255,255,0.25); border:1px solid rgba(255,255,255,0.18); }
        .active { opacity: 1; font-weight: bold; }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">

<div class="glass rounded-2xl p-10 w-full max-w-md shadow-2xl">

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">UniFAST-TDP SMS</h1>
        <p class="text-white/80">Scholarship Management System</p>
    </div>

    <div class="flex gap-4 mb-8">
        <button id="btnLogin" class="flex-1 py-3 px-6 rounded-xl font-semibold bg-white/20 hover:bg-white/30 transition-all active">Log In</button>
        <button id="btnRegister" class="flex-1 py-3 px-6 rounded-xl font-semibold border-2 border-white/30 hover:bg-white/20 transition-all">Register</button>
    </div>

    {{-- Display errors --}}
    @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500/50 text-red-100 p-4 rounded-xl mb-6">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Display success message --}}
    @if (session('success'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-100 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- LOGIN FORM -->
    <form id="loginForm" method="POST" action="{{ route('login.submit') }}" class="space-y-4" style="display: block;">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <label class="block text-white/90 mb-2 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white placeholder-white/60 focus:outline-none focus:border-white/50">
        </div>

        <div>
            <label class="block text-white/90 mb-2 font-medium">Password</label>
            <input type="password" name="password" required
                class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white placeholder-white/60 focus:outline-none focus:border-white/50">
        </div>

        <label class="flex items-center text-white/80">
            <input type="checkbox" name="remember" class="mr-2 w-4 h-4">
            Remember me
        </label>

        <button type="submit"
            class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition-all">
            Sign In
        </button>
    </form>

    <!-- REGISTER FORM -->
    <form id="registerForm" method="POST" action="{{ route('register.submit') }}" class="space-y-4" style="display: none;">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <label class="block text-white/90 mb-2 font-medium">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white placeholder-white/60 focus:outline-none focus:border-white/50">
        </div>

        <div>
            <label class="block text-white/90 mb-2 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white placeholder-white/60 focus:outline-none focus:border-white/50">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-white/90 mb-2 font-medium">Password</label>
                <input type="password" name="password" required
                    class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white placeholder-white/60 focus:outline-none focus:border-white/50">
            </div>
            <div>
                <label class="block text-white/90 mb-2 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white placeholder-white/60 focus:outline-none focus:border-white/50">
            </div>
        </div>

        <div>
            <label class="block text-white/90 mb-2 font-medium">Role</label>
            <select name="role" required
                class="w-full p-4 rounded-xl border border-white/30 bg-white/10 text-white focus:outline-none focus:border-white/50">
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="secretary" {{ old('role') == 'secretary' ? 'selected' : '' }}>Secretary</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition-all">
            Create Account
        </button>
    </form>

</div>

<script>
    const loginBtn = document.getElementById('btnLogin');
    const registerBtn = document.getElementById('btnRegister');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    loginBtn.addEventListener('click', () => {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        loginBtn.classList.add('active');
        registerBtn.classList.remove('active');
    });

    registerBtn.addEventListener('click', () => {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        registerBtn.classList.add('active');
        loginBtn.classList.remove('active');
    });
</script>

</body>
</html>