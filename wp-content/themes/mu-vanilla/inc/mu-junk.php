<?php

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


// First, we remove all the RSS feed links from wp_head using remove_action
remove_action( 'wp_head','feed_links', 2 );
remove_action( 'wp_head','feed_links_extra', 3 );

// Resource Hints is a rather new W3C specification that “defines the dns-prefetch,
// preconnect, prefetch, and prerender relationships of the HTML Link Element (<link>)”.
// These can be used to assist the browser in the decision process of which origins it
// should connect to, and which resources it should fetch and preprocess to improve page performance.
remove_action( 'wp_head', 'wp_resource_hints', 2 );

// Sends a Link header for the REST API.
// https://developer.wordpress.org/reference/functions/rest_output_link_header/
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

// Outputs the REST API link tag into page header.
// https://developer.wordpress.org/reference/functions/rest_output_link_wp_head/
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

// https://developer.wordpress.org/reference/functions/wp_oembed_add_discovery_links/
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// WordPress Page/Post Shortlinks
// URL shortening is sometimes useful, but this automatic ugly url
// in your header is useless. There is no reason to keep this. None.
remove_action( 'wp_head', 'wp_shortlink_wp_head');

// Weblog Client Link
// Are you editing your WordPress blog using your browser?
// Then you are not using a blog client and this link can probably be removed.
// This link is also used by a few 3rd party sites/programs that use the XML-RPC request formats.
// One example is the Flickr API. So if you start having trouble with a 3rd party service that
// updates your blog, add this back in. Otherwise, remove it.
remove_action ('wp_head', 'rsd_link');

// Windows Live Writer Manifest Link
// If you don’t know what Windows Live Writer is (it’s another blog editing client), then remove this link.
remove_action( 'wp_head', 'wlwmanifest_link');

// WordPress Generator (with version information)
// This announces that you are running WordPress and what version you are using. It serves no purpose.
remove_action('wp_head', 'wp_generator');

function my_deregister_scripts(){
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// remove wp version number from scripts and styles
function remove_css_js_version( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_version', 9999 );
add_filter( 'script_loader_src', 'remove_css_js_version', 9999 );