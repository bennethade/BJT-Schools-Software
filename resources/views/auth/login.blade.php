<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  @php
  $getHeaderSetting = App\Models\Setting::getSingle();
  @endphp

  <link href="{{ $getHeaderSetting->getFavicon() }}" rel="icon" type="image/jpg">



  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #6e00ff, #a000c8);
      padding: 40px 10px;
      /* add spacing at top and bottom */
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      /* ensures full height but allows for scroll */
    }


    .container {
      width: 900px;
      height: 500px;
      background: #1a1a2e;
      border-radius: 15px;
      display: flex;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .login-section {
      width: 40%;
      padding: 40px;
      background: #2e2e3e;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .login-section .user-icon {
      width: 80px;
      height: 80px;
      border: 2px solid #00d0ff;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-section .user-icon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }



    /* .login-section .user-icon::before {
      content: '\1F464';
      font-size: 36px;
    } */

    .login-section input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 20px;
      background: #444;
      color: white;
      padding-left: 20px;
    }

    .login-section button {
      width: 100%;
      padding: 12px;
      background: #ff007f;
      /* background: #4329c5; */
      color: white;
      border: none;
      border-radius: 20px;
      margin-top: 10px;
      cursor: pointer;
      font-weight: bold;
    }

    .login-section .options {
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
      font-size: 12px;
      width: 100%;
      color: #aaa;
    }

    .welcome-section {
      width: 60%;
      background: #000;
      color: white;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .welcome-section h1 {
      font-size: 48px;
      font-weight: bold;
      margin: 20px;
      position: relative;
      z-index: 2;
    }

    .slider {
      flex: 1;
      position: relative;
      overflow: hidden;
    }

    .slides {
      display: flex;
      height: 100%;
      width: 100%;
      /* Adjust based on number of slides */
      animation: slide 40s infinite;
    }

    .slides img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      flex-shrink: 0;
    }

    .welcome-heading {
      font-size: 42px;
      text-align: center;
    }


    @keyframes slide {
      0% {
        transform: translateX(0);
      }

      11.11% {
        transform: translateX(0);
      }

      13.88% {
        transform: translateX(-100%);
      }

      25% {
        transform: translateX(-100%);
      }

      27.77% {
        transform: translateX(-200%);
      }

      38.88% {
        transform: translateX(-200%);
      }

      41.66% {
        transform: translateX(-300%);
      }

      52.77% {
        transform: translateX(-300%);
      }

      55.55% {
        transform: translateX(-400%);
      }

      66.66% {
        transform: translateX(-400%);
      }

      /* Reverse starts here — match timing */
      69.44% {
        transform: translateX(-300%);
      }

      80.55% {
        transform: translateX(-300%);
      }

      83.33% {
        transform: translateX(-200%);
      }

      94.44% {
        transform: translateX(-200%);
      }

      97.22% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(0);
      }
    }


    .top-nav {
      position: absolute;
      top: 20px;
      right: 30px;
      display: flex;
      gap: 20px;
      font-size: 14px;
      color: white;
      z-index: 3;
    }

    .top-nav a {
      color: white;
      text-decoration: none;
    }

    .top-nav .sign-btn {
      padding: 6px 16px;
      background: #00d0ff;
      border-radius: 20px;
      font-weight: bold;
    }

    @media (max-width: 992px) {
      .container {
        flex-direction: column;
        width: 95%;
        height: auto;
      }

      .login-section,
      .welcome-section {
        width: 100%;
        height: auto;
      }

      .login-section {
        padding: 30px 20px;
      }

      .welcome-section h2 {
        font-size: 28px;
        margin: 10px 0;
        text-align: center;
      }

      .slider {
        height: 200px;
      }

      .slides img {
        object-fit: cover;
      }

      .login-section input,
      .login-section button {
        font-size: 14px;
        padding: 10px;
      }

      .top-nav {
        flex-direction: column;
        top: 10px;
        right: 10px;
        gap: 10px;
      }
    }

    @media (max-width: 576px) {
      .user-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
      }

      .login-section input,
      .login-section button {
        font-size: 13px;
        padding: 8px;
      }

      .welcome-section h2 {
        font-size: 22px;
        /* smaller font-size only for mobile */
      }

      .welcome-heading {
        font-size: 22px;
      }


      .slider {
        height: 150px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="login-section">
      {{-- <div class="user-icon">

      </div> --}}

      <div class="user-icon">
        <img src="{{ $getHeaderSetting->getLogo() }}" alt="Student Icon">
        {{-- <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Student Icon"> --}}
      </div>


      @include('_message')

      <form action="{{ url('login') }}" method="post">
        @csrf

        <input type="email" class="" name="email" required placeholder="Email">

        <input type="password" class="" name="password" placeholder="Password">

        <button type="submit">LOGIN</button>
      </form>

      <div class="options">
        <!-- <label><input type="checkbox"> Remember me</label> -->
        <a href="{{ url('forgot-password') }}" style="color: #ff007f;">Forgot your password?</a>
      </div>

    </div>
    <div class="welcome-section">
      <!-- <div class="top-nav">
                <a href="#">About</a>
                <a href="#">Download</a>
                <a href="#">Pricing</a>
                <a href="#">Features</a>
                <a href="#">Contact</a>
                <a href="#" class="sign-btn">Sign In</a>
            </div> -->
      <h2 class="welcome-heading">WELCOME TO {{ $getHeaderSetting->abbreviation }}</h2>

      <div class="slider">
        <div class="slides">
          <img src="{{ asset('upload/slides/image2.png') }}" alt="Slide 2">
          <img src="{{ asset('upload/slides/image3.jpg') }}" alt="Slide 3">
          <img src="{{ asset('upload/slides/image4.jpg') }}" alt="Slide 4">
          <img src="{{ asset('upload/slides/image5.jpg') }}" alt="Slide 5">
          <img src="{{ asset('upload/slides/image6.jpg') }}" alt="Slide 5">
        </div>
      </div>
    </div>
  </div>
</body>

</html>