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
<?php if (BANNERS != 'false') { ?>
    <section class="banner-features">
        <div class="container">
            <ul class="features-list">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-1">
                                <div class="icon mdi mdi-comment-text-outline"></div>
                                <h5>Техническая<br> поддержка 24/7</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-2">
                                <div class="icon mdi mdi-checkbox-marked-circle-outline"></div>
                                <h5>Готовые решения<br> для бизнеса</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-3">
                                <div class="icon mdi mdi-flag-outline"></div>
                                <h5>Премиальное<br> качество</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-4">
                                <div class="icon mdi mdi-account-multiple-outline"></div>
                                <h5>Более 1 200 000<br> довольных клиентов</h5>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </section>
<?php } if (TESTIMONIALS != 'false') { ?>
    <section class="well ins1 testi-block">
        <div class="container">
            <h2 class="center">О нас говорят</h2>
                <div class="row swiper-testi">
                    <blockquote class="col-xs-12 col-md-4 col-sm-4">
                        <p data-equal-group="2">
                            <q>В TemplateMonster создают красивые, профессиональные и универсальные шаблоны, которые легко рекомендовать и продвигать. У них огромный выбор различных шаблонов, и Вы всегда можете найти подходящий для своего проекта. У TemplateMonster работают профессиональные аффилиат-менеджеры, с которыми приятно общаться. Я очень рекомендую TemplateMonster и их аффилиатскую программу.
                            </q>
                        </p>
                        <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-1.png'?>" alt="" /><span>Аигарс Силкалнс</span> <a href="http://colorlib.com" target="_blank">Colorlib.com</a></cite>
                    </blockquote>
                    <blockquote class="col-xs-12 col-md-4 col-sm-4">
                        <p data-equal-group="2">
                            <q>Всякий раз, когда я хочу использовать свежую тему для своего веб-сайта, а также для веб-сайта своих клиентов, Template Monster - это первое место, куда я прихожу постоянно, потому что они всегда пытаются удовлетворить наши ожидания, что очень сложно сейчас, так как потребности людей развиваются так быстро. Тем не менее, они прилагают все усилия, чтобы мы были счастливы. С нетерпением ждем совместной работы с ними как аффилиат-партнера!
                            </q>
                        </p>
                        <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-2.png'?>" alt="" /><span>Юзуру Ишикава</span> <a href="http://www.scratchinginfo.com/" target="_blank">Scratchinginfo.com</a></cite>
                    </blockquote>
                    <blockquote class="col-xs-12 col-md-4 col-sm-4">
                        <p data-equal-group="2">
                            <q>Я считаю, что Вы создали отличную компанию! Я уже несколько лет работаю в индустрии веб-разработки и никогда не был так впечатлен веб-дизайн конпанией. Я был очень впечатлен услугами, предлагаемыми вашей компанией по таким разумным тарифам ... и общий внешний вид и функциональность вашего веб-сайта отличается от любого другого.
                            </q>
                        </p>
                        <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-3.png'?>" alt="" /><span>Вавилен Татарскы</span> <a href="http://www.webtemplatesbox.com/" target="_blank">Webtemplatesbox.com</a></cite>
                    </blockquote>                
                </div>
            <div class="text-center off1">
                <a href="<?php echo S_SITE_URL ?>search" class="btn3 all_btn">Выбрать шаблон</a>
            </div>
        </div>
    </section>
<?php }} ?>
<?php $components->other->banners_by_group(array("name" => "default-2", 'max' => 1)); ?>
<?php $components->other->banners_by_group(array("name" => "default", 'max' => 3)); ?>