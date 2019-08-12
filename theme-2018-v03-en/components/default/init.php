<?php
/**
 * Hack to display specific pages without processing the layout
 * We capture output of the page using ob and can place it inside layout if needed
 */
$filename = CURRENT_THEME_DIR . 'override/' . $page->getAlias() . '.php';
if (strpos($_SERVER['REQUEST_URI'],'category') === false && file_exists($filename))
{
    include $filename;
    exit;
}