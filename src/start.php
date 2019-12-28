<?php
/**
 * Initializes base constants and sets up autoloading
 */

if (!defined('MVVWB_TEMPLATE_BASE')) {
    /** Base path of the template */
    define('MVVWB_TEMPLATE_BASE', get_template_directory_uri() . '/');
}

if (!defined('MVVWB_TEMPLATE_VERSION')) {
    /** Version of this template */
    define('MVVWB_TEMPLATE_VERSION', '{{version}}');
}

if (!defined('MVVWB_TEMPLATE_VIEWS')) {
    /** Absolute path to the views */
    define('MVVWB_TEMPLATE_VIEWS', implode(DIRECTORY_SEPARATOR, [ __DIR__, 'MVVWB', 'Views', '' ]));
}

if (!defined('MVVWB_TEMPLATE_ADMIN_VIEWS')) {
    /** Absolute path to the admin views */
    define('MVVWB_TEMPLATE_ADMIN_VIEWS', implode(DIRECTORY_SEPARATOR, [ __DIR__, 'MVVWB', 'AdminViews', '' ]));
}

if (!defined('MVVWB_TEMPLATE_AUTOLOAD')) {
    spl_autoload_register(function ($class) {
        // Only load classes from the "MVVWB" namespace
        if (strncmp('MVVWB', $class, 5) !== 0)
            return false;

        // Replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require_once $file;
            return true;
        }

        return false;
    });

    /**
     * Helper constant to determine if the autloading was set up or not
     * @internal
     */
    define('MVVWB_TEMPLATE_AUTOLOAD', '1');
}
