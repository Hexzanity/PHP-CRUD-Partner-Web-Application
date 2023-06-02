<?php
session_start();
include('../../config/db.php');
include('includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <?php include('includes/navbar.php'); ?>
        <header>
            <div class="container">
                    <div class="container">
                            <p style="font-weight:bolder; font-size:20px; margin-bottom:-10px" class="text-center text-black">Nike Pegasus 40</p>
                            <h1 style="font-weight:bolder; font-size:65px; margin-top:0px; line-height:70px" class="text-center text-black">THE WORLD RUNS<br> IN PEGASUS</h1>
                    </div>
                        <div class="text-center text-white">
                            <video height="90%" width="100%" autoplay loop muted>
							<source src="../../images/JDI.mp4" type="video/mp4"></video></div><div class="content">
                        </div>
            </div>
        </header>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php include('products/1.php'); ?>
                    <?php include('products/2.php'); ?>
                    <?php include('products/3.php'); ?>
                    <?php include('products/4.php'); ?>
                    <?php include('products/5.php'); ?>
                    <?php include('products/6.php'); ?>
                    <?php include('products/7.php'); ?>
                    <?php include('products/8.php'); ?>
                </div>
            </div>
        </section>
        <footer class="py-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">All Rights Reserved by Hexzanity &copy;</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
