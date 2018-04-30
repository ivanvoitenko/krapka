<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheetsЖ
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

add_action('template_redirect', function(){
    if (
        is_user_logged_in() && is_page('register') ||
        !is_user_logged_in() && is_page() && (is_page('account') || get_post(get_queried_object()->post_parent)->post_name == 'account')
    ) {
        wp_redirect(home_url());die;
    }

});

add_filter( 'themes_update_check_locales', '__return_empty_array' );
add_filter( 'plugins_update_check_locales', '__return_empty_array' );
add_filter( 'pvc_enqueue_styles', '__return_false' );

add_action('init', function(){
    setcookie('front_banner', true, time() + 2 * 365 * 24* 60 * 60);
});

add_filter('the_excerpt', function($ex){
    return strip_tags($ex);
});

function paulund_remove_default_image_sizes( $sizes) {
    unset( $sizes['medium_large']);
    unset( $sizes['medium']);
    unset( $sizes['large']);

    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'paulund_remove_default_image_sizes');


function author_url($echo = true) {
    $url = esc_url( get_author_posts_url( get_the_author_meta('ID') ) );

    if ($echo) {
        echo $url;
    } else {
        return $url;
    }
}

function human_time($post = null) {
    $post = get_post($post);

    if ( ! $post ) {
        return false;
    }

    load_textdomain( 'admin', WP_LANG_DIR . "/admin-".get_locale().".mo" );

    $m_time = $post->post_date;
    $time = get_post_time( 'G', true, $post );

    $time_diff = time() - $time;

    if ( $time_diff > 0 && $time_diff < DAY_IN_SECONDS ) {
        $h_time = sprintf( __( '%s ago', 'admin' ), human_time_diff( $time ) );
    } else {
        $h_time = get_the_date('', $post);
    }

    echo $h_time;
}

add_filter('body_class', function(){
    $classes = [];

    if (is_single()) {
        $classes[] = 'single';
    } elseif (is_archive()) {
        $classes[] = 'archive';
        $classes[] = 'archive-id-' . get_queried_object_id();
    } elseif (is_page()) {
        $classes[] = 'is-page-id-' . get_queried_object_id();
        $classes[] = 'is-page';
        $classes[] = 'is-page-' . get_queried_object()->post_name;
    }

    return $classes;
}, 11);
add_action('alm_unlimited_installed', '__return_true');


add_action('save_post', 'jr_select_parent_terms', 10, 2); // automatically select parent terms
function jr_select_parent_terms($post_id, $post) {
    if( $post->post_type == 'revision' ) return;
    $taxonomy = 'category';

    $terms = wp_get_object_terms($post->ID, $taxonomy);

    foreach ($terms as $term) {
        $parenttags = get_ancestors($term->term_id, $taxonomy);
        wp_set_object_terms( $post->ID, $parenttags, $taxonomy, true );
    }

}

function custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
add_filter( 'excerpt_more', function(){return '...';}, 999 );

add_shortcode('donation', function(){
    ob_start();

    get_template_part('templates/donation-btn');

    $content = ob_get_clean();

    return $content;

});

add_action('login_header', function(){
    echo '<style>.login h1 a {background-size: 200px;width:200px;margin-bottom:0;height:60px}</style>';
});

if (is_admin()) {
    add_action('admin_print_footer_scripts', 'qtranxf_admin_footer',999);
    remove_action('admin_footer', 'qtranxf_admin_footer',999);
}


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Настройки темы',
        'menu_title'	=> 'Настройки темы',
        'menu_slug' 	=> 'theme-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}

add_filter('alm_append_data', function($r){
    global $repeater;

    $repeater = $r;

    ob_start();

    get_template_part('alm_templates/btn');

    $content = ob_get_clean();

    return $content;
});

