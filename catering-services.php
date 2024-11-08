<?php
if (isset($_SESSION['admin'])) {
    include 'ADMIN/INCLUDE/login.php';
} else {
    include 'INCLUDE/login.php';
}
if (empty($_GET['event'])) {
    header('location: index.php');
    exit();
}

$event = $_GET['event'];

$getService = mysqli_query($conn, "SELECT * FROM services WHERE name='$event'");

if (mysqli_num_rows($getService) <= 0) {
    header('location: index.php');
    exit();
}

$edit = false;

if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] == true) {
        $edit = true;
    }
}

$dataServices = mysqli_fetch_assoc($getService);

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
    <title><?= $dataServices['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
    <link rel="stylesheet" href="CSS/newHeads.css">
    <style>
        #packageDiv {
            overflow: hidden;
            border-radius: 25px;
            height: 275px;
            flex: 1 1 30%;
            min-width: 300px;
            max-width: 100%;
            transition: 0.5s;
            position: relative;
        }

        #packageDiv:hover {
            transform: scale(1.05);
        }

        .topBackground {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;

            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(255, 255, 255, 0)),
                url('IMAGE/<?= $dataServices['background'] ?>');
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
    <section>
        <div class="" style="padding-top: 0; min-height: 65vh">
            <div class="topBackground w-100 bg-dark" style="height: 65vh; z-index: 1; left: 0%">

            </div>
            <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100"
                style="top: 0; left: 0%; z-index: 2; height: 75vh">
                <h1 class="text-center text-white"><?= $dataServices['title'] ?> <?= $edit == true ? '<i onclick="openTitleEdit()" class="bi bi-pencil-square text-white" style="cursor: pointer"></i>' : '' ?></h1>
                <h4 class="text-center text-white"><?= $dataServices['description'] ?></h4>
            </div>
        </div>
        <div class="w-100 p-4" style="margin-top: 60px; height: fit-content">
            <div class="p-4">
                <div class="d-flex gap-4 p-4 flex-wrap justify-content-between">
                    <div style="height: fit-content" class="border shadow d-flex flex-column align-items-center justify-content-center" id="packageDiv">
                        <div>
                            <img src="IMAGE/PACKAGE/<?= empty($dataServices['package1Image']) ? 'noimage.jpg' : $dataServices['package1Image'] ?>" class="w-100 h-100" alt="">
                        </div>
                        <div class="w-100 p-4" style="min-height: 30vh">
                            <h4 class="text-dark">
                                <?= $dataServices['package1'] ?>
                            </h4>
                            <h6>50-150 Pax</h6>
                            <hr>
                            <h6 style="font-weight: normal; text-align: justify">The ideal <?= strtolower($event) ?> catering package for a minimum of 30-50 guests, which includes:</h6>
                            <ul>
                                <?php while($data = mysqli_fetch_assoc($query1)) {
                                    echo '<li>' . $data['name'] .'</li>';
                                } ?>
                            </ul>
                            <h6 style="font-weight: normal">The exact price varies based on menu choices, the number of guests, service and design preferences, and the <?= strtolower($service) ?> location.</h6>
                          
                        </div>
                    </div>
                    <div style="height: fit-content" class="border shadow d-flex flex-column align-items-center justify-content-center" id="packageDiv">
                        <div>
                            <img src="IMAGE/PACKAGE/<?= empty($dataServices['package2Image']) ? 'noimage.jpg' : $dataServices['package2Image'] ?>" class="w-100 h-100" alt="">
                        </div>
                        <div class="w-100 p-4" style="min-height: 30vh">
                            <h4 class="text-dark">
                                <?= $dataServices['package2'] ?>
                            </h4>
                            <h6>50-150 Pax</h6>
                            <hr>
                            <h6 style="font-weight: normal; text-align: justify">The ideal <?= strtolower($event) ?> catering package for a minimum of 30-50 guests, which includes:</h6>
                            <ul>
                                <?php while($data = mysqli_fetch_assoc($query1)) {
                                    echo '<li>' . $data['name'] .'</li>';
                                } ?>
                            </ul>
                            <h6 style="font-weight: normal">The exact price varies based on menu choices, the number of guests, service and design preferences, and the <?= strtolower($service) ?> location.</h6>
                          
                        </div>
                    </div>
                    <div style="height: fit-content" class="border shadow d-flex flex-column align-items-center justify-content-center" id="packageDiv">
                        <div>
                            <img src="IMAGE/PACKAGE/<?= empty($dataServices['package3Image']) ? 'noimage.jpg' : $dataServices['package3Image'] ?>" class="w-100 h-100" alt="">
                        </div>
                        <div class="w-100 p-4" style="min-height: 30vh">
                            <h4 class="text-dark">
                                <?= $dataServices['package3'] ?>
                            </h4>
                            <h6>50-150 Pax</h6>
                            <hr>
                            <h6 style="font-weight: normal; text-align: justify">The ideal <?= strtolower($event) ?> catering package for a minimum of 30-50 guests, which includes:</h6>
                            <ul>
                                <?php while($data = mysqli_fetch_assoc($query1)) {
                                    echo '<li>' . $data['name'] .'</li>';
                                } ?>
                            </ul>
                            <h6 style="font-weight: normal">The exact price varies based on menu choices, the number of guests, service and design preferences, and the <?= strtolower($service) ?> location.</h6>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 mb-4" style="height: fit-content">
            <h4 class="text-center">Why choose Ace Catering for your <?= strtolower($event) ?>? <?= $edit == true ? '<i onclick="openResourceDescription()" class="bi bi-pencil-square text-dark" style="cursor: pointer"></i>' : '' ?></h4>
            <p class="text-center" style="padding-left: 15%; padding-right: 15%;">
                ACE Catering offers a unique blend of culinary excellence and top-notch service, ensuring every event or meal is memorable. With expertly crafted menus made from the finest ingredients, we cater to all tastes and dietary preferences. Our dedicated team pays attention to every detail, ensuring flawless execution. Whether it’s a special occasion or a casual gathering, ACE Catering delivers a seamless, delightful dining experience, making us the perfect choice for your catering needs.
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary btn-lg" onclick="window.location.href = '<?= isset($_SESSION['login']) ? 'newBundle.php' : 'login.php' ?>'">BOOK NOW!</button>
                </div>
            </p>
        </div>
        <?php if ($edit == true) { ?>
            <div class="editTitleModal" style="display: none">
                <div class="position-fixed bg-dark" style="opacity: 0.5; z-index: 999; width: 100%; height: 100vh; left: 0%; top: 0%;"></div>
                <div class="p-4 position-fixed bg-white border rounded shadow" style="left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 500px; height: fit-content;">
                    <h5>Admin Edit</h5>
                    <hr>
                    <div>
                        <form id="titleForm" action="ADMINPHP/titleEdit.php" enctype="multipart/form-data" method="POST" class="d-flex flex-column gap-2">
                            <input type="hidden" name="name" value="<?= $dataServices['name'] ?>">
                            <div class="d-flex flex-column gap-2">
                                <label for="">Title: </label>
                                <input name="title" type="text" class="form-control" value="<?= $dataServices['title'] ?>" placeholder="Enter new title...">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <label for="">Background Image: </label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <label for="">Description: </label>
                                <textarea name="description" rows="6" id="" class="form-control" style="text-align: justify"><?= $dataServices['description'] ?></textarea>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger" onclick="closeTitleEdit()">Close</button>
                        <button type="submit" form="titleForm" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
            <div class="editPackage1Modal" style="display: none">
                <div class="position-fixed bg-dark" style="opacity: 0.5; z-index: 999; width: 100%; height: 100vh; left: 0%; top: 0%;"></div>
                <div class="p-4 position-fixed bg-white border rounded shadow" style="left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 500px; height: fit-content;">
                    <h5>Admin Edit</h5>
                    <hr>
                    <div>
                        <form id="package1Form" action="ADMINPHP/packageEdit.php" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-2">
                            <input type="hidden" name="name" value="<?= $dataServices['name'] ?>">
                            <div class="d-flex flex-column gap-2">
                                <input type="hidden" id="packageNumber" name="package">
                                <label for="">Package Name: </label>
                                <input id="packageName" name="packageName" type="text" class="form-control" value="<?= $dataServices['package1'] ?>" placeholder="Enter new package name...">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <label for="">Package Image: </label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger" onclick="closePackage1Edit()">Close</button>
                        <button type="submit" form="package1Form" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
            <div class="editResourceModal" style="display: none">
                <div class="position-fixed bg-dark" style="opacity: 0.5; z-index: 999; width: 100%; height: 100vh; left: 0%; top: 0%;"></div>
                <div class="p-4 position-fixed bg-white border rounded shadow" style="left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 500px; height: fit-content;">
                    <h5>Admin Edit</h5>
                    <hr>
                    <div>
                        <form id="resourceForm" action="ADMINPHP/resourceEdit.php" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-2">
                            <input type="hidden" name="name" value="<?= $dataServices['name'] ?>">
                            <div class="d-flex flex-column gap-2">
                                <input type="hidden" id="resourceNumber" name="resourceNumber">
                                <label for="">Resource Name: </label>
                                <input id="resourceName" name="resourceName" type="text" class="form-control" value="<?= $dataServices['package1'] ?>" placeholder="Enter new package name...">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <label for="">Resource Image: </label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger" onclick="closeResourceEdit()">Close</button>
                        <button type="submit" form="resourceForm" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
            <div class="editResourceDescriptionModal" style="display: none">
                <div class="position-fixed bg-dark" style="opacity: 0.5; z-index: 999; width: 100%; height: 100vh; left: 0%; top: 0%;"></div>
                <div class="p-4 position-fixed bg-white border rounded shadow" style="left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 500px; height: fit-content;">
                    <h5>Admin Edit</h5>
                    <hr>
                    <div>
                        <form id="resourceDesForm" action="ADMINPHP/resourceDesEdit.php" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-2">
                            <input type="hidden" name="name" value="<?= $dataServices['name'] ?>">
                            <div class="d-flex flex-column gap-2">
                                <label for="">Resource Description: </label>
                                <textarea name="resourceDescription" class="form-control"><?= $dataServices['resourceDescription'] ?></textarea>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger" onclick="closeResourceDescription()">Close</button>
                        <button type="submit" form="resourceDesForm" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <?php include 'newMessage.php' ?>
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
    <?php if ($edit == true) { ?>

        function openTitleEdit() {
            $('.editTitleModal').css('display', 'block');
        }

        function closeTitleEdit() {
            $('.editTitleModal').css('display', 'none');
        }

        function openPackage1Edit(number, name) {
            $('.editPackage1Modal').css('display', 'block');
            $('#packageNumber').val(number);
            $('#packageName').val(name);
        }

        function closePackage1Edit() {
            $('.editPackage1Modal').css('display', 'none');
        }

        function openResourceEdit(number, name) {
            $('.editResourceModal').css('display', 'block');
            $('#resourceNumber').val(number);
            $('#resourceName').val(name);
        }

        function closeResourceEdit() {
            $('.editResourceModal').css('display', 'none');
        }

        function openResourceDescription() {
            $('.editResourceDescriptionModal').css('display', 'block');
        }

        function closeResourceDescription() {
            $('.editResourceDescriptionModal').css('display', 'none');
        }
    <?php } ?>
</script>

</html>