<?php
namespace FBT\App\Controllers;
defined('ABSPATH') || exit ;

class AdminTab
{
    public static function woocommerceTab ( $tabs ) 
    {
        $tabs[ 'fbt_admin_tab' ] = array(
            'label' => __( 'Frequently Bought Together Products' , 'text_domain' ) ,            // Tab Title
            'target' => 'fbtViewTab' ,                                                          // Target ID
            'priority' => 30                                                                    // Priority
        ) ;
        return $tabs ;
    }

    public static function tabViewFunction () 
    {
        if ( file_exists ( FBT_PLUGIN_PATH . '/App/Views/AdminTabView.php' ) ) 
        {
            include ( FBT_PLUGIN_PATH . '/App/Views/AdminTabView.php') ;
        }
        else 
        {
            wp_die( 'Tab View Not Found' ) ;
        }
    }

    public static function postFunction () 
    {
        global $post ;
        if ( isset( $_POST[ 'fbt_product_ids' ] )  )
        {
            $data = $_POST[ 'fbt_product_ids' ] ;
            update_post_meta( $post->ID , 'fbt_product_ids' , $data ) ;
        }
        else
        {
            delete_post_meta( $post->ID , 'fbt_product_ids'  ) ;
        }
    }
      
}
