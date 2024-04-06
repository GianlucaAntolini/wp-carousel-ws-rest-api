

<?php
/*
Plugin Name: Carousel WS REST API
Description: Plugin to provide a REST API that returns necessary data for an hypotetic carousel
Version: 1.0
Author: Gianluca Antolini
*/

// Function to register the custom post type "slides"
// a slide has a title, description and image/video
function create_slides_post_type() {

    // labels
    $labels = array(
        'name'                => _x( 'Slides', 'Post Type General Name', 'carousel-ws-rest-api' ),
        'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'carousel-ws-rest-api' ),
        'menu_name'           => __( 'Slides', 'carousel-ws-rest-api' ),
        'parent_item_colon'   => __( 'Slide', 'carousel-ws-rest-api' ),
        'all_items'           => __( 'Tutte le Slides', 'carousel-ws-rest-api' ),
        'view_item'           => __( 'Visualizza Slide', 'carousel-ws-rest-api' ),
        'add_new_item'        => __( 'Aggiungi nuova Slide', 'carousel-ws-rest-api' ),
        'add_new'             => __( 'Aggiungi nuova', 'carousel-ws-rest-api' ),
        'edit_item'           => __( 'Modifica Slide', 'carousel-ws-rest-api' ),
        'update_item'         => __( 'Aggiorna Slide', 'carousel-ws-rest-api' ),
        'search_items'        => __( 'Cerca Slide', 'carousel-ws-rest-api' ),
        'not_found'           => __( 'Non trovata', 'carousel-ws-rest-api' ),
        'not_found_in_trash'  => __( 'Non trovata nel cestino', 'carousel-ws-rest-api' ),
    );
      
    // options
    $args = array(
        'label'               => __( 'slides', 'carousel-ws-rest-api' ),
        'description'         => __( 'Slides for js carousel', 'carousel-ws-rest-api' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail' ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 1,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => false,
        'rewrite' => array('slug' => 'slides'),
  
    );

    // registering the custom post type
    register_post_type( 'slides', $args );


}

add_action( 'init', 'create_slides_post_type' );



// Function to get the slides data in JSON format
function get_slides( $data ) {
  // Get the slides from the database
  $slides = get_posts( array(
    'post_type' => 'slides',
  ) );

  // Remove all slides that don't have a thumbnail
  $slides = array_filter($slides, function($slide){
    return has_post_thumbnail($slide->ID);
  });

  // Prepare slides data for the response
  $slides_data = array(
    'status' => 'success',
    'data' => array()
  );

  // If there are no slides, set the status to error and add a errorMessage 
  if ( empty( $slides )  ) {
    $slides_data['status'] = 'error';
    $slides_data['errorMessage'] = 'No slides found';
    return $slides_data;
  }

  // Loop througth the slides and add the data to the response (title, description, author, date, img)
  foreach($slides as $slide){
    $description = $slide->post_content;

    //remove all backslashes from the img_url inside array
    $slides_data['data'][] = array(
      'title' => $slide->post_title,
      'description' => $description,
      'author' => get_the_author_meta('display_name', $slide->post_author),
      'date' => $slide->post_date,
      'img' => wp_get_attachment_url( get_post_thumbnail_id($slide->ID), 'full')
    );
  }

  

  return $slides_data;
}

/*http://localhost/wp-json/carousel-ws-rest-api/v1/slides*/


// Register the rest route
add_action( 'rest_api_init', function () {
  register_rest_route( 'carousel-ws-rest-api/v1', '/slides', array(
    'methods' => 'GET',
    'callback' => 'get_slides'
  ) );
} );



?>