<?php
if(isset($_SESSION['admin'])) {
    include 'ADMIN/INCLUDE/login.php';
} else {
    include 'INCLUDE/login.php';
}

$query = mysqli_query($conn, "SELECT * FROM eventcategory");
$getSection1 = mysqli_query($conn, "SELECT * FROM homepagesection1 LIMIT 1");
$dataSection1 = mysqli_fetch_assoc($getSection1);
$edit = false;

$getServices = mysqli_query($conn, "SELECT * FROM services");
$dataServices = [];

while($data = mysqli_fetch_assoc($getServices)) {
    $dataServices[] = $data;
}

if(isset($_SESSION['admin'])) {
    if($_SESSION['admin'] == true) {
        $edit = true;
    } else {
        $edit = false;
    }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
    <link rel="stylesheet" href="">
    <style>
        .parallax-section {
            position: relative;
            height: 100vh;
            overflow: hidden;
            background-color: #000;
            perspective: 1px;
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

        #eventCons {
            background-color: white;
            transition: all 0.5s ease;
            position: relative;
        }

        #eventCons img {
            transition: filter 0.5s ease, transform 0.5s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #eventCons:hover img {
            filter: blur(3px);
            /* Apply blur effect */
            transform: scale(1.1);
            /* Scale the image to zoom in */
        }

        #eventName h5 {
            color: white;
        }

        .grid-container {
            padding: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .grid-item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            text-align: center;
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
            /* One item in the middle column */
            height: 420px;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 1s ease-out forwards;
        }

        #calendar {
            position: static;
            left: 45%;
            width: 80%;
            margin: 20px auto;
            border-radius: 5px;
            padding: 10px;
            background-color: #e8ecf0;
            box-shadow: 1px 1px 8px 1px black;
            z-index: 99;
        }

        #calendar table {
            width: 100%;
            border-collapse: collapse;
        }

        #calendar td {
            border: 1px solid black;
            text-align: left;
            padding: 0px;
            height: 75px;
            font-size: 12px;
            padding-left: 10px;
        }

        #calendar th {
            background-color: skyblue;
            border: 1px solid black;
            text-align: center;
            width: 100px;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 12px
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
        }

        @media screen and (max-width: 425px) {
            #messageContainer {
                left: 25px;
                width: 325px;
            }
        }
    </style>
</head>

