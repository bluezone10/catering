<?php
include 'header.php';
$query = mysqli_query($conn, "SELECT * FROM eventcategory");
?>
<title>ACE Services</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .carousel-item {
        height: calc(100vh - 115px);
    }

    .carousel-item .container {
        height: 100%;
    }
</style>
<section>
    <div id="servicesCarousel" style="margin-top: 100px" class="carousel slide" data-ride="carousel"
        data-interval="false">
        <div class="carousel-inner">
            <?php
            $first = true;
            while ($data = mysqli_fetch_assoc($query)) {
                $where = $data['name'];
                $query1 = mysqli_query($conn, "SELECT * FROM event WHERE type_event='$where'");
                $count = mysqli_num_rows($query1);
                ?>
                <div class="carousel-item <?php if ($first) {
                    echo 'active';
                    $first = false;
                } ?>">
                    <div class="container">
                        <div class="h-100 w-100">
                            <h2 class="text-center mt-2">SERVICES</h2>
                            <h5 class="text-center"><?= $data['name'] ?></h5>
                            <div class="d-flex align-items-center justify-content-around flex-wrap gap-4">
                                <?php if ($count >= 1) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($query1)) { ?>
                                        <div class="border shadow rounded p-4" style="width: 350px; height: 400px">
                                            <h5><?= $row['event_name'] ?></h5>
                                            <hr>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img style="height: 100px" src="ADMIN/IMAGE/EVENT/<?= $row['image'] ?>" alt="">
                                            </div>
                                            <hr>
                                            <p class="text-justify"><?= $row['description'] ?></p>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="border shadow rounded p-4" style="width: 350px; height: 400px">
                                        <h5>Coming Soon!</h5>
                                        <hr>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="text-center" style="font-size: 24px">Coming Soon!</p>
                                        </div>
                                        <hr>
                                        <p class="text-center" style="font-size: 24px">Coming Soon!</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <a class="carousel-control-prev bg-secondary" style="opacity: 0.2; width: 50px" href="#servicesCarousel"
            role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next bg-secondary" style="opacity: 0.2; width: 50px" href="#servicesCarousel"
            role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include 'footer.php'; ?>