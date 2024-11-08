<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="CSS/login1s.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/newHeads.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        .loginContainer {
            width: 100%;
            min-height: 100vh;
            height: fit-content;
        }

        .loginFormContainer {
            width: 100vh;
            min-height: 60vh;
            height: fit-content;
        }

        #signUpText {
            color: #0d6efd;
        }

        #signUpText:hover {
            color: palevioletred;
        }

        .googleButton {
            color: #0d6efd;
            border: solid 0.1vh #0d6efd;
            transition: 0.5s ease-out;
        }

        .googleButton:hover {
            color: white;
            background-color: #0d6efd;
        }

        .emailCons {
            display: flex;
            flex-direction: row;
        }

        #loginDiv {
            width: 50%;
            transition: 1s;
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .asd {

            }
            .emailCons {
                flex-direction: column;
            }

            .loginFormContainer {
                flex-direction: column;
            }

            .loginFormContainer {
                min-height: 50vh;
                width: 100%;
            }

            #loginDiv {
                margin-top: 20%;
                margin-left: 0%;
                width: 100%;
                min-height: 70vh;
            }
        }

        @media (max-width: 767px) {
            .asd {
                
            }
            .emailCons {
                flex-direction: column;
            }

            .loginFormContainer {
                flex-direction: column;
            }

            .loginFormContainer {
                min-height: 50vh;
                width: 100%;
            }

            #loginDiv {
                margin-top: 20%;
                margin-left: 0%;
                width: 100%;
                min-height: 70vh;
            }
        }
    </style>
</head>