<body>
    <?php include 'newHeader.php' ?>
    <section id="section1" class="parallax-section">
        <div class="border bg-light slider-container">
            <div class="position-absolute w-100 h-100 d-flex flex-column gap-2 align-items-center justify-content-center"
                style="z-index: 10">
                <?php if($edit == true) { ?>
                    <i onclick="section1Edit()" class="position-absolute bi bi-pencil-square text-white" style="cursor: pointer; user-select: none;right: 20%; top: 30%; font-size: 24px"></i>
                <?php } ?>          
                <h1 class="text-white p-2 rounded-pill w-75 text-center" id="heading"
                    style="text-shadow: 2px 2px black;"></h1>
                <p class="text-white p-2 rounded-pill w-75 text-center" id="paragraph"
                    style="text-shadow: 2px 2px black;"></p>
            </div>
            <div id="sliderWrapper" class="slider-wrapper">
                <img src="IMAGE/background.jpg" alt="Image 1" class="active">
                <img src="IMAGE/background2.jpg" alt="Image 2" class="next">
                <img src="IMAGE/background3.jpg" alt="Image 3" class="next">
            </div>
        </div>
    </section>
    <section id="section2">
        <div class="bg-light w-100" style="min-height: 100vh; height: fit-content">
            <div class="w-100 d-flex align-items-center justify-content-center" style="z-index: 10">
                <div class="position-relative d-flex flex-column border bg-white rounded-circle"
                    style="top: -50px; user-select: none; width: 100px; height: 100px; z-index: 10">
                    <div onclick="toSection1()" class="h-50 d-flex align-items-center justify-content-center"
                        style="cursor: pointer">
                        <i class="bi bi-chevron-down" style="font-size: 24px"></i>
                    </div>
                    <div onclick="toSection2()" class="h-50 d-flex align-items-center justify-content-center"
                        style="z-index: 11; cursor: pointer">
                        <i class="bi bi-chevron-up" style="font-size: 24px"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="border" style="flex-grow: 1"> -->
            <div class="position-absolute w-100 h-100 p-4" style="margin-top: -100px">
                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                    <!-- Create a calendar here with button of next and previous -->
                    <div class="w-100 d-flex align-items-center justify-content-center flex-column"
                        style="max-width: 700px">
                        <h5 class="text-dark">Event Calendar <i class="bi bi-calendar text-dark"></i></h5>
                        <div id="calendar" class="shadow rounded border"></div>
                        <div class="position-absolute d-flex justify-content-between ps-2 pe-2"
                            style="width: calc(50% - 50px); top: 50%; z-index: 99">
                            <button class="btn btn-primary" onclick="prevMonth()">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="btn btn-primary" onclick="nextMonth()">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
    </section>
    <section class="section3">
        <div class="bg-light w-100" style="min-height: 100vh; height: fit-content">
            <h3 class="text-center">Catering Services</h3>
            <div class="grid-container">
                <div class="left-column d-flex flex-column">
                    <div <?php if($edit == true) { ?>onclick="editServices('Debut')"<?php } else { ?>onclick="window.location.href = 'catering-services.php?event=<?= $dataServices[0]['name'] ?>'"<?php } ?> style="cursor: pointer; border-radius: 25px; overflow: hidden"
                        class="d-flex align-items-center justify-content-center left-item grid-item shadow">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 1px 1px black"><?= $dataServices[0]['name'] ?> <?php if($edit == true) { ?><i class="bi bi-pencil-square"></i><?php } ?>
                        </h3>
                        <img src="IMAGE/<?= $dataServices[0]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                    <div <?php if($edit == true) { ?><?php } else { ?>onclick="window.location.href = 'catering-services.php?event=<?= $dataServices[1]['name'] ?>'"<?php } ?> 
                        style="cursor: pointer; border-radius: 25px; overflow: hidden"
                        class="d-flex align-items-center justify-content-center left-item grid-item shadow">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 1px 1px black"><?= $dataServices[1]['name'] ?> <?php if($edit == true) { ?><i class="bi bi-pencil-square"></i><?php } ?></h3>
                        <img src="IMAGE/<?= $dataServices[1]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                </div>
                <div <?php if($edit == true) { ?><?php } else { ?>onclick="window.location.href = 'catering-services.php?event=<?= $dataServices[2]['name'] ?>'"<?php } ?>  style="cursor: pointer; border-radius: 25px; overflow: hidden"
                    class="d-flex align-items-center justify-content-center grid-item middle-column shadow">
                    <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 1px 1px black"><?= $dataServices[2]['name'] ?> <?php if($edit == true) { ?><i class="bi bi-pencil-square"></i><?php } ?></h3>
                    <img src="IMAGE/<?= $dataServices[2]['background'] ?>" class="w-100 h-100" alt="">
                </div>
                <div class="right-column d-flex flex-column">
                    <div <?php if($edit == true) { ?><?php } else { ?>onclick="window.location.href = 'catering-services.php?event=<?= $dataServices[3]['name'] ?>'"<?php } ?> 
                        style="cursor: pointer; border-radius: 25px; overflow: hidden"
                        class="right-item grid-item shadow d-flex align-items-center justify-content-center">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 1px 1px black">
                        <?= $dataServices[3]['name'] ?> <?php if($edit == true) { ?><i class="bi bi-pencil-square"></i><?php } ?></h3>
                        <img src="IMAGE/<?= $dataServices[3]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                    <div  <?php if($edit == true) { ?><?php } else { ?>onclick="window.location.href = 'catering-services.php?event=<?= $dataServices[4]['name'] ?>'"<?php } ?> 
                        style="cursor: pointer; border-radius: 25px; overflow: hidden"
                        class="right-item grid-item shadow d-flex align-items-center justify-content-center">
                        <h3 class="position-absolute text-white" style="z-index: 2; text-shadow: 1px 1px black"><?= $dataServices[4]['name'] ?><?php if($edit == true) { ?><i class="bi bi-pencil-square"></i><?php } ?></h3>
                        <img src="IMAGE/<?= $dataServices[4]['background'] ?>" class="w-100 h-100" alt="">
                    </div>
                </div>
            </div>
            <!-- <div class="position-relative bg-light justify-content-center w-100 gap-4 d-flex flex-wrap"
                style="height:fit-content; top: -100px; padding: 25px; padding-top: 100px;">
                <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                    <div id="eventCons" class="border rounded shadow"
                        style="height: 200px; width: 300px; user-select: none; cursor: pointer">
                        <div id="eventName" class="w-100 h-100 d-flex align-items-center justify-content-center position-absolute" style="z-index: 10">
                            <h5 class="text-center ps-2 pe-2 p-2 rounded-pill" style="width: fit-content"><?= $data['name'] ?></h5>
                        </div>
                        <img src="IMAGE/<?= empty($data['image']) ? 'noimage.jpg' : $data['image'] ?>" class="w-100 h-100" alt="">
                    </div>
                <?php } ?>
            </div> -->
        </div>
    </section>
    <section class="section4">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center"
            style="min-height: 100vh; height: fit-content;">
            <!-- <div class="w-100 w-md-50 h-100 bg-warning">
                <img src="IMAGE/Picture3.jpg" class="w-100 h-100" alt="">
            </div> -->
            <div class="w-100 w-md-50 h-100">
                <div class="slider-container1">
                    <div id="sliderWrapper1" class="slider-wrapper1">
                        <img src="IMAGE/background.jpg" alt="Image 1" class="active">
                        <img src="IMAGE/background2.jpg" alt="Image 2" class="next">
                        <img src="IMAGE/background3.jpg" alt="Image 3" class="next">
                    </div>
                </div>
            </div>
            <div class="w-100 w-md-50 h-100 bg-white">
                <h1 class="ps-4 pe-4" style="font-family: Arial; font-weight: bolder; font-size: 5vw">Online Order and
                    Food
                    Delivery!</h1>
                <p class="ps-4 pe-4" style="text-indent: 50px; text-align: justify">Lorem ipsum dolor sit amet,
                    consectetur
                    adipiscing elit. Aenean dictum lacus sed mauris dignissim, vitae eleifend magna consequat. Curabitur
                    aliquam mattis magna a suscipit. Morbi dapibus nec nulla posuere euismod. Curabitur non arcu
                    pretium, pretium augue ac, porta nisi. Nulla ac elit ut quam volutpat luctus at id enim. Ut pharetra
                    metus id mi volutpat luctus. Fusce ut augue dui. Aenean viverra tempus magna, quis congue nisl
                    sollicitudin quis. Maecenas porttitor sem ac sapien dapibus, ut condimentum tortor tincidunt. Duis
                    ut eros eget tortor ultricies bibendum. Etiam porttitor, enim ut pulvinar condimentum, leo enim
                    scelerisque elit, id ultricies lectus augue eu lacus. Nunc rhoncus purus porttitor, laoreet urna a,
                    egestas diam. Nulla semper maximus finibus. Morbi vel rutrum arcu, non aliquam nisi. Mauris a tortor
                    et sem malesuada laoreet ut ut dui.</p>
                <div class="ps-4 w-100 d-flex align-items-center justify-content-center">
                    <button class="btn btn-warning bg-lg w-50">Order Now!</button>
                </div>
            </div>
        </div>
    </section>
    <section id="gallerySection" class="section5">
        <div class="container-fluid d-flex align-items-center" style="height: fit-content; padding: 0;">
            <div class="row g-0 h-100 p-4">
                <h1 class="text-center">Gallery</h1>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                    <div class="img-container position-relative w-100 h-100">
                        <img src="IMAGE/Picture1.jpg" class="img-fluid w-100 h-100 object-fit-cover"
                            alt="Gallery Image 1">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                    <div class="img-container position-relative w-100 h-100">
                        <img src="IMAGE/Picture3.jpg" class="img-fluid w-100 h-100 object-fit-cover"
                            alt="Gallery Image 2">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                    <div class="img-container position-relative w-100 h-100">
                        <img src="IMAGE/Picture4.jpg" class="img-fluid w-100 h-100 object-fit-cover"
                            alt="Gallery Image 3">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                    <div class="img-container position-relative w-100 h-100">
                        <img src="IMAGE/Picture5.jpg" class="img-fluid w-100 h-100 object-fit-cover"
                            alt="Gallery Image 4">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                    <div class="img-container position-relative w-100 h-100">
                        <img src="IMAGE/Picture6.jpg" class="img-fluid w-100 h-100 object-fit-cover"
                            alt="Gallery Image 5">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center">
                    <div class="img-container position-relative w-100 h-100">
                        <img src="IMAGE/Picture7.jpg" class="img-fluid w-100 h-100 object-fit-cover"
                            alt="Gallery Image 6">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if($edit == true) { ?>
        <div class="section1EditModal" style="display: none">
            <div class="position-fixed bg-dark" style="opacity: 0.5; z-index: 999; width: 100%; height: 100vh; left: 0%; top: 0%;"></div>
            <div class="p-4 position-fixed bg-white border rounded shadow" style="left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 500px; height: fit-content;">
                <h5>Admin Edit</h5>
                <hr>
                <div>
                    <form id="section1Form" action="ADMINPHP/section1Edit.php" method="POST" class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column gap-2">
                            <label for="">Section 1 Title: </label>
                            <input name="title" type="text" class="form-control" value="<?= $dataSection1['title'] ?>" placeholder="Enter new page title...">
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <label for="">Section 1 Paragraph: </label>
                            <textarea name="description" rows="6" id="" class="form-control" style="text-align: justify"><?= $dataSection1['description'] ?></textarea>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="d-flex gap-2">
                    <button class="btn btn-danger" onclick="closeSection1Edit()">Close</button>
                    <button type="submit" form="section1Form" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php include 'newMessage.php' ?>
    <?php include 'newFooter.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="JS/newHeader.js"></script>
    <script>


        function toSection1() {
            const section2 = document.getElementById('section2');
            document.querySelector('#section2').scrollIntoView({ behavior: 'smooth' });
            console.log('asd');
            // Add fade-up animation after scrolling to section 2
            section2.classList.add('fade-up');
        }

        function toSection2() {
            const section2 = document.getElementById('section1');
            section2.scrollIntoView({ behavior: 'smooth' });

        }




        document.addEventListener('DOMContentLoaded', function () {
            const sliderWrapper = document.getElementById('sliderWrapper');
            const sliderWrapper1 = document.getElementById('sliderWrapper1'); // Corrected ID selector
            const images = sliderWrapper.querySelectorAll('img');
            const images1 = sliderWrapper1.querySelectorAll('img');
            const numImages = images.length;
            const numImages1 = images1.length;

            let currentIndex = 0;
            let currentIndex1 = 0;

            function changeImage() {
                const prevIndex = currentIndex;
                currentIndex = (currentIndex + 1) % numImages;

                images[prevIndex].classList.remove('active');
                images[prevIndex].classList.add('next');

                images[currentIndex].classList.add('active');
                images[currentIndex].classList.remove('next');
            }

            function changeImage1() {
                const prevIndex1 = currentIndex1;
                currentIndex1 = (currentIndex1 + 1) % numImages1;

                images1[prevIndex1].classList.remove('active');
                images1[prevIndex1].classList.add('next');

                images1[currentIndex1].classList.add('active');
                images1[currentIndex1].classList.remove('next');
            }

            setInterval(changeImage, 5000);
            setInterval(changeImage1, 5000);

            window.addEventListener('scroll', function () {
                const scrollPosition = window.pageYOffset;
                const translateY = scrollPosition * 0.5;
                const scale = 1 + (scrollPosition / 1000); // Adjust the scaling factor as needed

                sliderWrapper.style.transform = `translateY(${translateY}px) scale(${scale})`;
            });

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
        });

        var currentMonth;
        var currentYear;
        var bookedDates = [];

        function createCalendar(year, month) {
            var currentDate = new Date(year, month - 1);
            var calendar = '<table>';
            calendar += '<h5 style="text-align: center; font-size: 24px; margin: 0; margin-top: 5px; margin-bottom: 5px">' + currentDate.toLocaleString('default', { month: 'long' }) + ' ' + year + '</h5>';
            calendar += '<thead><tr><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr></thead>';
            calendar += '<tbody>';

            var startDay = new Date(year, month - 1, 1).getDay();
            var numDays = new Date(year, month, 0).getDate();

            var day = 1;
            for (var i = 0; i < 6; i++) {
                calendar += '<tr>';
                for (var j = 0; j < 7; j++) {
                    if (i === 0 && j < startDay) {
                        calendar += '<td></td>';
                    } else if (day > numDays) {
                        break;
                    } else {
                        var dateStr = year + "-" + ("0" + month).slice(-2) + "-" + ("0" + day).slice(-2);
                        if (bookedDates.includes(dateStr)) {
                            calendar += '<td style="background-color: orange;">' + day + '</td>';
                        } else {
                            calendar += '<td>' + day + '</td>';
                        }
                        console.log(bookedDates);
                        console.log(dateStr);
                        day++;
                    }
                }
                calendar += '</tr>';
            }
            calendar += '</tbody></table>';

            return calendar;
        }

        function showCalendar() {
            document.getElementById('calendar').innerHTML = createCalendar(currentYear, currentMonth);
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }
            showCalendar();
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            showCalendar();
        }

        function fetchBookedDates() {
            $.ajax({
                url: 'PHP/fetchbookedData.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    bookedDates = data.map(function (date) {
                        return date.trim(); // Remove any leading/trailing spaces
                    });
                    showCalendar();
                    console.log(bookedDates);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching booked dates:', error);
                }
            });
        }

        // Initialize calendar with current month
        var today = new Date();
        currentMonth = today.getMonth() + 1;
        currentYear = today.getFullYear();
        fetchBookedDates();

        <?php if($edit == true) { ?>
            function section1Edit() {
                $('.section1EditModal').css('display', 'block');
            }

            function closeSection1Edit() {
                $('.section1EditModal').css('display', 'none');
            }
        <?php } ?>
    </script>

</body>

</html>