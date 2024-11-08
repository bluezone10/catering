<?php
include 'INCLUDE/login.php';
include 'PHP/security.php';
if (!isset($_SESSION['login']) AND !isset($_SESSION['admin'])) {
    if (isset($_POST['month'])) {
        $month = $_POST['month'];
        $date = $_POST['date'];
    } else {
        $date = $_POST['date'];
        $month = date('F');
    }
    echo "<script>window.location.href= 'login.php?calendar&date=" . $date . '&month=' . $month . "'</script>";
    exit();
} else {
    $name = $_SESSION['username'];
}

if (isset($_POST['bookedDate'])) {
    $_SESSION['date'] = $_POST['bookedDate'];
}


$menu = mysqli_query($conn, "SELECT * FROM product");
$food = mysqli_query($conn, "SELECT * FROM cart");
$title = $_SESSION['selectedEventData']['eventTitle'];
$package = $_SESSION['selectedEventData']['package'];
$packageItem = mysqli_query($conn, "SELECT * FROM packageItem WHERE services='$title' AND package='$package'");
$services1 = mysqli_query($conn, "SELECT * FROM services");
$getCategory = mysqli_query($conn, "SELECT * FROM productcategory");
$getCategory1 = mysqli_query($conn, "SELECT * FROM productcategory WHERE name != 'Beef'");
if(isset($_POST['continuePayment'])) {
    header('location: payment.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Now!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/reservex.css">
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
        <div style="min-height: 100vh; margin-top: 60px">
            <div id="menuContainer" class="w-100 border shadow bg-light p-2 d-flex gap-2" style="min-height: 100vh">
                <div class="container-fluid">
                    <div class="row h-100">
                        <div id="itemContainer" class="col-md-8 col-12 border p-2 bg-white rounded d-flex flex-column">
                            <div class="border d-flex gap-2 p-2" style="min-height: 50px; height: fit-content">
                                <button class="btn btn-warning buttonCategory">All</button>
                                <?php while($data = mysqli_fetch_assoc($getCategory)) { ?>
                                    <button class="btn btn-outline-warning buttonCategory"><?= $data['name'] ?></button>
                                <?php } ?>  
                            </div>
                            <div id="productList"
                                class="border-start border-end border-bottom d-flex gap-2 flex-wrap p-2 justify-content-center flex-grow-1"
                                style="max-height: 100vh; overflow-y: auto">

                            </div>
                        </div>
                        <div id="cartContainer" class="col-md-4 col-12 border p-4 bg-white rounded d-md-block d-block" style="max-height: 120vh; overflow-y: auto">
                            <h4>Order Summary</h4>
                            <span style="font-weight: normal; font-size: 14px">(THIS IS FOR ADDS ON ONLY IT"S OPTIONAL)</span>
                            <div class="ps-2">
                                <h5>Event: <span style="font-weight: normal"><?= $_SESSION['selectedEventData']['eventTitle'] ?></span></h5>
                            </div>
                            <div class="ps-2">
                                <h5>Item Included</h5>
                                <ul id="itemIncluded" class="sss">
                                    <?php while($data = mysqli_fetch_assoc($packageItem)) { ?>
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
                                    if (isset($_POST['bookedDate']) && count($_POST['bookedDate']) > 0) {
                                        $firstDate = $_POST['bookedDate'][0];
                                        $lastDate = $_POST['bookedDate'][count($_POST['bookedDate']) - 1];

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
            <div class="bg-white d-flex justify-content-between ps-4 pe-4 pt-2 pb-2" style="height: 10vh">
                <button onclick="window.location.href = 'newbundle.php'" class="btn btn-danger"><i
                        class="bi bi-arrow-left"></i> Return</button>
                <button onclick="window.location.href = 'payment.php'" class="btn btn-warning">Process <i
                        class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        <!-- Reminder Modal for Carting Item Product -->
        <div class="reminderModal w-100 h-100" style="display: none">
            <div class="bg-dark position-fixed w-100 h-100" style="opacity: 0.5; top: 0%; left: 0%; z-index: 999">
            </div>
            <div class="bg-light border rounded shadow p-4 position-fixed"
                style="z-index: 1000; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 350px; min-height: 150px; height: fit-content">
                <h5 class="text-danger text-center alert alert-danger">Reminder!</h5>
                <hr>
                <p class="text-center">Do you want to cart this item?</p>
                <hr>
                <div>
                    <button class="btn btn-success">Confirm</button>
                    <button class="btn btn-danger">Cancel</button>
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
    const foodCategories = ['Beef' <?php while($data = mysqli_fetch_assoc($getCategory1)) { echo ", '" . $data['name'] . "'"; } ?>];

      function loadCarts() {
            let itemPrices;
            $.ajax({
                type: "POST",
                url: "PHP/fetchCartData.php",
                dataType: "json",
                success: function (response) {
                    // Clear all cart lists and total price display
                    $('.cartUL').empty();
                    $('#subTotal').empty();  // Assuming you have an element to display the total price
                    $('#reservation').empty();
                    $('#totalPrice').empty();

                    let totalPrice = 0;  // Initialize total price variable

                    response.forEach(item => {
                        if (item.totalPrice) {  // Check if the item is the total price object
                            totalPrice = parseFloat(item.totalPrice).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        } else if (item.subTotal) {
                            subTotal = parseFloat(item.subTotal).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        } else if (item.reservation) {
                            reservation = parseFloat(item.reservation).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        } else {
                            if(item.total_price <= 0) {
                                itemPrices = '';
                            } else {
                                itemPrices = '₱' + parseFloat(item.total_price).toLocaleString('en-US', { minimumFractionDigits: 2 });
                            }
                            const itemHtml = `<li>x${item.quantity} ${item.product} <span class="float-end">
                                <i class="bi bi-pencil-square text-success" onclick="editCart(${item.id})"></i> 
                                <i class="bi bi-trash text-danger" onclick="removeCart(${item.id})"></i>
                             </li>`;

                            // Append items to the correct category list
                            if (foodCategories.includes(item.category)) {
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

                
                 
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response:', xhr.responseText);
                }
            });
        }


    function removeCart(id) {
        if (confirm("Do you want to remove this item?")) {
            $.ajax({
                type: "POST",
                url: "PHP/removeCart.php",
                data: { cartId: id },
                success: function (response) {
                    if (response.trim() === "success") {
                        loadCarts(); // Reload the cart to reflect the changes
                    } else {
                        console.error('Error removing the item:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error removing the item:', error);
                }
            });
        }
    }

    loadCarts();

    document.addEventListener('DOMContentLoaded', function () {
        // Fetch and display products based on the selected category
        function loadProducts(category = '') {
            $.ajax({
                url: 'PHP/fetchProductData.php',
                method: 'GET',
                data: { category: category },
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#productList').empty(); // Clear existing products
                        data.forEach(product => {
                            $('#productList').append(`
                            <div class="border rounded shadow pb-2" style="width: 250px; min-height: 300px; height: fit-content">
                                <div style="height: 200px; width: 150px" class="w-100">
                                    <img src="ADMIN/IMAGE/PRODUCT/${product.image}" class="w-100 h-100" alt="">
                                </div>
                                <div class="ps-4 pt-2">
                                    <h5>${product.name}</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h5 class="ps-2">Pax: </h5>
                                    <div class="input-group mb-0" style="padding-left: 10%; padding-right: 10%">
                                        <button class="btn btn-outline-secondary button-minus" type="button">-</button>
                                        <input type="number" id="itemQuantity${product.id}" class="form-control text-center pax-input" style="width: 60px; appearance: textfield; -moz-appearance: textfield; -webkit-appearance: none;" value="1" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary button-plus" type="button">+</button>
                                    </div>
                                </div>
                                <div class="w-100 ps-2 pe-2 pt-2">
                                    <button class="btn btn-warning w-100 addToCartBtn" data-id="${product.id}" data-product="${product.name}" data-quantity="1">Add Menu</button>
                                </div>
                            </div>
                        `);
                        });

                        // Re-attach the event listeners for increment and decrement
                        attachButtonListeners();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response:', xhr.responseText);
                }
            });
        }

        // Attach click event listeners to category buttons
        document.querySelectorAll('.buttonCategory').forEach(button => {
            button.addEventListener('click', function () {
                // First, reset all buttons to 'btn btn-outline-warning'
                document.querySelectorAll('.buttonCategory').forEach(btn => {
                    btn.setAttribute('class', 'btn btn-outline-warning buttonCategory');
                });
                
                // Set the clicked button to 'btn btn-warning'
                this.setAttribute('class', 'btn btn-warning buttonCategory');
                
                const category = this.textContent.trim(); // Get the category name from the button text
                loadProducts(category); // Load products based on the selected category
            });
        });


        
        function handleDecrement(button) {
            const input = button.parentElement.querySelector('.pax-input');
            const currentValue = parseInt(input.value);
            const minValue = parseInt(input.min) || 1;

            if (currentValue > minValue) {
                input.value = currentValue - 1;
            } else {
                console.log('Minimum value reached');
            }
        }

        // Function to handle the increment of the quantity
        function handleIncrement(button) {
            const input = button.parentElement.querySelector('.pax-input');
            const currentValue = parseInt(input.value);

            input.value = currentValue + 1;
        }

        // Attach event listeners for buttons
        function attachButtonListeners() {
            document.querySelectorAll('.button-minus').forEach(button => {
                button.addEventListener('click', function () {
                    handleDecrement(this);
                });
            });

            document.querySelectorAll('.button-plus').forEach(button => {
                button.addEventListener('click', function () {
                    handleIncrement(this);
                });
            });
        }

        let selectedProduct = null;

        $(document).on('click', '.addToCartBtn', function () {
            const productId = $(this).data('id');
            const quantity = $('#itemQuantity' + productId).val();
            const productName = $(this).data('product');
            selectedProduct = { id: productId, quantity: quantity, productName: productName };
            console.log(quantity);
            console.log(productName);
            // Show the reminder modal
            $('.reminderModal').fadeIn();
        });

        $('.reminderModal .btn-success').on('click', function () {
            if (selectedProduct) {
                $.ajax({
                    type: "POST",
                    url: "PHP/addToCart.php",
                    data: {
                        productId: selectedProduct.id,
                        quantity: selectedProduct.quantity,
                        productName: selectedProduct.productName
                    },
                    success: function (response) {
                        console.log('Item added to cart:', response);

                        // Close the modal
                        $('.reminderModal').fadeOut();

                        // Reload the cart items
                        loadCarts();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error adding to cart:', error);
                    }
                });
            }
        });

        $('.reminderModal .btn-danger').on('click', function () {
            $('.reminderModal').fadeOut();
        });


        loadProducts();
 

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