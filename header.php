<?php include 'INCLUDE/login.php'; ?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/headerx1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .logoAce {
            width: 100px;
            height: 100px;
            margin-left: 25px;
            cursor: pointer;
        }

        .logoAce img {
            width: 100%;
            height: 100%;
        }

        .top-panel {
            display: flex;
            height: 100px;
        }

        .logo {
            position: static;
            height: 60px;
            width: 60px;
            margin-top: 20px;
            margin-left: 25px;
        }

        .profile-nav {
            left: 220px
        }

        .prof-nav {
            height: fit-content;
            padding-bottom: 25px;
            padding-left: 10px;
            padding-right: 10px;
            width: 175px;
            left: 220px;
        }

        .prof-nav #a {
            margin: 0;
        }

        #services1 {
            left: 5.5%;
            height: fit-content;
            padding-bottom: 10px;
            width: 175px;
            border-radius: 5px;
            box-shadow: 1px 1px 4px 1px gray;
        }

        #services {
            left: 5.5%;
            height: fit-content;
            padding-bottom: 10px;
            width: 175px;
            border-radius: 5px;
            box-shadow: 1px 1px 4px 1px gray;
        }
    </style>
</head>

<body>

    <div class="top-panel">
        <div class="logoAce" onclick="window.location.href = 'index.php'">
            <img src="IMAGE/logo1.png" alt="">
        </div>
        <?php if (isset($_SESSION['login'])) { ?>
            <div class="profile-nav" id="pr" onclick="nav()"></div>
            <div class="prof-nav" id="prof" onmouseleave="hideNav()">
                <a id="a" href="account.php">My Bookings</a>
                <a id="a" href="account.php?account">My Account</a>
                <hr>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a id="a" href="INCLUDE/logout.php?logout">Log Out</a>
                <?php } else { ?>
                    <a id="a" href="login.php">Login</a>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="profile-nav1"></div>
        <?php if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == true) { ?>
                <div class="logo"><img src="IMAGE/logo.png" alt="" height="100%" width="100%"></div>
            <?php } else { ?>
                <div class="logo"><img src="IMAGE/logo.png" alt="" height="100%" width="100%"></div>
            <?php } ?>
        <?php } else { ?>
            <div class="logo"><img src="IMAGE/logo.png" alt="" height="100%" width="100%"></div>
        <?php } ?>
        <div class="nav">
            <a href="index.php">Home</a>
            <a id="serve" class="serve" href="services.php">Services</a>
            <a href="about.php">About</a>
            <a href="gallery.php">Gallery</a>
            <?php if (!isset($_SESSION['login'])) { ?>
                <a href="login.php">Login</a>
            <?php } ?>
            <?php if (isset($_SESSION['user'])) { ?>
                <a href="contact.php">Contact</a>
                <a href="bundle.php">Reservation</a>
            <?php } ?>
        </div>
        <div class="line"></div>

    </div>

    <script>
        let prof = document.getElementById("prof");
        let pr = document.getElementById("pr");
        function nav() {
            prof.style.display = "flex";
            pr.style.transform = "rotate(-90deg)";
        }

        function hideNav() {
            prof.style.display = "none";
            pr.style.transform = "rotate(90deg)";
        }
    </script>