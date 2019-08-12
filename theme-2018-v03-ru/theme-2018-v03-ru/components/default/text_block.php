<?php if ($text->getTitle()!=''){?>
<div class="text_block <?php if(WEBSTUDIO == 'true') { echo 'fullwidth'; } ?>">
  <h2><?php echo $text->getTitle() ?></h2>
  <p class="text_block_content" ><?php echo $text->getContent() ?></p>
</div>
<?php }?>