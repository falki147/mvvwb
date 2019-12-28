<?php
/**
 * File which is used to render the location metabox HTML
 *
 * Following variables are passed to it:
 * - $location: Contains the current location value
 * - self::LOCATION_NAME: Contains the name which should be used for the HTML input element
 */

namespace MVVWB\AdminViews;

?><p>
    <label for="<?=self::LOCATION_NAME?>"><?=__('Location', 'mvvwb')?></label>

    <input id="<?=self::LOCATION_NAME?>" name="<?=self::LOCATION_NAME?>"
        type="text" class="widefat" value="<?=esc_attr($location)?>">
</p>
