<?php
/**
 * File which is used to render the footer HTML
 * 
 * Following variables are passed to it:
 * - $navigation: Contains the footer menu HTML code
 */

namespace MVVWB\Views;

?><footer class="footer">
    <nav class="navigation">
        <?=$navigation?>
    </nav>
    <div class="copyright">
        &copy; <a href="https://www.mvvwb.at/">Musikverein Vorderweissenbach</a>, 2019
    </div>
</footer>
