
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Solar Maintenance System</title>
        {{-- Favicon --}}
    <link
        rel="icon"
        type="image/jpeg"
        href="{{ asset('images/branding/polylogo.jpg') }}"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background: #063b2b;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    90deg,
                    rgba(3, 45, 33, 0.92) 0%,
                    rgba(3, 45, 33, 0.78) 45%,
                    rgba(3, 45, 33, 0.55) 100%
                ),
                url('{{ asset('images/backgrounds/department.jpg') }}');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Decorative glow */
        .login-page::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 193, 7, 0.10);
            top: -200px;
            right: -150px;
        }

        .login-page::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(25, 135, 84, 0.16);
            bottom: -180px;
            left: -100px;
        }

        .container {
            width: 100%;
            max-width: 1250px;
            margin: auto;
            padding: 35px;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 50px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        /* LEFT SIDE */
        .brand-section {
            color: white;
            padding: 30px;
        }

        .school-logo {
            width: 95px;
            height: 95px;
            object-fit: contain;
            background: white;
            border-radius: 16px;
            padding: 8px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .institution {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: #ffc107;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .department {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 30px;
        }

        .brand-section h1 {
            font-size: clamp(36px, 5vw, 62px);
            line-height: 1.05;
            margin-bottom: 18px;
            font-weight: 800;
        }

        .brand-section h1 span {
            color: #ffc107;
        }

        .project-title {
            max-width: 650px;
            font-size: 18px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.90);
            margin-bottom: 30px;
        }

        .project-info {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .info-item {
            border-left: 3px solid #ffc107;
            padding-left: 12px;
        }

        .info-label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.60);
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: white;
        }

        /* LOGIN CARD */
        .login-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 24px;
            padding: 42px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 470px;
            margin-left: auto;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #063b2b;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #24352e;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #d9dfdc;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: 0.25s ease;
            background: #f9fbfa;
        }

        .form-control:focus {
            border-color: #198754;
            background: white;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.12);
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 8px 0 25px;
            font-size: 13px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #555;
        }

        .remember input {
            accent-color: #198754;
        }

        .forgot-link {
            color: #198754;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #198754;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s ease;
            box-shadow: 0 8px 18px rgba(25, 135, 84, 0.22);
        }

        .login-button:hover {
            background: #146c43;
            transform: translateY(-1px);
        }

        .back-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #198754;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-home:hover {
            text-decoration: underline;
        }

        .error-box {
            background: #fff1f1;
            border: 1px solid #f1b5b5;
            color: #a33a3a;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 18px;
        }

        /* MOBILE */
        @media (max-width: 900px) {
            .login-page {
                background-position: center;
            }

            .container {
                grid-template-columns: 1fr;
                max-width: 650px;
                padding: 25px;
                gap: 25px;
            }

            .brand-section {
                text-align: center;
                padding: 10px;
            }

            .school-logo {
                margin-bottom: 15px;
            }

            .institution {
                font-size: 15px;
            }

            .brand-section h1 {
                font-size: 40px;
            }

            .project-title {
                margin-left: auto;
                margin-right: auto;
                font-size: 15px;
            }

            .project-info {
                justify-content: center;
            }

            .login-card {
                margin: 0 auto;
                padding: 30px;
            }
        }

        @media (max-width: 500px) {
            .container {
                padding: 18px;
            }

            .brand-section h1 {
                font-size: 32px;
            }

            .project-title {
                font-size: 14px;
            }

            .login-card {
                padding: 25px 20px;
                border-radius: 18px;
            }

            .login-header h2 {
                font-size: 26px;
            }

            .remember-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    <div class="container">

        <!-- LEFT SIDE -->
        <section class="brand-section">

            <img
                src="{{ asset('images/branding/polylogo.jpg') }}"
                alt="Federal Polytechnic Bauchi Logo"
                class="school-logo"
            >

            <div class="institution">
                Federal Polytechnic Bauchi
            </div>

            <div class="department">
                Department of Software and Web Development
            </div>

            <h1>
                Solar <span>Maintenance</span> System
            </h1>

            <p class="project-title">
                Preventive Maintenance Schedule and Cost Model
                for a 2-Year-Old Solar-Battery Installation.
            </p>

            <div class="project-info">

                <div class="info-item">
                    <span class="info-label">Developer</span>
                    <span class="info-value">
                        Ukaba Benjamin Adekpe
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">Supervisor</span>
                    <span class="info-value">
                        Mallama. Zainab Umar Mohammed
                    </span>
                </div>

            </div>

        </section>


        <!-- LOGIN CARD -->
        <section class="login-card">

            <div class="login-header">
                <h2>Welcome Back</h2>

                <p>
                    Sign in to access the Solar Maintenance System dashboard.
                </p>
            </div>


            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- EMAIL -->
                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="form-control"
                        placeholder="Enter your email address"
                    >

                </div>


                <!-- PASSWORD -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="form-control"
                        placeholder="Enter your password"
                    >

                </div>


                <!-- REMEMBER / FORGOT -->
                <div class="remember-row">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>Remember me</span>

                    </label>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot-link"
                        >
                            Forgot password?
                        </a>

                    @endif

                </div>


                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="login-button"
                >
                    Login to Dashboard
                </button>

            </form>


            <a
                href="{{ url('/') }}"
                class="back-home"
            >
                ← Back to Home
            </a>

        </section>

    </div>

</div>

</body>
</html>
