<?php if(isset($file_name)) { ?>
<div class="banner for_blick <?php echo (isset($classname))?" $classname":""; ?>">
    <a <?php echo (isset($id))?'id="'.$id.'"':""; ?> href="<?php echo  $href ?>" <?php echo (isset($target))?'target="'.$target.'"':""; ?>>
        <img src="<?php echo FRONTEND_DIR .'/images/'.$file_name ?>" alt="<?php echo $alt ?>" <?php echo (isset($width)?"width=\"$width\"":"") ?>/>
    </a>
</div>
<?php } ?>