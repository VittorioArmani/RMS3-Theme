<?php
if (WEBSTUDIO != 'true') {
    /*$components->default->categories_list(array('home' => true));*/
}
?>
<section class="well <?php if (WEBSTUDIO == 'true') {
    echo 'templates2';
} else {
    echo 'templates';
} ?>">
    <div class="cleafix"></div>
    <div class="container">
        <?php $components->other->text_block_main(array('text' => $page->getText('header')))?>
    </div>
    <div id="templates_block" class="container featured_block">
        <?php $components->default->featured_block(array()); ?>
    </div>
    <div class="cleafix"></div>
    <div class="container">
        <?php $components->other->text_block_main(array('text' => $page->getText('footer')))?>
    </div>
</section>
<?php if (WEBSTUDIO != 'true') { ?>
    <section class="banner-features">
        <div class="container">
            <ul class="features-list">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-1">
                                <div class="icon mdi mdi-comment-text-outline"></div>
                                <h5>Free 24/7<br> Support Team</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-2">
                                <div class="icon mdi mdi-checkbox-marked-circle-outline"></div>
                                <h5>Ready Solutions<br> For Business</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-3">
                                <div class="icon mdi mdi-flag-outline"></div>
                                <h5>Premium<br> Quality</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-4">
                                <div class="icon mdi mdi-account-multiple-outline"></div>
                                <h5>1 200 000+<br> Satisfied Customers</h5>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </section>
    <section class="well ins1 testi-block">
        <div class="container">
            <h2 class="center">Testimonials</h2>
                <div class="row swiper-testi">
                    <blockquote class="col-xs-12 col-md-4 col-sm-4">
                        <p data-equal-group="2">
                            <q>TemplateMonster make beautiful, professional and versatile templates that are easy to recommend and promote. They have huge selection of different templates and you can always find the right one for your project. TemplateMonster have great affiliate managers making them a pleasure to partner with. I highly recommend TemplateMonster template and their affiliate program.
                            </q>
                        </p>
                        <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-1.png'?>" alt="" /><span>Aigars Silkalns</span> <a href="http://colorlib.com" target="_blank">Colorlib.com</a></cite>
                    </blockquote>
                    <blockquote class="col-xs-12 col-md-4 col-sm-4">
                        <p data-equal-group="2">
                            <q>Whenever I want to use distinctive theme for my website as well as the website for my clients, Template Monster is the first place I come all the time because they are always trying to meet up our expectation which is very difficult now since needs of people are evolving so rapidly. However, they have been making continuous effort to keep us happy. Looking forward to working together with them as an affiliate partner!
                            </q>
                        </p>
                        <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-2.png'?>" alt="" /><span>Yuzuru Ishikawa</span> <a href="http://www.scratchinginfo.com/" target="_blank">Scratchinginfo.com</a></cite>
                    </blockquote>
                    <blockquote class="col-xs-12 col-md-4 col-sm-4">
                        <p data-equal-group="2">
                            <q>I am writing to let you know what an excellent company I believe you have created. I have been in the web development industry for a number of years now and have never been as impressed by a webdesign company as I have been by yours today. I was very impressed by the services your company offers at such reasonable rates...and the overall look and functionality of your website I found to be unlike any other.
                            </q>
                        </p>
                        <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-3.png'?>" alt="" /><span>Vavilen Tatarsky</span> <a href="http://www.webtemplatesbox.com/" target="_blank">Webtemplatesbox.com</a></cite>
                    </blockquote>                
                </div>
            <div class="text-center off1">
                <a href="<?php echo S_SITE_URL ?>search" class="btn3 all_btn">Choose a Theme</a>
            </div>
        </div>
    </section>
<?php } ?>
<?php $components->other->banners_by_group(array("name" => "default-2", 'max' => 1)); ?>
<?php $components->other->banners_by_group(array("name" => "default", 'max' => 3)); ?>