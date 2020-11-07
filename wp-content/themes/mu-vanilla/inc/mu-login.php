<?php

    namespace musca\login;

    //Añade capa de personalización al login de WordPress
    function logo()
    {
    ?>
        <style type="text/css">
        #login h1 a, .login h1 a
        {
            background-image: url( <?=get_template_directory_uri()?>/assets/admin/images/login-logo.png);
            /*margin-bottom: 0;*/
            background-size: 180px;
            width: 300px;
            height: 180px;
            margin-left: auto;
            margin-right: auto;
        }
        .login form
        {
            border-radius: 5px;
        }
        .wp-core-ui .button-primary
        {
            background: #0779ad !important;
            border-color: #0779ad !important;
            box-shadow: 0 1px 0 #0779ad !important;
            text-shadow: 0 -1px 1px #0779ad, 1px 0 1px #0779ad, 0 1px 1px #0779ad, -1px 0 1px #0779ad !important;
            color: #fff !important;
        }
        body.login
        {
            background-color: #0779ad;
        }
        .login #backtoblog a, .login #nav a
        {
            color: #fff !important;
        }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'musca\login\logo' );

    function logo_url_title()
    {
        return 'Pon aquí el texto que quieras';
    }
    add_filter( 'login_headertitle', 'musca\login\logo_url_title' );

    function logo_url()
    {
        return home_url();
    }
    add_filter( 'login_headerurl', 'musca\login\logo_url' );

    function no_wordpress_errors()
    {
        return 'Ups! Algo has puesto mal...';
    }
    add_filter( 'login_errors', 'musca\login\no_wordpress_errors' );

    function eliminar_vibracion_login()
    {
        remove_action('login_head', 'wp_shake_js', 12);
    }
    add_action('login_head', 'musca\login\eliminar_vibracion_login');