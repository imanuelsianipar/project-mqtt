<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SIPANCAR</title>
    
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'ABeeZee', sans-serif; }
        body { background-color: #FFFFFF; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .register-container { width: 540px; position: relative; }
        .register-header { background-color: #9AFCFF; height: 97px; border-radius: 20px 20px 0 0; display: flex; justify-content: space-between; align-items: center; padding: 0 40px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); position: relative; z-index: 2; }
        .register-header h1 { font-size: 30px; color: #000000; font-weight: normal; }
        .logo-placeholder { width: 60px; height: 60px; background-color: #fff; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px; text-align: center; }
        .register-body { background: rgba(217, 217, 217, 0.15); border-radius: 0 0 20px 20px; padding: 40px 80px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); margin-top: -10px; text-align: center; }
        .register-body h2 { font-size: 30px; color: #000000; margin-bottom: 5px; font-weight: normal; }
        .register-body p { font-size: 20px; color: #000000; margin-bottom: 30px; }
        .form-group { text-align: left; margin-bottom: 20px; }
        .form-group label { display: block; font-size: 15px; color: #000000; margin-bottom: 8px; padding-left: 15px; }
        .input-wrapper { position: relative; }
        .input-wrapper input { width: 100%; height: 40px; background: #D9D9D9; border: 1px solid #000000; border-radius: 20px; padding: 0 20px; font-size: 15px; color: #545454; box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.1); }
        .input-wrapper input:focus { outline: none; border-color: #9AFCFF; }
        
        /* Ikon mata dimatikan fungsinya */
        .eye-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: default; color: #545454; }
        
        .btn-register { width: 120px; height: 35px; background: #9AFCFF; border-radius: 20px; border: none; font-size: 16px; color: #000000; cursor: pointer; margin-top: 15px; margin-bottom: 10px; transition: 0.3s; }
        .btn-register:hover { background: #7de8ed; }
        .login-link { display: block; font-size: 13px; color: #000000; text-decoration: none; }
        .login-link:hover { text-decoration: underline; color: #0056b3; }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="register-header">
            <div class="logo-placeholder">Logo BMKG</div> 
            <h1>SIPANCAR</h1>
            <div class="logo-placeholder">Logo JABAR</div>
        </div>

        <div class="register-body">
            <h2>Daftar Akun</h2>
            <p>Silahkan Daftarkan Akun Anda</p>

            @if($errors->any())
                <div style="background-color: #ffcccc; color: #ff0000; padding: 10px; border-radius: 10px; margin-bottom: 20px; text-align: left; font-size: 13px;">
                    <ul style="padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-wrapper">
                        <input type="text" name="username" placeholder="Masukkan Username Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="Masukkan Password Anda" required>
                        <span class="eye-icon">👁️</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Anda</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        <span class="eye-icon">👁️</span>
                    </div>
                </div>

                <button type="submit" class="btn-register">Daftar</button>
                
                <a href="{{ url('/') }}" class="login-link">Sudah memiliki akun? Silahkan Login</a>
            </form>
        </div>
    </div>

</body>
</html>