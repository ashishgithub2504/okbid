<section class="footerContentWrap">
    <footer class="footerWrap footerStyleDark">
        <div class="container footerWidget widget_area">
            <div class="row columnsWrap">
                <aside class="col-md-6 col-sm-6 widgetWrap widget widget_advert">
                    <div class="widget_advert_inner">
                        <h3 class="sc_title sc_title_iconed">
                           <?= $SettingConfig['sitename'] ?>
                        </h3>
                        <br>
                       
                    </div>
                </aside>
                <aside class="col-md-6 col-sm-6 widget">
                    <div class="widget_advert_inner">
                        <h3 class="sc_title sc_title_iconed text-center" style="margin-right: 100px; color: white;"> Newsletter </h3>
                        <?= $this->Form->create('Newsletter', ['url' => '/newsletters/add','role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]])  ?>
                        <div class="columnsWrap">
                            <div class="col-sm-8" style="margin-bottom: 12px; left: 155px;">
                                <?php echo $this->Form->input('email', ['placeholder' => 'Email','label' => false,'style'=>["background-color: #fff; width: 400px;"]]); ?>
                            </div>
                        </div>
                        <div class="sc_contact_form_button" style="float: right;">
                            <div class="squareButton ico">
                                <button class="btn btn-default" onclick="this.form.submit()" style="color:teal;">Subscribe</button>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </aside>
            </div>
        </div>
    </footer> 
    <div class="copyWrap">
        <div class="container copy">
            <div class="copyright">
                <a href="<?= _BASE_ ?>"><?= $SettingConfig['sitename'] ?></a> 
                © 2017 All Rights Reserved
<!--                <a href="#">Terms of Use</a>
                and 
                <a href="#">Privacy Policy</a>-->
            </div>
            
        </div>
    </div>
</section>