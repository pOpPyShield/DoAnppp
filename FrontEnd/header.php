<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Public/Asset/Style/style.css">
    <link rel="stylesheet" type="text/css" href="Public/Asset/Style/account_log.css">
    <link rel="stylesheet" type="text/css" href="Public/Asset/Style/lightslider.css">
    <link rel="stylesheet" type="text/css" href="Public/Asset/Style/detail-product.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="Public/Asset/Js/lightslider.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Admin</title>
</head>

<body>
    <!------Start-Navbar-->
        <?php 
            if(isset($_GET['login']) == 'success') {
        ?>     
                <script>alert('Login Success!!!');</script>
        <?php    
            }
        ?>
        <?php include_once './View/navbar.php'; ?>
    <!-------End-Navbar-->
