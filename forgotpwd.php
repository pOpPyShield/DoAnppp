<?php include_once './View/header.php'?>

    <h1>Reset your password</h1>
    <p>An email will be send to you with instructions on how to reset your password.</p>
    <form action="Includes/reset-request.inc.php" method="POST">
        <input type="email" name="email" placeholder="Enter your email address...">
        <button type="button" name="reset-request-submit">Receive new password by email</button>
    </form>

<?php include_once './View/footer.php';?>