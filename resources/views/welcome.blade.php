
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Solar Maintenance System | Federal Polytechnic Bauchi</title>

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

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7faf8;
            color: #17352a;
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;

            background:
                linear-gradient(
                    rgba(3, 55, 39, 0.82),
                    rgba(3, 45, 33, 0.90)
                ),
                url('{{ asset('images/backgrounds/department.jpg') }}');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: rgba(255, 193, 7, 0.08);
            top: -180px;
            right: -120px;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(25, 135, 84, 0.15);
            bottom: -180px;
            left: -120px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 30px;
            position: relative;
            z-index: 2;
        }

        /* NAVBAR */
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }

        .nav-inner {
            max-width: 1200px;
            margin: auto;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
        }

        .brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            background: white;
            padding: 4px;
            border-radius: 10px;
        }

        .brand-text strong {
            display: block;
            font-size: 14px;
        }

        .brand-text span {
            display: block;
            font-size: 11px;
            color: #ffc107;
            margin-top: 3px;
        }

        .nav-login {
            color: white;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.45);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.25s ease;
        }

        .nav-login:hover {
            background: #ffc107;
            border-color: #ffc107;
            color: #17352a;
        }

        /* HERO CONTENT */
        .hero-content {
            max-width: 850px;
            padding-top: 80px;
        }

        .badge {
            display: inline-block;
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.55);
            color: #ffc107;
            padding: 9px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 22px;
        }

        .hero h1 {
            color: white;
            font-size: clamp(42px, 7vw, 78px);
            line-height: 0.98;
            margin-bottom: 25px;
            font-weight: 800;
        }

        .hero h1 span {
            color: #ffc107;
        }

        .hero-description {
            max-width: 760px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 14px 25px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
        }

        .btn-primary {
            background: #198754;
            color: white;
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.25);
        }

        .btn-primary:hover {
            background: #146c43;
            transform: translateY(-2px);
        }

        .btn-secondary {
            border: 1px solid rgba(255, 255, 255, 0.45);
            color: white;
        }

        .btn-secondary:hover {
            background: white;
            color: #17352a;
        }

        /* PROJECT DETAILS */
        .project-section {
            padding: 80px 0;
            background: white;
        }

        .section-heading {
            text-align: center;
            max-width: 750px;
            margin: 0 auto 50px;
        }

        .section-heading .small-title {
            color: #198754;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .section-heading h2 {
            font-size: 38px;
            color: #063b2b;
            margin-bottom: 15px;
        }

        .section-heading p {
            color: #68756f;
            line-height: 1.7;
            font-size: 15px;
        }

        /* FEATURES */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card {
            background: #f8fbf9;
            border: 1px solid #e2ebe6;
            border-radius: 15px;
            padding: 28px;
            transition: 0.25s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: #198754;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.07);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e6f4ed;
            color: #198754;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            font-size: 18px;
            color: #17352a;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #68756f;
            font-size: 14px;
            line-height: 1.7;
        }

        /* ABOUT PROJECT */
        .about-section {
            padding: 80px 0;
            background: #f5f8f6;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .about-image {
            min-height: 420px;
            border-radius: 20px;
            background:
                linear-gradient(
                    rgba(3, 55, 39, 0.20),
                    rgba(3, 55, 39, 0.30)
                ),
                url('{{ asset('images/backgrounds/department.jpg') }}');

            background-size: cover;
            background-position: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        }

        .about-content .small-title {
            color: #198754;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .about-content h2 {
            font-size: 38px;
            color: #063b2b;
            margin-bottom: 18px;
        }

        .about-content p {
            color: #68756f;
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .details {
            margin-top: 25px;
            display: grid;
            gap: 14px;
        }

        .detail {
            border-left: 3px solid #ffc107;
            padding-left: 14px;
        }

        .detail strong {
            display: block;
            color: #17352a;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .detail span {
            color: #68756f;
            font-size: 13px;
        }

        /* FOOTER */
        footer {
            background: #063b2b;
            color: white;
            padding: 35px 0;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            padding: 4px;
            border-radius: 8px;
        }

        .footer-brand strong {
            font-size: 14px;
        }

        .footer-brand span {
            display: block;
            color: #ffc107;
            font-size: 11px;
            margin-top: 3px;
        }

        .footer-copy {
            color: rgba(255, 255, 255, 0.65);
            font-size: 12px;
            text-align: right;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .features {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .about-image {
                min-height: 350px;
            }
        }

        @media (max-width: 600px) {
            .nav-inner {
                padding: 15px 20px;
            }

            .brand-text {
                display: none;
            }

            .container {
                padding: 25px 20px;
            }

            .hero-content {
                padding-top: 100px;
            }

            .hero h1 {
                font-size: 45px;
            }

            .hero-description {
                font-size: 15px;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .section-heading h2,
            .about-content h2 {
                font-size: 30px;
            }

            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-copy {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">

    <div class="nav-inner">

        <a href="{{ url('/') }}" class="brand">

            <img
                src="{{ asset('images/branding/polylogo.jpg') }}"
                alt="Federal Polytechnic Bauchi Logo"
            >

            <div class="brand-text">
                <strong>Federal Polytechnic Bauchi</strong>
                <span>Software & Web Development</span>
            </div>

        </a>

        <a href="{{ route('login') }}" class="nav-login">
            Login
        </a>

    </div>

</nav>


<!-- HERO -->
<section class="hero">

    <div class="container">

        <div class="hero-content">

            <div class="badge">
                Departmental Final Year Project
            </div>

            <h1>
                Solar <span>Maintenance</span> System
            </h1>

            <p class="hero-description">
                A web-based preventive maintenance and cost management
                system designed to support inspection scheduling,
                degradation tracking, maintenance records and
                replacement forecasting for solar-battery installations.
            </p>

            <div class="buttons">

                <a href="{{ route('login') }}" class="btn btn-primary">
                    Access System
                </a>

                <a href="#features" class="btn btn-secondary">
                    Explore Project
                </a>

            </div>

        </div>

    </div>

</section>


<!-- FEATURES -->
<section class="project-section" id="features">

    <div class="container">

        <div class="section-heading">

            <div class="small-title">
                System Features
            </div>

            <h2>
                Everything in One System
            </h2>

            <p>
                The system provides tools for monitoring solar installation
                maintenance activities, costs, components and future
                replacement requirements.
            </p>

        </div>


        <div class="features">

            <div class="feature-card">

                <div class="feature-icon">📅</div>

                <h3>Maintenance Scheduling</h3>

                <p>
                    Schedule preventive maintenance activities and
                    keep track of upcoming maintenance tasks.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">🔍</div>

                <h3>Inspection Tracking</h3>

                <p>
                    Record inspection activities and monitor the
                    condition of solar system components.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">💰</div>

                <h3>Cost Monitoring</h3>

                <p>
                    Record maintenance expenses and monitor the
                    cost associated with maintaining the installation.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">🔧</div>

                <h3>Component Management</h3>

                <p>
                    Manage important solar installation components
                    and keep their information organized.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">📊</div>

                <h3>Degradation Tracking</h3>

                <p>
                    Monitor component condition and record changes
                    that may affect system performance.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">🔮</div>

                <h3>Replacement Forecasting</h3>

                <p>
                    Estimate future replacement requirements based
                    on component condition and maintenance records.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- ABOUT PROJECT -->
<section class="about-section">

    <div class="container">

        <div class="about-grid">

            <div class="about-image"></div>


            <div class="about-content">

                <div class="small-title">
                    About The Project
                </div>

                <h2>
                    Preventive Maintenance Made Simple
                </h2>

                <p>
                    This project focuses on the preventive maintenance
                    of a two-year-old solar-battery installation.
                </p>

                <p>
                    The system provides a centralized platform for
                    recording inspections, maintenance activities,
                    component information and associated costs.
                </p>

                <p>
                    It also supports degradation monitoring and
                    replacement forecasting to help improve maintenance
                    planning.
                </p>


                <div class="details">

                    <div class="detail">

                        <strong>Institution</strong>

                        <span>
                            Federal Polytechnic Bauchi
                        </span>

                    </div>


                    <div class="detail">

                        <strong>Department</strong>

                        <span>
                            Software and Web Development
                        </span>

                    </div>


                    <div class="detail">

                        <strong>Developer</strong>

                        <span>
                            Ukaba Benjamin Adekpe
                        </span>

                    </div>


                    <div class="detail">

                        <strong>Supervisor</strong>

                        <span>
                            Mallama. Zainab Umar Mohammed
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- FOOTER -->
<footer>

    <div class="container">

        <div class="footer-inner">

            <div class="footer-brand">

                <img
                    src="{{ asset('images/branding/polylogo.jpg') }}"
                    alt="Federal Polytechnic Bauchi Logo"
                >

                <div>

                    <strong>
                        Federal Polytechnic Bauchi
                    </strong>

                    <span>
                        Department of Software and Web Development
                    </span>

                </div>

            </div>


            <div class="footer-copy">

            © {{ date('Y') }} <strong>Ukaba Benjamin Adekpe</strong>. All Rights Reserved.<br> <br>


            Solar Maintenance System · Preventive Maintenance & Cost Model

        </div>

        </div>

    </div>

</footer>

</body>
</html>