<?php
namespace FBT\App\Controllers ;
defined('ABSPATH') || exit ;

class ShopPage 
{
    public static function getPostArray ()
    {
        global $post  ; 
        $fbtProductIds [] = $post->ID ;
        $fbtProductIds [] = get_post_meta( $post->ID , 'fbt_product_ids' , true ) ;
        if ( count( $fbtProductIds ) > 1 )                                                  
        {   
            if(! empty( $fbtProductIds[1] ) )                                               // Check for FBT products
            {
                $addCartProductsIds [] = $fbtProductIds[0] ;                                // Cart Product IDs
                foreach ( $fbtProductIds[1] as $fbtProductId ) 
                {
                    $addCartProductsIds [] = $fbtProductId ;   
                }
                $addCartProductsDetails = [] ;                                              // Cart Product Details
                foreach ( $addCartProductsIds as $addProductId ) 
                {
                    $cartProductDetails = [] ;   
                    $product = wc_get_product( $addProductId );
                    $productName = $product->get_name() ;    
                    $product_image_url = $product->get_image() ;
                    $productPrice = $product->get_price() ;
                    $productStock = $product->get_stock_quantity() ;
                    $cartProductDetails [] = $addProductId ;
                    $cartProductDetails [] = $productName  ; 
                    $cartProductDetails [] = $product_image_url  ; 
                    $cartProductDetails [] = $productPrice  ; 
                    if ( $productStock >= 1 )                                               // Check for Product Stock
                    {
                        $addCartProductsDetails []  =  $cartProductDetails ;
                    }
                }
                if ( file_exists ( FBT_PLUGIN_PATH . '/App/Views/ShopPageView.php' ) ) 
                {
                    include ( FBT_PLUGIN_PATH . '/App/Views/ShopPageView.php') ;
                }
                else 
                {
                    wp_die( 'FBT View Page Not Found' ) ;
                }
            }
        }
    }   

    public static function addCartProducts ()
    {
        global $woocommerce ;
        if ( isset ( $_POST [ 'fbt_add_to_cart' ] ) )
        {
            $mainProductId = sanitize_text_field( filter_var( $_POST [ 'fbt_main_product' ] , FILTER_VALIDATE_INT ) );
            if ( isset ( $_POST [ $mainProductId ] ) ) 
            {
                $woocommerce->cart->add_to_cart( $mainProductId ) ;                                                  // Adding Main Product
            }  
            $fbtProductIDS = get_post_meta( $mainProductId , 'fbt_product_ids' , true ) ;
            print_r( $_POST ) ;
            foreach ($fbtProductIDS as $cartProductDetails)
            {
                $checkBoxName = sanitize_text_field( filter_var( $_POST [ $cartProductDetails ] , FILTER_VALIDATE_INT ) );
                if ( $checkBoxName == $cartProductDetails)
                {
                    if ( isset ( $_POST [ $checkBoxName ] ) ) 
                    {
                        $woocommerce->cart->add_to_cart( $checkBoxName ) ;                                             // Adding FBT Products from checkbox
                    }  
                }
            }
        }
    }
}