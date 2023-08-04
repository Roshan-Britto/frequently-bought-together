<?php
    defined('ABSPATH') || exit ; 
    global $post ;
?>

<div id="fbtViewTab" class="panel woocommerce_options_panel">
    <div class="options_group">
        <p class="form-field" id="choose_product" >
            <label for="product_ids"><?php esc_html_e( 'Add the Products Here', 'woocommerce' ); ?></label>
            <select class="wc-product-search" multiple="multiple" style="width: 60%;" id="fbt_product_ids" name="fbt_product_ids[]" data-placeholder="<?php esc_attr_e( 'Search Product', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
                <?php
                foreach ( $product_ids as $product_id ) 
                {
                    $product = wc_get_product( $product_id );
                    if ( is_object( $product ) ) 
                    {
                        echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
                    }
                }
                ?>
            </select>
        </p>
    </div>
</div>