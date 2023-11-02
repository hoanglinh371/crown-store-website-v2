<?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case 'password-not-the-same': {
                echo "<script type='text/javascript'>alert('Password are not the same.');</script>";
                break;
            }
            case 'not-find-account': {
                echo "<script type='text/javascript'>alert('Email or password is incorrect.');</script>";
                break;
            }
            case 'email-is-existed': {
                echo "<script type='text/javascript'>alert('This email address has been used.');</script>";
                break;
            }

            default: {
                break;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <title>Login - Register</title>
</head>
<body>
<?php
    require_once './components/header.php';
?>
<div class="login-container">
    <div class="sign-in-form">
        <h2>Already have an account?</h2>
        <span>Sign in with your email and password</span>
        <form method="post" action="./processes/login_process.php">
            <div class="group">
                <input
                    type="email"
                    id="sign_in_email"
                    class="form-input"
                    name="email"
                    required
                >
                <label for="sign_in_email" class="form-input-label">Email</label>
            </div>

            <div class="group">
                <input
                    type="password"
                    id="sign_in_password"
                    class="form-input"
                    name="password"
                    required
                >
                <label for="sign_in_password" class="form-input-label">Password</label>
            </div>

            <div class="buttons-container">
                <button type="submit" class="button">SIGN IN</button>
                <a class="button inverted" href="./forgot-password.php">FORGET PASSWORD?</a>
            </div>
        </form>
    </div>

    <div class="sign-up-form">
        <h2>Don't have an account?</h2>
        <span>Sign up with your email and password</span>
        <form method="post" action="./processes/register_process.php">
            <div class="group">
                <input
                    type="text"
                    id="first_name"
                    class="form-input"
                    name="first_name"
                    required
                >
                <label for="first_name" class="form-input-label">First Name</label>
            </div>
            <div class="group">
                <input
                    type="text"
                    id="last_name"
                    class="form-input"
                    name="last_name"
                    required
                >
                <label for="last_name" class="form-input-label">Last Name</label>
            </div>

            <div class="group">
                <input
                    type="email"
                    id="sign_up_email"
                    class="form-input"
                    name="email"
                    required
                >
                <label for="sign_up_email" class="form-input-label">Email</label>
            </div>

            <div class="group">
                <input
                    type="password"
                    id="sign_up_password"
                    class="form-input"
                    name="password"
                    required
                >
                <label for="sign_up_password" class="form-input-label">Password</label>
            </div>

            <div class="group">
                <input
                    type="password"
                    id="confirm_password"
                    class="form-input"
                    name="confirm_password"
                    required
                >
                <label for="confirm_password" class="form-input-label">Confirm Password</label>
            </div>

            <div class="group">
                <input
                    type="text"
                    id="phone"
                    class="form-input"
                    name="phone"
                    required
                >
                <label for="phone" class="form-input-label">Phone</label>
            </div>

            <div class="group">
                <input
                    type="text"
                    id="address"
                    class="form-input"
                    name="address"
                    required
                >
                <label for="address" class="form-input-label">Address</label>
            </div>

            <button type="submit" class="button">SIGN UP</button>
        </form>
    </div>
</div>
<script>

</script>
</body>
</html>
