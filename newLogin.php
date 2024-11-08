<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/newHeaders.css">
    <style>

    </style>
</head>

<body>
    <?php include 'newHeader.php' ?>
    <section>
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center" style="height: calc(100vh - 90px)">
            <div class="w-100 w-md-50 h-100 bg-white d-flex align-items-center justify-content-center">
                <div class="p-4 w-100">
                        <h3>Login Form</h3>
                        <form action="" class="d-flex flex-column gap-4 p-4 justify-content-center">
                            <div class="w-100">
                                <label for="">Username</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="w-100">
                                <label for="">Password</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="d-flex">
                                <div class="w-50">
                                    <input type="checkbox" class="form-check-input">
                                    <label for="">Show Password</label>
                                </div>
                                <div class="w-50">
                                    <a href="" class="float-end" style="text-decoration: none">Forgot Password</a>
                                </div>
                            </div>
                            <div class="w-100">
                                <button class="btn btn-warning w-100">Login</button>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="w-100 w-md-50 h-100 bg-secondary">
           
            </div>
        </div>
    </section>
    <?php include 'newMessage.php' ?>
    <?php include 'newFooter.php' ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="JS/newHeader.js"></script>
<script>

</script>

</html>