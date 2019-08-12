<?php if ($text->getTitle()!=''){?>
<div class="text-block">
    <h2><?php echo $text->getTitle() ?></h2>
    <?php echo $text->getContent() ?>
</div>
<?php }?>