<?php
include 'INCLUDE/login.php';
include 'PHP/security.php';
$title = $_SESSION['selectedEventData']['eventTitle'];
$package = $_SESSION['selectedEventData']['package'];
$services1 = mysqli_query($conn, "SELECT * FROM services");
$packageItem = mysqli_query($conn, "SELECT * FROM packageItem WHERE services='$title' AND package='$package'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHEDULE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
    <link rel="stylesheet" href="CSS/newHeads.css">
    <style>
        .booked {
            background-color: #FFA500;
            /* Orange color */
            cursor: not-allowed;
        }

        .navigation-buttons {
            position: static;
            top: 50%;
            transform: translateY(-50%);
        }

        #prevButton {
            left: 20px;
        }

        #nextButton {
            right: 20px;
        }

        .calendar-container {
            margin: 0;
            margin-top: 100px;
            width: 100%;
            height: calc(100vh - 60px);
            display: flex;
            align-items: center;
        }

        .calendar-table {
            width: 80%;
            height: 50vh;
        }

        .calendar-table th,
        .calendar-table td {
            text-align: center;
            vertical-align: middle;
            width: calc(100% / 7);
            /* Divide the width equally among 7 columns */
            height: calc(100% / 6);
            /* Assuming a maximum of 6 rows in the calendar */
        }

        .other-month {
            color: #a9a9a9;
            /* Grey color for previous and next month dates */
        }

        .current-date {
            background-color: #ffcccc;
            /* Light red color for the current date */
        }

        #calendarCCC {
            flex-direction: row;
        }

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

        #reminderSection {
            display: none;
        }

        #reminderModal {
            z-index: 2;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -300%);
            width: 500px;
            height: fit-content;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(218, 172, 176, 1) 0%, rgba(237, 152, 60, 1) 0%, rgba(187, 146, 94, 1) 13%, rgba(228, 138, 145, 1) 54%, rgba(212, 118, 127, 1) 100%);
            animation: popUp 1s ease-out forwards;
        }

        @keyframes popUp {
            0% {
                opacity: 0;
                transform: translate(-50%, -300%);
            }

            40% {
                transform: translate(-50%, -50%);
            }


            60% {
                opacity: 1;
                transform: translate(-50%, -40%);
            }

            70% {
                transform: translate(-50%, -50%);
            }

            85% {
                transform: translate(-50%, -40%);
            }
            87.5% {
                transform: translate(-50%, -45%);
            }
            
            100% {
                transform: translate(-50%, -50%);
            }
        }


        @media screen and (max-width: 1000px) {
            .calendar-container {
                width: 100%;
            }

            .calendar-table {
                height: 50vh;
            }

            #calendarCCC {
                flex-direction: column;
            }
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
    <section style="margin-top: 40vh; padding-left: 5%; padding-right: 5%">
        <div id="calendarCCC" class="d-flex align-items-start justify-content-start gap-2"
            style="margin-top: 60px; min-height: 65vh">
            <div class="calendar-container d-flex" style="margin-top: 60px; height: fit-content">
                <div class="d-flex align-items-center pt-4 h-100 ps-2">
                    <button id="prevButton" type="button" class="btn btn-secondary navigation-buttons"
                        onclick="prevMonth()">&lt;</button>
                </div>
                <div class="w-100">
                    <div class="row mb-3 mt-1 pt-0">
                        <div class="col-12 text-start">
                            <span id="monthLabel" style="font-size: 24px; font-weight: bold"></span>
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered w-100 calendar-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                        </tr>
                                    </thead>
                                    <tbody id="calendarBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center h-100 pt-4">
                    <button id="nextButton" type="button" class="btn btn-secondary navigation-buttons"
                        onclick="nextMonth()">&gt;</button>
                </div>
            </div>
            <div class="w-100" style="padding: 25px; padding-top: 5%; padding-left: 10%;;height: fit-content">
                <h2>Booking Summary</h2>
                <div>
                    <select name="selectedEvents" class="form-select" id="selectedEvents" style="width: 250px">
                        <option value="">Select Event</option>
                        <option value="Single Event">Single Event</option>
                        <option value="Multi-Event">Multi-Event</option>
                    </select>
                </div>
                <div class="ps-4 mt-2">
                    <h5><?= $_SESSION['selectedEventData']['eventTitle'] ?></h5>
                    <p class="m-0"><?= $_SESSION['selectedEventData']['package'] ?></p>
                    <p class="m-0"><?= $_SESSION['selectedEventData']['quantity'] ?> pax</p>
                </div>
                <div class="ps-0 mt-2">
                    <h4>Order Summary</h4>
                    <div class="ps-2">
                        <ul>
                            <?php while ($data = mysqli_fetch_assoc($packageItem)) { ?>
                                <li><?= $data['name'] ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div id="listBookedDates" style="display: block">
                    <div>
                        <label for="" class="form-label">Booked Dates</label>
                        <ul>
                        </ul>
                    </div>
                    <div>
                        <button id="resetButton" class="btn btn-warning" onclick="resetBooking()">Reset Booking</button>
                        <button id="proceedButton" class="btn btn-warning" onclick="showReminderModal();">Proceed
                            Booking</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Book This Date?</h5>
                </div>
                <div class="modal-body">
                    <p id="modalDate"></p>
                    <div>
                        <label for="" class="form-label" id="ReminderDuration"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#bookModal').modal('hide')"
                        data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmBookingButton">Book</button>
                </div>
            </div>
        </div>
    </div>
    <section id="reminderSection" class="position-fixed w-100 h-100" style="left: 0; top: 0; z-index: 1000; display: none;">
        <div class="position-fixed w-100 h-100 bg-dark" style="left: 0; top: 0; opacity: 0.5; z-index: 1"></div>
        <div id="reminderModal" class="position-fixed bg-white p-4 rounded shadow" style="z-index: 2; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="alert alert-warning text-center">REMINDER!</div>
            <hr>
            <div class="text-center text-white">
                Do you want to add more items?
            </div>
            <hr>
            <div class="d-flex justify-content-between gap-2">
                <div>
                    <button class="btn btn-danger" id="cancelReminder">Cancel</button>
                </div>
                <div>
                    <button class="btn btn-primary" id="yesReminder">YES</button>
                    <button class="btn btn-success" id="noReminder">NO</button>
                </div>
            </div>
        </div>
    </section>
    <?php include 'newMessage.php' ?>
    <section id="contactSection" class="footerSection position-relative" style="margin-top: 0%; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(255, 255, 255, 0)), url('IMAGE/PRivate.jpg'); background-position: bottom; background-size: cover; min-height: 40vh; height: fit-content">
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

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const bookedDates = [];
    let selectedEventType = document.querySelector('#selectedEvents').value;
    let multiEventDaysSelected = [];

    const userBookedDate = [];
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();

    function fetchBookedDates() {

        $.ajax({
            url: 'PHP/fetchNewBooked.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                bookedDates.length = 0;

                $.each(data, function(index, item) {
                    bookedDates.push({
                        day: item.year,
                        month: item.month,
                        year: item.day
                    });

                });

                if (userBookedDate.length > 0) {
                    bookedDates.push(...userBookedDate);
                }

                console.log(bookedDates)

                generateCalendar(currentYear, currentMonth);
            },
            error: function(xhr, status, error) {
                console.log("An error occurred while fetching the data.");
                console.error("Error details: " + error);
            }
        });
    }


    console.log(bookedDates);

    function generateCalendar(year, month) {
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDay = new Date(year, month, 1).getDay();
        const prevMonthDays = new Date(year, month, 0).getDate();
        const calendarBody = document.getElementById('calendarBody');
        const monthLabel = document.getElementById('monthLabel');

        calendarBody.innerHTML = '';
        monthLabel.textContent = `${monthNames[month]} ${year}`;

        let row = document.createElement('tr');
        for (let i = 0; i < firstDay; i++) {
            let cell = document.createElement('td');
            let day = prevMonthDays - firstDay + i + 1;
            cell.textContent = day;
            cell.classList.add('other-month');
            if (isBooked(day, month, year)) {
                cell.classList.add('booked');
                cell.setAttribute('style', 'background-color: #FFA500');
                cell.onclick = null;
            } else {
                cell.onclick = function() {
                    showBookModal(day, month - 1, year);
                };
            }
            row.appendChild(cell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            let cell = document.createElement('td');
            cell.textContent = day;
            if (isBooked(day, month + 1, year)) {
                cell.classList.add('booked');
                cell.setAttribute('style', 'background-color: #FFA500');
                cell.onclick = null;
            } else {
                cell.onclick = function() {
                    showBookModal(day, month, year);
                };
            }
            if (isCurrentDate(day, month, year)) {
                cell.classList.add('current-date');
                cell.setAttribute('style', 'background-color: #ffcccc;');
            }
            row.appendChild(cell);
            if ((firstDay + day - 1) % 7 === 6) {
                calendarBody.appendChild(row);
                row = document.createElement('tr');
            }
        }

        let nextMonthDay = 1;
        while (row.children.length < 7) {
            let cell = document.createElement('td');
            cell.textContent = nextMonthDay++;
            cell.classList.add('other-month');
            if (isBooked(cell.textContent, month + 1, year)) {
                cell.classList.add('booked');
                cell.setAttribute('style', 'background-color: #FFA500');
                cell.onclick = null;
            } else {
                cell.onclick = function() {
                    showBookModal(cell.textContent, month + 1, year);
                };
            }
            row.appendChild(cell);
        }
        calendarBody.appendChild(row);
    }

    function isBooked(day, month, year) {
        return bookedDates.some(date => date.day === day && date.month === month && date.year === year);
    }

    function isCurrentDate(day, month, year) {
        const currentDate = new Date();
        return day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear();
    }

    function showReminderModal() {
        // Show the entire reminder section
        document.getElementById('reminderSection').style.display = 'block';
        $('#reminderModal').addClass('animate__animated animate__fadeIn'); // Optional animation
    }

    // Function to close the reminder modal
    function closeReminderModal() {
        $('#reminderModal').removeClass('animate__animated animate__fadeIn'); // Optional animation
        document.getElementById('reminderSection').style.display = 'none'; // Hide the section
    }

    // Event listeners for Cancel, Yes, and No buttons
    document.getElementById('cancelReminder').addEventListener('click', closeReminderModal);
    document.getElementById('yesReminder').addEventListener('click', function() {
        proceedBooking()
    });
    document.getElementById('noReminder').addEventListener('click', function(){
        proceedPayment();
    });


    function showBookModal(day, month, year) {
        const currentDate = new Date();
        const selectedDate = new Date(year, month, day);
        selectedEventType = document.querySelector('#selectedEvents').value;

        if (userBookedDate.length > 0) {
            alert("You have already booked a date. Please reset your booking to book again.");
            return;
        }

        if (selectedDate < currentDate) {
            alert("You cannot book a date in the past.");
            return;
        }

        if (selectedEventType == "Multi-Event") {
            reminder.textContent = "Duration (Select the next date after this)";
        }

        const modalDate = document.getElementById('modalDate');
        modalDate.textContent = `Are you sure you want to book ${year}-${pad(month + 1)}-${pad(day)}?`;
        document.getElementById('confirmBookingButton').onclick = function() {
            bookDate(day, month, year);
        };

        if (selectedEventType != "") {
            $('#bookModal').modal('show');
        } else {
            alert("Please select an Event to continue booking")
        }

    }

    

    // function bookDate(day, month, year) {
    //     const typeEvent = "<?= $_SESSION['selectedEventData']['type'] ?>";
    //     var numberOfDays = parseInt($('#numberOfDays').val());

    //     if(typeEvent == "Single Event") {
    //         numberOfDays = 1;
    //     } else {

    //     }

    //     if (isNaN(numberOfDays) || numberOfDays < 1) {
    //         alert("Please enter a valid duration.");
    //         return;
    //     }

    //     const bookedList = document.querySelector("#listBookedDates ul");
    //     bookedList.innerHTML = ""; 

    //     for (let i = 0; i < numberOfDays; i++) {
    //         let newDate = new Date(year, month + 1, day + i);
    //         const newDay = {
    //             day: newDate.getDate(),
    //             month: newDate.getMonth(),
    //             year: newDate.getFullYear()
    //         };

    //         userBookedDate.push(newDay);
    //         bookedDates.push(newDay);

    //         const li = document.createElement("li");
    //         li.textContent = `${monthNames[newDate.getMonth() - 1]} ${newDate.getDate()}, ${newDate.getFullYear()}`;
    //         bookedList.appendChild(li);
    //     }

    //     fetchBookedDates()
    //     console.log(userBookedDate);
    //     console.log(bookedDates);
    //     $('#bookModal').modal('hide');
    // }
    let reminder = document.getElementById('ReminderDuration');

    function bookDate(day, month, year) {
        selectedEventType = document.querySelector('#selectedEvents').value;
        reminder.textContent = "";
        if (selectedEventType === "Single Event") {
            addBookedDate(day, month, year, 1);
            $('#bookModal').modal('hide');
        } else if (selectedEventType === "Multi-Event") {
            if (multiEventDaysSelected.length === 0) {
                multiEventDaysSelected.push({
                    day,
                    month,
                    year
                });
                $('#bookModal').modal('hide');
            } else {
                let lastSelected = multiEventDaysSelected[multiEventDaysSelected.length - 1];
                let newDate = new Date(year, month, day);
                let lastDate = new Date(lastSelected.year, lastSelected.month, lastSelected.day);
                console.log(reminder.textContent);

                if (newDate > lastDate) {
                    multiEventDaysSelected.push({
                        day,
                        month,
                        year
                    });
                    if (multiEventDaysSelected.length === 2) {
                        // Proceed with booking the range of dates
                        let days = calculateDaysBetweenDates(multiEventDaysSelected[0], multiEventDaysSelected[1]);
                        addBookedDate(multiEventDaysSelected[0].day, multiEventDaysSelected[0].month, multiEventDaysSelected[0].year, days);

                        // Push all selected days to userBookedDate
                        pushDatesToUserBookedDate(multiEventDaysSelected[0], multiEventDaysSelected[1]);

                        multiEventDaysSelected = []; // Reset selection for next booking
                        $('#bookModal').modal('hide');
                    } else {
                        alert('Please select another date.');
                    }
                } else {
                    alert('Please select a date after the last one.');
                }
            }
        } else {
            alert('Please select an Event.');
        }
    }

    function calculateDaysBetweenDates(startDate, endDate) {
        let start = new Date(startDate.year, startDate.month, startDate.day);
        let end = new Date(endDate.year, endDate.month, endDate.day);
        return Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1; // Number of days between the two dates
    }

    function addBookedDate(day, month, year, numberOfDays) {
        selectedEventType = document.querySelector('#selectedEvents').value;
        const bookedList = document.querySelector("#listBookedDates ul");
        bookedList.innerHTML = "";
        let startDate = new Date(year, month, day);
        let endDate = new Date(year, month, day + numberOfDays - 1);

        for (let i = 0; i < numberOfDays; i++) {
            let newDate = new Date(year, month, day + i);
            const newDay = {
                day: newDate.getDate(),
                month: newDate.getMonth() + 1,
                year: newDate.getFullYear()
            };
            userBookedDate.push(newDay);
            bookedDates.push(newDay);
        }

        let formattedDateRange;

        if (selectedEventType == "Multi-Event") {
            formattedDateRange = `${monthNames[startDate.getMonth()]} ${startDate.getDate()}, ${startDate.getFullYear()} - ` +
                `${monthNames[endDate.getMonth()]} ${endDate.getDate()}, ${endDate.getFullYear()}`;

        } else {
            formattedDateRange = `${monthNames[startDate.getMonth()]} ${startDate.getDate()}, ${startDate.getFullYear()}`;
        }

        const li = document.createElement("li");
        li.textContent = formattedDateRange;
        bookedList.appendChild(li);

        fetchBookedDates();
    }


    // Function to push booked dates to userBookedDate array
    function pushDatesToUserBookedDate(startDate, endDate) {
        let start = new Date(startDate.year, startDate.month, startDate.day);
        let end = new Date(endDate.year, endDate.month, endDate.day);

        let currentDate = start;

        while (currentDate <= end) {
            let newDay = {
                day: currentDate.getDate(),
                month: currentDate.getMonth(),
                year: currentDate.getFullYear()
            };

            currentDate.setDate(currentDate.getDate() + 1);
        }

        console.log("User Booked Dates:", userBookedDate); // Log the updated userBookedDate array
    }



    function submitBookedDatesToServer(day, month, year, numberOfDays) {
        let bookedRange = [];
        for (let i = 0; i < numberOfDays; i++) {
            let newDate = new Date(year, month, day + i);
            bookedRange.push(`${newDate.getFullYear()}-${pad(newDate.getMonth() + 1)}-${pad(newDate.getDate())}`);
        }

        $.post('reservation.php', {
            bookedDates: bookedRange
        }, function(response) {
            console.log('Booking saved:', response);
        });
    }

    function resetBooking() {
        if (userBookedDate.length === 0) {
            alert("You haven't booked any date yet.");
            return;
        }

        // Remove each date from the bookedDates array that matches the user's booked dates
        userBookedDate.forEach(userDate => {
            const index = bookedDates.findIndex(
                bookedDate =>
                bookedDate.day === userDate.day &&
                bookedDate.month === userDate.month &&
                bookedDate.year === userDate.year
            );
            if (index !== -1) {
                bookedDates.splice(index, 1);
            }
        });

        console.log('Booking reset. Updated bookDates:', bookedDates);

        // Clear userBookedDate after resetting
        userBookedDate.length = 0;

        // Clear the list of booked dates
        const bookedList = document.querySelector("#listBookedDates ul");
        bookedList.innerHTML = "";

        fetchBookedDates()

        alert("Your booking has been reset. You can book again.");
    }

    function proceedBooking() {
        if (userBookedDate.length === 0) {
            alert("You need to select at least one date before proceeding.");
            return;
        }

    
            const form = document.createElement('form');
            form.action = 'reservation.php';
            form.method = 'POST';

            userBookedDate.forEach(date => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'bookedDate[]';
                input.value = `${date.year}-${pads(date.month)}-${pads(date.day)}`;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
       
    }

    function proceedPayment() {
        if (userBookedDate.length === 0) {
            alert("You need to select at least one date before proceeding.");
            return;
        }

  
            const form = document.createElement('form');
            form.action = 'reservation.php';
            form.method = 'POST';

            userBookedDate.forEach(date => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'bookedDate[]';
                input.value = `${date.year}-${pads(date.month)}-${pads(date.day)}`;
                form.appendChild(input);
            });

            const newINput = document.createElement('input');
            newINput.type = 'hidden';
            newINput.name = 'continuePayment';
            newINput.value = 'true'; 
            form.appendChild(newINput);
            
            document.body.appendChild(form);
            form.submit();
     
    }

    function pads(number) {
        return number < 10 ? '0' + number : number;
    }


    // function bookDate(day, month, year) {
    //     if (confirm("Do you want to book this date?")) {
    //         const selectedDate = `${year}-${pad(month + 1)}-${pad(day)}`;
    //         const form = document.createElement('form');
    //         form.method = 'POST';
    //         form.action = 'reservation.php';
    //         const input = document.createElement('input');
    //         input.type = 'hidden';
    //         input.name = 'bookedDate';
    //         input.value = selectedDate;
    //         form.appendChild(input);
    //         document.body.appendChild(form);
    //         form.submit();
    //     }
    // }

    function pad(num) {
        return num.toString().padStart(2, '0');
    }


    $(document).ready(function() {
        fetchBookedDates();
    });

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        fetchBookedDates()
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        fetchBookedDates()
    }
</script>

</html>