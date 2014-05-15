<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/modernizr.basic.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/styles.css">
        <?php wp_head() ?>
    </head>
    <body>
