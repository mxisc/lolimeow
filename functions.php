<?php
defined( 'ABSPATH' ) || exit;
$themedata = wp_get_theme();$themeversion = $themedata['Version'];define('THEME_VERSION', $themeversion);
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/module/panel/' );
require_once dirname( __FILE__ ) . '/module/panel/options-framework.php';
require_once get_template_directory() . '/options.php';
require_once dirname( __FILE__ ) . '/module/panel/options-framework-js.php';
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

require_once get_stylesheet_directory() . '/module/core/global.php';
require_once get_stylesheet_directory() . '/module/core/article.php';
require_once get_stylesheet_directory() . '/module/core/comments.php';
require_once get_stylesheet_directory() . '/module/core/admin.php';
require_once get_stylesheet_directory() . '/module/core/gravatar.php';
require_once get_stylesheet_directory() . '/module/core/mail.php';
require_once get_stylesheet_directory() . '/module/core/user.php';
require_once get_stylesheet_directory() . '/module/core/shortcode.php';
require_once get_stylesheet_directory() . '/module/core/optimize.php';
require_once get_stylesheet_directory() . '/module/core/navwalker.php';
require_once get_stylesheet_directory() . '/module/core/bot.php';
if( get_boxmoe('no_categoty') ) require_once get_stylesheet_directory() . '/module/core/nocategory.php';
function save_private_comment_meta($comment_id) {
    // 检查私密评论字段是否存在且被选中
    if (isset($_POST['private'])) {
        // 将布尔值 true 作为私密标记保存到评论的元数据中
        add_comment_meta($comment_id, 'private_comment', true, true);
    }
}
add_action('comment_post', 'save_private_comment_meta', 10, 1);



