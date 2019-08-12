<form action="<?php echo SITE_DOMAIN ?>/search" method="post" class="filter-result-form <?php if (WEBSTUDIO == 'true') {
    echo 'web-studio';
} ?>">
    <input type="hidden" name="search" value="advanced"/>
    <div class="container">
            <?php
            if (WEBSTUDIO == 'true') { ?>
                <div class="col-lg-5 col-md-5 col-sm-12 pl_pr_5">
                    <label for="search_by_category">Все Категории:</label>
                    <div class="select_wr">
                        <select name="category" id="search_by_category">
                            <option value="0">Все</option>
                            <?php foreach ($cats_list as $cat) {?>
                <option value="<?php echo $cat->getId() ?>"<?php if ( isset($post->category) and ($post->category == $cat->getId())) echo " selected=\"selected\""; ?>><?php echo html::specialchars($cat->getVisibleName()); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 pl_pr_5">
                    <label for="search_by_type">Все Типы CMS</label>
                    <div class="select_wr">
                        <select id="search_by_type" name="type">
                            <option value="0">Все</option>
                            <?php foreach ($types_list as $type) {?>
                <option value="<?php echo $type->getId() ?>"<?php echo (@$post->type == $type->getId()) ? " selected=\"selected\"":""?>><?php echo html::specialchars($type->getVisibleName()); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--<div class="col-lg-4 col-md-3 col-sm-12 pl_pr_5">
                    <div class="">
                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="search_by_price">Price</label>
                            <input type="text" id="search_by_price_from" name="price_from" value="<?php echo empty($post->price_from)?'':$post->price_from ?>" size="16">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6"><span>to</span>
                            <input type="text" id="search_by_price_to" name="price_to" value="<?php echo empty($post->price_to)?'':$post->price_to ?>" size="16">
                        </div> 
                        <label id="keywdLabel" for="search_by_keyword">Ключевое слово англ:</label>
                        <div id="search_by_keyword_wrapper">
                                <input id="search_by_keyword" placeholder="Введите ключевое слово..." name="keyword" style="width:100% !important" type="text" value="<?php if( isset($post->keyword) ) echo $post->keyword ?>"/>
                        </div>
                    </div>
                </div>-->
                <div class="col-lg-2 col-md-2 col-sm-3">
                    <button class="btn2" type="submit" name="submit" value="Search Template">Искать шаблон</button>
                </div>
            <?php } else { ?>
                <div class="col-lg-5 col-md-5 col-sm-12 pl_pr_5">
                    <label for="search_by_category">Все Категории:</label>
                    <div class="select_wr">
                        <select id="search_by_category" name="category">
                            <option value="0">Все Категории</option>
                            <?php foreach ($cats_list as $cat) { ?>
                <option value="<?php echo $cat->getId() ?>"<?php if (isset($post->category) and ($post->category == $cat->getId())) echo " selected=\"selected\""; ?>><?php echo html::specialchars($cat->getVisibleName()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 pl_pr_5">
                    <label for="search_by_type">Все Типы CMS:</label>
                    <div class="select_wr">
                        <select id="search_by_type" name="type">
                            <option value="0">Все Типы CMS</option>
                            <?php foreach ($types_list as $type) {?>
                <option value="<?php echo $type->getId() ?>"<?php echo (@$post->type == $type->getId()) ? " selected=\"selected\"":""?>><?php echo html::specialchars($type->getVisibleName()); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--<div class="col-lg-4 col-md-3 col-sm-12 pl_pr_5">
                    <div class="">
                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="search_by_price">Price</label>
                            <input type="text" id="search_by_price_from" name="price_from" value="<?php echo empty($post->price_from)?'':$post->price_from ?>" size="16">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6"><span>to</span>
                            <input type="text" id="search_by_price_to" name="price_to" value="<?php echo empty($post->price_to)?'':$post->price_to ?>" size="16">
                        </div> 
                        <label id="keywdLabel" for="search_by_keyword">Ключевое слово англ:</label>
				<div id="search_by_keyword_wrapper">
            			<input id="search_by_keyword" placeholder="Введите ключевое слово..." name="keyword" style="width:100% !important" type="text" value="<?php if( isset($post->keyword) ) echo $post->keyword ?>"/>
				</div>
                    </div>
                </div>-->
                <div class="col-lg-2 col-md-3 col-sm-12 pl_pr_5">
                    <button class="btn2" type="submit" name="submit" value="Search Template">Искать шаблон</button>
                </div>
            <?php } ?>
    </div>
</form>
