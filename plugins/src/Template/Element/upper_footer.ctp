<div class="row">
    <div class="col-md-9 col-sm-12">
        <div class="sc_testimonials sc_testimonials_style_1 sc_testimonials_padding sc_testimonials_controls_top">
            <h2 class="sc_testimonials_title">Testimonials</h2>
            <div id="swiper_container_3" class="sc_slider sc_slider_swiper sc_slider_controls sc_slider_controls_top swiper-container3 swiper-container-horizontal">
                <ul class="sc_testimonials_items swiper-wrapper">
                    <?php if(count($testimonials) > 0) {
                        foreach($testimonials as $testimonial){ ?>
                    <li class="sc_testimonials_item swiper-slide">
                        <div class="sc_testimonials_item_content">
                            <div class="sc_testimonials_item_quote">
                                <div class="sc_testimonials_item_text">
                                    <b><?= $testimonial->title ?></b><br/>
                                    <?= $testimonial->content ?>
                                </div>
                            </div>
                            <div class="sc_testimonials_item_author">
                                <div class="sc_testimonials_item_avatar">
                                    <?php
                                    if (!empty($testimonial->user->profile_pic) && file_exists(WWW_ROOT . "uploads/users/" . $testimonial->user->profile_pic)) {
                                        echo $this->Html->image(_BASE_ . "uploads/users/" . $testimonial->user->profile_pic,['style' => ['height:inherit;']]);
                                    } else {
                                        echo $this->Html->image('no-image.png');
                                    }
                                    ?>
                                </div>
                                <div class="sc_testimonials_item_name">
                                    <?php if(empty($testimonial->user)) echo $testimonial->user_name; 
                                    else echo $testimonial->user->name; ?>
                                </div>
                                <div class="sc_testimonials_item_position">
                                    User
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php }
                    } ?>
                </ul>
            </div>
            <ul class="flex-direction-nav">
                <li>
                    <a class="swiper-button-prev3" href="#"></a>
                </li>
                <li>
                    <a class="swiper-button-next3" href="#"></a>
                </li>
            </ul>
        </div>                       
    </div>
</div>
<style>
    .sc_testimonials_item_text p{
        padding : 0;
    }
</style>