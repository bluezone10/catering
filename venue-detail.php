<?php
include 'INCLUDE/login.php';
include 'config.php';  

$event = $_GET['venue'];

$query = mysqli_query($conn, "SELECT * FROM catering_venue WHERE name='$event'");

if(mysqli_num_rows($query) < 1) {
    header('location: ../catering-venue.php');
    exit();
} else {
    $row = mysqli_fetch_assoc($query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['name'] ?> Venue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .parallax {
            background-image: url('IMAGE/<?= $row['image'] ?>');
            background-size: cover;
            background-position: center;
            height: 100vh;
            width: 100%;
            position: relative;
        }

        .parallax-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 20px;
            height: 100%;
        }

        #map {
            min-height: 100vh;
            width: 100%;
        }

        .image-container {
            width: 300px;
            height: 250px;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
            cursor: pointer;
        }
        
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the image covers the container */
            transition: 0.5s ease-in-out;
        }

        .container-wrapper {
            min-height: 100vh;
            padding: 4rem;
        }

        .image-container:hover img {
            scale: 1.75;
        }
    </style>
</head>
<body>
    <?php include 'newHeader.php'; ?>
    <section>
        <div class="parallax">
            <div class="parallax-content d-flex align-items-center justify-content-center">
                <div class="p-4" style="padding-left: 10%; padding-right: 10%">
                    <h2 class="text-center" style="text-shadow: 1px 1px black;"><?= $row['name'] ?></h2>
                    <h5 class="text-center" style="padding-left: 5%; padding-right: 5%; letter-spacing: 2px; line-height: 1.5; text-shadow: 1px 1px black">
                        <?= empty($row['description']) ? '' : $row['description'] ?>
                    </h5>
                </div>
            </div>
        </div>
        <div id="overview" class="d-flex flex-column w-100" style="height: fit-content; padding-bottom: 50px">
            <div class="border-bottom d-flex flex-wrap ps-4 pe-4 bg-light w-100 align-items-center justify-content-center gap-0" style="min-height: 75px">
                <div onclick="scrollToSection('overview')" class="p-4" style="cursor: pointer">
                    <h5 class="text-secondary">Overview</h5>
                </div>
                <div onclick="scrollToSection('map')" class="p-4" style="cursor: pointer">
                    <h5 class="text-secondary">Map</h5>
                </div>
                <div onclick="scrollToSection('gallery')" class="p-4" style="cursor: pointer">
                    <h5 class="text-secondary">Gallery</h5>
                </div>
            </div>
            <div class="p-4">
                <h2 class="text-center">Mall of Asia Overview</h2>
            </div>
            <div class="d-flex gap-4 justify-content-center mt-4 flex-wrap">
                <div class="border pt-4" style="background-color: whitesmoke; width: 400px; height: 300px; border-radius: 25px">
                    <h3 class="text-center">Function Type</h3>
                    <div>
                        <li class="text-center" style="list-style-type: none; font-size: 20px">Air-conditioned</li>
                    </div>
                </div>
                <div class="border pt-4" style="background-color:whitesmoke; width: 400px; height: 300px; border-radius: 25px">
                    <h3 class="text-center">Ideal for</h3>
                    <div>
                        <li class="text-center" style="list-style-type: none; font-size: 20px">Wedding</li>
                        <li class="text-center" style="list-style-type: none; font-size: 20px">Kids Party</li>
                        <li class="text-center" style="list-style-type: none; font-size: 20px">Corporate</li>
                    </div>
                </div>
                <div class="border pt-4" style="background-color:whitesmoke; width: 400px; height: 300px; border-radius: 25px">
                    <h3 class="text-center">Capacity</h3>
                    <div>
                        <li class="text-center" style="list-style-type: none; font-size: 20px">100 - 500 pax</li>
                    </div>
                </div>
            </div>
        </div>
        <div id="map"></div>
        <div id="gallery" class="container-wrapper">
            <h2 class="text-center">Venue Gallery</h2>
            <div class=" d-flex justify-content-center">
                <div id="imageClicking" class="image-container border bg-light">
                    <img id="imageClicking1" src="IMAGE/Picture3.jpg" onclick="viewImage('Picture4.jpg')" alt="Example Image">
                </div>
            </div>
         
        </div>
        <div id="imageViewer" class="border rounded bg-white" style="display: none; width: 600px; height: 500px;position: fixed; left: 50%; top: 50%; transform: translate(-50%, -50%)">
            <img id="imageData" src="IMAGE/Picture3.jpg" class="w-100 h-100" style="object-fit: cover" alt="Example Image">
            <button onclick="closeViewImage()" class="position-absolute btn btn-danger d-flex align-items-center justify-content-center" style="right: 10px; top: 10px; width: 25px; height: 25px"><i class="bi bi-x"></i></button>
        </div>
    </section>
    <?php include 'newMessage.php'; ?>
    <?php include 'newFooter.php'; ?>

    <!-- Define initMap function before loading the Google Maps API -->
    <script>
        function initMap() {
            const location = { lat: <?= $row['latitude'] ?>, lng: <?= $row['longitude'] ?> }; // Example: Makati, Philippines
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: location,
            });
            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        function viewImage(image) {
            $('#imageData').attr('src', 'IMAGE/' + image);
            $('#imageViewer').show();
        }

        // Function to hide the image viewer
        function closeViewImage() {
            $('#imageViewer').hide();
            $('#imageData').attr('src', '');
        }

        function scrollToSection(sectionId) {
            var elem = document.getElementById(sectionId);
            elem.scrollIntoView({ behavior: 'smooth' });
        }



        $(document).ready(function() {
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#imageClicking', '#imageClicking1').length) {
                    closeViewImage();
                    console.log('Image viewer closed');
                } 
            });

            // Prevent closing when clicking inside the image viewer
            $('#imageViewer').on('click', function(event) {
                event.stopPropagation();
            });
        });

   
       
    </script>

    <!-- Load the Google Maps API script with async and defer attributes -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="JS/newHeader.js"></script>
</body>
</html>
