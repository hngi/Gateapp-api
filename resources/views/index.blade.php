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
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/download-footer.css">
    <link rel="stylesheet" href="styles/index.css">
    <title>Gate App</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light our-nav col-12 border-bottom">
                <a class="navbar-brand app-logo" href="#">
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
                    <a class="btn btn-success login-btn mx-2" href="{{ url('/login') }}">LOGIN<a/>
                    <button class="btn btn-outline-success signup-btn mx-2" onclick="location.href='https://drive.google.com/open?id=1kds4OWSe-A4IwaIzP--E15qN_Yb3h43K'">DOWNLOAD</button>
                </div>
            </nav>
            <div class="col-12 welcome-image border-bottom">
                <!--  -->
                <div class="col-12 col-md-6 mx-auto welcome-image-words text-center">
                    <h1 class="mt-5 mb-4">Modern Gate Management <br> That Makes Life Smarter</h1>
                    <p class="mb-4">A fully packaged gate management platform for any infrastructure <br>
                        (Home, Estate, or Office). This module increases your security <br>
                        without hassle.</p>
                    <button class="btn request-demo-btn">REQUEST DEMO</button>
                </div>
            </div>
            <div class="features col-12 mb-2">
                <h3 class="text-center mt-5 mb-0">FEATURES</h3>
                <hr class="green-underline mt-2">
                <div class="col-8 features-listed mx-auto row mx-0">
                    <div class="col indiv-feature">
                        <div class="col-8 mx-auto mt-5 text-center">
                            <img class="feature-img" src="images/visitor-management.png" alt=""> <br>
                            <span>Visitor Management</span>
                        </div>
                    </div>
                    <div class="col indiv-feature">
                        <div class="col-8 mx-auto mt-5 text-center">
                            <img class="feature-img" src="images/guard-management.png" alt=""> <br>
                            <span>Guard Management</span>
                        </div>
                    </div>
                    <div class="col indiv-feature">
                        <div class="col-8 mx-auto mt-5 text-center">
                            <img class="feature-img" src="images/staff-management.png" alt=""> <br>
                            <span>Staff Management</span>
                        </div>
                    </div>
                    <div class="col indiv-feature">
                        <div class="col-8 mx-auto mt-5 text-center">
                            <img class="feature-img" src="images/delivery-management.png" alt=""> <br>
                            <span>Delivery Management</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 gateguard-desc row mx-0 mb-5 mt-5">
                <div class="col-12 col-md-7">
                    <div class="col-12 col-md-9 mx-auto what-is-gateguard mt-5">
                        <h1>What is GateGuard?</h1>
                        <hr class="green-underline mt-2 ml-0">
                        <p class="mt-4">An app that makes life easy for everyone, it is a security <br>
                            solution for gated apartment and estates. It helps residents <br>
                            securely manage who goes in and out of the gate. Its fully <br>
                            packed features has helped reduce the challenged faced <br>
                            during visitor authorization to a single click.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="col-10 gateguard-image">
                        <img src="images/gateguard-image.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 feature-breakdown">
                <div class="col-12 col-md-11 mx-auto row mx-0 breakdown-con">
                    <div class="col-12 col-md">
                        <div class="col-12 col-md-10 mt-4">
                            <h3 class="breakdown-header">Residents</h3>
                            <hr class="green-underline mt-2 ml-0">
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Residents can update "Expected Visitor" details on <br> GateGuard mobile
                                        app.</p>
                                </div>
                            </div>
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Get real time notifications on visitors coming to <br> your home</p>
                                </div>
                            </div>
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Staff management service (Cook, Maid, Nanny, <br> Driver) hire through
                                        the app.</p>
                                </div>
                            </div>
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Residents get alerts whenever their staff checks in <br> / out the gate.
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn learn-more-btn mb-5">
                                    LEARN MORE
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="col-10 mt-5 breakdown-image mx-auto px-0">
                            <img src="images/mansion.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-11 mx-auto row mx-0 breakdown-con">
                    <div class="col-12 col-md">
                        <div class="col-10 mt-5 breakdown-image mx-auto px-0">
                            <img src="images/gate.png" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="col-12 col-md-10 mt-4 ml-auto">
                            <h3 class="breakdown-header">Security Guards</h3>
                            <hr class="green-underline mt-2 ml-0">
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Guards can view "Expected Visitors" details on <br> GateGuard mobile
                                        app.</p>
                                </div>
                            </div>
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Guards real time notifications on visitors coming <br> to to visit.</p>
                                </div>
                            </div>
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Guards will now have access to the list of <br> blacklisted staffs to
                                        prevent entry.</p>
                                </div>
                            </div>
                            <div class="col-12 row mx-0 px-0 breakdown-feature">
                                <div class="pt-2 col-2">
                                    <img class="" src="images/star.png" alt="">
                                </div>
                                <div class="pt-2 col-10">
                                    <p class="">Faster check-ins at the gate which has eliminated <br> the long queues.
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn learn-more-btn mb-5">
                                    LEARN MORE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="customers col-11 col-md-11 mx-auto">
                <div class="col-12 customer-review mt-5">
                  <h2 class="text-center customer-header">WHAT OUR CUSTOMERS SAY</h2>
                  <hr class="green-underline mt-2">
                  <div class="customer-image mt-5 mx-auto">
                    <img src="images/12.jpeg" alt="">
                  </div>
                  <div class="customer-words mx-auto text-center mt-4 col-12 col-md-6">
                      <p>Great App I must say!!! this solution, definitely makes me feel very <br>
                         comfortable, confident and in control of the security of my family. <br>
                          Now we can track who/what goes in or out. NICE!!!</p>
                        <h4 class="review-author mb-0">- Mompha James</h4>
                        <span class="review-location">GamesVille Estate</span>
                  </div>
                  <div class="col-12 col-md-10 partners-showcase row mx-0 px-0 mx-auto mt-3">
                      <div class="col-6 col-md pt-5">
                          <img src="images/Alex.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/real.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-2">
                          <img src="images/Fortis.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/king.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/John.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/Windermere.png" alt="">
                      </div>
                  </div>
                </div>
                <div class="col-12 customer-review mt-5">
                  <h2 class="text-center customer-header">WHAT OUR CUSTOMERS SAY</h2>
                  <hr class="green-underline mt-2">
                  <div class="customer-image mt-5 mx-auto">
                    <img src="images/12.jpeg" alt="">
                  </div>
                  <div class="customer-words mx-auto text-center mt-4 col-12 col-md-6">
                      <p>Great App I must say!!! this solution, definitely makes me feel very <br>
                         comfortable, confident and in control of the security of my family. <br>
                          Now we can track who/what goes in or out. NICE!!!</p>
                        <h4 class="review-author mb-0">- Mompha James</h4>
                        <span class="review-location">GamesVille Estate</span>
                  </div>
                  <div class="col-12 col-md-10 partners-showcase row mx-0 px-0 mx-auto mt-3">
                      <div class="col-6 col-md pt-5">
                          <img src="images/Alex.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/real.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-2">
                          <img src="images/Fortis.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/king.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/John.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/Windermere.png" alt="">
                      </div>
                  </div>
                </div>
                <div class="col-12 customer-review mt-5">
                  <h2 class="text-center customer-header">WHAT OUR CUSTOMERS SAY</h2>
                  <hr class="green-underline mt-2">
                  <div class="customer-image mt-5 mx-auto">
                    <img src="images/12.jpeg" alt="">
                  </div>
                  <div class="customer-words mx-auto text-center mt-4 col-12 col-md-6">
                      <p>Great App I must say!!! this solution, definitely makes me feel very <br>
                         comfortable, confident and in control of the security of my family. <br>
                          Now we can track who/what goes in or out. NICE!!!</p>
                        <h4 class="review-author mb-0">- Mompha James</h4>
                        <span class="review-location">GamesVille Estate</span>
                  </div>
                  <div class="col-12 col-md-10 partners-showcase row mx-0 px-0 mx-auto mt-3">
                      <div class="col-6 col-md pt-5">
                          <img src="images/Alex.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/real.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-2">
                          <img src="images/Fortis.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/king.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/John.png" alt="">
                      </div>
                      <div class="col-6 col-md pt-5">
                          <img src="images/Windermere.png" alt="">
                      </div>
                  </div>
                </div>
                
              </section>
            <!-- DOWNLOAD APP AND FOOTER SECTIONS -->
            <div class="col-12 download-footer px-0">
                <div class="col-12 download-app row mx-0">
                    <div class="col-12 col-md-5">
                        <div class="col-9 download-image-con mt-5 mx-auto">
                            <img src="images/download-app-image.png" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 mb-2">
                        <div class="col-10 details-con mx-auto">
                            <h2>DOWNLOAD THE APP</h2>
                            <hr class="green-underline mt-2 ml-0">
                            <p>Worry less abot security saying goodbye to the old scary security <br>
                                system. Monitor every activity at your residence with just one click. <br>
                                GateGUARD is the perfect App that solves every of your security <br> worries.</p>
                            <div class="col-12 download-links row mx-0 px-0 mt-5">
                                <div class="col-12 col-sm-8 mt-2 col-md-5 store-link px-0">
                                    <img src="images/playstore.png" style="cursor: pointer" alt="" onclick="location.href='https://drive.google.com/open?id=1kds4OWSe-A4IwaIzP--E15qN_Yb3h43K'">
                                </div>
                                <div class="col-12 col-sm-8 mt-2 col-md-5 store-link px-0">
                                    <img src="images/appstore.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <img src="images/playstore.png" style="cursor: pointer" alt="playstore" onclick="location.href='https://drive.google.com/open?id=1kds4OWSe-A4IwaIzP--E15qN_Yb3h43K'">
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