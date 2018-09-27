<?= $this->element('slider') ?>
<section class="with_sidebar sideBarRight">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                
                <div class="col-sm-12 hrShadow">
                    <h2 class="margin_top_small">Horse Breeds</h2>
                    <div class="sc_blogger relatedPostWrap">
                        <?php if(count($featured_news) > 0){
                            foreach($featured_news as $k => $news){ 
                                if($k == 0) continue; ?>
                        <article class="col-md-4 col-sm-12 margin_bottom_small">
                            <div class="thumb hoverIncrease" data-image="<?= _BASE_ ?>/uploads/news/<?= $news->image ?>" data-title="<?= $news->title ?>">
                                <?= $this->Html->image('/uploads/news/'.$news->image, ["alt" => "$news->title"]) ?>
                            </div>
                            <h4>
                                <?= $this->Html->link($news->title,['controller' => 'news', 'action' => 'view', $news->id]) ?>
                            </h4>
                            <p><?= $news->short_desc ?></p>
                            <div class="relatedInfo">
                                Posted 
                                <span class="post_date"><?= $news->created->format('M d, Y') ?></span>
                                <span class="separator">|</span>
                                <span class="infoTags">
                                    <?= $news->category->name ?>
                                </span>
                            </div>
<!--                            <div class="relatedMore">
                                <ul>
                                    <li class="squareButton light ico">
                                        <a class="fa-link" title="More" href="#">More</a>
                                    </li>
                                    <li class="squareButton light ico">
                                        <a class="fa-comment" title="Comments - 0" href="#comments">0</a>
                                    </li>
                                </ul>
                            </div>-->
                        </article>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            
            
        </div>
       <?= $this->element('upper_footer') ?>
    </div>
</section>
