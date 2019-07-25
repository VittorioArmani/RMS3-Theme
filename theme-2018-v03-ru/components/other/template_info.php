<div id="buy_button_block">
    <a id="template_buy2_<?php echo $template->getId() ?>" href="<?php echo htmlentities($template->getBuyUrl()) ?>" rel="nofollow">Buy this Template</a>
</div>
<div id="support_block">
    <h3>Support For Your Template</h3>
    <dl>
        <dt id="support_help_center">
            <a href="//info.template-help.com/help/" target="_blank">Online Help Center</a><br>
        </dt>
        <dd>The online help center contains lots of useful information and tutorials</dd>
        <dt id="support_download_samples">
            <a href="//www.templatehelp.com/free-templates.php" target="_blank">Download Sample Template</a>
        </dt>
        <dd>Try your skills before the purchase. Download a sample template</dd>
        <dt id="support_faq">
            <a href="<?php echo SITE_DOMAIN?>/faq">Frequently Asked Questions</a>
        </dt>
        <dd>Please review this selection to find an answer to your question before asking a support operator.</dd>
        <dt id="support_100_percent">
            <a href="//www.templatehelp.com/preset/satisfact.php?pr_code=<?php echo PR_CODE ?>&amp;aff_url=<?php echo AFF ?>" target="_blank">100% Satisfaction Guarantee</a>
        </dt>
        <dd>Learn how we back our product and ensure that our customers are protected.</dd>
    </dl>
</div>
<div id="stillquestions_banner">
    <?php $components->other->banners_by_group(array("name"=>"support", 'max'=>1))?>
</div>