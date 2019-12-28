<?php
/**
 * Defines LocationMetabox class
 */

namespace MVVWB;

/**
 * Handles the metabox functionality for locations
 *
 * It creates the HTML for the metabox and handles the storing of the location with the help of the
 * LocationHelper.
 *
 * This class is not intended to be intantiated
 */
class LocationMetabox {
    /**
     * Name of the location HTML input field
     * @internal
     */
    const LOCATION_NAME = 'mvvwb_location';

    /**
     * Adds the metabox to wordpress
     */
    public static function addMetabox() {
        add_meta_box(
            'location-box',
            __('Location', 'mvvwb'),
            function ($post) {
                $location = LocationHelper::getLocation($post);

                include MVVWB_TEMPLATE_ADMIN_VIEWS . 'LocationMetaboxView.php';
            },
            [ 'post' ], 'side'
        );
    }

    /**
     * Saves the data to the post if the location was set
     *
     * @param int $postID id of the post
     * @param mixed[] $values values which were sent with the request e.g. $_POST
     */
    public static function saveMetabox($postID, $values) {
        if (isset($values[self::LOCATION_NAME]))
            LocationHelper::setLocation(\get_post($postID), $values[self::LOCATION_NAME]);
    }
}
