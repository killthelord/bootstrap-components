<?php
/**
 * Plugin Name: Bootstrap Components
 * Plugin URI: http://www.dribbl.es
 * Description: Generate Bootstrap Component over functions or shortcode
 * Version: 0.0.1
 * Author: Killthelord
 * Author URI: http://twitter.com/rchmet
 * Requires at least: 3.3
 * Tested up to: 3.5
 *
 *
 * @package BootstrapComponents
 * @category Core
 * @author Killthelord
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'BootstrapComponents' ) ) {
 
 class BootstrapComponents {
 	
 	public static $incr = 0;
 	public static $data = array();
 	public static $components = array(
 		'block',
 		'breadcrumbs',
 		'button',
 		'descriptions',
 		'dropdown',
 		'menu',
 		'nav',
 		'navbar',
 		'table',
 		'tabs'
 	);
 	
 	public static function shortcode($name, $attrs, $content){
 		$comp_dir = dirname(__FILE__).'/components/';
 		$cmp_path = $comp_dir.$name.'.php';
 		
 		if(!file_exists($cmp_path))
 			return;
 			
 		ob_start();
		include $cmp_path;
 		$res = ob_get_clean();
 		
 		if(!empty($attrs['save'])){
 			self::$data[$attrs['save']] = $res;
 			return;
 		}
 		return $res; 		
 	}
 	
 	public static function block($attrs, $content){
 		return self::shortcode('block', $attrs, $content);
 	}
 	
 	public static function breadcrumbs($attrs, $content){
 		return self::shortcode('breadcrumbs', $attrs, $content);
 	}
 	
 	public static function button($attrs, $content){
 		return self::shortcode('button', $attrs, $content);
 	}
 	
 	public static function descriptions($attrs, $content){
 		return self::shortcode('descriptions', $attrs, $content);
 	}
 	
 	public static function dropdown($attrs, $content){
 		return self::shortcode('dropdown', $attrs, $content);
 	}
 	
 	public static function menu($attrs, $content){
 		return self::shortcode('menu', $attrs, $content);
 	}
 	
 	public static function nav($attrs, $content){
 		return self::shortcode('nav', $attrs, $content);
 	}
 	
 	public static function navbar($attrs, $content){
 		return self::shortcode('navbar', $attrs, $content);
 	}
 	
 	public static function table($attrs, $content){
 		return self::shortcode('table', $attrs, $content);
 	}
 	
 	public static function tabs($attrs, $content){
 		return self::shortcode('tabs', $attrs, $content);
 	}
 	
 	public static function init(){
 		// register shortcode
 		foreach(BootstrapComponents::$components as $cmp){
 			add_shortcode('boot-'.$cmp, array('BootstrapComponents', $cmp));
 		}
 		
		add_action('wp_enqueue_scripts', array('BootstrapComponents', 'add_script'));
 	}
 	
 	public static function add_script(){
 		wp_register_script('less', 'http://lesscss.googlecode.com/files/less-1.3.0.min.js');
 		wp_enqueue_script('less');
 		?>
 		<style type="text/less">
 			<?php readfile(dirname(__FILE__).'/base.css') ?>
 		</style>
 		<?php
 	}
 }
 
 function bsc($name, $attrs = array(), $content){
 	return BootstrapComponents::shortcode($name, $attrs, $content);
 }
 
 function bsc_($name, $attrs, $content){
 	echo BootstrapComponents::shortcode($name, $attrs, $content); 	
 }
 
 function bsc_attrs($attrs = array(), $exclude = array()){
 	$buffer = '';
 	$attrs = (array)$attrs;
 	foreach($attrs as $key => $value){
 		if(is_null($value)) continue;
 		if(in_array($key, $exclude)) continue;
 		if($value === true) {
 			$buffer .= ' '.$key;
 			continue;
 		}
 		if(bsc_startwith($key, 'data_')){
 			$key[4] = '-';
 		}
		$buffer .= ' '.$key.'="'.$value.'"';
 	}
 	return $buffer;
 }
 
 function bsc_data($key){
 	$res = BSC::$data[$key];
 	return $res;
 }
 
 function bsc_splitter($content, $splitter, $delimiter)
 {
 	if(empty($splitter)) $splitter = '\[\+\]';
 	if(empty($delimiter)) $delimiter  = '[-]';
 	$items = preg_split('/'.$splitter.'/', trim($content));
 	foreach($items as $item){
 		$result[] = explode($delimiter, trim($item));
 	} 
 	return $result;
 }
 
function bsc_startwith($haystack, $needle)
{
    return !strncmp($haystack, $needle, strlen($needle));
}
	
function bsc_endwith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
	
function bsc_add_shortcodes($content){
	global $shortcode_tags;
	
	$old = $shortcode_tags;
	remove_all_shortcodes();
	
	// register shortcode
	foreach(BootstrapComponents::$components as $cmp){
		add_shortcode('boot-'.$cmp, array('BootstrapComponents', $cmp));
	}

	$content = do_shortcode($content);
	$shortcode_tags = $old;

	return $content;
}

add_filter('the_content', 'bsc_add_shortcodes', 7);
add_action('init', array('BootstrapComponents', 'init'));

}
