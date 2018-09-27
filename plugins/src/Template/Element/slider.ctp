<section>
    <div class="sliderHomeBullets staticSlider slider_engine_royal slider_alias_4">
        <div class="royalSlider">
          <?php if(count($sliders) > 0){
            foreach($sliders as $slider) { ?>
            <div class="slideContent sliderBGanima slide-1" data-rsDelay="1500">
                <div class="container">
                    <img alt="<?= $slider->title ?>" class="rsABlock image" src="uploads/images/<?= $slider->image ?>" width="100%" height="100%">
                    <!--<img alt="<?= $slider->title ?>" class="rsABlock image" data-fade-effect="none" data-move-effect="left" data-opposite="true" data-move-offset="900" data-delay="500" data-speed="900" data-easing="easeOutBack" src="uploads/images/<?= $slider->image ?>" data-rsw="1020" data-rsh="500">-->
<!--                    <div class="rsABlock textBlock theme_accent" data-fade-effect="none" data-move-effect="left" data-opposite="true" data-move-offset="1200" data-delay="700" data-speed="1200" data-easing="" data-rsw="707" data-rsh="471">
                        <div class="title">Some title for this image</div>
                        <p>Any subtitle</p>
                    </div>
                    <div class="rsABlock order" data-fade-effect="none" data-move-effect="bottom" data-opposite="true" data-move-offset="950" data-delay="1500" data-speed="900" data-easing="" data-rsw="707" data-rsh="471">
                        <a href="#">Button</a>
                    </div>-->
                </div>
            </div>
            <?php }
            } ?>
        </div>
    </div>
</section>