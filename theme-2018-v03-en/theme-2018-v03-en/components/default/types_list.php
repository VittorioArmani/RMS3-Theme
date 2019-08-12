<?php if (!empty($list)) {?>
<ul id="types_list">
    <?php foreach ($list as $type) { ?>
        <li>
            <a <?php if ($type->getAlias() == $current) {?> class="active" <?php } ?> href="<?php echo $type->getUrl()?>"><?php echo $type->getVisibleName() ?></a>
        </li>
    <?php }?>
</ul>
<?php }?>