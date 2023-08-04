<?php
    defined('ABSPATH') || exit ;
    global $post ; 
?>

<script>
    function checkboxInput ( amount ,checkboxName )
    {
        var checkbox = document.getElementById(checkboxName)
        if ( checkbox.checked == false )
        {
            var currentAmount =  document.getElementById( 'cartAmount' ).value  ; 
            document.getElementById( 'cartAmount' ).value = currentAmount - amount ;
        }
        else if (checkbox.checked == true )
        {
            var currentAmount =  parseInt( document.getElementById( 'cartAmount' ).value  )  ; 
            document.getElementById( 'cartAmount' ).value = currentAmount + amount ;
        }
    }
</script>

<div style="margin-top: 10px">
    <form method="post">
        <h2>Buy it With</h2>
        <div style="display: flex; flex-direction: row; align-items: center;">
            <?php 
                $totalPrice = 0 ;   
                foreach ( $addCartProductsDetails as $cartProductDetails ) 
                {
                    $productId = $cartProductDetails[0] ;
                    $productName =  $cartProductDetails[1] ;    
                    $product_image_url =  $cartProductDetails[2] ;
                    $productPrice = $cartProductDetails[3] ;
                    $totalPrice += $productPrice ;
            ?>

            <div style="margin: 5px; padding: 5px;display: flex; flex-direction: row; flex-wrap: wrap; align-items:center">
                <?php echo ( $product_image_url ) ?>
            </div> 

            <?php
                }
            ?>
            <div style="text-align: left;">
                <input type="hidden" name="fbt_main_product" value="<?php echo esc_attr_e( $post->ID ) ?>">
                <label ><h6>Total Price : $ <input type="text" style="border: none;" name="" id="cartAmount" value="<?php echo esc_attr_e( $totalPrice )  ?>"></h6></label>
                <button class="button button alt" type="submit" name="fbt_add_to_cart">Add all to Cart</button>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <?php
                foreach ( $addCartProductsDetails as $cartProductDetails ) 
                {
                    $productId = $cartProductDetails[0] ;
                    $productName =  $cartProductDetails[1] ;    
                    $product_image_url =  $cartProductDetails[2] ;
                    $productPrice = $cartProductDetails[3] ;
            ?>
            <h2><input type="checkbox" name="<?php echo esc_attr_e( $productId )  ?>" value="<?php echo esc_attr_e( $productId )  ?>" id="<?php echo esc_attr_e( $productId ) ?>" onclick="checkboxInput(<?php echo esc_attr_e($productPrice)  ?> , <?php echo esc_attr_e( $productId ) ?>)" style="height: 30px; width: 30px; padding:5px;"  checked  ><?php echo esc_html_e( $productName ) ?> : $<?php echo esc_html_e( $productPrice ) ?></h2>
            <?php
                }   
            ?>
        </div>
    </form>
</div>