<?php
include 'INCLUDE/login.php';
include 'PHP/security.php';
if (isset($_POST['payment'])) {
    date_default_timezone_set('Asia/Manila');
    $book = $_SESSION['date'];

    if (is_array($book)) {
        $book = implode(', ', $book);
    }
    
    $username = $_SESSION['username'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $street = $_POST['street'];
    $time = $_POST['startTime'];
    $end = $_POST['endTime'];
    $payment = $_POST['payment'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $date = date('d/m/Y h:i A');
    $service = $_SESSION['selectedEventData']['eventTitle'];
    $package = $_SESSION['selectedEventData']['package'];
    function generateRandomId() {
        $letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4); 
        $numbers = substr(str_shuffle("0123456789"), 0, 4); 
        return $letters . $numbers; 
    }
    
    do {
        $randomId = generateRandomId();
        $checkExist = mysqli_query($conn, "SELECT * FROM order_list WHERE orderID='$randomId'");
    } while(mysqli_num_rows($checkExist) >= 1); 

    mysqli_query($conn, "INSERT INTO `order_list`(`orderID`, `customer_name`, `username`, `address`, `street`, `time`, `end_time`, `payment`, `email`, `contact`, `date_create`, `date`, `package`, `services`, `status`)
        VALUES ('$randomId', '$name', '$username','$address','$street','$time', '$end', '$payment','$email','$contact','$date', '$book', '$package', '$service', 'Pending')") or die();
    mysqli_query($conn, "INSERT INTO `schedule` (`orderID`, `name`, `username`, `time`, `end_time`, `date`, `package`, `services`, `status`) VALUES ('$randomId','$name', '$username', '$time', '$end', '$book', '$package', '$service', 'Pending')");

    $cart = mysqli_query($conn, "SELECT * FROM cart WHERE username='$username'");
    while ($data = mysqli_fetch_assoc($cart)) {
        $cartCategory = $data['category'];
        $cartProduct = $data['product'];
        $cartPrice = $data['price'];
        $cartQuantity = $data['quantity'];
        $total_price = $data['total_price'];
        mysqli_query($conn, "INSERT INTO `order_product` (`orderID`, `username`, `category`, `product`, `price`, `quantity`, `total_price`, `date`) 
            VALUES ('$randomId', '$username','$cartCategory', '$cartProduct', '$cartPrice', '$cartQuantity', '$total_price', '$date')");
    }
    mysqli_query($conn, "DELETE FROM `cart` WHERE username='$username'") or die();
    $_SESSION['month'] = null;
    $_SESSION['date'] = null;


    header('location: success.php');
    exit();

    
}

$services1 = mysqli_query($conn, "SELECT * FROM services");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER SUCCESS!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/newHeads.css">
    <style>
        .contactTopNav i {
            color: white;
        }
        .navMenu a {
            color: white;
        }
        .contactNumberTop {
            color: white;
        }

        .loginText {
            color: white;
        }

        .navigation {
            position: absolute;
            left: 0;
            top: 0;
            height: 40vh;
            width: 100%;
            z-index: -1;
            padding-bottom: 10vh;
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(255, 255, 255, 0)),
                url('IMAGE/backgroundtest1.jpg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }
        
        #burger {
            display: none;
        }

        .navMenu {
            display: flex;
        }
        

        @media (min-width: 768px) and (max-width: 1023px) {
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

            #burger {
                display: block;
            }

            .navMenu {
                display: none;
            }
        }

        @media screen and (max-width: 992px) {

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
    <section class="navigation" style="z-index: 10">
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
    <section style="margin-top: 40vh">
        <div class="orderContainer position-static d-flex align-items-center justify-content-center" style="height: 100vh; margin-top: 60px">
            <div class="p-4" style="border-top: solid 5px orange; border-bottom: solid 5px orange">
                <h1 class="text-center">Order Complete!</h1>
                <hr>
                <h2 class="text-center">Your order is now being processed</h2>
                <div class="d-flex justify-content-center">
                    <button onclick="window.location.href = 'index.php'" class="btn btn-warning btn-lg">Home</button>
                </div>
               
            </div>
        </div>
    </section>
    <?php include 'newMessage.php'; ?>
    <section id="contactSection" class="footerSection position-relative" style="margin-top: 5%; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(255, 255, 255, 0)), url('IMAGE/PRivate.jpg'); background-position: bottom; background-size: cover; min-height: 40vh; height: fit-content">
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
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="JS/newHeader.js"></script>
<script>
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
</html>