function themeblvd_disable_admin_bar() {
    if ( ! current_user_can('edit_posts') ) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action( 'after_setup_theme', 'themeblvd_disable_admin_bar' );

/**
 * Redirect back to homepage and not allow access to
 * WP admin for Subscribers.
 */
function themeblvd_redirect_admin(){
    if ( !isset($_POST['action']) && ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
        wp_redirect( get_the_permalink(104) );
        exit;
    }
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );

add_action('wp_ajax_nopriv_liqpay', 'liqpay');
add_action('wp_ajax_liqpay', 'liqpay');
function liqpay() {
    include 'lib/LiqPay.php';

    $params = array(
        'action'         => 'pay',
        'amount'         => (int) $_POST['value'],
        'sandbox'        => TRUE,
        'currency'       =>  LiqPay::CURRENCY_UAH,
        'description'    => 'Пожертвование сайту Krapka.Club',
        'result_url'     => get_permalink(114),
        'version'        => '3'
    );

    $public_key  = 'i42349064372';
    $private_key = '3GihKq5dbJUdDCmcA2Wae9MDLGZyAaN38T7ipjnV';

    $liqpay = new LiqPay($public_key, $private_key);
    $params    = $liqpay->cnb_params($params);
    $data      = base64_encode(json_encode($params));
    $signature = $liqpay->cnb_signature($params);

    echo json_encode([
        'data' => $data,
        'sign' => $signature
    ]);
    die;
}

if (!is_user_logged_in()) {
    add_action( 'wp_ajax_nopriv_ajaxlogin', function(){
        check_ajax_referer( 'ajax-login-nonce', 'security' );

        if (!is_email( $_POST['user_login']) ) {
            echo json_encode(array('loggedin'=>false, 'error'=> __('Пожалуйста, введите действительный адрес') ));
        } else {

            global $wpdb;

            if(!isset($_POST['user_login'])) {
                echo json_encode(array('loggedin'=>false, 'error'=> __('Логин или пароль не верный') ));die;
            }

            $row = $wpdb->get_row($wpdb->prepare( "SELECT ID FROM {$wpdb->users} WHERE user_email = '%s' AND user_status = 1", $_POST['user_login']) );

            if (!$row){
                echo json_encode(array('loggedin'=>false, 'error'=> __('Аккаунт не активирован') ));die;
            }

            $user_signon = wp_signon( $_POST, false );
            if ( is_wp_error($user_signon) ){
                echo json_encode(array('loggedin'=>false, 'error'=> __('Логин или пароль не верный') ));
            } else {
                echo json_encode(array('loggedin'=>true, 'redirect'=> $_POST['_wp_http_referer'] ));
            }

        }


        die();
    } );

}

function get_countries_array() {
    $countries = [];


    if (($handle = fopen(__DIR__ . "/lib/_countries.csv", "r")) !== FALSE) {
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

            if(!$row++)
                continue;

            $countries[] = $data[1];

        }

        fclose($handle);
    }

    sort($countries);

    return $countries;
}

add_filter('acf/get_field_groups', function($fields){

    if (!function_exists('qtranxf_gettext'))
        return $fields;

    $fields = array_map(function($data){
        if (isset($data['title'])) {
            $data['title'] = qtranxf_gettext($data['title']);
        }

        return $data;
    }, $fields);

    return $fields;
});

function edit_profile(){
    global $userdata;

    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'edit_profile')) {
        wp_redirect(get_permalink(151));die;
    }

    if (isset($_POST['first_name'])) {
        update_user_meta(get_current_user_id(), 'first_name', esc_html($_POST['first_name']));
    }

    if (isset($_POST['last_name'])) {
        update_user_meta(get_current_user_id(), 'last_name', esc_html($_POST['last_name']));
    }

    $valid_post_fields = [
        'first_name',
        'last_name',
        'description',
    ];

    foreach($valid_post_fields as $post_field) {
        if (isset($_POST[ $post_field ])) {
            update_user_meta(get_current_user_id(), $post_field, esc_html($_POST[ $post_field ]));
        }
    }

    $valid_acf_fields = [
        'position',
        'organization',
        'country',
        'city',
        'tags',
    ];

    foreach($valid_acf_fields as $acf_field) {
        if (isset($_POST[ $acf_field ])) {
            if (is_array($_POST[ $acf_field ])) {

                $_POST[ $acf_field ] = array_map(function($field) {
                    return esc_html($field);
                }, $_POST[ $acf_field ]);

                update_field($acf_field, $_POST[ $acf_field ], $userdata);
            } else {
                update_field($acf_field, esc_html($_POST[ $acf_field ]), $userdata);
            }

        }
    }

    update_user_meta(get_current_user_id(), 'filled', 1);

    wp_redirect(get_permalink(151));
}
add_action('admin_post_edit_profile', 'edit_profile');
add_action('admin_post_nopriv_edit_profile', 'edit_profile');

