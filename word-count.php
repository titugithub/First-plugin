<?php 


/**
 * Plugin Name:       Word Count
 * Plugin URI:        https://wordpress.developertitu.com
 * Description:       Count Words form any WordPres Post
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Titu
 * Author URI:        https://developertitu.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */



 
function my_plugin_override() {

    load_plugin_textdomain( 'word-count', false, dirname( __FILE__ ) . '/languages' ); 

}

add_action( 'plugins_loaded', 'my_plugin_override' );


function wordcount_count_words($content){
    $stripped_content = strip_tags($content);
    $wordn = str_word_count( $stripped_content );
    $label = __("Total number of words","word-count");
    $label = apply_filters( "wordcount_heading","$label" );
    $tag = apply_filters( "wordcount_heading","h2" );
    $content .= sprintf('<%s>%s: %s</%s>',$tag,$label,$wordn,$tag);
    return $content;
}

add_filter( the_content, 'wordcount_count_words' );