<?php
if (isset($_SESSION['admin'])) {
    include 'ADMIN/INCLUDE/login.php';
} else {
    include 'INCLUDE/login.php';
}

$query = mysqli_query($conn, "SELECT * FROM eventcategory");
$getSection1 = mysqli_query($conn, "SELECT * FROM homepagesection1 LIMIT 1");
$dataSection1 = mysqli_fetch_assoc($getSection1);
$edit = false;
$services1 = mysqli_query($conn, "SELECT * FROM services");
$getServices = mysqli_query($conn, "SELECT * FROM services");
$dataServices = [];

while ($data = mysqli_fetch_assoc($getServices)) {
    $dataServices[] = $data;
}


$edit = false;
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] == true) {
        $edit = true;
    } else {
        $edit = false;
    }
}

$slider = mysqli_query($conn, "SELECT * FROM background ORDER BY id asc LIMIT 1");
$dataSlider = mysqli_fetch_assoc($slider);
$gallery = mysqli_query($conn, "SELECT * FROM gallery");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ace Catering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newIndex1.css">
    <link rel="stylesheet" href="CSS/newHeads.css">
    <style>
        body {
            overflow-x: hidden;
        }

        .firstContainer {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(255, 255, 255, 0)),
                url('IMAGE/BACKGROUND/<?= $dataSlider['image'] ?>');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            transition: 1s ease;
        }

        @keyframes popUpFromLeft {
            0% {
                transform: translateX(-50px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes popUpFromRight {
            0% {
                transform: translateX(50px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes popUpFromBottom {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .aboutPictureLeft {
            opacity: 0;
        }

        .aboutPictureRight {
            opacity: 0;
        }

        .section3 {
            position: relative;
            margin-top: 10%;
            margin-bottom: 10%;
            padding-top: 50px;
            padding-left: 5%;
            padding-right: 5%;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(218, 172, 176, 1) 0%, rgba(237, 152, 60, 1) 0%, rgba(187, 146, 94, 1) 13%, rgba(228, 138, 145, 1) 54%, rgba(212, 118, 127, 1) 100%);

        }

        .grid-container {
            padding: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .grid-item {
            opacity: 0;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            text-align: center;
            transition: opacity 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid-item.left.visible {
            animation: popUpFromLeft 2s forwards;
        }

        .grid-item.right.visible {
            animation: popUpFromRight 2s forwards;
        }

        .grid-item.middle.visible {
            animation: popUpFromBottom 2s forwards;
        }

        .grid-item img {
            transition: all 0.5s ease;
        }

        .grid-item:hover img {
            filter: blur(2px);
            scale: 1.1;
        }

        .left-column,
        .right-column {
            flex: 1 1 calc(25% - 20px);
            /* Two items per column */
            height: 400px;
            gap: 20px;
        }

        .left-item {
            height: 50%;
        }

        .right-item {
            height: 50%;
        }

        .middle-column {
            flex: 1 1 calc(50% - 20px);
    
            height: 420px;
        }

        .aboutSection {
            position: relative;
            min-height: 50vh;
            padding-top: 0%;
            padding-left: 10%;
            padding-right: 10%;
            margin-bottom: 10%;
        }

        .slider-container {
            position: relative;
            height: calc(100vh);
            overflow: hidden;
            background-color: #000;
        }

        .slider-wrapper {
            display: flex;
            height: 100%;
            width: 100%;
            transition: opacity 1s ease-in-out, transformX 1s ease-in-out;
            will-change: opacity, transform;
        }

        .slider-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
            filter: blur(2.5px)
        }

        .slider-wrapper img.active {
            opacity: 1;
            transform: scale(1.1);
        }

        .slider-wrapper img.next {
            transform: scale(1.25);
            opacity: 0;
        }

        .slider-container:before,
        .slider-container:after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50px;
            z-index: 10;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), transparent);
        }

        .slider-container:after {
            right: 0;
            background: linear-gradient(to left, rgba(0, 0, 0, 0.5), transparent);
        }

        .slider-container1 {
            position: relative;
            height: calc(100vh);
            overflow: hidden;
            background-color: #000;
        }

        .slider-wrapper1 {
            display: flex;
            height: 100%;
            width: 100%;
            transition: opacity 1s ease-in-out, transformX 1s ease-in-out;
            will-change: opacity, transform;
        }

        .slider-wrapper1 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
            filter: blur(2.5px)
        }

        .slider-wrapper1 img.active {
            opacity: 1;
            transform: scale(1.1);
        }

        .slider-wrapper1 img.next {
            opacity: 0;
            transform: scale(1.25);
        }

        .slider-container1:before,
        .slider-container1:after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50px;
            z-index: 10;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), transparent);
        }

        .slider-container1:after {
            right: 0;
            background: linear-gradient(to left, rgba(0, 0, 0, 0.5), transparent);
        }

        .custom-shape-divider-top-1729598897 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1729598897 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 70px;
        }

        .custom-shape-divider-top-1729598897 .shape-fill {
            fill: #FFFFFF;
        }

        .custom-shape-divider-bottom-1729598932 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1729598932 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 70px;
        }

        .custom-shape-divider-bottom-1729598932 .shape-fill {
            fill: #FFFFFF;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in-left {
            animation: slideInLeft 1s ease-out forwards;
        }

        /* Slide-in from the right */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in-right {
            animation: slideInRight 1s ease-out forwards;
        }

        /* Make the items visible after animation */
        .visible {
            opacity: 1;
            transform: none;
        }

        .emailSection {
            display: none;
        }

        #burger {
            display: none;
        }

        .navMenu {
            display: flex;
        }
        

        @media (min-width: 768px) and (max-width: 1023px) {
            .custom-shape-divider-top-1729598897 svg {
                width: calc(100% + 1.3px);
                height: 47px;
            }

            .custom-shape-divider-bottom-1729598932 svg {
                width: calc(100% + 1.3px);
                height: 47px;
            }

            #burger {
                display: block;
            }

            .navMenu {
                display: none;
            }

            .navMenu a {
                font-size: 2vh;
            }
        }

        @media (max-width: 767px) {
            .custom-shape-divider-top-1729598897 svg {
                width: calc(100% + 1.3px);
                height: 30px;
            }

            .custom-shape-divider-bottom-1729598932 svg {
                width: calc(100% + 1.3px);
                height: 30px;
            }

            #burger {
                display: block;
            }

            .navMenu {
                display: none;
            }
        }

        @media screen and (max-width: 992px) {
            .middle-column {
                flex: 1 1 100%;
                /* Stack columns on smaller screens */
                height: 200px;
            }

            .left-column {
                width: 100%;
            }

            .slider-container1 {
                width: 100%;
                height: calc(50vh)
            }

            #burger {
                display: block;
            }

            .navMenu {
                display: none;
            }
        }
    </style>
