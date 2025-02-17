<?php
    session_start();
    include ('../DATN/DB/DBcontext.php');
    $loggin = false;
    if (isset($_SESSION['account'])) {
        $account = $_SESSION['account'];
        $sql = "SELECT * FROM `accountcustomer` WHERE `SDT` = '$account' OR `Email` = '$account'";
        $dataac = $db->ArraySelect($sql);
        if(count($dataac) > 0){
            $account_id = $dataac[0]['id'];
            $loggin = true;
            $datatotalcart = $db->OneSelect("SELECT SUM(product.Price * cart.quality) as totalCart,count(*) as count FROM cart,product WHERE cart.product_id = product.id AND cart.account_id =$account_id;");
        }
        else{
            echo '<script>alert("tài khoản không tồn tại!")</script>';
        }    
    }
?>
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        <?php
                        if($loggin){
                            if($dataac[0]['access']==='employee'){
                                echo '<li><a href="niceadmin"><i class="fa fa-user"></i> Admin</a></li>';
                            }
                        }
                        ?>
                        <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                        <li><a href="checkout.php"><i class="fa fa-user"></i> Checkout</a></li>
                        <?php
                            if($loggin){
                                echo '<li><a href="logout.php"><i class="fa fa-user"></i> Logout</a></li>';
                            }
                            else{
                                echo '<li><a href="login.html"><i class="fa fa-user"></i> Login</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
                
            
        </div>
    </div>
</div> <!-- End header area -->
     
<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="index.html">e<span>Electronics</span></a></h1>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="cart.php">Cart - <span class="cart-amunt"><?php echo $datatotalcart['totalCart']??0 ?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $datatotalcart['count']??0 ?></span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div> 
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop page</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>  
        </div>
    </div>
</div> <!-- End mainmenu area -->