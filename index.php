<?php 
session_start();

require_once './FrontEnd/header.php'?>
<?php if(isset($_GET['upload'])=='success') {?>
        <script>alert('Upload img success');</script>
<?php } ?> 
<?php if(isset($_GET['logout']) == 'success') {?>
        <script>alert('Have nice day');</script>
<?php } ?>
    <!------Start-Main-->
<section class="Main">
        <div class="container">
            <div class="row">
                <?php include_once './FrontEnd/leftnav.php';?>
                <section class="col-9" id="right">
                    <?php include_once './FrontEnd/slidebar.php'; ?>
                    <?php include_once './FrontEnd/sanphamt11.php';  ?>    
            </div>
            <div class="main-p">
                <?php include_once './FrontEnd/pcbanchay.php'; ?>
            </div>
            <div class="main-product">
                <?php include_once './FrontEnd/uudailaptop.php'; ?>
            </div>
            <div class="main-product">
              <?php include_once './FrontEnd/manhinhkhuyenmai.php';?>
            </div>

            <div class="main-product">
                <?php include_once './FrontEnd/pc-workstation.php'; ?>
    
            <div class="main-product">
                <?php include_once './FrontEnd/banphimgaming.php'; ?>
            </div>
            <div class="main-product">
                <?php include_once './FrontEnd/chuotgaming.php'; ?>
            </div>
            <hr>
            <div class="row" id="selling">
                <?php include_once './FrontEnd/emailenter.php'; ?>
            </div>

            </div>  
        </div>
</section>
    <!------End-Main-->
<?php include_once './FrontEnd/footer.php' ?>