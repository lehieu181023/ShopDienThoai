<?php
    include ('../DBcontext.php');
    $search = $_GET['search'] ?? '';
    $sqlselect = "SELECT * FROM `product` WHERE `Name` LIKE '%$search%' ORDER BY `CreateDay` DESC LIMIT 4 ;";
    $listpd = $db->ArraySelect($sqlselect);
?>
<div class="col-md-4">
    <div class="single-sidebar">
        <h2 class="sidebar-title">Search Products</h2>
        <input type="text" id="search" placeholder="Search products..." onchange="searchProduct(this.value)">
        <input type="button" class="btn btn-primary" onclick="searchProduct($('#search').val())" value="Search">
    </div>
    
    <div class="single-sidebar">
        <h2 class="sidebar-title">Products</h2>
        <?php
            foreach($listpd as $item){
        ?>
        <div class="thubmnail-recent">
            <img src="<?php 
                        $haystack = $item['Image'];
                        $needle = "uploads/";
                        $length = strlen($needle); // Độ dài cần kiểm tra
                        
                        if (substr($haystack, 0, $length) === $needle) {
                            echo 'NiceAdmin/'. $item['Image'] ;
                        } else {
                            echo $item['Image'] ;  // Không tìm thấy needle trong haystack, nên trả về giá trị ban đầu
                        }
                        ?>" class="recent-thumb" alt="">
            <h2><a href="single-product.html"><?php echo $item['Name'] ?></a></h2>
            <div class="product-sidebar-price">
                <ins><?php echo $item['Price'] . ' VND' ?></ins> 
                <!-- <del>$800.00</del> -->
            </div>                             
        </div>
        <?php } ?>
    </div>
</div>