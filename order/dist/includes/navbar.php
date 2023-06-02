<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
            <img src="icon.png" width="40" height="40">
                <a class="navbar-brand" href="order.php">Nike PH</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=" ">
                                Welcome <strong><?php include('user.php') ?>!</strong>
                            </a>
                        </li>
                        &nbsp&nbsp
                        <form class="d-flex">
                        <a href="cart.php" class="btn btn-primary">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        </a>
                        &nbsp&nbsp&nbsp&nbsp
                        </form>
                        <form class="d-flex">
                        <a href="Order_details.php" class="btn btn-success">
                        <i class="bi-bag-fill me-1"></i>
                        Order Details
                        </a>
                        </form>
                    </ul>
                    
                    <button class="btn btn-danger" type="submit" onclick="location.href='../../includes/sign-in.php'">Sign Out</button>

                </div>
            </div>
        </nav>
</body>
</html>