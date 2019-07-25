<?php if (isset($message)) { ?>
    <p class="no_items_found"><?php echo $message ?></p>
<?php } ?>
<?php
for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $cols; $j++) {
        if (isset($templates[$i][$j])) {
            $components->default->template(array('template' => $templates[$i][$j]));
        } else {
            break;
        }
    }
}
?>
<?php if (isset($page))
    $components->default->pager(array('max_page' => $max_page,
        'page' => $page,
        'url' => $url,
        'pattern' => $pattern,
        'catalog_type' => $catalog_type,
        'alias' => $alias
    )); ?>