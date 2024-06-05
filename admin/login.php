    <?php require_once('../config.php');
    require_once('Login.php'); // Include the Login class file
    ?>
    <!DOCTYPE html>
    <html lang="en" class="" style="height: auto;">
    <?php require_once('inc/header.php') ?>


    

    <body class="hold-transition login-page bg-black" style="overflow: hidden;">
    

    <style>

.animated-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
}

.animated-text h2,
.animated-text p {
    overflow: hidden; /* Ensures text is not visible until animation starts */
    white-space: nowrap; /* Ensures text doesn't wrap */
    
}
.animated-text h2 {
    animation: typing-h2 3s steps(40, end) forwards; /* Adjust timing as needed */
}

.animated-text p:nth-of-type(1) {
    animation: typing-p1 6s steps(40, end) forwards; /* Adjust timing as needed */
}

.animated-text p:nth-of-type(2) {
    animation: typing-p2 8s steps(40, end) forwards; /* Adjust timing as needed */
}
@keyframes typing-h2 {
    from {
        width: 0; /* Start with 0 width */
    }
    to {
        width: 100%; /* End with full width */
    }
}

@keyframes typing-p1 {
    0% {
        width: 0; /* Start with 0 width */
    }
    50% {
        width: 0; /* Stay at 0 width for first 50% of animation */
    }
    to {
        width: 100%; /* End with full width */
    }
}
@keyframes typing-p2 {
    0% {
        width: 0; /* Start with 0 width */
    }
    75% {
        width: 0; /* Stay at 0 width for first 75% of animation */
    }
    to {
        width: 100%; /* End with full width */
    }
}

/* @keyframes typing {
    from {
        width: 0; 
    }
    to {
        width: 100%; 
    }
} */


</style>
        <script>
            start_loader()
        </script>

        <main class="d-flex">
            <div class="login-box _form w-100 mx-4">
                <div class="row" style="height: 100vh;">
                    <!-- Image column -->
                    <div class="col-md-6 d-none d-md-block" style="position: relative; overflow: hidden; height: 100vh; margin-left: -5%;">
                        <img src="../assets/images/logImg.jpg" class="img-fluid" alt="Login Image" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.1;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #FFFFFF;">
                            <div class="animated-text">
                            <h2 style="font-size: 3rem; margin-bottom: 1rem;">Welcome to BuddyGet</h2>
                                <p style="font-size: 2rem;">Savings Management System</p>
                                <p style="font-size: 1.1rem;">"Where every penny counts towards your dreams"</p>

                        </div>
                    </div>
                </div>
                    <!-- Login form column -->
                    <!-- <div class="col-md-6" style="margin-top: 20vh; margin-left: auto;"> -->
                    <div class="col-md-6 align-items-center justify-content-center"  style="margin-top: 30vh; margin-left: auto; height: 100vh;">
                    <!-- <div class="w-100" style="margin-top: 20vh; margin-left: 5%;"> -->
                        <!-- <h2 class="text-center mb-4 pb-3">Login to BuddyGet</h2> -->
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                            <p class="login-box-msg text-dark" style="font-size: 20px; font-weight: bold;">Login to access your account</p>

                                <form id="login-frm" action="" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 position-relative">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-eye-slash toggle-password"></span>
                                            </div>
                                        </div>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" value="login" class="btn btn-primary btn-block" style="font-weight: bold">Login</button>
                                    <div class="row justify-content-center">
                                    <p class="text-dark mt-2 d-block mx-auto">Don't have an account? <span><a href="./register.php" style="font-weight: bold;">Sign Up</a></span>

                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </main>

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>

        <script>
            $(document).ready(function() {
                end_loader();
            })
            $(document).ready(function() {
                $('.toggle-password').click(function() {
                    $(this).toggleClass('fa-eye fa-eye-slash');
                    var input = $($(this).closest('.input-group').find('input'));
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                    } else {
                        input.attr('type', 'password');
                    }
                });
            });
        </script>
    </body>

    </html>
