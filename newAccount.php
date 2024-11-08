<?php
if(isset($_SESSION['admin'])) {
    include 'ADMIN/INCLUDE/login.php';
} else {
    include 'INCLUDE/login.php';
}

include 'PHP/security.php';
$name = explode(" ", $_SESSION['name']);
$username = $_SESSION['username'];
$orderList = mysqli_query($conn, "SELECT * FROM order_list WHERE username='$username'");

$services1 = mysqli_query($conn, "SELECT * FROM services");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take a look to our Bundle!</title>
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
    <section style="margin-top: 35vh">
        <div class="container-fluid">
            <div class="row" style="padding-top: 60px; min-height: 100vh">
                <div class="col-lg-2 col-md-4 bg-light d-block d-md-block" style="min-height: 20vh">
                    <div class="border w-100 h-100 p-2">
                        <div class="border d-flex flex-column gap-2">
                            <button id="personalButton" class="w-100 btn btn-primary" onclick="personalAccount()"><i
                                    class="bi bi-person"></i> Personal Account</button>
                            <button id="privacyButton" class="w-100 btn btn-outline-primary"
                                onclick="privacySetting()"><i class="bi bi-lock"></i>Privacy Setting</button>
                            <button id="bookingButton" class="w-100 btn btn-outline-primary"
                                onclick="bookingSetting()"><i class="bi bi-bag"></i> My Booking</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 p-2" style="min-height: 50vh">
                    <div class="border rounded w-100 h-100 p-4">
                        <form id="personalAccount" style="display: block" action="">
                            <h4>Personal Account</h4>
                            <div class="d-flex flex-column gap-2">
                                <div class="w-100">
                                    <label for="firstName" class="form-label">First Name: </label>
                                    <input type="text" id="firstName" class="form-control" value="<?= $name[0] ?>" placeholder="First Name...">
                                </div>
                                <div class="w-100">
                                    <label for="lastName" class="form-label">Last Name: </label>
                                    <input type="text" id="lastName" class="form-control" value="<?= empty($name[1]) ? "" : $name[1] ?>" placeholder="Last Name...">
                                </div>
                                <div class="w-100">
                                    <label for="contactNumber" class="form-label">Contact Number: </label>
                                    <input type="text" id="contactNumber" class="form-control" placeholder="Contact Number..." value="<?= $_SESSION['contact'] ?>">
                                </div>
                                <div class="w-100">
                                    <label for="address" class="form-label">Address: </label>
                                    <input type="text" id="address" class="form-control" placeholder="Your location..." value="<?= $_SESSION['address'] ?>">
                                </div>
                                <div class="w-100 mt-4">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                        <form id="privacySetting" style="display: none" action="">
                            <h4>Privacy Setting</h4>
                            <div class="d-flex flex-column gap-2">
                                <div class="w-100">
                                    <label for="oldPassword" class="form-label">Old Password: </label>
                                    <input type="password" id="oldPassword" class="form-control"
                                        placeholder="Old Password...">
                                </div>
                                <div class="w-100">
                                    <label for="newPassword" class="form-label">New Password: </label>
                                    <input type="password" id="newPassword" class="form-control"
                                        placeholder="New Password...">
                                </div>
                                <div class="w-100">
                                    <label for="confirmPassword" class="form-label">Confirm Password: </label>
                                    <input type="password" id="confirmPassword" class="form-control"
                                        placeholder="Confirm Password...">
                                </div>
                                <div class="w-100 mt-4">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                        <div id="bookingSetting" class="w-100"
                            style="display: none; max-height: 100vh; overflow-y: auto">
                            <div class="d-flex gap-2 mb-2">
                                <button class="btn btn-primary" data-status="All">All</button>
                                <button class="btn btn-outline-primary" data-status="Pending">Pending</button>
                                <button class="btn btn-outline-primary" data-status="Booked">Ongoing</button>
                                <button class="btn btn-outline-primary" data-status="Completed">Completed</button>
                                <button class="btn btn-outline-primary" data-status="Request Cancel">Cancel</button>
                            </div>
                            <h4>Manage your Booking</h4>
                            <table class="table">
                                <thead class="border bg-light rounded">
                                    <tr class="text-center">
                                        <th class="border">Order ID</th>
                                        <th class="border">Booked Date</th>
                                        <th class="border">Status</th>
                                        <th class="border"></th>
                                    </tr>
                                </thead>
                                <tbody id="orderList"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 p-2">
                    <div class="border bg-light rounded h-100 w-100 d-flex flex-column">
                        <div class="w-100 d-flex gap-2 flex-column align-items-center justify-content-center"
                            style="height: 250px">
                            <div class="border rounded-circle shadow"
                                style="width: 160px; height: 150px; overflow: hidden">
                                <img src="ADMIN/IMAGE/<?= $_SESSION['profile'] ?>" class="w-100 h-100" alt="">
                            </div>
                            <div>
                                <h5><?= strtoupper($_SESSION['name']) ?></h5>
                            </div>
                        </div>
                        <div class="d-flex flex-column p-4 gap-4" style="flex-grow: 1">
                            <div class="bg-white rounded p-2" style="min-height: 100px; height: fit-content">
                                <h6>Number of Orders</h6>
                                <hr>
                                <p class="text-center"><?= mysqli_num_rows($orderList) ?></p>
                            </div>
                            <div class="bg-white rounded" style="min-height: 100px; height: fit-content">
                                <!-- Additional content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="viewOrderModal" style="display: none">
            <div class="bg-dark w-100 h-100 position-fixed" style="opacity: 0.5; left: 0%; top: 0%; z-index: 999"></div>
            <div class="position-fixed p-4 border shadow rounded bg-white"
                style="z-index: 1000; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; max-height: 80vh; overflow-y: auto">
                <h5>Order Summary</h5>
                <hr>
                <div>
                    <div class="ps-2">
                        <h5>Item Included</h5>
                        <ul id="itemCart" class="cartUL">

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
                    <!-- <div class="ps-2">
                        <h5>Payment Summary:</h5>
                        <ul id="paymentSummary" class="payment">
                            <li id="subTotal"></li>
                            <li id="reservation"></li>
                            <li id="totalPrice"></li>
                        </ul>
                    </div> -->
                </div>
                <hr>
                <div id="viewOrderButton" class="d-flex gap-2">
                    <button class="btn btn-danger" onclick="viewCloseOrder()">Close</button>
                </div>
            </div>
        </div>
    </section>
    <?php include 'newMessage.php' ?>
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
<script>
    var personalForm = document.getElementById('personalAccount');
    var privacyForm = document.getElementById('privacySetting');
    var personalButton = document.getElementById('personalButton');
    var privacyButton = document.getElementById('privacyButton');
    var bookingButton = document.getElementById('bookingButton');
    var bookingForm = document.getElementById('bookingSetting');

    function personalAccount() {
        personalForm.style.display = "block";
        privacyForm.style.display = "none";
        bookingForm.style.display = "none";
        personalButton.setAttribute('class', 'w-100 btn btn-primary');
        privacyButton.setAttribute('class', 'w-100 btn btn-outline-primary');
        bookingButton.setAttribute('class', 'w-100 btn btn-outline-primary');
    }

    function privacySetting() {
        personalForm.style.display = "none";
        privacyForm.style.display = "block";
        bookingForm.style.display = "none";
        personalButton.setAttribute('class', 'w-100 btn btn-outline-primary');
        privacyButton.setAttribute('class', 'w-100 btn btn-primary');
        bookingButton.setAttribute('class', 'w-100 btn btn-outline-primary');
    }

    function bookingSetting() {
        personalForm.style.display = "none";
        privacyForm.style.display = "none";
        bookingForm.style.display = "block";
        personalButton.setAttribute('class', 'w-100 btn btn-outline-primary');
        privacyButton.setAttribute('class', 'w-100 btn btn-outline-primary');
        bookingButton.setAttribute('class', 'w-100 btn btn-primary');
    }

    function fetchOrderList(status = 'All') {
        $.ajax({
            url: 'PHP/fetchOrderList.php',
            method: 'GET',
            data: { status: status },
            dataType: 'json',
            success: function (data) {
                var orderList = '';
                data.forEach(function (order) {
                    var btnClass;
                    if (order.status === "Pending") {
                        btnClass = "success";
                    } else if (order.status === "Ongoing") {
                        btnClass = "primary";
                    } else if(order.status === "Request Cancel") {
                        btnClass = "danger";
                    } else {
                        btnClass = "warning";
                    }

                    orderList += `
                    <tr class="text-center border-start border-end">
                        <td class="text-center align-middle pt-3 p-1 pb-3">${order.orderID}</td>
                        <td class="text-center align-middle pt-3 p-1 pb-3">${order.date}</td>
                        <td class="text-center align-middle pt-3 p-1 pb-3">
                            <span class="bg-${btnClass} p-2 rounded ps-4 pe-4 text-white">${order.status}</span>
                        </td>
                        <td class="text-center align-middle pt-3 p-1 pb-3">
                            <a href="#" onclick="viewOrder('${order.orderID}');event.preventDefault()" class="text-success" style="text-decoration: none">View Order</a>
                        </td>
                    </tr>
                `;
                });
                $('#orderList').html(orderList);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching order list:', error);
            }
        });
    }

    $(document).ready(function () {
        // Fetch all orders on page load
        fetchOrderList();

        // Attach click events to filter buttons
        $('#bookingSetting .btn').click(function () {
            var status = $(this).data('status'); // Get the status from the data-status attribute
            fetchOrderList(status); // Fetch the orders based on the status

            // Change the button styles
            $('#bookingSetting .btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        });
    });

    function viewOrder(orderID) {
        var viewModal = document.querySelector('.viewOrderModal').style.display = "block";
        let viewOrderbutton = document.querySelector('#viewOrderButton');
        $.ajax({
            type: "POST",
            url: "PHP/fetchViewOrderData.php",
            data: { orderID: orderID },
            dataType: "json",
            success: function (response) {
                // Clear all cart lists and total price display
                $('.cartUL').empty();
                $('#subTotal').empty();  // Assuming you have an element to display the total price
                $('#reservation').empty();
                $('#totalPrice').empty();

                let totalPrice = 0;  // Initialize total price variable
                var orderStatus = false;
                var orderCancelId = "";

                response.forEach(item => {
                    if (item.totalPrice) {  // Check if the item is the total price object
                        totalPrice = parseFloat(item.totalPrice).toLocaleString('en-US', { minimumFractionDigits: 2 });
                    } else if (item.subTotal) {
                        subTotal = parseFloat(item.subTotal).toLocaleString('en-US', { minimumFractionDigits: 2 });
                    } else if (item.reservation) {
                        reservation = parseFloat(item.reservation).toLocaleString('en-US', { minimumFractionDigits: 2 });
                    } else {
                        const itemHtml = `<li>x${item.quantity} ${item.product}</li>`;

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

                    if (item.subTotal <= 0) {
                        subTotal = 0;
                        reservation = 0;
                    }

                    if (item.status == "Pending") {
                        orderStatus = true;
                    }

                    if (item.cancelID) {
                        orderCancelId = item.cancelID;
                    }
                });

                const newButton = '<button id="cancelRequestButton" class="btn btn-danger" onclick="requestCancel(' + '\'' + orderCancelId + '\'' + ')">Request Cancel</button>'
                if (orderStatus == true) {
                    $('#viewOrderButton').append(newButton);
                }

                $('#subTotal').text(`Sub Total: ₱${subTotal}`);
                $('#reservation').text(`Reservation Fee: ₱${reservation}`);
                $('#totalPrice').text(`Total: ₱${totalPrice}`);

            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.log('Response:', xhr.responseText);
            }
        });
    }

    function viewCloseOrder() {
        var viewModal = document.querySelector('.viewOrderModal').style.display = "none";
        $('#cancelRequestButton').remove();
        $('.cartUL').empty();
        $('#subTotal').empty();  // Assuming you have an element to display the total price
        $('#reservation').empty();
        $('#totalPrice').empty();
    }

    function requestCancel(orderID) {
        if (confirm('Do you want to request to cancel this order?')) {
            $.ajax({
                url: 'PHP/requestCancel.php', // Change to your actual server-side script location
                method: 'POST',
                data: {
                    orderID: orderID,
                },
                success: function (response) {
                    console.log(response);
                    fetchOrderList();
                },
                error: function (xhr, status, error) {
                    console.error('Error processing the request:', error);
                }
            });
        }
    }

    $(document).ready(function () {
        $('#privacySetting').on('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            var oldPassword = $('#oldPassword').val().trim();
            var newPassword = $('#newPassword').val().trim();
            var confirmPassword = $('#confirmPassword').val().trim();

            // Basic validation
            if (oldPassword === "" || newPassword === "" || confirmPassword === "") {
                alert("Please fill in all fields.");
                return;
            }

            if (newPassword !== confirmPassword) {
                alert("New Password and Confirm Password do not match.");
                return;
            }

            // If validation passes, send the data via AJAX
            $.ajax({
                url: 'PHP/updatePassword.php', // Change to your actual server-side script location
                method: 'POST',
                data: {
                    oldPassword: oldPassword,
                    newPassword: newPassword
                },
                success: function (response) {
                    if (response === 'success') {
                        alert('Password changed successfully.');
                        $('#privacySetting')[0].reset(); // Reset the form
                    } else {
                        alert('Error: ' + response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error processing the request:', error);
                }
            });
        });

        $('#personalAccount').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally

            var firstName = $('#firstName').val().trim();
            var lastName = $('#lastName').val().trim();
            var contactNumber = $('#contactNumber').val().trim();
            var address = $('#address').val().trim();

            // Basic validation
            if (firstName === "" || contactNumber === "" || address === "") {
                alert("Please fill in all required fields.");
                return;
            }

            if(confirm("Do you want to update the personal information of your account?")) {
                $.ajax({
                    url: 'PHP/updatePersonalAccount.php', // Change to your actual server-side script location
                    method: 'POST',
                    data: {
                        firstName: firstName,
                        lastName: lastName,
                        contactNumber: contactNumber,
                        address: address
                    },
                    success: function(response) {
                        if (response === 'success') {
                            alert('Personal account updated successfully.');
                            // Optionally, you can reset the form or provide further feedback
                        } else {
                            alert('Error: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error processing the request:', error);
                    }
                });
            }
      
        });
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