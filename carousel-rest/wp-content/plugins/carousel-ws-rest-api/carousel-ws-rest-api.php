

<?php
/*
Plugin Name: Carousel WS REST API
Description: Plugin to provide a REST API that returns necessary data for an hypotetic carousel
Version: 1.0
Author: Gianluca Antolini
*/


/*
TODO:
- change db table -> img is now link (can also be a video)
                  -> title_eng and title_ita, description_eng and description_ita
- add language parameter to the request
- add error handling
*/
/**
 * Get slides data from database and return them as JSON
 *
 * @param array $data Options for the function.
 * @return string|null JSON string of the slides
 */
function get_slides( $data ) {
//   $posts = get_posts( array(
//     'author' => '1',
//   ) );

//   if ( empty( $posts ) ) {
//     return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
//   }

  //get data from database -> table is slides and columns are id, title, description, img
  // for now just get the data and return a string concatenating everything

  global $wpdb;
  $results = $wpdb->get_results( "SELECT * FROM slides" );
  $slides = array();
  foreach($results as $row){
       $slides[] = array(
              'id' => $row->id,
              'title' => $row->title,
              'description' => $row->description,
              'img' => $row->img
       );
  }
  return json_encode($slides);
}

/*http://localhost/wp-json/carousel-ws-rest-api/v1/slides/1*/

add_action( 'rest_api_init', function () {
  register_rest_route( 'carousel-ws-rest-api/v1', '/slides', array(
    'methods' => 'GET',
    'callback' => 'get_slides'
  ) );
} );
?>