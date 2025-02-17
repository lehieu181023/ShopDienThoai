<?php
    session_start();
   
    if(!isset($_SESSION['account'])){
        $response = [
            'success' => false,
            'message' => 'Bạn chưa đăng nhập!'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }else{
        $account = $_SESSION['account'];
        include ('../DBcontext.php');
        $sql = "SELECT * FROM `accountcustomer` WHERE `SDT` = '$account' OR `Email` = '$account'";
        $data = $db->ArraySelect($sql);
        if(count($data) > 0){
            $account_id = $data[0]['id'];
        }
        else{
            $response = [
                'success' => false,
                'message' => 'tài khoản không tồn tại!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }   
    $sql = "SELECT cart.id,product_id,product.quantity as qualitypr, product.Image,product.Name,product.Price,cart.quality,(product.Price * cart.quality) as total FROM cart,product WHERE cart.product_id = product.id AND cart.account_id = $account_id";
    $data = $db->ArraySelect($sql);
    $db->closeConnection(); 
    
?>
<table cellspacing="0" class="shop_table cart">
    <thead>
        <tr>
            <th class="product-remove">&nbsp;</th>
            <th class="product-thumbnail">&nbsp;</th>
            <th class="product-name">Product</th>
            <th class="product-price">Price</th>
            <th class="product-quantity">Quantity</th>
            <th class="product-subtotal">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($data as $item){
        ?>    
        <tr class="cart_item">
            <td class="product-remove">
                <a title="Remove this item" class="remove" onclick="deleteData(<?php echo $item['id'] ?>)">x</a> 
            </td>

            <td class="product-thumbnail">
                <a href="single-product.php?product=<?php echo $item['product_id'] ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?php 
                                                                                                                            $haystack = $item['Image'];
                                                                                                                            $needle = "uploads/";
                                                                                                                            $length = strlen($needle); // Độ dài cần kiểm tra
                                                                                                                            
                                                                                                                            if (substr($haystack, 0, $length) === $needle) {
                                                                                                                                echo 'NiceAdmin/'. $item['Image'] ;
                                                                                                                            } else {
                                                                                                                                echo $item['Image'] ;  // Không tìm thấy needle trong haystack, nên trả về giá trị ban đầu
                                                                                                                            }
                                                                                                                            ?>"></a>
            </td>

            <td class="product-name">
                <a href="single-product.php?product=<?php echo $item['product_id'] ?>"><?php echo $item['Name'] ?></a> 
            </td>

            <td class="product-price">
                <span class="amount"><?php echo $item['Price'] . ' VND'?></span> 
            </td>

            <td class="product-quantity">
                <div class="quantity buttons_added">
                    <?php
                    if($item['quality'] < $item ['qualitypr']) 
                    {       
                    ?>
                        <input type="button" class="plus" value="+" onclick="editCart(<?php echo $item['id'] ?>,<?php echo ($item['quality'] + 1) ?>)">
                    <?php } ?>
                    <?php echo $item['quality'] ?>
                    <?php
                    if($item['quality'] > 1)
                    {       
                    ?>
                        <input type="button" class="plus" value="-" onclick="editCart(<?php echo $item['id'] ?>,<?php echo ($item['quality'] - 1) ?>)">
                    <?php } ?>
                </div>
            </td>

            <td class="product-subtotal">
                <span class="amount"><?php echo $item['total'] ?></span> 
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td class="actions" colspan="6">
                <a type="button" href="checkout.php"  class="btn checkout-button button alt wc-forward">Proceed to Checkout</a>
            </td>
        </tr>
    </tbody>
</table>