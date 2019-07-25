<?php /* $components->default->categories_list(array('visible' => false)) */ ?>
<div class="container">
<?php $components->other->text_block(array('text' => $page->getText('header')))?>
</div>
<div class="container">
<?php $components->default->text_block(array('text' => $page->getText('footer')))?>
</div>
<?php $components->other->banners_by_group(array("name"=>"default-2", 'max'=>1));?>
<?php $components->other->banners_by_group(array("name"=>"default", 'max'=>3));?>