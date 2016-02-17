<?php
/*
Plugin Name: LIQUID RWD Plus
Plugin URI: https://lqd.jp/wp/plugin.html
Description: Responsive Web Design Plus (RWD+). Users can switch the mobile display and PC display on smartphones.
Author: LIQUID DESIGN
Author URI: https://lqd.jp/wp/
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0.1
*/
/*  Copyright 2016 LIQUID DESIGN (email : info@lqd.jp)

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

// admin
add_action( 'admin_menu', 'liquid_rwd_plus_admin' );
function liquid_rwd_plus_admin() {
    add_options_page(
      'RWD+',
      'RWD+',
      'administrator',
      'liquid-rwd-plus',
      'liquid_rwd_plus_admin_page'
    );
    register_setting(
      'liquid_rwd_plus_group',
      'liquid_rwd_plus_toggle',
      'liquid_rwd_plus_toggle_validation'
    );
}
function liquid_rwd_plus_toggle_validation( $input ) {
     $input = (int) $input;
     if ( $input === 0 || $input === 1 ) {
          return $input;
     } else {
          add_settings_error(
               'liquid_rwd_plus_toggle',
               'liquid_rwd_plus_toggle_validation_error',
               __( 'illegal data', 'error' ),
               'error'
          );
     }
}
function liquid_rwd_plus_admin_page() {
     $liquid_rwd_plus_toggle = get_option( 'liquid_rwd_plus_toggle' );
     if( empty( $liquid_rwd_plus_toggle ) ){
          $checked_on = 'checked="checked"';
          $checked_off = '';
     } else {
          $checked_on = '';
          $checked_off = 'checked="checked"';
     }
?>
<div class="wrap">
<h1>RWD+ Settings</h1>
<form method="post" action="options.php">
<?php
     settings_fields( 'liquid_rwd_plus_group' );
     do_settings_sections( 'default' );
?>
<table class="form-table">
     <tbody>
     <tr>
          <th scope="row">Enable RWD+</th>
          <td>
               <label for="liquid_rwd_plus_toggle_on"><input type="radio" id="liquid_rwd_plus_toggle_on" name="liquid_rwd_plus_toggle" value="0" <?php echo $checked_on; ?>>On</input></label>
               <label for="liquid_rwd_plus_toggle_off"><input type="radio" id="liquid_rwd_plus_toggle_off" name="liquid_rwd_plus_toggle" value="1" <?php echo $checked_off; ?>>Off</input></label>
          </td>
     </tr>
     </tbody>
</table>
<?php submit_button(); ?>
</form>
<p>by <a href="https://lqd.jp/wp/" target="_blank" rel="nofollow">LIQUID PRESS</a></p>
</div><!-- /wrap -->
<?php } 

// main
$liquid_rwd_plus_toggle = get_option( 'liquid_rwd_plus_toggle' );
if( empty( $liquid_rwd_plus_toggle ) ){
    add_action( 'wp_enqueue_scripts', 'liquid_rwd_plus_scripts');
    function liquid_rwd_plus_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery.cookie', plugins_url() . '/liquid-rwd-plus/js/jquery.cookie.js', array() );
        wp_enqueue_script( 'rwd', plugins_url() . '/liquid-rwd-plus/js/rwd.js', array() );
    }
}

?>