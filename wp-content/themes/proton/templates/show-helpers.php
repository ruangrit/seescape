<?php

// Show Maintenance
if (isset($_GET['maintenance-mode'])) {
    if ($_GET['maintenance-mode'] == 'true') {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        wp_head();
        get_template_part('templates/page-maintenance');
        exit();
    }
}

// Show Coming Soon
if (isset($_GET['coming-soon'])) {
    if ($_GET['coming-soon'] == 'true') {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        wp_head();
        get_template_part('templates/page-coming-soon');
        exit();
    }
}
