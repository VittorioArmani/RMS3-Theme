<?php
$counter_preview = 0;
foreach($tpage as $num=>$scr){
    if ($scr->isHead()) { ?>
        <?php if ($scr->getDescription()!='') { ?>
        <h3><?php echo $scr->getDescription() ?></h3>
        <?php } ?>
        <center id="main-preview">
            <?php if ($scr->needIframe()) { ?>
                <iframe frameborder='0' id="url<?php echo $num?>" src="<?php echo $scr->getUrl() ?>" width="<?php echo $scr->getWidth() ?>" height="<?php echo $scr->getHeight() ?>"></iframe>
            <?php } else {
                if ($scr->getHref()!='') { ?>
                    <a id="href<?php echo $num?>" href="<?php echo $scr->getHref() ?>">
                <?php } ?>
                        <img id="url<?php echo $num?>" src="<?php echo $scr->getUrl() ?>" alt="<?php echo $scr->getDescription() ?>" <?php echo $scr->getWidth() > 0 ? 'width="'.$scr->getWidth().'"' : ''?> <?php echo $scr->getHeight() > 0 ? 'height="'.$scr->getHeight().'"' : '' ?> />
                <?php if ($scr->getHref()!='') { ?>
                    </a>
                <?php }
            } ?>
        </center>
    <?php }
} ?>