</head>
<body>
    <section class="emailSection">
        <div class="position-fixed bg-dark w-100 h-100" style="z-index: 9; left: 0; top: 0; opacity: 0.75"></div>
        <div class="emailContainer position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="z-index: 10; left: 0%; top: 0;">
            <div class="bg-white d-flex" style="min-width: 70%; min-height: 60%; max-width: 100%; max-height: 80%; overflow-y: auto">
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
                        <div class="">
                            <label for="" class="form-label">Location: </label>
                            <input type="text" class="form-control" placeholder="Enter your location" required>
                        </div>
                        <div class="">
                            <label for="" class="form-label">Services: </label>
                            <select name="" class="form-select" id="">
                                <option value="">Select a service</option>
                                <?php
                                    $serviceGETNow = mysqli_query($conn, "SELECT * FROM services");
                                    while($data = mysqli_fetch_assoc($serviceGETNow)) { ?>
                                        <option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                    <?php }
                                ?>
                            </select>
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
    <section class="navigation">
        <div class="topNav d-flex justify-content-between pt-2">
            <div class="contactTopNav d-flex align-items-center gap-3 ps-4">
                <!-- <i class="bi bi-facebook" style="font-size: 20px" onclick="window.open('https\://www.facebook.com/arancoloma.cristelbelen.5', '_blank')"></i>
                <i class="bi bi-instagram" style="font-size: 20px"></i>
                <i class="bi bi-twitter" style="font-size: 20px"></i>
                                
                <span class="text-white contactNumberTop">+639159559058</span> -->
                <i id="burger" class="bi bi-list mt-4" style="font-size: 5vh"></i>
            </div>
            <div class="locationLoginTopNav d-flex align-items-center justify-content-end pe-3">
                <div class="navMenu position-absolute gap-3 mt-2 align-items-center" style="left: 50%; top: 0%; transform: translate(-50%, -0%);">
                    <a href="index.php" style="text-decoration: none; font-size: 2vh">HOME</a>
                    <div class="d-flex flex-column">
                        <div>
                            <a href="" style="text-decoration: none; font-size: 2vh" onclick="event.preventDefault(); servicesSubMenu();">SERVICES <i id="chevron" class="bi bi-chevron-down"></i></a>
                        </div>
                        <div id="servicesSubMenus" class="position-absolute flex-column align-items-center pe-3" style="margin-top: 25px; display: none">
                            <?php while ($data = mysqli_fetch_assoc($services1)) { ?>
                                <a href="catering-services.php?event=<?= $data['name'] ?>" style="text-decoration: none; font-size: 2vh"><?= $data['name'] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <a href="" style="text-decoration: none; font-size: 2vh" onclick="scrollElementTo('aboutSection'); event.preventDefault();">ABOUT US</a>
                    <a href="" style="text-decoration: none; font-size: 2vh" onclick="scrollElementTo('gallerySection'); event.preventDefault();">GALLERY</a>
                    <a href="" style="text-decoration: none; font-size: 2vh" onclick="scrollElementTo('contactSection'); event.preventDefault();">CONTACT US</a>
                </div>
                <?php if (isset($_SESSION['login']) and $_SESSION['login'] == true) { ?>
                    <div style="font-size: 2.25vh"><i class="bi bi-bag text-white me-1"></i><span class="loginText" onclick="window.location.href = 'newBundle.php'">Book</span></div>
                    <div style="font-size: 2.25vh"><i class="bi bi-person text-white ms-2 me-1"></i><span class="loginText" onclick="window.location.href = 'newAccount.php'">Profile</span></div>
                    <div style="font-size: 2.25vh"><i class="bi bi-box-arrow-left text-white ms-2 me-1"></i><span class="loginText" onclick="window.location.href = 'INCLUDE/logout.php?logout'">Logout</span></div>
                <?php } else { ?>
                    <div style="font-size: 2.25vh"><i class="bi bi-person text-white me-1"></i><span class="loginText" onclick="window.location.href = 'login.php'">Login</span> | <span class="signupText">Sign Up</span></div>
                <?php } ?>
            </div>
        </div>
        <div class="bottomNav d-flex mt-4 ps-4">
            <div class="logoDiv me-4 p-2" style="overflow: hidden">
                <img src="IMAGE/acelogo.png" class="img-fluid" onclick="window.location.href = 'index.php'" alt="" style="cursor: pointer">
            </div>
        </div>
    </section>
    <section class="firstSection w-100 position-relative" style="height: 100vh">
        <div class="firstContainer d-flex flex-column text-white align-items-center justify-content-center">
            <div class="backgroundImage"></div>
        </div>
        <div class="position-absolute d-flex flex-column text-white align-items-center justify-content-center w-100" style="height: 100vh; left: 0; top: 0;">
            <h2 class="text-white text-center" id="heading"></h2>
            <p class="text-white text-center d-none" id="paragraph"></p>
            <button class="enquireButton" onclick="$('.emailSection').css('display', 'block');">INQUIRE NOW</button>
        </div>
        <div class="custom-shape-divider-bottom-1729579912">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>
    <section class="section3">
        <div class="w-100" style="min-height: 80vh; height: fit-content">
            <h1 class="text-center text-white" style="font-family: Brush Script MT, Brush Script Std, cursive">Catering Services</h1>
            <div class="grid-container">
                <div class="left-column d-flex flex-column">
                    <div class="left-item grid-item shadow" onclick="window.location.href = 'catering-services.php?event=<?= $dataServices[0]['name'] ?>'" style="cursor: pointer; border-radius: 25px; overflow: hidden">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 0px 0px 6px rgba(0,0,0,255);"><?= $dataServices[0]['name'] ?></h3>
                        <img src="IMAGE/<?= $dataServices[0]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                    <div class="left-item grid-item shadow" style="cursor: pointer; border-radius: 25px; overflow: hidden">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 0px 0px 6px rgba(0,0,0,255);"><?= $dataServices[1]['name'] ?></h3>
                        <img src="IMAGE/<?= $dataServices[1]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                </div>
                <div class="middle-column d-flex align-items-center justify-content-center">
                    <div class="grid-item shadow" style="cursor: pointer; border-radius: 25px; overflow: hidden">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 0px 0px 6px rgba(0,0,0,255);"><?= $dataServices[2]['name'] ?></h3>
                        <img src="IMAGE/<?= $dataServices[2]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                </div>
                <div class="right-column d-flex flex-column">
                    <div class="right-item grid-item shadow" style="cursor: pointer; border-radius: 25px; overflow: hidden">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 0px 0px 6px rgba(0,0,0,255);"><?= $dataServices[3]['name'] ?></h3>
                        <img src="IMAGE/<?= $dataServices[3]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                    <div class="right-item grid-item shadow" style="cursor: pointer; border-radius: 25px; overflow: hidden">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 0px 0px 6px rgba(0,0,0,255);"><?= $dataServices[4]['name'] ?></h3>
                        <img src="IMAGE/<?= $dataServices[4]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-shape-divider-bottom-1729579912">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
        <div class="custom-shape-divider-top-1729586767">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>
    <section id="aboutSection" class="aboutSection w-100 mb-0" style="padding-bottom: 0;">
        <div class="d-flex flex-column" style="min-height: 80vh">
            <div class="ps-4 position-absolute" style="width: 50%">
                <h1 class="text-center" style="font-family: Brush Script MT, Brush Script Std, cursive">ABOUT US</h1>
            </div>
            <div class="grid-items w-100 d-flex flex-row-reverse" style="height: 50vh">
                <div class="aboutPictureRight rounded shadow" style="overflow: hidden; width: 35%">
                    <img src="IMAGE/Picture1.jpg" class="img-fluid w-100 h-100" alt="">
                </div>
                <div class="d-flex align-items-center flex-column justify-content-center" style="padding-left: 5%; padding-right: 7.5%; width: 65%">
                    <h3>MAKING DREAMS COME TRUE</h3>
                    <p style="text-align: justify; padding-left: 5%; padding-right: 5%">ACE catering is committed to making dreams come true through exceptional service and culinary expertise by partnering with top-notch chefs and utilizing the finest quality ingredients, Ace catering consistently delivers exquisite menus that cater to a diverse range of tastes and dietary preferences , ensuring that every guest is satisfied and delighted with their dining experience.</p>
                </div>
            </div>
            <div style="height: 50vh;" class="grid-items">
                <div class="position-absolute d-flex flex-row" style="margin-top: -7.5vh; height: 50vh">
                    <div class="aboutPictureLeft rounded shadow" style="overflow: hidden; width: 35%">
                        <img src="IMAGE/Picture2.jpg" class="img-fluid w-100 h-100" alt="">
                    </div>
                    <div class="d-flex align-items-center flex-column justify-content-center" style="padding-left: 5%; padding-right: 12.5%; width: 65%">
                        <h3 style="font-size: 4vh">TURNING A VISION INTO A REALITY</h3>
                        <p style="text-align: justify; padding-left: 5%; padding-right: 5%">Effective leaders in ACE Catering understand the importance of turning their vision into reality. They know that simply having a vision is not enough; it must be accompanied by both short- and long-term goals. These goals serve as a roadmap for achieving the vision and provide direction for the organization. Furthermore, effective leaders also inspire and share the vision with their team. They understand that a shared vision is crucial in rallying people and organizational systems behind the unified goal.</p>
                    </div>
                </div>
            </div>
            <div style="height: 50vh;" class="grid-items">
                <div class="position-absolute d-flex flex-row-reverse" style="margin-right: 10%; margin-top: -12.5vh; height: 50vh">
                    <div class="aboutPictureRight rounded shadow" style="overflow: hidden; width: 35%">
                        <img src="IMAGE/Picture3.jpg" class="img-fluid w-100 h-100" alt="">
                    </div>
                    <div class="d-flex align-items-center flex-column justify-content-center" style="padding-left: 5%; padding-right: 7.5%; width: 65%">
                        <h3 style="font-size: 4vh">A PERFECTIONIST ON EVERY DETAIL</h3>
                        <p style="text-align: justify; padding-left: 5%; padding-right: 5%">ACE Catering strives for excellence in every aspect of their service, ensuring that each detail is handled with precision and attention to enhance the overall dining experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section4 mt-0" style="margin-bottom: 10%;">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center"
            style="min-height: 100vh; height: fit-content;">
            <div class="w-100 w-md-50 h-100 position-relative">
                <div class="slider-container1">
                    <div id="sliderWrapper1" class="slider-wrapper1">
                        <img src="IMAGE/wedd.jpg" alt="Image 1" class="active">
                        <img src="IMAGE/debut.jpg" alt="Image 2" class="next">
                        <img src="IMAGE/Birtday.jpg" alt="Image 3" class="next">
                        <img src="IMAGE/wedding.jpg" alt="Image 3" class="next">
                        <img src="IMAGE/PRivate.jpg" alt="Image 3" class="next">
                        <img src="IMAGE/weddingfinal.jpg" alt="Image 3" class="next">
                        <img src="IMAGE/backgroundtest1.jpg" alt="Image 3" class="next">
                        <img src="IMAGE/weddingbasic.jpg" alt="Image 3" class="next">
                    </div>
                </div>
                <div class="custom-shape-divider-top-1729598897">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                    </svg>
                </div>
                <div class="custom-shape-divider-bottom-1729598932">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                    </svg>
                </div>
            </div>
            <div class="w-100 w-md-50 h-100 bg-white">
                <h1 class="ps-4 pe-4 text-center" style="font-family: Arial; font-weight: bolder; font-size: 5vw">Online Order</h1>
                <p class="ps-4 pe-4" style="text-indent: 50px; text-align: justify">ACE Catering is committed to delivering exceptional dining experiences right at your doorstep. By partnering with expert chefs and using top-quality ingredients, ACE Catering offers a wide selection of menus to suit different tastes and dietary needs. With a focus on precision and attention to detail, we make sure every aspect of your order is handled seamlessly, ensuring a hassle-free and enjoyable dining experience from start to finish.</p>
                <div class="ps-4 w-100 d-flex align-items-center justify-content-center">
                    <button class="btn btn-warning bg-lg w-50" <?= isset($_SESSION['login']) && $_SESSION['login'] == true ? 'onclick="window.location.href = \'newBundle.php\'"' : 'onclick="window.location.href = \'login.php\'"' ?>>Order Now!</button>
                </div>
            </div>
        </div>
    </section>
    <section id="gallerySection" class="section5" style="padding-left: 10%; padding-right: 10%; padding-bottom: 10%">
        <div class="container-fluid d-flex align-items-center" style="height: fit-content; padding: 0;">
            <div class="row g-0 h-100 p-4">
                <h1 class="text-center">Gallery</h1>
                <?php while($data = mysqli_fetch_assoc($gallery)) { ?>
                    <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                        <div class="img-container position-relative w-100 h-100">
                            <img src="IMAGE/GALLERY/<?= $data['image'] ?>" class="img-fluid w-100 h-100 object-fit-cover"
                                alt="<?= $data['name'] ?>">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
   <section id="contactSection" class="footerSection position-relative" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(255, 255, 255, 0)), url('IMAGE/PRivate.jpg'); background-position: bottom; background-size: cover; min-height: 40vh; height: fit-content">
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
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script>
    const images = [];

    $.ajax({
        type: "GET",
        url: "PHP/getBackgroundSlider.php",
        dataType: "json",
        success: function (response) {
            $.each(response, function (index, data) {
               images.push('IMAGE/BACKGROUND/' + data);
            });
            console.log(images);
        }, 
        error: function(xhr, status, error) {
            console.error('Error: ', error)
        }
    });
   
 
    let currentImageIndex = 0;
    const container = document.querySelector('.firstContainer');

    function changeBackground() {
        container.classList.add('fade');
        setTimeout(() => {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            container.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.75), rgba(255, 255, 255, 0)), url('${images[currentImageIndex]}')`;

            container.classList.remove('fade');
            container.classList.add('visible');
        }, 1000);
    }

    setInterval(changeBackground, 5000);

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

    document.addEventListener('DOMContentLoaded', function() {
        const headingText = "<?= $dataSection1['title'] ?>";
        const paragraphText = "<?= $dataSection1['description'] ?>";

        function typeText(element, text, speed) {
            let index = 0;

            function type() {
                if (index < text.length) {
                    element.textContent += text.charAt(index);
                    index++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        const headingElement = document.getElementById('heading');
        const paragraphElement = document.getElementById('paragraph');

        typeText(headingElement, headingText, 50);
        setTimeout(() => typeText(paragraphElement, paragraphText, 25), headingText.length * 50);

        const gridItems = document.querySelectorAll('.grid-item');
        const aboutSections = document.querySelectorAll('.grid-items');

        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        // Intersection Observer for the grid items (left, middle, right)
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const item = entry.target;
                    // Check the position and add relevant animation classes
                    if (item.closest('.left-column')) {
                        item.classList.add('left');
                    } else if (item.closest('.right-column')) {
                        item.classList.add('right');
                    } else if (item.closest('.middle-column')) {
                        item.classList.add('middle');
                    }
                    item.classList.add('visible'); // Trigger the animation
                    observer.unobserve(item); // Stop observing after it becomes visible
                }
            });
        }, options);

        // Intersection Observer for the "About Us" section (different sides)
        const observerAbout = new IntersectionObserver((entries, observerAbout) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const item = entry.target;

                    // Apply specific animations based on side (left or right)
                    if (item.querySelector('.aboutPictureLeft')) {
                        item.querySelector('.aboutPictureLeft').classList.add('slide-in-left');
                    } else if (item.querySelector('.aboutPictureRight')) {
                        item.querySelector('.aboutPictureRight').classList.add('slide-in-right');
                    }

                    item.classList.add('visible'); // Trigger the animation
                    observerAbout.unobserve(item); // Stop observing after it becomes visible
                }
            });
        }, options);

        // Observe each grid item
        gridItems.forEach(item => {
            observer.observe(item);
        });

        // Observe each "About Us" section
        aboutSections.forEach(item => {
            observerAbout.observe(item);
        });

        const sliderWrapper1 = document.getElementById('sliderWrapper1');
        const images1 = sliderWrapper1.querySelectorAll('img');
        const numImages1 = images1.length;
        let currentIndex1 = 0;

        function changeImage1() {
            const prevIndex1 = currentIndex1;
            currentIndex1 = (currentIndex1 + 1) % numImages1;

            images1[prevIndex1].classList.remove('active');
            images1[prevIndex1].classList.add('next');

            images1[currentIndex1].classList.add('active');
            images1[currentIndex1].classList.remove('next');
        }

        setInterval(changeImage1, 5000);
    });
</script>

</html>