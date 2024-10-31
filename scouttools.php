<?php
/**
 * Plugin Name: Scout Tools
 * Plugin URI:  http://rexi.dk/scout-tools/
 * Description: Skriv morse, A-K kode på din hjemmeside.
 * Version:     1.0.4
 * Author:      René Staghøj Nielsen
 * Author URI:  http://rexi.dk/
 * Text Domain: strsn
 * Domain Path: /languages
 * License:     GPL2
 */

// Exit if accessed directly
if(!defined('ABSPATH')){
    exit;
}

/** esc_html__( 'Tekst her' , 'strsn') **/

/** Load sprog Start **/

function strsn_load_textdomain() {
  load_plugin_textdomain( 'strsn', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

add_action( 'plugins_loaded', 'strsn_load_textdomain' );

/** Load sprog Slut **/


/**  Menu Start **/

function strsn_plugin_setup_menu(){
	add_menu_page('Scout Tools Denmark', 'Scout Tools', 'manage_options', 'strsn', 'strsn_main', 'dashicons-clipboard');
}

add_action('admin_menu', 'strsn_plugin_setup_menu');

/**  Menu Slut **/

/**  Shortcode Morse Start **/

add_shortcode("morse", "strsn_morse_process_shortcode");
 
function strsn_morse_process_shortcode($atts){
$a = shortcode_atts(array('id'=>'-1'), $atts);
        // No ID value
        if(strcmp($a['id'], '-1') == 0){
                return "";
        }

$a['id'] = strtolower($a['id']);

/* Bogstaver */
$strsn_search  = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'n', 'm', 'o', 'p', 'q',
					   'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'æ', 'ø', 'å', ' ',
					   '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

/* Bogstaver i kode */
$strsn_replace = array('.-/', '-.../', '-.-./', '-../', './', '..-./', '--./', '..../', '../', '.---/', '-.-/',
					   '.-../', '-./', '--/', '---/', '.--./', '--.-/', '.-.', '.../', '-/', '..-/', '...-/',
					   '.--/', '-..-/', '-.--', '--..', '.-.-', '---.', '.--.-', '/',
					   '.----/', '..---/', '...--/', '....-/', '...../', '-..../', '--.../', '---../', '----./', '-----/');

$strsn_subject = $a['id'];

        return "<p>" .str_replace($strsn_search, $strsn_replace, $strsn_subject). "</ p>";
}

/** Shortcode Morse Slut **/

/**  Shortcode A-K Start **/

add_shortcode("ak", "strsn_ak_process_shortcode");
 
function strsn_ak_process_shortcode($atts){
$ak = shortcode_atts(array('id'=>'-1'), $atts);
        // No ID value
        if(strcmp($ak['id'], '-1') == 0){
                return "";
        }

$ak['id'] = strtolower($ak['id']);

/* Bogstaver */
$strsn_search  = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'n', 'm', 'o', 'p', 'q',
					   'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'æ', 'ø', 'å');

/* Bogstaver i kode */
$strsn_replace = array('k', 'l', 'n', 'm', 'o', 'p', 'q','r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'æ',
					   'ø', 'å','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');

$strsn_subject = $ak['id'];

        return str_replace($strsn_search, $strsn_replace, $strsn_subject). "</ p>";
}

/** Shortcode A-K Slut **/

function strsn_main(){

echo "<h1>" .esc_html__( 'Scout Tools' , 'strsn'). "</h1>";
echo "<p>" .esc_html__( 'Her kan du finde værkertøjer til dit spejder arbejdet. Eks. morse oversætter osv...' , 'strsn'). "</p>";
echo esc_html__( 'For at få en morse kode på din side eller indlæg så skal du bruge [morse id=&#34;Det der skal være morse kode skrives her&#34;]' , 'strsn');
}


?>