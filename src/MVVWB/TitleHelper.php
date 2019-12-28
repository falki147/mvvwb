<?php
/**
 * Defines TitleHelper class
 */

namespace MVVWB;

/**
 * Provides a utility function for transforming the title
 *
 * This class is not intended to be intantiated
 */
class TitleHelper {
    /**
     * Encapsulates the first word of the title with a span tag
     *
     * @param string $title the title of the page
     * @return string the transformed title
     */
    public static function transform($title) {
        return preg_replace_callback('/^\\S*/', function ($matches) {
            return '<span>' . $matches[0] . '</span>';
        }, $title);
    }
}
