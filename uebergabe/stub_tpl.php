<?php
define('ABSPATH','/');define('KA_DRAFT',false);
function esc_url($u){return $u;} function esc_html($s){return htmlspecialchars($s,ENT_QUOTES,'UTF-8',false);} function esc_attr($s){return htmlspecialchars($s,ENT_QUOTES);}
function esc_textarea($s){return htmlspecialchars($s);}
function get_theme_file_uri($p){return $p;} function get_theme_file_path($p){return __DIR__.'/'.$p;} function home_url($p=''){return $p;} function admin_url($p=''){return '/'.$p;}
function wp_nonce_field(){echo '<input type="hidden" name="ka_nonce" value="x">';} function sanitize_key($s){return $s;} function wp_unslash($s){return $s;}
function get_option($k,$d=null){return $d;} function wp_kses($s,$a){return strip_tags($s,'<strong><em><br>');} function wp_kses_post($s){return $s;}
function wpautop($s){$p=preg_split('/\n\s*\n/',trim($s));return implode("\n",array_map(fn($x)=>'<p>'.trim($x).'</p>',$p));}
function antispambot($s){return $s;} function wp_strip_all_tags($s){return strip_tags($s);} function wp_json_encode($d,$f=0){return json_encode($d,$f);}
function add_action(){} function register_setting(){} function add_menu_page(){} function add_filter(){}
$GLOBALS['lp']=0; $GLOBALS['lt']='Impressum';
function get_page_by_path($s){return null;} function apply_filters($t,$c){return $c;} function get_the_content(){return '';} function get_the_title(){return $GLOBALS['lt'];}
function have_posts(){ if($GLOBALS['lp']<1){return true;} return false;} function the_post(){$GLOBALS['lp']++;}
function the_title(){echo $GLOBALS['lt'];} function the_content(){}
require 'inc/icons.php'; require 'inc/content.php'; require 'inc/views.php';
ka_chrome();
echo '<div class="kview" data-view="home"><main class="view view-home">'; $GLOBALS['ka_view']='home'; ka_view_home(); echo '</main></div>';
foreach ([['ueber-mich','about'],['leistungen','services'],['ablauf','process'],['kontakt','contact']] as $v){
  echo '<div class="kview" data-view="'.$v[0].'" hidden><main class="view view-'.$v[1].'">'; $GLOBALS['ka_view']=$v[1]; call_user_func('ka_view_'.$v[1]); if($v[1]!=='contact') ka_contact_band(); else ka_next_link(); echo '</main></div>';
}
foreach ([['impressum','Impressum'],['datenschutz','Datenschutz']] as $v){
  $GLOBALS['lp']=0;$GLOBALS['lt']=$v[1];
  echo '<div class="kview" data-view="'.$v[0].'" hidden><main class="view view-legal">'; $GLOBALS['ka_view']='legal'; ka_view_legal(); ka_contact_band(false); ka_next_link(); echo '</main></div>';
}
ka_footer();
echo '<script>window.KA_DATA='.json_encode(ka_js_data(),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).';</script>';
