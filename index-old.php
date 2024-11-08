<?php include 'header.php'; ?>
<title>ACE Catering</title>
<link rel="stylesheet" href="CSS/index12.css">
<style>
    .sec-1 {
        background-image: url('IMAGE/background.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Set the background attachment to fixed for the parallax effect */
        background-size: cover;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #ffffff;
    }
</style>
<section class="sec-1">
    <h1 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">CREATING UNFORGETTABLE MEMORIES</h1>
    <?php if(!isset($_SESSION['login']) AND !isset($_SESSION['admin'])) {
        echo '<button id="signup" class="btn btn-primary btn-lg">Sign Up</button>';
    } ?>
</section>

<section class="sec-2">
    <h1>ABOUT US</h1>
    <p>This is a testimonial, this section will have a slogan that says something nice about you and your services.</p>
    <a href="about.php">DISCOVER</a>
</section>
<section class="sec-3">
    <div>
        <h1>S E R V I C E S</h1>
        <p>Let us turn your dreams into realty</p>
        <a href="services.php">DISCOVER</a>
    </div>
</section>
<section class="sec-4">
    <div>
        <h1>G A L L E R Y</h1>
        <p>Unforgettable Memories</p>
        <a href="">D I S C O V E R</a>
    </div>
</section>
<div class="bottom-panel"></div>
<script>
    var signup = document.getElementById('signup');
    signup.addEventListener('click', function() {
        window.location.href = "login.php?signup";
    });

    // Adjust the background position for the parallax effect
    window.addEventListener('scroll', function() {
        var scrolled = window.scrollY;
        var sec1 = document.querySelector('.sec-1');
        sec1.style.backgroundPositionY = -scrolled * 0.5 + 'px'; // Adjust the speed of parallax scrolling here
    });
</script>
<script src="JS/index.js"></script>
<?php include 'footer.php'; ?>
