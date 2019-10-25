<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/slick/slick.css">
    <link rel="stylesheet" href="/slick/slick-theme.css">
    <link rel="stylesheet" href="/styles/global.css">
    <link rel="stylesheet" href="/styles/navbar.css">
    <link rel="stylesheet" href="/styles/download-footer.css">
    <link rel="stylesheet" href="/styles/index.css">
    <title>Gate App</title>
    <style>
            .login{
                background: #fff;
            }
        </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light our-nav col-12 border-bottom">
            <a class="navbar-brand app-logo" href="{{url('/')}}">
                <img src="images/Logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse nav-utilities" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">Partners</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>

                </ul>
                <a href="{{url('login')}}"><button class="btn btn-success login-btn mx-2">LOGIN</button></a>
                <button class="btn btn-outline-success signup-btn mx-2">SIGN UP</button>
            </div>
        </nav>

           @yield('content')

            <footer class="border col-12 app-footer">
                <div class="col-11 mx-auto row mx-0 mt-5">
                    <div class="col-12 col-md">
                        <ul class="list-group footer-list">
                            <li class="list-group-item pb-2 list-header">Features</li>
                            <li class="list-group-item py-1 footer-links ">Visitor Management</li>
                            <li class="list-group-item py-1 footer-links ">Delivery Management</li>
                            <li class="list-group-item py-1 footer-links ">Communication Management</li>
                        </ul>
                    </div>
                    <div class="col-12 col-md">
                        <ul class="list-group footer-list">
                            <li class="list-group-item pb-2 list-header">Company</li>
                            <li class="list-group-item py-1 footer-links ">About Us</li>
                            <li class="list-group-item py-1 footer-links ">Contact Us</li>
                            <li class="list-group-item py-1 footer-links ">Frequently Asked Questions</li>
                            <li class="list-group-item py-1 footer-links ">Terms and Conditions</li>
                        </ul>
                    </div>
                    <div class="col-12 col-md">
                        <ul class="list-group footer-list">
                            <li class="list-group-item pb-2 list-header">Contact</li>
                            <li class="list-group-item py-1 footer-links">Plot 6, Gibbert Avenue, Flutter
                                estate, <br>
                                Agidingbi, Ikeja, Lagos state.</li>
                            <li class="list-group-item py-1 footer-links">+234 705 784 3748</li>
                            <li class="list-group-item py-1 footer-links">contact@gateguard.org</li>
                        </ul>
                    </div>
                    <div class="col-8 col-sm-6 col-md">
                        <div class="col-12 col-md-8 mt-3 footer-logo">
                            <img src="images/gateguard-white.png" alt="">
                        </div>
                        <div class="col-12 col-md-8 mt-3 social-links">
                            <img class="mx-2" src="images/instagram.png" alt="">
                            <img class="mx-2" src="images/twitter.png" alt="">
                            <img class="mx-2" src="images/facebook.png" alt="">
                        </div>
                        <div class="col-12 mt-2 footer-download">
                            <p class="mb-1">Download App</p>
                            <div class="col-12 row mx-0 px-0">
                                <div class="col px-0 app-cons mr-2">
                                    <img src="images/playstore.png" alt="">
                                </div>
                                <div class="col px-0 app-cons">
                                    <img src="images/appstore.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<script src="slick/slick.js"></script>
<script type="text/javascript">
    $(".customers").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true,
        autoplay: true
    });
</script>

</html>
