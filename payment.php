<?php
include 'INCLUDE/login.php';
include 'PHP/security.php';
date_default_timezone_set('ASIA/MANILA');
$day = $_SESSION['date'];
$booked = $_SESSION['date'];

$title = $_SESSION['selectedEventData']['eventTitle'];
$package = $_SESSION['selectedEventData']['package'];
$packageItem = mysqli_query($conn, "SELECT * FROM packageItem WHERE services='$title' AND package='$package'");

if (is_array($booked) && count($booked) > 0) {
    $bookedDate = $booked[0]; // Extract the first element as a string
} else {
    echo "No booking date provided.";
    exit(); // Stop further execution if no date is available
}

$finds = mysqli_query($conn, "SELECT * FROM schedule WHERE date='$bookedDate'");
$bookedTimes = array();
$province = mysqli_query($conn, "SELECT * FROM province");
$services1 = mysqli_query($conn, "SELECT * FROM services");

while ($data = mysqli_fetch_assoc($finds)) {
    $newEnd = explode(":", $data['end_time']);
    $APM = explode(" ", $newEnd[1]);
    $newEnd = $newEnd[0];
    $newEnd = $newEnd . ":00 " . $APM[1];
    $_SESSION['end'] = $newEnd;
    $bookedTimes[] = $data['time'];
    $bookedTimes[] = $newEnd;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
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
        <div id="menuContainer" class="w-100 border shadow bg-light p-2 d-flex gap-2"
            style="margin-top: 60px; min-height: 90vh; height: fit-content">
            <div class="container-fluid">
                <div class="row h-100">
                    <div id="itemContainer"
                        class="col-md-8 col-12 border p-2 bg-white rounded d-flex align-items-center">
                        <form id="contactForm" class="position-static w-100 h-100" action="success.php" method="POST">
                            <h4 class="ps-4 pt-4">Customer Information</h4>
                            <input type="text" name="payment" hidden>
                            <div class="row h-100 p-4">

                                <div class="col-md-6 col-12 p-2 rounded d-flex flex-column gap-4">
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="address" class="form-label" style="min-width: 125px">Name</label>
                                        <input id="name" type="text" name="name" class="form-control"
                                            value="<?= $_SESSION['name'] ?>" readonly required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="address" class="form-label"
                                            style="min-width: 125px; max-width: 125px">Contact #</label>
                                        <input type="tel" pattern="^(09|\+639)\d{9}$" class="form-control"
                                            name="contact" required placeholder="+63 or (09123456789) (Required)">
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="address" class="form-label"
                                            style="min-width: 125px; max-width: 125px">Email</label>
                                        <input type="email" name="email" class="form-control" required
                                            placeholder="Email Address (Required)">
                                    </div>
                                    <!-- <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="province" class="form-label" style="min-width: 125px">Province</label>
                                        <select name="province" id="province-select" class="form-select">
                                            <option value="" disabled selected>Select a Province</option>
                                            <?php while ($row = mysqli_fetch_assoc($province)) { ?>
                                                <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="city" class="form-label" style="min-width: 125px">City</label>
                                        <select name="city" id="city-select" class="form-select">
                                            <option value="" disabled selected>Select a City</option>
                                 
                                        </select>
                                    </div> -->
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="region" class="form-label" style="min-width: 125px">Region</label>
                                        <select name="region" class="form-select form-select-md" id="region"></select>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="province" class="form-label"
                                            style="min-width: 125px">Province</label>
                                        <select name="province" class="form-select form-select-md"
                                            id="province"></select>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="city" class="form-label" style="min-width: 125px">City</label>
                                        <select name="city" class="form-select form-select-md" id="city"></select>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="barangay" class="form-label" style="min-width: 125px">Brgy</label>
                                        <select name="barangay" class="form-select form-select-md"
                                            id="barangay"></select>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="address" class="form-label"
                                            style="min-width: 125px; max-width: 125px">Address</label>
                                        <input type="text" name="street" class="form-control" required
                                            placeholder="Street / Building No. / Brgy or Subdv">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 d-md-flex d-flex flex-column gap-4">
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="startTime" class="form-label" style="min-width: 125px">Start of
                                            Event</label>
                                        <?php
                                        $startOptions = array(
                                            "08:00 AM",
                                            "09:00 AM",
                                            "10:00 AM",
                                            "11:00 AM",
                                            "12:00 PM",
                                            "01:00 PM",
                                            "02:00 PM",
                                            "03:00 PM",
                                            "04:00 PM",
                                            "05:00 PM",
                                            "06:00 PM",
                                            "07:00 PM",
                                            "08:00 PM"
                                        );
                                        $availableOptions = array();

                                        foreach ($startOptions as $option) {
                                            $time = strtotime($option);
                                            $startRange = strtotime("00:00 AM");
                                            $endRange = strtotime("00:00 AM");
                                            $availableOptions[] = $option;
                                        }

                                        if (empty($availableOptions)) {
                                            echo "<span style='color: red;'>Fully Booked</span>";
                                        } else {
                                            echo "<select name='startTime' class='form-select' id='startTime' required>";
                                            foreach ($availableOptions as $option) {
                                                echo "<option value='$option'>$option</option>";
                                            }
                                            echo "</select>";
                                        }
                                        ?>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <label for="End of Event" class="form-label" style="min-width: 125px">End of
                                            Event: </label>
                                        <input type="time" name="endTime" class="form-control">
                                    </div>
                                    <div class="d-none gap-2 align-items-center w-100">
                                        <label for="End of Event" class="form-label" style="min-width: 125px">Payment
                                            Method: </label>
                                        <select name="paymentMethod" class="form-select" id="" required>
                                            <option value="Full Payment" selected>Full Payment</option>
                                            <option value="Installment">Installment</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label for="street">


                            </label>
                        </form>
                    </div>
                    <div id="cartContainer" class="col-md-4 col-12 border p-4 bg-white rounded d-md-block d-block">
                        <h4>Order Summary</h4>
                        <span style="font-weight: normal; font-size: 14px">(THIS IS FOR ADDS ON ONLY IT"S
                            OPTIONAL)</span>
                        <div class="ps-2">
                            <h5>Event: <span
                                    style="font-weight: normal"><?= $_SESSION['selectedEventData']['eventTitle'] ?></span>
                            </h5>
                        </div>
                        <div class="ps-2">
                            <h5>Item Included</h5>
                            <ul id="itemIncluded" class="sss">
                                <?php while ($data = mysqli_fetch_assoc($packageItem)) { ?>
                                    <li><?= $data['name'] ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="ps-2">
                            <h5>Food</h5>
                            <ul id="foodCart" class="cartUL">

                            </ul>
                        </div>
                        <div class="ps-2">
                            <h5>Utensil</h5>
                            <ul id="utensilCart" class="cartUL">

                            </ul>
                        </div>
                        <div class="ps-2">
                            <h5>Tent</h5>
                            <ul id="tentCart" class="cartUL">

                            </ul>
                        </div>
                        <div class="ps-2">
                            <h5>Table & Chairs</h5>
                            <ul id="tableCart" class="cartUL">

                            </ul>
                        </div>
                        <div class="ps-2">
                            <h5>Booked Date</h5>
                            <ul>
                                <?php
                                if (isset($_SESSION['date']) && count($_SESSION['date']) > 0) {
                                    $firstDate = $_SESSION['date'][0];
                                    $lastDate = $_SESSION['date'][count($_SESSION['date']) - 1];

                                    $firstDateFormatted = date("F j, Y", strtotime($firstDate));
                                    $lastDateFormatted = date("F j, Y", strtotime($lastDate));

                                    if ($firstDate === $lastDate) {
                                        echo "<li>$firstDateFormatted</li>";
                                    } else {
                                        echo "<li>$firstDateFormatted - $lastDateFormatted</li>";
                                    }
                                } else {
                                    echo "<li>No dates booked</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomContainer position-static p-2 border shadow rounded bg-white d-flex justify-content-between"
            style="min-height: 10vh; width: 100%">
            <button class="btn btn-warning" onclick="window.location.href = 'reservation.php'">Return to Menu</button>
            <h5 class="p-2 d-flex align-items-center justify-content-center" style="text-align: center">Payment is to be
                discussed upon the call of the business owner</h5>
            <?php
            if (empty($availableOptions)) {
                echo "<button type='button' class='btn btn-warning' disabled>Proceed</button>";
            } else {
                echo "<button type='submit'class='btn btn-warning' form='contactForm'>Proceed</button>";
            }
            ?>
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
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="JS/newHeader.js"></script>
<script src="ph-address-selector2.js"></script>
<script>
    function loadCarts() {
        $.ajax({
            type: "POST",
            url: "PHP/fetchCartData.php",
            dataType: "json",
            success: function (response) {
                // Clear all cart lists and total price display
                $('.cartUL').empty();
                $('#totalPrice').text('');  // Assuming you have an element to display the total price

                let totalPrice = 0;  // Initialize total price variable

                response.forEach(item => {
                    if (item.totalPrice) {  // Check if the item is the total price object
                        totalPrice = parseFloat(item.totalPrice).toLocaleString('en-US', { minimumFractionDigits: 2 });
                    } else if (item.subTotal) {
                        subTotal = parseFloat(item.subTotal).toLocaleString('en-US', { minimumFractionDigits: 2 });
                    } else if (item.reservation) {
                        reservation = parseFloat(item.reservation).toLocaleString('en-US', { minimumFractionDigits: 2 });
                    } else {
                        const itemHtml = `<li>x${item.quantity} ${item.product}</li>`;

                        // Append items to the correct category list
                        if (item.category === 'Food') {
                            $('#foodCart').append(itemHtml);
                        } else if (item.category === 'Utensil') {
                            $('#utensilCart').append(itemHtml);
                        } else if (item.category === 'Tent') {
                            $('#tentCart').append(itemHtml);
                        } else if (item.category === 'Table & Chairs') {
                            $('#tableCart').append(itemHtml);
                        }
                    }
                });

                // Display the formatted total price
                $('#subTotal').text(`Sub Total: ₱${subTotal}`);
                $('#reservation').text(`Reservation Fee: ₱${reservation}`);
                $('#totalPrice').text(`Total: ₱${totalPrice}`);

                console.log('Total Price:', totalPrice);
                console.log('Sub Total:', subTotal);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.log('Response:', xhr.responseText);
            }
        });
    }

    loadCarts();

    document.getElementById('province-select').addEventListener('change', function () {
        var province = this.value;

        // Make an AJAX request to fetch cities
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'PHP/selectedProvince.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status == 200) {
                var cities = JSON.parse(this.responseText);

                // Clear previous city options
                var citySelect = document.getElementById('city-select');
                citySelect.innerHTML = '<option value="" disabled selected>Select a City</option>';

                // Populate cities in the select box
                cities.forEach(function (city) {
                    var option = document.createElement('option');
                    option.value = city.name;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            }
        };
        xhr.send('province=' + province);
    });

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
<?php include 'footer.php'; ?>