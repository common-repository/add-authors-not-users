<?php

/**
 *
 * @link       http://addusersnotauthors.com
 * @since      1.0.0
 *
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/includes
 */

/**
 *
 * @since      1.0.0
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/includes
 * @author     Yonatan Est <	heyyonatane@gmail.com>
 */
class Aanu_Add_Authors_Not_Users {

	/**
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Add_Authors_Not_Users_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'AANU_PLUGIN_NAME_VERSION' ) ) {
			$this->version = AANU_PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'add-authors-not-users';

		$this->aanu_load_dependencies();
		$this->aanu_set_locale();
		$this->aanu_define_admin_hooks();
		$this->aanu_define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function aanu_load_dependencies() {


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-aanu-add-authors-not-users-loader.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-aanu-add-authors-not-users-i18n.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-aanu-add-authors-not-users-admin.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-aanu-add-authors-not-users-public.php';

		$this->loader = new Aanu_Add_Authors_Not_Users_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function aanu_set_locale() {

		$plugin_i18n = new Aanu_Add_Authors_Not_Users_i18n();

		$this->loader->aanu_add_action( 'plugins_loaded', $plugin_i18n, 'aanu_load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function aanu_define_admin_hooks() {

		$plugin_admin = new Aanu_Add_Authors_Not_Users_Admin( $this->aanu_get_plugin_name(), $this->aanu_get_version() );

		$this->loader->aanu_add_action( 'admin_enqueue_scripts', $plugin_admin, 'aanu_enqueue_styles' );
		$this->loader->aanu_add_action( 'admin_enqueue_scripts', $plugin_admin, 'aanu_enqueue_scripts' );
		$this->loader->aanu_add_action( 'admin_enqueue_scripts', $plugin_admin, 'aanu_enqueue_scripts' );
		$this->loader->aanu_add_action( 'add_meta_boxes', $plugin_admin, 'aanu_meta_box' );
		$this->loader->aanu_add_action( 'save_post', $plugin_admin, 'aanu_meta_box_save');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function aanu_define_public_hooks() {

		$plugin_public = new Aanu_Add_Authors_Not_Users_Public( $this->aanu_get_plugin_name(), $this->aanu_get_version() );

		$this->loader->aanu_add_action( 'wp_enqueue_scripts', $plugin_public, 'aanu_enqueue_styles' );
		$this->loader->aanu_add_action( 'wp_enqueue_scripts', $plugin_public, 'aanu_enqueue_scripts' );

		
		$this->loader->aanu_add_filter( 'the_author', $plugin_public, 'aanu_author_name' );
		$this->loader->aanu_add_filter( 'get_the_author_display_name', $plugin_public, 'aanu_author_name' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function aanu_run() {
		$this->loader->aanu_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function aanu_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Add_Authors_Not_Users_Loader    Orchestrates the hooks of the plugin.
	 */
	public function aanu_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function aanu_get_version() {
		return $this->version;
	}

}