<body>
    <section class="emailSection" style="z-index: 1000">
        <div class="position-fixed bg-dark w-100 h-100" style="z-index: 9; left: 0; top: 0; opacity: 0.75"></div>
        <div class="emailContainer position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="z-index: 10; left: 0%; top: 0;">
            <div class="emailCons bg-white" style="min-width: 60%; min-height: 60%; max-width: 100%; max-height: 80%; overflow-y: auto">
                <div id="emailDiv" class="border-end w-50" style="background-image: url('IMAGE/PRivate.jpg'); background-size: cover; background-position: center">
                </div>
                <div id="emailDiv" class="border-end w-50 p-4" style="overflow-y: auto">
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
    <section class="navigation">
        <div class="topNav">
            <div class="locationLoginTopNav d-flex align-items-center justify-content-end pe-3">
                <?php if (isset($_SESSION['login']) and $_SESSION['login'] == true) { ?>
                    <div><i class="bi bi-bag text-white me-1"></i><span class="loginText">Shop</span></div>
                    <div><i class="bi bi-person text-white ms-2 me-1"></i><span class="loginText">Profile</span></div>
                    <div><i class="bi bi-box-arrow-left text-white ms-2 me-1"></i><span class="loginText" onclick="window.location.href = 'INCLUDE/logout.php?logout'">Logout</span></div>
                <?php } else { ?>
                    <div><i class="bi bi-person text-white me-1"></i><span class="loginText" onclick="loginForm()">Login</span> | <span class="signupText"  onclick="signUpForm()">Sign Up</span></div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section>
        <!-- Body Background of the Login Page -->
        <div class="bodyBackground"></div>
        <!-- Login Container -->
        <div class="loginContainer position-absolute d-flex align-items-center justify-content-center">
            <div class="loginFormContainer rounded shadow d-flex bg-white">
                <div id="loginDiv" class="loginDiv1 p-4 pt-0 d-flex align-items-center justify-content-center gap-2 flex-column" style="z-index: 5; background: rgb(0, 0, 0); background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(218, 172, 176, 1) 0%, rgba(237, 152, 60, 1) 0%, rgba(187, 146, 94, 1) 13%, rgba(228, 138, 145, 1) 54%, rgba(212, 118, 127, 1) 100%);">
                    <img src="IMAGE/acelogo.png" onclick="window.location.href = 'index.php'" class="rounded w-50 img-fluid" style="cursor: pointer; filter:brightness(80%)" alt="">
                    <h4 class="text-center text-dark" style="font-size: 3vh; text-shadow: 0px 0px 6px rgba(255,255,255,1); font-family: Brush Script MT, Brush Script Std, cursive">Aran Cristel Events & Catering Services</h4>
                    <h6 class="text-center text-dark" style="font-size: 2vh">Benitez Salazar St. Tubuan 1, Silang, Cavite</h6>
                    <h6 class="text-center text-dark" style="font-size: 2vh">09159559058/09268053199</h6>
                    <h6 class="text-center text-dark" style="font-size: 2vh">cristel_belen@yahoo.com</h6>
                    <button class="btn btn-outline-dark w-75" style="font-size: 2vh"  onclick="$('.emailSection').css('display', 'block')">INQUIRE NOW</button>
                </div>
                <!-- Login Form -->
                <div id="loginDiv" class="loginDiv2 loginFormBatch p-4 bg-white" style="z-index: 4">
                    <?php if(isset($_GET['error']) AND $_GET['error'] == "incorrect") { ?>
                    <div class="alertReminder alert alert-danger text-center">
                        Incorrect Username or Password!
                    </div>
                    <?php } elseif(isset($_GET['success']) AND $_GET['success'] == "accountcreated") { ?>
                    <div class="alertReminder alert alert-success text-center">
                        Successfully Created the Account!
                    </div>
                    <?php } ?>
                    <h5 class="text-center" style="font-size: 2.5vh">LOGIN FORM</h5>
                    <hr class="mt-4 mb-4 ">
                    <form action="INCLUDE/login.php" method="POST" class="ps-4 pe-4 d-flex flex-column gap-2">
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Username</label>
                            <input type="text" name="username" class="form-control border border-dark" placeholder="Enter your username...">
                        </div>
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Password</label>
                            <input id="passwordInput" name="password" type="password" class="form-control border border-dark" placeholder="Enter your password...">
                        </div>
                        <div>
                            <button class="btn btn-outline-dark w-100 mt-2" type="submit">LOGIN</button>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <div class="d-flex gap-2">
                                <input type="checkbox" id="showPasswordCheckbox" onchange="showPasswordCheck()" class="border border-dark form-check-input">
                                <span style="font-size: 2vh">Show Password</span>
                            </div>
                            <div style="flex: 1">
                                <a href="" class="float-end" id="signUpText" style="text-decoration: none; font-size: 2vh">Forgot Password</a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="d-flex flex-column align-items-center justify-content-center mt-4 w-100">
                        <a href="PHP/google-signin.php" class="rounded googleButton ps-3 pe-3 pt-1 pb-1" style="text-decoration: none"><i class="bi bi-google"></i> Sign in with Google</a>
                        <div class="mt-2">Doesn't Have Account? <span id="signUpText" class="" onclick="signUpForm()" style="cursor: pointer">Sign Up</span></div>
                    </div>
                </div>
                <!-- Sign Up Form -->
                <div id="loginDiv" class="loginDiv3 p-4 border rounded" style="max-height: 65vh; display: none; overflow-y: auto">
                    <h5 class="text-center">Sign Up Form</h5>
                    <hr>
                    <div class="text-center">Already Have an Account? <span id="signUpText" onclick="loginForm()" style="cursor: pointer">Login Now!</span></div>
                    <hr>
                    <form action="PHP/signUpForm.php" method="POST" class="ps-4 pe-4 d-flex flex-column gap-2" onsubmit="return validatePassword()">
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Username</label>
                            <input type="text" name="username" class="form-control border border-dark" placeholder="Enter your username..." required>
                        </div>
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">First Name</label>
                            <input type="text" name="firstName" class="form-control border border-dark" placeholder="Enter your first name..." required>
                        </div>
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Last Name</label>
                            <input type="text" name="lastName" class="form-control border border-dark" placeholder="Enter your last name..." required>
                        </div>
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Email</label>
                            <input type="email" name="email" class="form-control border border-dark" placeholder="Enter your email..." required>
                        </div>
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Password</label>
                            <input type="password" id="signUpPassword" name="password" class="form-control border border-dark" placeholder="Enter your password..." required>
                        </div>
                        <div>
                            <label for="" class="form-label" style="font-size: 2vh">Confirm Password</label>
                            <input type="password" id="signUpSecondPassword" name="secondPassword" class="form-control border border-dark" placeholder="Enter the password..." required>
                        </div>
                        <div>
                            <button class="btn btn-outline-dark w-100 mt-2" type="submit">SIGN UP</button>
                        </div>
                        <hr>
                        <div class="text-center">Already Have an Account? <span id="signUpText" onclick="loginForm()" style="cursor: pointer">Login Now!</span></div>
                        <hr>
                    </form>
                </div>
                <div class="p-4 bg-white w-50" style="display: none">
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Password should match this is for checking if the password is match
     function validatePassword() {
        const password = document.getElementById("signUpPassword").value;
        const secondPassword = document.getElementById("signUpSecondPassword").value;

        if (password !== secondPassword) {
            alert("Passwords do not match. Please try again.");
            return false;
        }
        return true;
    }
    // Feature of check box show password
    function showPasswordCheck() {
        let passwordInput = document.getElementById('passwordInput');
        let checkInput = document.getElementById('showPasswordCheckbox');

        if(checkInput.checked){
            passwordInput.setAttribute('type', 'text');
        } else {
            passwordInput.setAttribute('type', 'password');
        }
    }
    // Animation of the Sign Up Form
    function signUpForm() {
        let loginDiv1 = document.querySelector('.loginDiv1');
        let loginDiv2 = document.querySelector('.loginDiv2');
        let loginDiv3 = document.querySelector('.loginDiv3');

        loginDiv1.style.transform = "translateX(100%)";
        loginDiv2.style.transform = "translateX(-100%)";
   
        setTimeout(function () {
            loginDiv2.style.display = "none";
        }, 300);

        setTimeout(function () {
            loginDiv3.style.display = "block";
        }, 750);

        setTimeout(function () {
            loginDiv3.style.transform = "translateX(-100%)";
            loginDiv3.style.visibility = "visible";
        }, 800);

    }
    // Animation of the Login Form
    function loginForm() {
        let loginDiv1 = document.querySelector('.loginDiv1');
        let loginDiv2 = document.querySelector('.loginDiv2');
        let loginDiv3 = document.querySelector('.loginDiv3');

        loginDiv1.style.transform = "translateX(0%)";
        loginDiv3.style.transform = "translateX(0%)";
   
        setTimeout(function () {
            loginDiv3.style.display = "none";
        }, 300);

        setTimeout(function () {
            loginDiv2.style.display = "block";
        }, 750);

        setTimeout(function () {
            loginDiv2.style.transform = "translateX(0)";
            loginDiv2.style.visibility = "visible";
        }, 800);
    }

    setTimeout(function () { 
        const alertElement = document.querySelector('.alertReminder');
        if (alertElement) {
            alertElement.style.display = "none";
            var myNewURL = "catering/login.php";
            window.history.pushState("object or string", "Title", "/" + myNewURL );
        }
    }, 3000);

</script>

</html>