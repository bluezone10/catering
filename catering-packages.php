<?php
include 'INCLUDE/login.php';
$service = $_GET['event'];
$query = mysqli_query($conn, "SELECT * FROM services WHERE name='$service'");
$serviceData = mysqli_fetch_assoc($query);
$package1 = $serviceData['package1'];
$package2 = $serviceData['package2'];
$package3 = $serviceData['package3'];

$query1 = mysqli_query($conn, "SELECT * FROM packageitem WHERE services='$service' AND package='$package1'");
$query2 = mysqli_query($conn, "SELECT * FROM packageitem WHERE services='$service' AND package='$package2'");
$query3 = mysqli_query($conn, "SELECT * FROM packageitem WHERE services='$service' AND package='$package3'");
$services1 = mysqli_query($conn, "SELECT * FROM services");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
    <link rel="stylesheet" href="CSS/newHeads.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .parallax {
            position: relative;
            left: 0;
            top: 0;
            height: 75vh;
            width: 100%;

            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(255, 255, 255, 0)),
                url('IMAGE/<?= $serviceData['background'] ?>');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .parallax-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 20px;
            height: 100%;
        }
    </style>
</head>

<body>
<section class="emailSection">
        <div class="position-fixed bg-dark w-100 h-100" style="z-index: 9; left: 0; top: 0; opacity: 0.75"></div>
        <div class="emailContainer position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="z-index: 10; left: 0%; top: 0;">
            <div class="bg-white d-flex" style="min-width: 60%; min-height: 60%; max-width: 100%; max-height: 80%; overflow-y: auto">
                <div class="border-end w-50" style="background-image: url('IMAGE/PRivate.jpg'); background-size: cover; background-position: center">
                </div>
                <div class="border-end w-50 p-4" style="overflow-y: auto">
                    <div class="d-flex justify-content-between align-item">
                        <h2>EMAIL US!</h2>
                        <i class="bi bi-x text-danger" onclick="$('.emailSection').css('display', 'none')" title="Close Email Form" style="cursor: pointer; font-size: 32px"></i>
                    </div>
                    <hr class="mt-2 mb-2">
                    <form action="" class="d-flex flex-column gap-1">
                        <div class="">
                            <label for="" class="form-label">Name: </label>
                            <input type="text" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="">
                            <label for="" class="form-label">Email: </label>
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="d-flex flex-column">
                            <label for="" class="form-label">Message: </label>
                            <textarea name="" rows="4" id="" class="form-control" placeholder="Enter your concern" required></textarea>
                        </div>
                        <div class="mt-2">
                            <button class="w-100 btn btn-outline-dark" type="submit">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="navigation" style="z-index: 10">
        <div class="topNav">
            <div class="contactTopNav d-flex align-items-center gap-3 ps-4">
                <i class="bi bi-facebook" style="font-size: 20px" onclick="window.open('https\://www.facebook.com/arancoloma.cristelbelen.5', '_blank')"></i>
                <i class="bi bi-instagram" style="font-size: 20px"></i>
                <i class="bi bi-twitter" style="font-size: 20px"></i>

                <span class="text-white contactNumberTop">+639159559058</span>
            </div>
            <div class="locationLoginTopNav d-flex align-items-center justify-content-end pe-3">
                <?php if (isset($_SESSION['login']) and $_SESSION['login'] == true) { ?>
                    <div><i class="bi bi-bag text-white me-1"></i><span class="loginText" onclick="window.location.href = 'newBundle.php'">Book</span></div>
                    <div><i class="bi bi-person text-white ms-2 me-1"></i><span class="loginText" onclick="window.location.href = 'newAccount.php'">Profile</span></div>
                    <div><i class="bi bi-box-arrow-left text-white ms-2 me-1"></i><span class="loginText" onclick="window.location.href = 'INCLUDE/logout.php?logout'">Logout</span></div>
                <?php } else { ?>
                    <div><i class="bi bi-person text-white me-1"></i><span class="loginText" onclick="window.location.href = 'login.php'">Login</span> | <span class="signupText">Sign Up</span></div>
                <?php } ?>
            </div>
        </div>
        <div class="bottomNav d-flex mt-4 ps-4">
            <div class="logoDiv me-4 p-2" style="overflow: hidden">
                <img src="IMAGE/acelogo.png" class="img-fluid" onclick="window.location.href = 'index.php'" alt="" style="cursor: pointer">
            </div>
            <div class="navMenu align-items-center gap-4 justify-content-center">
                <a href="index.php">HOME</a>
                <div class="d-flex flex-column">
                    <div>
                        <a href="" onclick="event.preventDefault(); servicesSubMenu();">SERVICES <i id="chevron" class="bi bi-chevron-down"></i></a>
                    </div>
                    <div id="servicesSubMenus" class="position-absolute flex-column align-items-center pe-3" style="margin-top: 25px; display: none">
                        <?php while ($data = mysqli_fetch_assoc($services1)) { ?>
                            <a href="catering-services.php?event=<?= $data['name'] ?>" class="text-white"><?= $data['name'] ?></a>
                        <?php } ?>
                    </div>
                </div>
                <a href="index.php#aboutSection">ABOUT US</a>
                <a href="index.php#gallerySection">GALLERY</a>
                <a href="" onclick="scrollElementTo('contactSection'); event.preventDefault();">CONTACT US</a>
            </div>
        </div>
    </section>
    <section>
        <div class="parallax">
            <div class="parallax-content d-flex align-items-center justify-content-center">
                <div class="p-4" style="padding-left: 10%; padding-right: 10%">
                    <h2 class="text-center" style="text-shadow: 1px 1px black;">
                        <?= $_GET['event'] ?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="bg-light border-bottom d-flex justify-content-center align-items-center gap-4 flex-wrap"
            style="min-height: 75px">
            <h5 class="text-secondary" style="cursor: pointer; user-select: none" onclick="scrollMe('package1')"><?= $package1 ?></h5>
            <h5 class="text-secondary" style="cursor: pointer; user-select: none" onclick="scrollMe('package2')"><?= $package2 ?></h5>
            <h5 class="text-secondary" style="cursor: pointer; user-select: none" onclick="scrollMe('package3')"><?= $package3 ?></h5>
        </div>
        <div class="w-100 bg-white d-flex flex-column flex-md-row p-4 gap-4" style="min-height: 50vh">
            <div class="border p-4 w-100 text-center text-white" style="border-radius: 25px; flex-grow: 1;    background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(218, 172, 176, 1) 0%, rgba(237, 152, 60, 1) 0%, rgba(187, 146, 94, 1) 13%, rgba(228, 138, 145, 1) 54%, rgba(212, 118, 127, 1) 100%);
