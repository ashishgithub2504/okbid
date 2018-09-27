<div id="sidebar_main" class="widget_area sidebar_main sidebar">
    <?php echo $this->Form->create(false, ['type' => 'get','url' => '/news/index','class' =>'search-form', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]); ?>
    <aside class="widgetWrap hrShadow widget woocommerce widget_product_search">
        <h3 class="title">Search News</h3>
            <input type="text" class="search-field" placeholder="Search for News …" name="keyword" title="Search for products:" value = "<?= !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : '' ?>">
            <span class="search-button squareButton light ico">
                <a class="search-field fa-search" onclick="this.form.submit()" href="#"></a>
            </span>
    </aside>
    <aside class="widgetWrap hrShadow widget woocommerce widget_product_tag_cloud">
        <h3 class="title">Categories</h3>
        <div class="tagcloud">
        <?php if(count($categories) > 0){
            foreach($categories as $k => $category){ 
                if(isset($this->request->query['category_id'])){
                    if($k === 0){ ?>
            <a class="<?= (isset($this->request->query['category_id']) && $this->request->query['category_id'] == 'all') ? 'btn btn-primary' : '' ?>" href="javascript:void(0);" onclick="selectCat(this)" category_id="all">All</a>
                <?php } } ?>
            <a class="<?= (isset($this->request->query['category_id']) && $this->request->query['category_id'] == $category->id) ? 'btn btn-primary' : '' ?>" href="javascript:void(0);" onclick="selectCat(this)" category_id="<?= $category->id ?>"><?= $category->name ?></a>
        <?php }
            } ?>
            <input type="hidden" name="category_id" id="catId" value="<?= !empty($this->request->query['category_id']) ? $this->request->query['category_id'] : '' ?>" />
        </div>
    </aside> 
    <?= $this->Form->end() ?>
    <hr>
    <aside class="widgetWrap widget widget_recent_posts">
        <h3 class="title">Recent News</h3>
     <?php if(count($recent_news) > 0){
                foreach($recent_news as $news){ ?>
        <article class="post_item with_thumb margin_bottom_mini">
            <div class="post_thumb">
                <?= $this->Html->image('/uploads/news/'.$news->image, ["alt" => "$news->title"]) ?>
            </div>
            <h5 class="post_title">
                <?= $this->Html->link($news->title, ['controller' => 'news', 'action' => 'view', $news->id]) ?>
            </h5>
            <div class="post_info">
                <span class="post_author"><?= $news->short_desc ?></span>
                <span class="post_date"><?= $news->created->format('M d, Y') ?></span>
<!--                <span class="post_comments">
                    <a href="#">
                        <span class="comments_icon fa-eye"></span>
                        <span class="post_comments_number">126</span>
                    </a>
                </span>-->
            </div>
        </article>
        <?php } } ?>
    </aside>    
</div>
<script type="text/javascript">
    <?php $this->Html->scriptStart(['block' => true]); ?>
        function selectCat(obj){
            var cat_id = $(obj).attr('category_id');
            $('#catId').val(cat_id);
            $('#filterForm').submit();
        }
    <?php $this->Html->scriptEnd(); ?>
</script>