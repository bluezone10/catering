<?php
    $services = mysqli_query($conn, "SELECT * FROM eventcategory");
    $services1 = mysqli_query($conn, "SELECT * FROM services");
?>
<style>
    .submenu {
        position: relative;
    }

    .submenu-items {
        position: relative;
        left: 20px; /* Adjust as needed */
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-out;
    }

    .d-none {
        display: none;
    }

    .submenu-items.d-none {
        max-height: 0;
        transition: max-height 0.5s ease-in;
    }

    #menuBurger {
        display: none;
    }

    #displayBurger {
        display: flex;
    }

    #displayBurger a {
        text-decoration: none;
    }

    #subMenuDisplay {
        display: none
    }

    #navName {
        color: white;
    }

    #navName:hover {
        color: black;
    }

    @media screen and (max-width: 840px) {
        #menuBurger {
            display: flex;
        }

        #displayBurger {
            display: none;
        }
    }

</style>
<div class="topNavigation w-100 d-flex ps-2">
    <div id="menuBurger" class="h-100 align-items-center" style="z-index: 10">
        <button id="navButton" class="btn btn-dark h-75 d-flex align-items-center p-2">
            <i class="bi bi-list" style="font-size: 32px"></i>
        </button>
    </div>
    <div class="d-flex align-items-center justify-content-start w-100" style="left: 0px; z-index: 1; user-select: none">
        <div>
            <img src="IMAGE/catering.png" style="height: 120px" alt="">
        </div>
        <div id="displayBurger" class="align-items-center justify-content-center gap-4 h-100" style="flex-grow: 1">
            <a id="navName" href="index.php">HOME</a>
            <a id="navName" href="about.php">ABOUT US</a>
            <a id="navName" href="#" onclick="toGallery(); event.preventDefault();">GALLERY</a>
            <a id="navName" href="#" onclick="displaySub(); event.preventDefault();">SERVICES <i class="bi bi-chevron-down"></i></a>
            <a id="navName" href="#" onclick="event.preventDefault(); toFooter()">CONTACT US</a>
            <div id="subMenuDisplay" class="position-absolute bg-white border p-2 gap-2 pt-3 pb-3 flex-column align-items-center justify-content-center" style="top: 60px; margin-left: 25px; height: fit-content; width: 200px">
                <?php while($data = mysqli_fetch_assoc($services1)) { ?>
                    <a href="catering-services.php?event=<?= $data['name'] ?>" class="text-dark"><?= $data['name'] ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if (!isset($_SESSION['login']) AND !isset($_SESSION['admin'])) { ?>
        <div class="h-100 d-flex align-items-center pe-2">
            <button class="d-flex btn btn-dark gap-1" onclick="window.location.href = 'login.php'"><i
                    class="bi bi-person"></i>Login</button>
        </div>
    <?php } else { ?>
        <div class="h-100 d-flex align-items-center pe-2 gap-2">
            <button onclick="window.location.href = 'newBundle.php'" class="btn btn-dark d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Shop"><i class="bi bi-cart"></i></button>
            <button onclick="window.location.href = 'newAccount.php'" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Profile"><i class="bi bi-person" style=""></i></button>
            <button class="d-flex btn btn-dark gap-1" onclick="window.location.href = 'INCLUDE/logout.php?logout'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout"><i
                    class="bi bi-arrow-left-square"></i></button>
        </div>
    <?php } ?>
</div>
<div id="burgerNav" class="burger-nav" style="top: 0px; max-height: 100vh; width: 250px; height: 100%; z-index: 100">
    <div class="d-flex justify-content-end">
        <i id="navX" class="bi bi-x text-white" style="user-select: none; cursor: pointer; font-size: 32px"></i>
    </div>
    <ul class="d-flex flex-column align-items-start ps-4">
        <li><a href="index.php" class="text-white">Home</a></li>
        <li><a href="about.php" class="text-white">About Us</a></li>
        <li><a href="#" onclick="toGallery(); event.preventDefault();" class="text-white">Gallery</a></li>
        <li class="submenu">
            <a href="#" class="text-white submenu-toggle">Services <i class="bi bi-chevron-down"></i></a>
            <ul class="submenu-items d-none flex-column ps-4">
                <li><a href="catering-services.php?event=Debut" class="text-white">Debut</a></li>
                <li><a href="catering-services.php?event=Private Party" class="text-white">Private Party</a></li>
                <li><a href="catering-services.php?event=Wedding" class="text-white">Wedding</a></li>
                <li><a href="catering-services.php?event=Corporate" class="text-white">Corporate</a></li>
                <li><a href="catering-services.php?event=Kids Party" class="text-white">Kids Party</a></li>
            </ul>
        </li>
        <li><a href="#" onclick="event.preventDefault(); toFooter()" class="text-white">Contact Us</a></li>
    </ul>
</div>
<script>
    document.getElementById('navX').addEventListener('click', function () {
        var burgerNav = document.getElementById('burgerNav');
        burgerNav.classList.remove('show');
    });

    document.querySelector('.submenu-toggle').addEventListener('click', function(event) {
        event.preventDefault();
        var submenu = document.querySelector('.submenu-items');
        var icon = this.querySelector('i');
        submenu.classList.toggle('d-none');
        if (!submenu.classList.contains('d-none')) {
            submenu.style.maxHeight = submenu.scrollHeight + "px";
            icon.classList.replace('bi-chevron-down', 'bi-chevron-up');
        } else {
            submenu.style.maxHeight = "0px";
            icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
        }
    });

    function toFooter() {
        const section2 = document.getElementById('sectionFooter');
        section2.scrollIntoView({ behavior: 'smooth' });
    }

    function toGallery() {
        const section2 = document.getElementById('gallerySection');
        section2.scrollIntoView({ behavior: 'smooth' });
    }
    const subMenuDisplay = document.getElementById('subMenuDisplay');
    
    function displaySub() {
        if(subMenuDisplay.style.display == "flex") {
            subMenuDisplay.style.display = "none";
        } else {
            subMenuDisplay.style.display = "flex";
        }
    }
</script>