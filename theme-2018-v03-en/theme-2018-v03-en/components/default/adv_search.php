<form action="<?php echo SITE_DOMAIN ?>/search" method="post" class="filter-result-form <?php if (WEBSTUDIO == 'true') {
    echo 'web-studio';
} ?>">
    <input type="hidden" name="search" value="advanced"/>
    <div class="container">
            <?php
            if (WEBSTUDIO == 'true') { ?>
                <div class="col-lg-3 col-md-3 col-sm-12 pl_pr_5">
                    <label for="search_by_category">All Categories:</label>
                    <div class="select_wr">
                        <select id="search_by_category" name="category">
                            <option value="0">All Categories</option>
                            <?php foreach ($cats_list as $cat) { ?>
                <option value="<?php echo $cat->getId() ?>"<?php if (isset($post->category) and ($post->category == $cat->getId())) echo " selected=\"selected\""; ?>><?php echo html::specialchars($cat->getVisibleName()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 pl_pr_5">
                    <label for="search_by_type">All CMS Types:</label>
                    <div class="select_wr">
                        <select id="search_by_type" name="type">
                            <option value="0">All CMS Types</option>
                            <?php foreach ($types_list as $type) {?>
                <option value="<?php echo $type->getId() ?>"<?php echo (@$post->type == $type->getId()) ? " selected=\"selected\"":""?>><?php echo html::specialchars($type->getVisibleName()); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 pl_pr_5">
                    <div class="">
                        <!--<div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="search_by_price">Price</label>
                            <input type="text" id="search_by_price_from" name="price_from" value="<?php echo empty($post->price_from)?'':$post->price_from ?>" size="16">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6"><span>to</span>
                            <input type="text" id="search_by_price_to" name="price_to" value="<?php echo empty($post->price_to)?'':$post->price_to ?>" size="16">
                        </div>-->
                        <label id="keywdLabel" for="search_by_keyword">Keyword:</label>
                <div id="search_by_keyword_wrapper">
                        <input id="search_by_keyword" placeholder="Enter keyword..." name="keyword" style="width:100% !important" type="text" value="<?php if( isset($post->keyword) ) echo $post->keyword ?>"/>
                </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-12 pl_pr_5">
                    <button class="btn2" type="submit" name="submit" value="Search Template">Search</button>
                </div>
            <?php } else { ?>
                <div class="col-lg-3 col-md-3 col-sm-12 pl_pr_5">
                    <label for="search_by_category">All Categories:</label>
                    <div class="select_wr">
                        <select id="search_by_category" name="category">
                            <option value="0">All Categories</option>
                            <?php foreach ($cats_list as $cat) { ?>
                <option value="<?php echo $cat->getId() ?>"<?php if (isset($post->category) and ($post->category == $cat->getId())) echo " selected=\"selected\""; ?>><?php echo html::specialchars($cat->getVisibleName()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 pl_pr_5">
                    <label for="search_by_type">All CMS Types:</label>
                    <div class="select_wr">
                        <select id="search_by_type" name="type">
                            <option value="0">All CMS Types</option>
                            <?php foreach ($types_list as $type) {?>
                <option value="<?php echo $type->getId() ?>"<?php echo (@$post->type == $type->getId()) ? " selected=\"selected\"":""?>><?php echo html::specialchars($type->getVisibleName()); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 pl_pr_5">
                    <div class="">
                        <!--<div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="search_by_price">Price</label>
                            <input type="text" id="search_by_price_from" name="price_from" value="<?php echo empty($post->price_from)?'':$post->price_from ?>" size="16">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6"><span>to</span>
                            <input type="text" id="search_by_price_to" name="price_to" value="<?php echo empty($post->price_to)?'':$post->price_to ?>" size="16">
                        </div>-->
                        <label id="keywdLabel" for="search_by_keyword">Keyword:</label>
				<div id="search_by_keyword_wrapper">
            			<input id="search_by_keyword" placeholder="Enter keyword..." name="keyword" style="width:100% !important" type="text" value="<?php if( isset($post->keyword) ) echo $post->keyword ?>"/>
				</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-12 pl_pr_5">
                    <button class="btn2" type="submit" name="submit" value="Search Template">Search</button>
                </div>
            <?php } ?>
    </div>
</form>