add_action('wp_ajax_upload_avatar', function(){

    if (!isset($_FILES['wpua-file']))
        die;

    WP_User_Avatar::wpua_action_process_option_update(get_current_user_id());

    echo json_encode(['src' => get_wp_user_avatar_src(get_current_user_id(), 'thumbnail')]);

    die;
});


add_action('wp_ajax_remove_article', function() {
    $valid_types = ['save', 'favorite'];

    if(!isset($_POST['type'], $_POST['ids']) || !in_array($_POST['type'], $valid_types) || !is_array($_POST['ids']))
        die;

    $user_posts = get_user_meta(get_current_user_id(), '_posts_' . $_POST['type'], true);

    foreach($_POST['ids'] as $id) {
        $key = array_search($id, $user_posts);
        if ($key === FALSE)
            die;

        unset($user_posts[ $key ]);
    }

    update_user_meta(get_current_user_id(), '_posts_' . $_POST['type'], $user_posts);

});

add_action('wp_ajax_save_article', function(){
    $valid_types = ['save', 'favorite'];

    if(!isset($_POST['type']) || !in_array($_POST['type'], $valid_types))
        die;

    $id = (int) $_POST['id'];

    if (
        (!$user_posts = get_user_meta(get_current_user_id(), '_posts_' . $_POST['type'], true)) ||
        !in_array($id, $user_posts)
    ) {
        $user_posts[] = $id;
    }

    update_user_meta(get_current_user_id(), '_posts_' . $_POST['type'], $user_posts);
});

add_action('wp_ajax_remove_user_tag', function(){
    global $userdata;

    if(!isset($_POST['tag']))
        die;

    $final_tags = [];

    if ($current_tags = get_field('tags', $userdata)) {
        foreach($current_tags as $tag) {
            if ($tag->term_id != $_POST['tag']) {
                $final_tags[] = $tag->term_id;
            }
        }

        update_field('tags', $final_tags, $userdata);
    }

});

add_action('wp_ajax_remove_subscribe_tag', function(){

    if(!isset($_POST['tag']))
        die;

    $final_tags = [];

    if ($current_tags = get_user_meta(get_current_user_id(), 'subscribe_tags', true)) {
        foreach($current_tags as $tag) {
            if ($tag != $_POST['tag']) {
                $final_tags[] = $tag;
            }
        }

        update_user_meta(get_current_user_id(), 'subscribe_tags', $final_tags);
    }

});

add_action('wp_ajax_save_user_settings', function(){
    if (!isset($_POST['form']))
        die;

    $errors = [];

    $valid_fields = [
        'user_email',
        'pass',
        'pass2',
        'privacy'
    ];

    parse_str($_POST['form'], $formdata);

    if(!isset($formdata['_wpnonce']) || !wp_verify_nonce($formdata['_wpnonce'], 'save_user_settings'))
        die;

    if(isset($formdata['tags']) && is_array($formdata['tags'])) {
        $formdata['tags'] = array_filter($formdata['tags'], function($val){
            return (int) $val > 0;
        });

        update_user_meta(get_current_user_id(), 'subscribe_tags', $formdata['tags']);
    }

    $formdata = array_filter($formdata, function($key) use ($valid_fields) {
        return in_array($key, $valid_fields);
    }, ARRAY_FILTER_USE_KEY);

    $formdata['ID'] = get_current_user_id();

    if (isset($formdata['user_email']) && $formdata['user_email'] && !filter_var($formdata['user_email'], FILTER_VALIDATE_EMAIL)) {
        unset($formdata['user_email']);

        $errors['user_email'] = 'Не верный email';

    } else if (isset($formdata['user_email']) && !$formdata['user_email']) {
        unset($formdata['user_email']);
    }


    if (isset($formdata['pass'], $formdata['pass2']) && $formdata['pass'] !== $formdata['pass2']) {
        $errors['pass'] = 'Пароли не совпадают';
        unset($formdata['pass']);

    } else if (isset($formdata['pass'], $formdata['pass2']) && $formdata['pass'] === $formdata['pass2']) {
        $formdata['user_pass'] = $formdata['pass'];
    }

    add_filter( 'send_password_change_email', '__return_false');
    add_filter( 'send_email_change_email',    '__return_false');

    wp_update_user($formdata);

    if (isset($formdata['privacy'])) {
        update_user_meta(get_current_user_id(), 'privacy', $formdata['privacy']);
    }

    die(json_encode(['errors' => $errors]));
});

