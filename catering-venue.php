<?php
include 'INCLUDE/login.php';

// Initial query for displaying all venues
$query = mysqli_query($conn, "SELECT * FROM catering_venue");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take a look at our Bundle!</title>
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
            background-image: url('IMAGE/background.jpg');
            background-size: cover;
            background-attachment: fixed;
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
        .venueDesign {
            cursor: pointer;
            overflow: hidden;
        }
        .venueDescription {
            display: none;
        }
        .venueDesign .background-blur {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            filter: blur(3px) brightness(70%);
            z-index: 1;
            transition: 0.5s;
        }
        .venueDesign:hover .background-blur {
            filter: blur(0px) brightness(100%);
        }
        .venueDesign:hover .venueImage {
            display: none;
        }
        .venueDesign:hover .venueDescription {
            display: block;
        }
        .venueDesign .d-flex {
            z-index: 2;
        }
    </style>
</head>

<body>
    <?php include 'newHeader.php'; ?>
    <section>
        <div class="parallax">
            <div class="parallax-content d-flex align-items-center justify-content-center">
                <div class="p-4">
                    <h2 class="text-center" style="text-shadow: 1px 1px black; padding-left: 10%; padding-right: 10%">
                        Let us help you discover the ideal venue from our selection of accredited locations, each ready
                        to host your dream event.</h2>
                </div>
            </div>
        </div>
        <div class="d-flex border-bottom bg-light ps-4 pe-4 pt-3 pb-3" style="width: 100%; height: 75px">
            <div class="d-flex gap-0">
                <input id="searchInput" type="search" class="form-control rounded-pill rounded-end m-0" placeholder="Location or Name Venue..." style="width: 250px">
                <button id="searchButton" class="btn btn-outline-success rounded-pill rounded-start m-0">Submit</button>
            </div>
        </div>
        <div class="p-4" style="min-height: 100vh">
            <div class="p-4 d-flex flex-wrap gap-4 justify-content-center venue-container">
                <?php while($data = mysqli_fetch_assoc($query)) { ?>
                    <div onclick="window.location.href = 'venue-detail.php?venue=<?= $data['name'] ?>'" class="venueDesign bg-white border shadow d-flex align-items-center justify-content-center position-relative"
                        style="border-radius: 25px; width: 400px; height: 400px">
                        <div class="background-blur" style="background-image: url('IMAGE/<?= $data['image'] ?>');"></div>
                        <div class="venueImage">
                            <div class="d-flex flex-column position-relative">
                                <h4 class="text-center text-white"><?= $data['name'] ?></h4>
                                <h5 class="text-center text-white"><?= $data['location'] ?></h5>
                                <h5 class="text-center text-white"><?= $data['pax'] ?> pax</h5>
                                <button class="btn btn-outline-light btn-lg rounded-pill">LEARN MORE</button>
                            </div>
                        </div>
                        <div class="venueDescription p-2" style="z-index: 3">
                            <h5 class="text-white text-center"><?= $data['description'] ?></h5>
                        </div>
                    </div>
                <?php } ?>    
            </div>
        </div>
    </section>
    <?php include 'newMessage.php'; ?>
    <?php include 'newFooter.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="JS/newHeader.js"></script>
    <script>
        $(document).ready(function() {
            function searchVenues() {
                var searchQuery = $('#searchInput').val();

                $.ajax({
                    url: 'PHP/searchVenue.php',
                    method: 'GET',
                    data: { search: searchQuery },
                    success: function(response) {
                        $('.venue-container').html(response);
                    }
                });
            }

            $('#searchButton').click(function(e) {
                e.preventDefault();
                searchVenues();
            });

            $('#searchInput').keyup(function(e) {
                if (e.keyCode === 13) {
                    searchVenues();
                }
            });
        });
    </script>
</body>

</html>
