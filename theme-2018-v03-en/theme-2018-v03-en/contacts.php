<?php
$text = $page->getText('header');
if (!isset($text)) {
	$text = $page->getText('footer');
	if (!isset($text)) {
		$contact_us_title = 'Contact us';
		$contact_us_content = '';
	}
}
$contact_us_title = $text->getTitle();
$contact_us_content = $text->getContent();
?>
<?php $components->default->categories_list(array('home' => true))?>
<div class="text_block">
    <h2><?=$contact_us_title?></h2>
    <?php echo $contact_us_content ?>
</div>