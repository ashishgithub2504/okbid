<section id="topOfPage" class="topTabsWrap color_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="speedBar">
                    <a class="home" href="<?= _BASE_ ?>">Home</a>
                    <span class="breadcrumbs_delimiter"> / </span>
                    <a class="all" href="#">All News</a>
<!--                    <span class="breadcrumbs_delimiter"> / </span>
                    <span class="current">News demo</span> -->
                </div>
                <h3 class="pageTitle h3">All News</h3>
            </div>
        </div>
    </div>
</section>

<section class="mainWrap with_sidebar sideBarRight">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <?php if(count($news) > 0){
                    foreach($news as $record){ ?>
                <article class="sc_post_format_gallery postDefault hrShadow post margin_bottom_big">
                    <div class="sc_section col-sm-6 post_thumb thumb">
                        <?= $this->Html->link($this->Html->image('/uploads/news/'.$record->image),['action' => 'view',$record->id],['escape' => false]) ?>
                    </div>
                    <h2 class="post_title">
                        <?= $this->Html->link($record->title,['action' => 'view', $record->id]) ?>
                    </h2>
                    <div class="postStandard">
                        <?php if(strlen($record->description) > 300){
                            $pos=strpos($record->description, ' ', 300);
                            echo substr($record->description,0,$pos ).'....';
                        }
                        else
                            echo $record->description;
                          ?>
                    </div>
                    <div class="postSharing">
                        <ul>
                            <li class="squareButton light ico">
                                <?= $this->Html->link('More',['action' => 'view', $record->id], ['class' => 'fa-link', 'title' => 'More']) ?>
                            </li>
                            <li class="squareButton light ico">
                                <a class="fa-eye" title="Views - 67" href="#">67</a>
                            </li>
                            <li class="squareButton light ico">
                                <a class="fa-comment" title="Comments - 0" href="#comments">0</a>
                            </li>
                            <li class="squareButton light ico likeButton like" data-postid="1542" data-likes="3" data-title-like="Like" data-title-dislike="Dislike">
                                <a class="fa-heart" title="Like - 3" href="#">
                                    <span class="likePost">3</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="post_info infoPost">
                        Posted <?= $record->created->format('M d, Y') ?>
<!--                        <span class="separator">|</span>
                        by <a href="#" class="post_author">-----</a>-->
                        <span class="separator">|</span>
                        <span class="post_cats">
                            in <?= $record->category->name ?>
                        </span>
                    </div>
                </article>
                <?php }
                echo $this->element('pagination');
                } else{
                    echo '<h3> No News Found </h3>';
                } ?>
                
            </div>
            <div class="col-md-3 col-sm-12">
                <?= $this->element('right_sidebar') ?>               
            </div>                
        </div>  
    </div>   
</section>