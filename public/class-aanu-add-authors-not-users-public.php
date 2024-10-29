<?php

/**
 *
 * @link       http://addusersnotauthors.com
 * @since      1.0.0
 *
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/public
 */

/**
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/public
 * @author     Yonatan Est <	heyyonatane@gmail.com>
 */
class Aanu_Add_Authors_Not_Users_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function aanu_enqueue_styles() {


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-authors-not-users-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function aanu_enqueue_scripts() {


		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-authors-not-users-public.js', array( 'jquery' ), $this->version, false );

	}


	function aanu_author_name( $name ) {
	global $post;
	 
	$author = get_post_meta( $post->ID, 'authorname', true );
	 
	if ( $author )
	$name = $author;
	 
	return $name;
	}

}
