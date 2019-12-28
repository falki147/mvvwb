<?php
/**
 * Defines LocationHelper class
 */

namespace MVVWB;

/**
 * Helps with loading and saving the location of a post (e.g. school, church square)
 *
 * This class is not intended to be intantiated
 */
class LocationHelper {
    /**
     * Retrieves the location of a given post
     *
     * @param \WP_Post $post the post where the location should be gathered
     * @return string the locaiton or an empty string, when it wasn't set yet
     */
    public static function getLocation($post) {
        return get_post_meta($post->ID, 'mvvwb_location', true);
    }

    /**
     * Sets the location of a given post
     *
     * @param \WP_Post $post the post where the location should be stored
     * @param string $location the location to store
     */
    public static function setLocation($post, $location) {
        update_post_meta($post->ID, 'mvvwb_location', $location);
    }
}
