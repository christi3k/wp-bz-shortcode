<?php
/**
 * Plugin Name: WP Bugzilla Shortcode
 * Plugin URI: https://github.com/christi3k/wp-bz-shortcode
 * Description: Adds a shortcode for generating links to Mozilla Bugzilla
 * Version: 0.1
 * Author: Christie Koehler (ck@christi3k.net)
 * Author URI: http://christiekoehler.com
 * License: GPL3
 */

/*  Copyright 2014 Christie Koehler (email : ck@christi3k.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


function wpbz_make_bugzilla_link( $attrs ){
  $bz_api_url = 'https://bugzilla.mozilla.org/rest/bug/';
  $bz_web_url = 'https://bugzilla.mozilla.org/show_bug.cgi?id=';
  extract( shortcode_atts( array( 'bug_id'=>'' ) , $attrs ));
  $response = wp_remote_get($bz_api_url.$bug_id);
  $json = wp_remote_retrieve_body(&$response);
  $data = json_decode($json, true);
  return '<a href="'$bug_web_url.$bug_id.'">Bug '. $bug_id . '</a> &ndash; '. $data['bugs'][0]['summary'] ;
}

add_shortcode('bugzilla','wpbz_make_bugzilla_link');
