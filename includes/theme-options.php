<?php

/**
 * Initialize the options before anything else. 
 */

add_action( 'admin_init', 'custom_theme_options', 1 );



function custom_theme_options() {

  /**
   * Get a copy of the saved settings array. 
   */

  $saved_settings = get_option( 'option_tree_settings', array() );

  

  /**
   * Create your own custom array that will be passes to the 
   * OptionTree Settings API Class.
   */

  $custom_settings = array(

    'contextual_help' => array(

      'content'       => array( 

        array(

          'id'        => 'general_help',

          'title'     => 'General',

          'content'   => '<p>Help content goes here!</p>'

        )

      ),

      'sidebar'       => '<p>Sidebar content goes here!</p>',

    ),

    'sections'        => array(

      array(

        'id'          => 'general',

        'title'       => 'General'

      )


    ),

    'settings'        => array(

	

      array(

        'label'       => 'Select site logo type',

        'id'          => 'logo_type',

        'type'        => 'select',

        'desc'        => 'Choose the site logo type. You can either use site\'s name or your logo',

        'choices'     => array(

          array(

            'label'       => 'Use Logo',

            'value'       => 'logo'

          ),

          array(

            'label'       => 'Use Site Name',

            'value'       => 'name'

          )

        ),

        'std'         => 'logo',

        'rows'        => '',

        'post_type'   => '',

        'taxonomy'    => '',

        'class'       => '',

        'section'     => 'general'

      ),

		  

		array(

        'label'       => 'Upload Your Logo',

        'id'          => 'upload_logo',

        'type'        => 'upload',

        'desc'        => 'Upload your logo. Logo size must be lower than 195px width and 65px height.',

        'std'         => '',

        'rows'        => '',

        'post_type'   => '',

        'taxonomy'    => '',

        'class'       => '',

        'section'     => 'general'

      ),

	  

		array(

        'label'       => 'Upload Your Favico',

        'id'          => 'upload_favico',

        'type'        => 'upload',

        'desc'        => 'Upload your favico.ico file. This is the image file will be shown at the left side of address bar. Must be sized as 16x16 pixels.',

        'std'         => '',

        'rows'        => '',

        'post_type'   => '',

        'taxonomy'    => '',

        'class'       => '',

        'section'     => 'general'

      )

    )

  );

  

  /* settings are not the same update the DB */

  if ( $saved_settings !== $custom_settings ) {

    update_option( 'option_tree_settings', $custom_settings ); 

  }

  

}

?>