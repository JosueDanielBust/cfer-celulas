<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
Plugin Name:  Celulas - CFERobledo
Plugin URI:   https://github.com/JosueDanielBust/cfer-celulas
Description:  Celulas Manager
Version:      1.0
Author:       Josue Daniel Bustamante
Author URI:   http://josuedanielbust.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  celulas-cfer
Domain Path:  /languages
*/

//      Register data structure and post type on Wordpress Core
function create_celula_post_type() {
    register_post_type('cfer_celula',
    array(
        'labels' => array(
            'name'                  =>  __( 'Celulas' ),
            'singular_name'         =>  __( 'Celula' ),
            'menu_name'             =>  __( 'Celulas' ),
            'name_admin_bar'        =>  __( 'Celula'),
            'add_new'               =>  __( 'Add New', 'celula' ),
            'add_new_item'          =>  __( 'Add new Celula' ),
            'new_item'              =>  __( 'New celula' ),
            'edit_item'             =>  __( 'Edit celula' ),
            'view_item'             =>  __( 'View celula' ),
            'all_items'             =>  __( 'All celulas' ),
            'search_items'          =>  __( 'Search celula' ),
            'parent_item_colon'     =>  __( 'Parent Celula:' ),
            'not_found'             =>  __( 'No celulas found.' ),
            'not_found_in_trash'    =>  __( 'No celulas found in trash.' )
        ),
        'public'        =>  true,
        'has_archive'   =>  true,
        'show_in_rest'  =>  true,
        'rewrite'       =>  true,
        'hierarchical'  =>  false,
        'rest_base'     =>  'celula',
        'menu_icon'     =>  'dashicons-groups',
        'rewrite'       =>  array('slug' => 'celula'),
        'taxonomies'    =>  array( 'category' ),
        'supports'      =>  array( 'title', 'thumbnail' ),
        )
    );
}
add_action( 'init', 'create_celula_post_type' );

//      Register custom metadata for custom post type
add_action( 'admin_init', 'cfer_add_metadata' );
add_action( 'save_post', 'cfer_save_metadata' );

function cfer_add_metadata(){
    add_meta_box( 'cfer_celula_metadata', 'Information', 'cfer_celula_options', 'cfer_celula', 'normal', 'high');
}

function cfer_celula_options(){
    global $post;
    $custom     =   get_post_custom( $post->ID );
    $day        =   $custom[ 'day' ][0];
    $hour       =   $custom[ 'hour' ][1];
    $address    =   $custom[ 'address' ][2];
    $phone      =   $custom[ 'phone' ][3];

    ?>
    <div class="cfer-metadata-groups">
        <div class="cfer-control-group">
            <label for="cfer_day">Día</label>
            <select name="cfer_day" id="cfer_day" value="<?php echo $day; ?>">
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Thuesday">Thuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
        </div>
        <div class="cfer-control-group">
            <label for="cfer_hour">Hora</label>
            <input type="text" name="cfer_hour" id="cfer_hour" value="<?php echo $hour; ?>" />
        </div>
        <div class="cfer-control-group">
            <label for="cfer_address">Dirección</label>
            <input type="text" name="cfer_address" id="cfer_address" value="<?php echo $address; ?>" />
        </div>
        <div class="cfer-control-group">
            <label for="cfer_phone">Teléfono</label>
            <input type="text" name="cfer_phone" id="cfer_phone" value="<?php echo $phone; ?>" />
        </div>
    </div>
    <?php
}

function cfer_save_metadata(){
    global $post;
    update_post_meta( $post->ID, 'day', $_POST[ 'cfer_day' ] );
    update_post_meta( $post->ID, 'hour', $_POST[ 'cfer_hour' ] );
    update_post_meta( $post->ID, 'address', $_POST[ 'cfer_address' ] );
    update_post_meta( $post->ID, 'phone', $_POST[ 'cfer_phone' ] );
}

//      Register administration screen panel
add_action( 'admin_menu', 'cfer_celulas_menu' );
function cfer_celulas_menu() {
	add_menu_page( 'CFER Celulas', 'CFER Celulas', 'cfer_celulas_manage_options', 'cfer_celula', 'cfer_celulas_options' );
}

//      Register shortcodes
// ...

?>