add_action( 'login_form_register', function() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        if ( is_user_logged_in() ) {
            $this->redirect_logged_in_user();
        } else {
            wp_redirect( home_url( 'register' ) );
        }
        exit;
    }
} );

function register() {

    if (!isset($_POST['form']))
        die;
    echo 3;
    $errors = [];
    $data   = [];

    parse_str($_POST['form'], $formdata);
var_dump(!wp_verify_nonce($formdata['_wpnonce'], 'register'));die;
    if(!isset($formdata['_wpnonce']) || !wp_verify_nonce($formdata['_wpnonce'], 'register'))
        die;


    if (!isset($formdata['first_name']) || !$formdata['first_name']) {
        $errors['first_name'] = 'Поле не может быть пустое';
    }

    if (!isset($formdata['user_email']) || !$formdata['user_email']) {
        $errors['user_email'] = 'Поле не может быть пустое';
    } else if (isset($formdata['user_email']) && $formdata['user_email'] && !filter_var($formdata['user_email'], FILTER_VALIDATE_EMAIL)) {
        $errors['user_email'] = 'Не верный email';
    }

    if (!isset($formdata['user_pass']) || !$formdata['user_pass']) {
        $errors['user_pass'] = 'Поле не может быть пустое';
    }

    if (!$errors) {

        // Generate the password so that the subscriber will have to check email...
        $password = wp_generate_password( 12, false );

        $user_data = array(
            'user_login'    => $formdata['user_email'],
            'user_email'    => $formdata['user_email'],
            'user_pass'     => $formdata['user_pass'],
            'first_name'    => $formdata['first_name'],
            'nickname'      => $formdata['first_name'],
            'display_name'  => $formdata['first_name'],
        );

        $user_id = wp_insert_user( $user_data );
        wp_new_user_notification( $user_id, null, 'admin' );
        if($user_id instanceof WP_Error) {
            if(isset($user_id->errors['existing_user_login'])) {
                $errors['user_email'] =  $user_id->errors['existing_user_login'][0];
            }
            if(isset($user_id->errors['existing_user_email'])) {
                $errors['user_email'] =  $user_id->errors['existing_user_email'][0];
            }
            if(isset($user_id->errors['user_nicename_too_long'])) {
                $errors['first_name'] =  $user_id->errors['user_nicename_too_long'][0];
            }
            if(isset($user_id->errors['invalid_username'])) {
                $errors['first_name'] =  $user_id->errors['invalid_username'][0];
            }

        } else {

            global $wpdb;

            $key = wp_generate_password( 20, false );
            $wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'ID' => $user_id ) );

            $reg_link = home_url("register-3/?action=user_activate&key=$key&user_id=" . $user_id);

            $_SESSION['register_link'] = $reg_link;
            $_SESSION['user_email'] = $formdata['user_email'];

            send_reg_link($formdata['user_email'], $reg_link);

            $data = ['location' => home_url('register-2')];
        }

    }

    die(json_encode(['errors' => $errors, 'data' => $data]));
}
add_action('wp_ajax_nopriv_register', 'register');
add_action('wp_ajax_register', 'register');

add_action('template_redirect', function(){

    if (is_user_logged_in() && (is_page('register') ||is_page('register-2') ||is_page('register-3'))) {
        wp_redirect(home_url());die;
    }

    if (is_page('register-3') && isset($_GET['action'],$_GET['key'], $_GET['user_id']) && $_GET['action'] === 'user_activate') {
        global $wpdb;
        $wpdb->update( $wpdb->users, ['user_status' => 1], ['user_activation_key' => $_GET['key'], 'ID' => $_GET['user_id']] );
        wp_redirect(home_url('register-3'));
        die;
    }
});

function send_reg_link($email, $reg_link) {

    $message = __('To activate your account, visit the following address:') . "\r\n\r\n";
    $message .= '<' . $reg_link . ">\r\n\r\n";

    wp_mail($email, sprintf(__('Your account info')), $message);
}

add_action('wp_ajax_nopriv_resend_reg_link', function(){
    if (isset($_SESSION['user_email'], $_SESSION['register_link'])) {
        send_reg_link($_SESSION['user_email'], $_SESSION['register_link']);
    }
});