">
                <h2><?= $_GET['event'] ?> Catering Packages</h2>
                <div style="margin-top: 25px; padding-left: 5%; padding-right: 5%">
                    <h4>50 - 150 pax</h6>
                    <p style="font-size: 20px; text-align: justify; text-indent: 35px"><?= $serviceData['description'] ?></p>
                </div>
            </div>
        </div>
        <div id="package1" class="bg-white d-flex mb-4" style="padding-left: 10%; padding-right: 10%; min-height: 50vh; overflow-y: auto">
            <div class="border w-50" style="border-radius: 25px; background-image: url('IMAGE/PACKAGE/<?= $serviceData['package1Image'] ?>'); background-size: cover; background-position: center;">

            </div>
            <div class="w-50 p-4">
                <div class="border p-4 bg-light w-100 h-100" style="max-height: 50vh; overflow-y: auto; border-radius: 25px">
                    <h2><?= $serviceData['package1'] ?></h2>
                    <h5>50 PAX</h5>
                    <h6 style="font-weight: normal">The ideal <?= strtolower($service) ?> catering package for a minimum of 30-50 guests, which includes:</h6>
                    <ul>
                        <?php while($data = mysqli_fetch_assoc($query1)) {
                            echo '<li>' . $data['name'] .'</li>';
                        } ?>
                    </ul>
                    <h6 style="font-weight: normal">The exact price varies based on menu choices, the number of guests, service and design preferences, and the <?= strtolower($service) ?> location.</h6>
                </div>
            </div>
        </div>
        <div id="package2" class="bg-white d-flex flex-row-reverse mb-4 mt-4" style="padding-left: 10%; padding-right: 10%; min-height: 50vh; overflow-y: auto">
            <div class="border w-50" style="border-radius: 25px; background-image: url('IMAGE/PACKAGE/<?= $serviceData['package2Image'] ?>'); background-size: cover; background-position: center;">

            </div>
            <div class="w-50 p-4">
                <div class="border p-4 bg-light w-100 h-100" style="max-height: 50vh; overflow-y: auto; border-radius: 25px">
                    <h2><?= $serviceData['package2'] ?></h2>
                    <h6 style="font-weight: normal">The ideal catering package for soon-to-wed couples for a minimum of 30-50 guests, which includes:</h6>
                    <ul>
                        <?php while($data = mysqli_fetch_assoc($query2)) {
                            echo '<li>' . $data['name'] .'</li>';
                        } ?>
                    </ul>
                    <h6 style="font-weight: normal">The exact price varies based on menu choices, the number of guests, service and design preferences, and the wedding location.</h6>
                </div>
            </div>
        </div>
        <div id="package3" class="bg-white d-flex mb-4 mt-4" style="padding-left: 10%; padding-right: 10%; min-height: 50vh; overflow-y: auto">
            <div class="border w-50" style="border-radius: 25px; background-image: url('IMAGE/PACKAGE/<?= $serviceData['package3Image'] ?>'); background-size: cover; background-position: center;">
        
            </div> 
            <div class="w-50 p-4">
                <div class="border p-4 bg-light w-100 h-100" style="max-height: 50vh; overflow-y: auto; border-radius: 25px">
                    <h2><?= $serviceData['package3'] ?></h2>
                    <h6 style="font-weight: normal">The ideal catering package for soon-to-wed couples for a minimum of 30-50 guests, which includes:</h6>
                    <ul>
                        <?php while($data = mysqli_fetch_assoc($query3)) {
                            echo '<li>' . $data['name'] .'</li>';
                        } ?>
                    </ul>
                    <h6 style="font-weight: normal">The exact price varies based on menu choices, the number of guests, service and design preferences, and the wedding location.</h6>
                </div>
            </div>
        </div>
    </section>
    <?php include 'newMessage.php'; ?>
    <section id="contactSection" class="footerSection position-relative" style="margin-top: 10%; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(255, 255, 255, 0)), url('IMAGE/PRivate.jpg'); background-position: bottom; background-size: cover; min-height: 40vh; height: fit-content">
        <div class="footerContainer w-100 h-100 pt-4">
            <div style="width: auto; height: 250px;">
                <img src="IMAGE/acelogo.png" class="img-fluid w-100 h-100" onclick="window.location.href='index.php'" alt="" style="cursor: pointer">
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center" style="flex: 1">
                <h1 class="text-white text-center" style="text-shadow: 0px 0px 6px rgba(255,255,255,1); font-family: Brush Script MT, Brush Script Std, cursive">Aran Cristel Events & Catering Services</h1>
                <h4 class="text-white text-center" style="text-shadow: 0px 0px 6px rgba(255,255,255,1);">Benitez Salazar St. Tubuan 1, Silang, Cavite</h4>
                <h4 class="text-white text-center" style="text-shadow: 0px 0px 6px rgba(255,255,255,1);">Contact Number: 09159559058/09268053199</h4>
                <h4 class="text-white text-center" style="text-shadow: 0px 0px 6px rgba(255,255,255,1);">Email: cristel_belen@yahoo.com</h4>
                <button class="btn btn-outline-light btn-lg" style="width: 250px;" onclick="$('.emailSection').css('display', 'block');">EMAIL US!</button>
            </div>
        </div>
        <div class="contactTopNav w-100 mt-4 d-flex gap-3 justify-content-between text-white" style="height: 25px">
            <div class="d-flex gap-3">
                <i onclick="window.open('https\://www.facebook.com/arancoloma.cristelbelen.5', '_blank')" class="bi bi-facebook" style="font-size: 20px"></i>
                <i class="bi bi-instagram" style="font-size: 20px"></i>
                <i class="bi bi-twitter" style="font-size: 20px"></i>
            </div>
            <div class="text-center">
                Copyright © 2024, ACE Catering Services
            </div>
        </div>
        <div class="custom-shape-divider-top-1729586767">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="JS/newHeader.js"></script>
    <script>
        function scrollMe(item) {
            const element = document.getElementById(item);
            element.scrollIntoView();
        }

        let servicesSubMenus = document.getElementById('servicesSubMenus');

        function servicesSubMenu() {
            if (servicesSubMenus.style.display == "flex") {
                $('#chevron').attr('class', 'bi bi-chevron-down');
                servicesSubMenus.style.display = "none";
            } else {
                $('#chevron').attr('class', 'bi bi-chevron-up');
                servicesSubMenus.style.display = "flex";
            }
        }

        function scrollElementTo(element) {
            document.getElementById(element).scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>