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
                                <h5>Premium Assistenza <br>Gratuita 24/7</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-2">
                                <div class="icon mdi mdi-checkbox-marked-circle-outline"></div>
                                <h5>Attività Commerciale<br> Soluzioni Pronte</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-3">
                                <div class="icon mdi mdi-flag-outline"></div>
                                <h5>Qualità Premium<br> Gagantita</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-4">
                                <div class="icon mdi mdi-account-multiple-outline"></div>
                                <h5>1 200 000+<br> Clienti Soddisfatti</h5>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </section>
<?php }if (TESTIMONIALS != 'false') {?>
    <section class="well ins1 testi-block">
       <div class="container">
           <h2 class="center">Testimonianze</h2>
               <div class="row swiper-testi">
                   <blockquote class="col-xs-12 col-md-4 col-sm-4">
                       <p data-equal-group="2">
                           <q>Realizzate dei modelli veramente molto belli e professionali di facili utilizzo e che si promuovono da soli. Un'ampia selezione di modelli diversi dove puoi trovare sempre quello giusto per ogni tipo di progetto. Avete ottimi manager affiliati che aiutano e sono sempre disponibili ad aiutare e collaborare insieme. Consiglio assolutamente i vostri modelli e il "Programma Rivenditore".
                           </q>
                       </p>
                       <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-1.png'?>" alt="" /><span>Tom Neroni</span> <a target="_blank">Speed Rivoluzione</a></cite>
                   </blockquote>
                   <blockquote class="col-xs-12 col-md-4 col-sm-4">
                       <p data-equal-group="2">
                           <q>Ogni volta che voglio usare un tema distintivo per un mio progetto nuovo oppure per un progetto web di un mio cliente, TemplateMonster.com è la piattaforma perfetta e il posto giusto per trovare il modello necessario. Soddisfano sempre le nostre aspettative. Adesso siamo addirittura diventati partner certificati affiliati e rivenditori che è strepitoso! Fornite l'opportunità veramente infinite, grazie ancora di tutto.
                           </q>
                       </p>
                       <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-2.png'?>" alt="" /><span>Raffaele Colombo</span> <a target="_blank">Delfino Studio</a></cite>
                   </blockquote>
                   <blockquote class="col-xs-12 col-md-4 col-sm-4">
                       <p data-equal-group="2">
                           <q>Consiglio assolutamente la collaborazione. L'azienda è eccellente da tutti i punti di vista. Io sono nel settore dello sviluppo web da un certo numero di anni e non sono mai stata così impressionata da una società di web design come lo siete voi. Sono rimasta molto soddisfatta dai servizi offerti da voi e soprattutto dai prezzi ragionevoli... l'aspetto e le funzionalità sono ai livelli altissimi e diversi dagli altri che è importantisimo oggi.
                           </q>
                       </p>
                       <cite><img class="testi-img" src="<?php echo FRONTEND_DIR .'/images/testi-3.png'?>" alt="" /><span>Liliana Esposito</span> <a target="_blIskrenovikank">ICT Soluzioni</a></cite>
                   </blockquote>
               </div>
           <div class="text-center off1">
               <a href="<?php echo S_SITE_URL ?>search" class="btn3 all_btn">Scegli un Tema</a>
           </div>
       </div>
   </section><?php } ?>
<?php } ?>
<?php $components->other->banners_by_group(array("name" => "default-2", 'max' => 1)); ?>
<?php $components->other->banners_by_group(array("name" => "default", 'max' => 3)); ?>