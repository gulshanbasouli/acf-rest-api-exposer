<?php
/**
 * Plugin Name:       ACF REST API Exposer
 * Plugin URI:        https://github.com/your-username/acf-rest-api-exposer
 * Description:       Exposes Advanced Custom Fields (ACF) data for all public custom post types and standard posts in the WordPress REST API under the "ACF" object.
 * Version:           1.0.0
 * Author:            Gulshan Ali
 * Author URI:        https://github.com/your-username
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       acf-rest-api-exposer
 * Requires at least: 5.0
 * Requires PHP:      7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register ACF fields in the WordPress REST API for all eligible post types.
 *
 * Post types excluded: acf-field-group, acf-field (internal ACF types).
 * Post types included: all public custom post types + standard "post".
 */
function lf_crt_ACF_meta_in_appdev_REST() {

    // Post types to exclude from REST API exposure
    $postypes_to_exclude = [ 'acf-field-group', 'acf-field' ];

    // Additional built-in post types to include (e.g. "post", "page")
    $extra_postypes_to_include = [ 'post' ];

    // Get all custom (non-built-in) post types
    $post_types = array_diff(
        get_post_types( [ '_builtin' => false ], 'names' ),
        $postypes_to_exclude
    );

    // Merge with extra built-in post types
    $post_types = array_merge( $post_types, $extra_postypes_to_include );

    foreach ( $post_types as $post_type ) {
        register_rest_field(
            $post_type,
            'ACF',
            [
                'get_callback' => 'lf_expse_all_ACF_fields',
                'schema'       => null,
            ]
        );
    }
}
add_action( 'rest_api_init', 'lf_crt_ACF_meta_in_appdev_REST' );


/**
 * Callback: Return all ACF fields for a given post object.
 *
 * @param array $object The REST API post object.
 * @return mixed        Array of ACF fields or false if none found.
 */
function lf_expse_all_ACF_fields( $object ) {
    $ID = $object['id'];
    return get_fields( $ID );
}
