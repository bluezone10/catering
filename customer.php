<?php 
    include 'header.php'; 
    include 'INCLUDE/db_con.php';
    $name = $_SESSION['username'];
    $total = mysqli_query($conn, "SELECT sum(price * quantity) as total FROM cart WHERE username='$name'");
    $totalAssoc = mysqli_fetch_assoc($total);
    $totalPrice = $totalAssoc['total'];
    mysqli_close($conn);
    if(isset($_POST['payment'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $street = $_POST['street'];
        $start = $_POST['startTime'];
        $end = $_POST['endTime'];
        $end = date("h:i A", strtotime($end));
        $payment = $_POST['payment'];
    } else {
        header('location: reservation.php');
        exit();
    }
?>
<section>
    <title>Contact Information</title>
    <link rel="stylesheet" href="CSS/customerx.css">
    <div class="contactInformation">
        <h1>Customer Information</h1>
        <form id="contactForm" action="success.php" method="POST">
            <input type="text" name="address" value="<?= $address ?>" hidden>
            <input type="text" name="street" value="<?= $street ?>" hidden>
            <input type="text" name="time" value="<?= $start ?>" hidden>
            <input type="text" name="end" value="<?= $end ?>" hidden>
            <input type="text" name="payment" value="<?= $payment ?>" hidden>
            <label for="name">
                Name
            <input style="color: black" id="name" type="text" name="name" value="<?= $name ?>" readonly required>
            </label>
            <label for="">Email Address
            <input type="email" name="email" required placeholder="Email Address (Required)">
            </label>
            <label for="">Contact Number
            <input type="tel" pattern="^(09|\+639)\d{9}$" name="contact" required placeholder="+63 or (09123456789) (Required)">
            </label>
        </form>
    </div>
    <h1 class="summary">Payment Summary</h1>
    <div class="paymentSummary">
        <h2>Order Subtotal<span class="subtotal">₱ <?= $totalPrice; ?></span></h2>
        <h2>Reservation Fee<span class="subtotal">₱ 499</span></h2>
        <h2 style="color: green; font-size: 2vw">Total<span class="subtotal">₱ <?= $totalPrice + 499; ?></span></h2>
    </div>
    <div class="bottomContainer">
        <button onclick="window.location.href = 'reservation.php'">Return to Menu</button>
        <h2>Payment is to be discussed upon the call of the business owner</h2>
        <button type="submit" form="contactForm">Proceed</button>
    </div>
</section>
<?php include 'footer.php'; ?>