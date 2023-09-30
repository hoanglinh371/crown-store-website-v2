<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body>
<?php
    require_once './components/header.php';
?>
<div class="d-flex justify-content-center">
    <div class="sign-in-form">
        <h2>Already have an account?</h2>
        <span>Sign in with your email and password</span>
        <form method="post" action="sign_in_process.php">
            <div class="group">
                <input
                    type="password"
                    id="new_password"
                    class="form-input"
                    name="new_password"
                >
                <label for="new_password" class="form-input-label">New Password</label>
            </div>

            <div class="group">
                <input
                    type="password"
                    id="confirm_new_password"
                    class="form-input"
                    name="confirm_new_password"
                >
                <label for="confirm_new_password" class="form-input-label">Confirm New Password</label>
            </div>

            <div class="buttons-container">
                <button type="submit" class="button">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
