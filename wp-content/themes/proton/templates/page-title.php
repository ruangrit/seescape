<?php

// Template: Page Title

$proton_page_title = get_field("proton_page_title");

if($proton_page_title) :
?>
    <div class="container">
        <div class="page-title ml-top-padding">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo $proton_page_title; ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
