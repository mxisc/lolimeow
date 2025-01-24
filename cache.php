<?php
// 设置缓存时间为5分钟（300秒）
define('CACHE_TIME', 300);

// 缓存目录
define('CACHE_DIR', __DIR__ . '/cache/');

// 检查缓存目录是否存在，不存在则创建
if (!file_exists(CACHE_DIR)) {
    mkdir(CACHE_DIR, 0755, true);
}

// 生成缓存文件名，基于请求的 URL
function get_cache_filename() {
    return CACHE_DIR . md5($_SERVER['REQUEST_URI']) . '.html';
}

// 检查缓存是否有效
function is_cache_valid($cache_file) {
    return file_exists($cache_file) && (time() - filemtime($cache_file)) < CACHE_TIME;
}

// 读取缓存
function read_cache($cache_file) {
    if (is_cache_valid($cache_file)) {
        // 输出缓存内容并终止脚本执行
        echo file_get_contents($cache_file);
        exit;
    }
}

// 写入缓存
function write_cache($cache_file, $content) {
    file_put_contents($cache_file, $content);
}

// 获取缓存文件名
$cache_file = get_cache_filename();

// 如果缓存有效，则直接输出缓存内容
read_cache($cache_file);

// 开始缓存页面内容
ob_start();

// 在页面结束时写入缓存内容
function end_cache($cache_file) {
    $content = ob_get_contents();
    write_cache($cache_file, $content);
    ob_end_flush();
}
register_shutdown_function('end_cache', $cache_file);
?>