<?php 
    session_start();
    require_once './Classes/img.php';
    if(isset($_POST['submit'])) {
        $img = new Img();
        if($img->uploadImg($_SESSION['id'], $_FILES['file'])) {
            header('Location: ./?upload=success');
        } else {
            header('Location: ./?upload=failed');
        }
    }
?>

<?php include_once './FrontEnd/header.php';?>
    <form action="uploadImg.php" method="POST" enctype="multipart/form-data">
        <input type="file" name='file'>
        <button type="submit" name="submit">upload</button>
    </form>
<?php include_once './FrontEnd/footer.php';?>