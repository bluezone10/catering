<?php 
    include 'header.php'; 
    include 'INCLUDE/db_con.php';
    $query = mysqli_query($conn, "SELECT * FROM gallery ORDER BY order_setup");
?>
<title>Gallery</title>
<link rel="stylesheet" href="CSS/galleryx.css">
<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
<div class="galleryContainer">
    <?php while($data = mysqli_fetch_assoc($query)) { ?>
    <div class="dataContainer">
        <div class="leftContainer">
            <div class="title"><h2><?= $data['event_name'] ?></h2></div>
            <div class="description"><p><?= $data['description'] ?></p></div>
        </div>
        <div class="rightContainer">
            <div id="wrapper" style="height:90%;width: 90%">
                <a-scene embedded style="height:100%; width:100%">
                    <a-sky src="ADMIN/IMAGE/GALLERY/<?= $data['image'] ?>" rotation="0 -90 0" radius="20"></a-sky>
                </a-scene>
            </div>
        </div>
    </div> 
    <?php } ?>
</div>

<?php include 'footer.php'; ?>