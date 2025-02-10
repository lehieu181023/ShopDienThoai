<?php 
    include ('../DBcontext.php');
    $page = $_GET['page']??1;
    $start = ($page - 1) * 12;  
    $sql = "SELECT * FROM `product` order by CreateDay desc Limit 12 OFFSET $start";
    $data = $db->ArraySelect($sql);
    $datacount = $db->OneSelect("SELECT COUNT(*) as count FROM `product`");
    $db->closeConnection();  
    $pagecount = ceil($datacount['count']/12) ;
?>
<div class="row">
<?php
    foreach($data as $item){
        // Render product item
?>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper img_pro" id="img_pro">
                <img src="<?php 
                $haystack = $item['Image'];
                $needle = "uploads/";
                $length = strlen($needle); // Độ dài cần kiểm tra
                
                if (substr($haystack, 0, $length) === $needle) {
                    echo 'NiceAdmin/'. $item['Image'] ;
                } else {
                    echo $item['Image'] ;  // Không tìm thấy needle trong haystack, nên trả về giá trị ban đầu
                }
                ?>" alt="">
            </div>
            <h2><a href=""><?php echo $item['Name'] ?></a></h2>
            <div class="product-carousel-price">
                <ins><?php echo $item['Price'] . 'VND'?></ins> 
                <!-- <del>$999.00</del> -->
            </div>  
            
            <div class="product-option-shop">
                <a class="add_to_cart_button" onclick="AddToCart(<?php echo $item['id'] ?>);">Add to cart</a>
            </div>                       
        </div>
    </div>
<?php } ?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="product-pagination text-center">
            <nav>
                <ul class="pagination">
                <?php if($page > 1){ ?>
                <li>
                    <a onclick="loaddataInShopPage(1)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php } ?>
                <?php 
                    for($i = 1; $i <= $pagecount ; $i++){
                ?>
                <li><a onclick="loaddataInShopPage(<?php echo $i ?>)"><?php echo $i ?></a></li>
                <?php }?>
                <?php if($page < $pagecount){ ?>
                <li>
                    <a onclick="loaddataInShopPage(<?php echo $pagecount ?>)" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php }?>
                </ul>
            </nav>                        
        </div>
    </div>
</div>