add_shortcode('subscribe-form', function(){
    ob_start();

    get_template_part('templates/footer', 'subscribe-form');

    $html = ob_get_contents();

    ob_end_clean();

    return $html;
});

add_action('wp_ajax_subscribe', 'subscribe_proccess');
add_action('wp_ajax_nopriv_subscribe', 'subscribe_proccess');
function subscribe_proccess() {
    $message = __('Новая Подписка') . "\r\n\r\n";
    $message .= "Теги: \r\n";
    $message .= join(', ', $_POST['email_tags']);

    wp_mail(get_option('admin_email'), __('Новая Подписка'), $message);
}

// Redirect uppercase urls to lowercase
//--------------------------------------------------
if(!is_admin()){
  add_action( 'init', 'storm_force_lowercase' );
}
function storm_force_lowercase(){
  $url = $_SERVER['REQUEST_URI'];
  if(preg_match('/[\.]/', $url)){
    return;
  }
  if(preg_match('/[A-Z]/', $url)){
    $lc_url = strtolower($url);
    header("Location: " . $lc_url);
    exit(0);
  }
}

// Add filter by author in wp-admin
//--------------------------------------------------
function add_filter_by_author() {
  $parameters = array(
    'name' => 'author',
    'show_option_all' => 'Все авторы'
  );

  if ( isset($_GET['user']) )
    $parameters['selected'] = $_GET['user'];

  wp_dropdown_users( $parameters );
}

add_action('restrict_manage_posts', 'add_filter_by_author');

// Check if is local site
//--------------------------------------------------
function is_local() {
  if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') return true;
}

// Registers an editor stylesheet for the theme.
//--------------------------------------------------
function wpdocs_theme_add_editor_styles() {
  add_editor_style();
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

// Using pre_get_posts to set posts per page (modify wp_query)
//--------------------------------------------------
function wpse120407_pre_get_posts( $query ) {
  $queried_object_id = get_queried_object_id();
  if ( $query->is_main_query() ) {
    switch ($queried_object_id) {
      case 1:
        $query->set( 'posts_per_page', 7 );
        break;
      case 2:
        $query->set( 'posts_per_page', 8 );
        break;
      default:
        $query->set( 'posts_per_page', 9 );
    }
  }
}
add_action( 'pre_get_posts', 'wpse120407_pre_get_posts' );

// Add meta 'description' filter (Yoast SEO plugin)
//--------------------------------------------------
function filter_wpseo_metadesc( $content ) {
  if (is_author()) {
    $cat_array = array();
    $args = array(
      'author' => get_the_author_meta('id'),
      'showposts'=>-1,
      'caller_get_posts'=>1
    );
    $author_posts = get_posts($args);
    if( $author_posts ) {
      foreach ($author_posts as $author_post) {
        foreach(get_the_category($author_post->ID) as $category) {
          $cat_array[$category->term_id] =  $category->name;
        }
      }
    }
    return 'Специализирующийся в таких темах как: ' . join(', ', $cat_array);
  }

  if ($content) {
    return substr(strip_tags($content), 0, 230) . '...';
  }
  return substr(strip_shortcodes(strip_tags(get_queried_object()->post_content)), 0, 230) . '...';

  return $content;
};

add_filter( 'wpseo_metadesc', 'filter_wpseo_metadesc', 10, 1 );

// Override Schema Output
//--------------------------------------------------
function override_schema_output ( $schema ) {
  if ( empty($schema) ) return;

  //description
  $schema["description"] = strip_shortcodes( $schema["description"] );

  //image url
  if( strpos( $schema["image"]["url"] , $_SERVER['HTTP_HOST'] ) == false ) {
    $schema["image"]["url"] = site_url() . $schema["image"]["url"];
  }

  return $schema;
}

add_filter('schema_output', 'override_schema_output');

// Remove hreflang link added by qTranslate-X plugin
//--------------------------------------------------
remove_action('wp_head', 'qtranxf_wp_head', 10);

// Disable xmlrpc (protection from DDoS attack)
//--------------------------------------------------
add_filter('xmlrpc_enabled','__return_false');

//add_filter('hidden_meta_boxes','hide_meta_box',10,2);
//
//function hide_meta_box($hidden, $screen) {
//  //make sure we are dealing with the correct screen
//  if ( ('post' == $screen->base) ){
//    //lets hide everything
//    $hidden = array('postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'revisionsdiv');
//  }
//  return $hidden;
//}
