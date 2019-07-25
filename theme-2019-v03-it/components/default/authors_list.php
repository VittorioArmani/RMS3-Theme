<ul>
<?php foreach ($authors as $author){ ?>
	<li><a href="<?php echo $author->getUrl()?>"><?php echo $author->getVisibleName() ?></a></li>
<?php } ?>
</ul>
