<?php
/*
Plugin Name: Custom Post Type Delete Bulk Action 
Plugin URI: http://www.pulse-creative.com
Description: Add Delete bulk action to multiple custom post type.
Author: Ashraful kabir
Author URI: http://www.pulse-creative.com
Version: 1.0

*/

if (!class_exists('Custom_Bulk_Action')) {
 
	class Custom_Bulk_Action {
		
		public function __construct() {
			
			if(is_admin()) {
				// admin actions/filters
				add_action('admin_footer-edit.php', array(&$this, 'custom_bulk_admin_footer'));
				add_action('load-edit.php',         array(&$this, 'custom_bulk_action'));
				add_action('admin_notices',         array(&$this, 'custom_bulk_admin_notices'));
			}
		}
		
		
		/**
		 * Step 1: add the custom Bulk Action to the select menus
		 */
		function custom_bulk_admin_footer() {
			global $post_type;
			
            // any aditional custom post type goes on to if statement
			if($post_type == 'fada-events' ||$post_type == 'fada-blog'||$post_type == 'fada-image'||$post_type =='artist-biography'||$post_type=='fada-artist'||$post_type == 'gallery-medium') {
				?>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery('<option>').val('delete').text('<?php _e('Delete')?>').appendTo("select[name='action']");
							jQuery('<option>').val('delete').text('<?php _e('Delete')?>').appendTo("select[name='action2']");
						});
					</script>
				<?php
	    	}
		}
		
		
		/**
		 * Step 2: handle the custom Bulk Action
		 * 
		 * Based on the post http://wordpress.stackexchange.com/questions/29822/custom-bulk-action
		 */
		function custom_bulk_action() {
			global $typenow;
			$post_type = $typenow;
			
            // any aditional custom post type goes on to if statement
			if($post_type == 'fada-events' ||$post_type == 'fada-blog'||$post_type == 'fada-image'||$post_type =='artist-biography'||$post_type=='fada-artist'||$post_type=='gallery-medium') {
				
				// get the action
				$wp_list_table = _get_list_table('WP_Posts_List_Table');  // depending on your resource type this could be WP_Users_List_Table, WP_Comments_List_Table, etc
				$action = $wp_list_table->current_action();				
								
				// security check
				check_admin_referer('bulk-posts');
				
				// make sure ids are submitted.  depending on the resource type, this may be 'media' or 'ids'
				if(isset($_REQUEST['post'])) {
					$post_ids = array_map('intval', $_REQUEST['post']);
				}
				
				if(empty($post_ids)) return;
				
				// this is based on wp-admin/edit.php
				$sendback = remove_query_arg( array('exported', 'untrashed', 'deleted', 'ids'), wp_get_referer() );
				if ( ! $sendback )
					$sendback = admin_url( "edit.php?post_type=$post_type" );
				
				$pagenum = $wp_list_table->get_pagenum();
				$sendback = add_query_arg( 'paged', $pagenum, $sendback );				
							
				$sendback = remove_query_arg( array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view'), $sendback );
				
				wp_redirect($sendback);
				exit();
			}
		}
		
		
	}
}

new Custom_Bulk_Action();