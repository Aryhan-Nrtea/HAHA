<?php require_once('../config.php');
require_once('Login.php'); // Include the Login class file
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page bg-navy">
    <script>
        start_loader()
    </script>

    <main class="d-flex">
        <div class="login-box _form w-100 mx-4">
            <div class="row">
                <!-- Image column -->
                <div class="col-md-6 d-none d-md-block">
                    <img src="../assets/images/login-img.jpg" class="img-fluid" alt="Login Image">
                </div>
                <!-- Login form column -->
                <div class="col-md-6">
                    <h2 class="text-center mb-4 pb-3">Login to BuddyGet</h2>
                    <div class="card card-outline card-primary w-100">
                        <div class="card-body w-100 h-100">
                            <p class="login-box-msg text-dark">LOGIN</p>
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
                                <button type="submit" value="login" class="btn btn-primary btn-block">Log In</button>
                                <p class="text-dark mt-2 d-block mx-auto">Don't have an account? <span><a href="./register.php">Sign Up</a></span></p>
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
