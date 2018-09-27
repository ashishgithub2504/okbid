<section id="topOfPage" class="topTabsWrap color_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="speedBar">
                    <a class="home" href="<?= _BASE_ ?>">Home</a>
                    <span class="breadcrumbs_delimiter"> / </span>
                    <span class="current">Gallery</span> 
                </div>
                <h3 class="pageTitle h3">Gallery</h3>
            </div>
        </div>
    </div>
</section>

<section class="mainWrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 sc_column_item"> 
                <?php if(!empty($results)){
                        foreach ($results as $key=>$val){
                    ?>
                
                <article class="col-md-4 col-sm-12 margin_bottom_small">
                        <div class="thumb hoverIncrease inited" data-image="<?php echo _BASE_.'/uploads/images/'.$val['image']; ?>" data-title="Large">
                                 <?php echo $this->Html->image('/uploads/images/'.$val['image'],['hight'=>'225px','width'=>'340px']); ?>          
                                <span class="hoverShadow"></span>
                                <a href="<?php echo _BASE_.'uploads/images/'.$val['image']; ?>" title="slider" rel="magnific" class="">
                                    <span class="hoverIcon"></span>
                                </a>
                        </div>
                        
                </article>
                <?php } } ?>

            </div> 
            </div> 
        </div>
</section>