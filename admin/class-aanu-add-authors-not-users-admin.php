<?php

/**
 *
 * @link       http://addusersnotauthors.com
 * @since      1.0.0
 *
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/admin
 */

/**
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/admin
 * @author     Yonatan Est <	heyyonatane@gmail.com>
 */
class Aanu_Add_Authors_Not_Users_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 *
	 * @since    1.0.0
	 */
	public function aanu_enqueue_styles() {


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-authors-not-users-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function aanu_enqueue_scripts() {


		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-authors-not-users-admin.js', array( 'jquery' ), $this->version, false );

	}

	function aanu_meta_box() {
	    add_meta_box( 'aanu-review-metabox', 'Add Authors Not Users', array( $this, 'aanu_meta_box_cb' ), 'post', 'normal', 'default' );
	}

	function aanu_meta_box_cb() {
	    	include_once 'partials/add-authors-not-users-admin-display.php';
	}


	function aanu_meta_box_save() {

	    global $post;
	    $post_id = isset( $post->ID ) ? $post->ID : '';
	    if($post_id) {
	    	$values = get_post_custom( $post->ID ); 
	    }
	    
	    // Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	     
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'aanu_meta_box_nonce' ) ) return;
	     
	    // if our current user can't edit this post, bail
	    if( !current_user_can( 'edit_post', $post_id ) ) return;
	     
	    // now we can actually save the data
	    $allowed = array( 
	        'a' => array( // on allow a tags
	            'href' => array() // and those anchors can only have href attribute
	        )
	    );

	    // Make sure your data is set before trying to save it
	    
	         
	    if( isset( $_POST['authorname'] ) )
	        update_post_meta( $post_id, 'authorname', $_POST['authorname'] );

	}

}
