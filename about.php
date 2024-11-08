<?php
include 'INCLUDE/login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT US</title>
    <link rel="stylesheet" href="CSS/aboutx.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
</head>

<body>
    <?php include 'newHeader.php'; ?>
    <section>
        <div class="position-static">
            <div class="d-flex p-4 align-items-center justify-content-center" style="height: 100vh">
                <?php if(isset($_SESSION['admin'])) { ?>
                    <i onclick="openSection1()" class="position-absolute bi bi-pencil-square text-success" style="cursor: pointer; user-select: none; top: 35%; font-size: 24px"></i>
                <?php } ?>
                <div>
                    <h1 class="text-center text-warning">ABOUT US</h1>
                    <p class="text-center">This is a testimonial, this section will have a slogan that says something nice about you and your
                        services.</p>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center" style="height: 100vh">
                <div class="w-100 w-md-50 h-100 p-4 d-flex align-items-center justify-content-center">
                    <img src="IMAGE/picture1.jpg" class="w-100" alt="">
                </div>
                <div
                    class="w-100 w-md-50 h-100 bg-white p-4 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="text-center">Making Dreams Come True</h1>
                    <p style="font-size: 20px; text-align: justify">ACE catering is committed to making dreams come true
                        through exceptional service and culinary expertise by partnering with top-notch chefs and
                        utilizing the finest quality ingredients, Ace catering consistently delivers exquisite menus
                        that cater to a diverse range of tastes and dietary preferences , ensuring that every guest is
                        satisfied and delighted with their dining experience.</p>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center" style="height: 100vh">
                <div id="secondRow" class="order-1 order-md-2 w-100 w-md-50 h-100 p-4 d-flex align-items-center justify-content-center">
                    <img src="IMAGE/picture2.jpg" class="w-100" alt="">
                </div>
                <div id="firstRow" class="order-2 order-md-1 w-100 w-md-50 h-100 bg-white p-4 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="text-center">Turning a Vision into a Reality</h1>
                    <p style="font-size: 20px; text-align: justify">
                        Effective leaders in ACE Catering understand the importance of turning their vision into reality.
                        They know that simply having a vision is not enough; it must be accompanied by both short- and
                        long-term goals. These goals serve as a roadmap for achieving the vision and provide direction
                        for the organization. Furthermore, effective leaders also inspire and share the vision with
                        their team. They understand that a shared vision is crucial in rallying people and
                        organizational systems behind the unified goal.
                    </p>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center" style="height: 100vh">
                <div class="w-100 w-md-50 h-100 p-4 d-flex align-items-center justify-content-center">
                    <img src="IMAGE/picture3.jpg" class="w-100" alt="">
                </div>
                <div
                    class="w-100 w-md-50 h-100 bg-white p-4 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="text-center">A Perfectionist on Every Detail</h1>
                    <p style="font-size: 20px; text-align: justify">ACE Catering strives for excellence in every aspect of their service, ensuring that each detail
                    is handled with precision and attention to enhance the overall dining experience.</p>
                </div>
            </div>
        </div>
        <?php if(isset($_SESSION['admin'])) { ?>
            <div class="section1About" style="display: none">
                <div class="bg-dark position-fixed h-100 w-100" style="opacity: 0.5; z-index: 999; left: 0%; top: 0%"></div>
                <div class="position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="z-index: 1000; left: 0%; top: 0%">
                    <div class="border bg-white p-4" style="width: 500px; height: fit-content;">
                        <h5>Admin Edit</h5>
                        <hr>
                        <div>
                            <form action="" class="d-flex flex-column gap-2">
                                <div class="d-flex flex-column gap-1">
                                    <label for="" class="form-label">About Title: </label>
                                    <input type="text" class="form-control" placeholder="Enter to change the about us title...">
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <label for="" class="form-label">About Description: </label>
                                    <textarea name="" class="form-control" rows="6" id="" placeholder="Enter to change description..."></textarea>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="d-flex gap-2">
                            <button onclick="closeSection1()" class="btn btn-danger">Close</button>
                            <button class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <?php include 'newMessage.php'; ?>
    <?php include 'newFooter.php'; ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="JS/newHeader.js"></script>
<script>
    <?php if(isset($_SESSION['admin'])) { ?>
        function openSection1() {
            $('.section1About').css('display', 'block');
        }

        function closeSection1() {
            $('.section1About').css('display', 'none');
        }
    <?php } ?>
</script>
</html>