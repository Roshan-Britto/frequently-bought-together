<?php

namespace FBT\App;

defined('ABSPATH') || exit ;

use FBT\App\Controllers\AdminTab ;
use FBT\App\Controllers\ShopPage ;

class Route 
{
    public static function fbtProductFunction( ) 
    {
        $fbtAdminMenu = new AdminTab ();
        add_filter( 'woocommerce_product_data_tabs' , [ $fbtAdminMenu , 'woocommerceTab' ] ) ;
        add_action( 'woocommerce_product_data_panels' , [ $fbtAdminMenu , 'tabViewFunction' ] ) ;
        add_action( 'woocommerce_admin_process_product_object' , [ $fbtAdminMenu , 'postFunction' ] ) ;

        $fbtShopPage = new ShopPage () ;
        add_action( 'woocommerce_after_single_product' , [ $fbtShopPage , 'getPostArray' ] ) ;
        add_action( 'wp_loaded' , [ $fbtShopPage , 'addCartProducts' ] ) ;
    }
}
