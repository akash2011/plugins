<?php
if (!session_id()) {
    session_start();
}

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_field_gallery_selector') ) :


class acf_field_gallery_selector extends acf_field {
	
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct( $settings )
	{
		// vars
		$this->name = 'gallery_selector';
		$this->label = __('Gallery Selector');
		$this->category = __("Choice",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'initial_value' => 'FADA'
		);		
	

        // do not delete!
        parent::__construct();

        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.0.0'
        );
    	
    	

	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like below) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
        function create_options( $field )
        {
            $field = array_merge($this->defaults, $field);
            $key = $field['name'];


            // Create Field Options HTML
            ?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
        <td class="label">
            <label><?php _e("Initial Value",'acf'); ?></label>
            <p class="description"><?php _e("The initial value of the gallery field",'acf'); ?></p>
        </td>
        <td>
            <?php

            do_action('acf/create_field', array(
                'type'		=>	'select',
                'name'		=>	'fields['.$key.'][initial_value]',
                'value'		=>	$field['initial_value'],
                'choices'	=>	$this->get_galleries()
            ));

            ?>
        </td>
        </tr>
            <?php

        }
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
        function create_field( $field )
        {
            $field = array_merge($this->defaults, $field);
            ?>
            <div>
                <select style="text-transform:uppercase !important;" name='<?php echo $field['name'] ?>'>
                    
                                      
                  <?php  
                     $current_user = wp_get_current_user();
       
                   $uid = $current_user->ID;

                    if($current_user->ID ==1)
                    {
                        $args=array( 
                        'post_type' => 'fada-galleries',
                         'posts_per_page'=>-1,
                            'order'=>'asc',
                            'orderby'=>'title',
                         //'post__not_in'=>array('46418')
                       );
                    }

                    else{
                   $args=array( 
                       'post_type' => 'fada-galleries',          
                       'author'=>$uid
                       );
                    }
       $query= new WP_Query($args);
            while($query->have_posts()){
                $query->the_post();
                //$title = the_title();
                 $id = get_the_ID();?>
               
                    
                <option <?php selected( $field['value'], $id ) ?> value='<?php echo get_the_ID(); ?>'>
                <?php echo get_the_title(); ?>
                    </option>
                
         <?php   }?>
                    
                    
                </select>
            </div>
            <?php
        }
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts() {

            // register ACF scripts
            wp_register_script( 'acf-input-gallery_selector', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );

            // Chosen
            wp_register_script( 'chosen', $this->settings['dir'] . 'js/chosen.jquery.min.js', array('acf-input', 'jquery'), $this->settings['version'] );
            wp_register_style( 'chosen', $this->settings['dir'] . 'css/chosen.min.css', array('acf-input'), $this->settings['version'] );

            // scripts
            wp_enqueue_script(array(
                'acf-input-gallery_selector',
                'chosen',
            ));

            // styles
            wp_enqueue_style(array(
                'chosen',
            ));


        }
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{
		// Note: This function can be removed if not used
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
	}

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
		*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in the database
	*/
	
	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// Note: This function can be removed if not used
		return $field;
	}
    
    function get_galleries() {
        
        //get_currentuserinfo();
        $current_user = wp_get_current_user();
       
       $uid = $current_user->ID;
        
        if($current_user->ID ==1)
        {
            $args=array( 
            'post_type' => 'fada-galleries',
             'show_posts'=>-1
           );
        }
    
        else{
       $args=array( 
           'post_type' => 'fada-galleries',          
           'author'=>$uid
           );
        }
       $query= new WP_Query($args);
            while($query->have_posts()){
                $query->the_post();
                //$title = the_title();
                 $id = get_the_ID();
                
                $galleries = array($id=>''.get_the_title().'','id'=>''.get_the_title().'');
                
            }
            
                    

        return $galleries;
        
    }

}



// initialize
new acf_field_gallery_selector( $this->settings );


// class_exists check
endif;

?>