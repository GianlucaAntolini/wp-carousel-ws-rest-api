

<?php
/*
Plugin Name: Carousel WS REST API
Description: Plugin to provide a REST API that returns necessary data for an hypotetic carousel
Version: 1.0
Author: Gianluca Antolini
*/

// Function to register the custom post type "slides"
// A slide has a title, description, image/video thumbnail, author and date
function create_slides_post_type() {

    // Labels
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
      
    // Options
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

    // Register the custom post type
    register_post_type( 'slides', $args );
}

// Register the custom post type on the 'init' hook
add_action( 'init', 'create_slides_post_type' );


// Function to get the slides data in JSON format
function get_slides( $data ) {

  // Get the language parameter from the request, default to 'it'
  $language = isset( $data['lang'] ) && in_array( $data['lang'], array( 'it', 'en' ) ) ? $data['lang'] : 'it';

  // Get the slides from the database, posts_per_page = -1 to get all the slides
  $slides = get_posts( array(
    'post_type' => 'slides',
    'posts_per_page' => -1,
  ) );

  // Remove all slides that don't have a thumbnail or a title or a description
  $slides = array_filter($slides, function($slide){
    return has_post_thumbnail($slide->ID) && !empty($slide->post_title) && !empty($slide->post_content);
  });

  // Filter slides based on language using Polylang
  if( function_exists('pll_get_post_language')){
    $slides = array_filter($slides, function($slide) use ($language){
      return pll_get_post_language($slide->ID) === $language;
    });
  }

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

  // Loop through the slides and add the data to the response (title, description, author, date, img)
  foreach($slides as $slide){

    $slides_data['data'][] = array(
      'title' => $slide->post_title,
      'description' =>  $slide->post_content,
      'author' => get_the_author_meta('display_name', $slide->post_author),
      'date' => $slide->post_date,
      'img' => wp_get_attachment_url( get_post_thumbnail_id($slide->ID), 'full')
    );
  }

  return $slides_data;
}

// Example of the REST API endpoint
/*http://localhost/wp-json/carousel-ws-rest-api/v1/slides*/
// Example of the REST API endpoint with language parameter
/*http://localhost/wp-json/carousel-ws-rest-api/v1/slides?lang=en*/

// Register the rest route with language parameter
add_action( 'rest_api_init', function () {
  register_rest_route( 'carousel-ws-rest-api/v1', '/slides', array(
    'methods' => 'GET',
    'callback' => 'get_slides',
    'args' => array(
      'lang' => array(
        'default' => 'it',
        'sanitize_callback' => 'sanitize_text_field',
      ),
    ),
  ) );
} );

?>