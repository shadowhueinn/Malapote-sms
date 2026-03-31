<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - SMS</title>
    <style>
        body { margin:0; padding:0; font-family: Arial, sans-serif; background: #f3f4f6; }
        .page { min-height:100vh; display:flex; justify-content:center; align-items:center; }
        .card { background:#fff; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.1); width: 100%; max-width: 420px; padding:2rem; }
        h1 { margin:0 0 1rem; color:#0f4761; text-align:center; }
        .toggle { display:flex; gap:10px; margin-bottom:1rem; }
        .toggle button { flex:1; border:1px solid #cbd5e1; background:#fff; padding:.6rem .8rem; border-radius:6px; cursor:pointer; }
        .toggle button.active { background:#0f766e; color:#fff; border-color:#0f766e; }
        form { display:none; gap:.8rem; }
        form.active { display:grid; }
        label { font-size:.9rem; font-weight:600; }
        input { padding:.65rem; border:1px solid #cbd5e1; border-radius:6px; width:100%; }
        .submit { border:none; background:#0f766e; color:#fff; padding:.7rem; border-radius:6px; cursor:pointer; }
        .error { color:#dc2626; margin:0.5rem 0; font-size:.9rem; }
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <h1>Login / Register</h1>
            <div class="toggle">
                <button id="btnLogin" class="active">Log In</button>
                <button id="btnRegister">Register</button>
            </div>

            @if ($errors->any())
                <div class="error">{{ implode(' ', $errors->all()) }}</div>
            @endif

            <form id="loginForm" class="active" method="POST" action="{{ route('login.submit') }}">
                @csrf
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <label><input type="checkbox" name="remember"> Remember me</label>
                <button type="submit" class="submit">Log In</button>
            </form>

            <form id="registerForm" method="POST" action="{{ route('register.submit') }}">
                @csrf
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
                <label>Role</label>
                <select name="role" style="padding:.65rem; border:1px solid #cbd5e1; border-radius:6px;">
                    <option value="student" selected>student</option>
                    <option value="secretary">secretary</option>
                    <option value="admin">admin</option>
                </select>
                <button type="submit" class="submit">Register</button>
            </form>
        </div>
    </div>
    <script>
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const btnLogin = document.getElementById('btnLogin');
        const btnRegister = document.getElementById('btnRegister');

        btnLogin.addEventListener('click', () => {
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
            btnLogin.classList.add('active');
            btnRegister.classList.remove('active');
        });

        btnRegister.addEventListener('click', () => {
            loginForm.classList.remove('active');
            registerForm.classList.add('active');
            btnRegister.classList.add('active');
            btnLogin.classList.remove('active');
        });
    </script>
</body>
</html>
