<?php
/**
 * Defines HomeController class
 */

namespace MVVWB\Controller;

/**
 * Class which helps rendering the content of the home page
 *
 * This class is not intended to be intantiated
 */
class HomeController {
    /**
     * Renders the HTML of the home page to the output buffer
     */
    public static function render() {
        ob_start();

        if (is_active_sidebar('home-sidebar'))
            dynamic_sidebar('home-sidebar');

        $homeWidgets = ob_get_clean();

        $locations = get_nav_menu_locations();
        
        $menuObject = isset($locations['home-menu']) ?
            wp_get_nav_menu_object($locations['home-menu']) : null;
        
        $menu = [];

        if ($menuObject) {
            // This menu also requires the description of each of the elements. This is why we don't
            // let wordpress generate the HTML because it doesn't contain this information
            foreach (wp_get_nav_menu_items($menuObject) as $menuItem) {
                $item = [
                    'title' => $menuItem->title,
                    'url'   => $menuItem->url,
                    'text'  => ''
                ];

                if ($menuItem->object === 'category')
                    $item['text'] = category_description($menuItem->object_id);
                elseif ($menuItem->object !== 'custom')
                    $item['text'] = get_the_excerpt($menuItem->object_id);

                $menu[] = $item;
            }
        }

        $name = get_bloginfo('name');

        include MVVWB_TEMPLATE_VIEWS . 'HomeView.php';
    }
}
