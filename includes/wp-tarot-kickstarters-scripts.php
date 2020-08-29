<?php

function wpggr_add_scripts() {
    wp_enqueue_style( 'wpggr-main-style', plugins_url() . '/wp-tarot-kickstarters/css/styles.css');
    wp_enqueue_script( 'wpggr-main-script', plugins_url() . '/wp-tarot-kickstarters/js/main.js');
}

add_action( 'wp_enqueue_scripts', 'wpggr_add_scripts' );

