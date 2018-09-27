<section id="topOfPage" class="topTabsWrap color_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="speedBar">
                    <a class="home" href="<?= _BASE_ ?>">Home</a>
                    <span class="breadcrumbs_delimiter"> / </span>
                    <!--<a class="all" href="#">All News</a>-->
                    <?= $this->Html->link('All News', ['action' => 'index']) ?>
                    <span class="breadcrumbs_delimiter"> / </span>
                    <span class="current">News post review</span> 
                </div>
                <h3 class="pageTitle h3">News post review</h3>
            </div>
        </div>
    </div>
</section>

<section class="post">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="post_info infoPost">
                    Posted
                    <a href="#" class="post_date"><?= $news->created->format('M d, Y') ?></a>
<!--                    <span class="separator">|</span>
                    by
                    <a href="#" class="post_author"> ------ </a>-->
                    <span class="separator">|</span>
                    <span class="post_cats">
                        in
                        <a class="cat_link" href="#"><?= $news->category->name ?></a>
                    </span>
                </div>
                <h1 class="post_title entry-title text-center"><?= $news->title ?></h1>
                <div class="sc_section col-sm-8 post_thumb thumb thumb_center ">
                    <?= $this->Html->image('/uploads/news/'.$news->image, ["alt" => $news->title]) ?>   
                </div>
                <div class="hrShadow ">
                    <h4><?= $news->short_desc ?></h4>
                    <?= $news->description ?>
                    <div class="tagsWrap">
                        <div class="postSharing">
                            <ul>
                                <li class="squareButton light ico share">
                                    <a class="fa-share-alt shareDrop" title="Share" href="#">Share</a>
                                    <ul class="share-social shareDrop" style="">
                                        <li>
                                            <a href="#" class="share-item" onclick="window.open('https://twitter.com/');">
                                                <img  src="<?= _BASE_ ?>/img/social/twitter_color.png" alt="twitter">Twitter
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="share-item" onclick="window.open('http://www.facebook.com/');">
                                                <img  src="<?= _BASE_ ?>/img/social/facebook_color.png" alt="facebook">Facebook
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="share-item" onclick="window.open('https://in.pinterest.com/');">
                                                <img  src="<?= _BASE_ ?>/img/social/pinterest_color.png" alt="pinterest">Pinterest
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="squareButton light ico">
                                    <a class="fa-eye" title="Views - 1067" href="#">1067</a>
                                </li>
                                <li class="squareButton light ico">
                                    <a class="fa-comment" title="Comments - 0" href="#comments">0</a>
                                </li>
                                <li class="squareButton light ico">
                                    <a class="fa-star" title="Rating - 69.5" href="#">69.5</a>
                                </li>
                                <li class="squareButton light ico likeButton like">
                                    <a class="fa-heart" title="Like - 4" href="#">
                                        <span class="likePost">4</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="infoPost">
                            Category: 
                            <a class="tag_link" href="#"><?= $news->category->name ?></a>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>          
                <div class="sc_blogger relatedPostWrap hrShadow no_col_padding_left">
                    <?php if(count($related_news) > 0){ ?>
                    <h2>Related news</h2>
                    <?php foreach($related_news as $rel){ ?>
                    <article class="col-md-3 col-sm-6 margin_bottom_small">
                        <div class="thumb hoverIncrease" data-image="<?= _BASE_ ?>/uploads/news/<?= $rel->image ?>" data-title="<?= $rel->title ?>">
                            <?= $this->Html->image('/uploads/news/'.$rel->image,['alt' => $rel->title]) ?>
                        </div>
                        <h4>
                            <?= $this->Html->link($rel->title,['action' => 'view',$rel->id],['title' => 'View Details']) ?>
                        </h4>
                        <p><?= $rel->short_desc ?></p>
                        <div class="relatedInfo">
                            Posted 
                            <a href="#" class="post_date"><?= $rel->created->format('M d, Y') ?></a>
                            <span class="separator">|</span>
                            <span class="infoTags">
                                <a class="tag_link" href="#"><?= $rel->category->name ?></a>
                            </span>
                        </div>
                        <div class="relatedMore">
                            <ul>
                                <li class="squareButton light ico">
                                    <?= $this->Html->link('More',['action' => 'view',$rel->id],['class' => 'fa-link', 'title' => 'More']) ?>
                                </li>
                                <li class="squareButton light ico">
                                    <a class="fa-comment" title="Comments - 0" href="#comments">0</a>
                                </li>
                            </ul>
                        </div>
                    </article>
                    <?php }
                    } else echo '<h2>No Related news</h2>'; ?>
                </div>
<!--                <div class="formValid margin_top_small">
                    <h2>Leave a Reply</h2>
                    <div class="commForm commentsForm">
                        <div id="respond" class="comment-respond">
                            <h3 id="reply-title" class="comment-reply-title"> 
                                <small>
                                    <a rel="nofollow" id="cancel-comment-reply-link" href="#respond">Cancel reply</a>
                                </small>
                            </h3>
                            <form action="#" method="post" id="commentform" class="comment-form">
                                <div class="columnsWrap no_col_padding_fc no_col_padding_lc">
                                    <div class="col-md-4 col-sm-12">
                                        <label for="author" class="required">Name</label>
                                        <input id="author" name="author" type="text" value="" size="30" aria-required="true">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label for="email" class="required">Email</label>
                                        <input id="email" name="email" type="text" value="" size="30" aria-required="true">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label for="url" class="optional">Website</label>
                                        <input id="url" name="url" type="text" value="" size="30" aria-required="true">
                                    </div>
                                </div>
                                <div class="message">
                                    <label for="comment" class="required">Your Message</label>
                                    <textarea id="comment" name="comment" class="textAreaSize" aria-required="true"></textarea>
                                </div>
                                <div class="enterBlock clr">
                                    <div class="squareButton ico comm">
                                        <a class="enter" href="#">Post comment</a>
                                    </div>
                                </div>
                                <p class="form-submit">
                                    <input name="submit" type="submit" id="send_comment" class="submit" value="Post Comment"> 
                                    <input type="hidden" name="comment_post_ID" value="1902" id="comment_post_ID">
                                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                </p> 
                            </form>
                        </div>
                        <div class="nav_comments"></div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>   
</section>