<ul>
<li class="btn7" ><a class="btn7" href="<?php echo S_SITE_URL?>">Home</a></li>
<?php
    if (!empty($items)) {
        foreach (array_reverse($items) as $item) {
?>
            <li class="btn7"><a class="btn7" href="<?php echo $item->getUrl()?>"<?php if (util::dog($current_page)==$item->getId()) echo "class='active'"; echo $item->isOut() ? ' target="_blank"' : ''?>><?php echo $item->getVisibleName()?></a></li>
<?php     }
    }
?>
</ul>