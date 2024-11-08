<?php 

    include 'header.php'; 
    $name = $_SESSION['username'];
    $result = mysqli_query($conn, "SELECT * FROM chat WHERE username='$name'");
?>
<link rel="stylesheet" href="CSS/contact.css">
<title>Contact Us!</title>
<section>
    <div class="contactContainer">
        <div class="dreams"></div>
        <div class="chatCons">
            <div class="chatPop" id="chatSo">
                <div class="messageBox" id="reply">
                    <div><p>Please do message us and we will get back to you shortly.</p></div>
                </div>
                <?php while($data = mysqli_fetch_assoc($result)) { ?>
                    <?php if(!empty($data['message'])) { ?>
                        <div class="messageBox" id="yourMessage">
                            <div><p><?= htmlspecialchars($data['message']) ?></p><span><?= $data['date'] ?></span></div>
                        </div>
                    <?php } else { ?>
                        <div class="messageBox" id="reply">
                            <div><p><?= htmlspecialchars($data['reply']) ?></p><span style="margin-top: 0.5%; left: 3.25%"><?= $data['date'] ?></span></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <form action="INCLUDE/message.php" method="POST">
                <input type="text" name="name" value="<?= $_SESSION['username']; ?>" hidden>
                <input type="text" name="message" placeholder="Send Message" autofocus>
                <button type="submit">SEND</button>
            </form>
        </div>
    </div>
    <div class="footer">

    </div>
    <script>
        var element = document.getElementById("chatSo");
        element.scrollTop = element.scrollHeight;
    </script>
</section>
<?php include 'footer.php'; ?>