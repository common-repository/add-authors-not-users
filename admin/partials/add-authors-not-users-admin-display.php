<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://addusersnotauthors.com
 * @since      1.0.0
 *
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/admin/partials
 */
?>

<?php


global $post;

$values = get_post_custom( $post->ID );

$authorname = isset( $values['authorname'] ) ? $values['authorname'][0] : '';
 
// We'll use this nonce field later on when saving.
wp_nonce_field( 'aanu_meta_box_nonce', 'meta_box_nonce' );
?>
	<div class="aanu-metabox" >
		<label for="authorname">Author name:</label>
		<input type="text" name="authorname" id="authorname" value="<?php echo $authorname; ?>" />

	</div> 	

			
<?php


