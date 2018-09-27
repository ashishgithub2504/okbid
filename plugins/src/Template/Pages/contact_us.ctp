<section id="topOfPage" class="topTabsWrap color_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="speedBar">
                    <a class="home" href="<?= _BASE_ ?>">Home</a>
                    <span class="breadcrumbs_delimiter"> / </span>
                    <span class="current">Contact Us</span> 
                </div>
                <h3 class="pageTitle h3">Contact Us</h3>
            </div>
        </div>
    </div>
</section>

<section class="mainWrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 sc_column_item"> 
                <?= $page->description ?>
            </div> 
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="sc_contact_form sc_contact_form_contact">
                    <h1 class="title">Send Us a Message</h1>
                        <?= $this->Form->create('Enquiry', ['url' => '/enquiries/add','role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]) ?>
                        <div class="columnsWrap">
                            <div class="col-sm-4">
                                <label class="required" for="sc_contact_form_name">Name</label>
                                <?= $this->Form->input('name',['placeholder' => 'Your name','div' => false, 'label' => false]) ?>
                            </div>
                            <div class="col-sm-4">
                                <label class="required" for="sc_contact_form_email">E-mail</label>
                                <?= $this->Form->input('email',['placeholder' => 'Your Email','div' => false, 'label' => false]) ?>
                            </div>
                            <div class="col-sm-4">
                                <label class="" for="sc_contact_form_phone">Phone</label>
                                <?= $this->Form->input('phone',['type' => 'text','placeholder' => 'Your Phone','div' => false, 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="message">
                            <label class="required" for="sc_contact_form_message">Your Message</label>
                            <?= $this->Form->textarea('message',['placeholder' => 'Your message...', 'class' => 'textAreaSize', 'div' => false, 'label' => false]) ?>
                        </div>
                        <div class="sc_contact_form_button">
                            <div class="squareButton ico">
                                <input type="submit" class="sc_contact_form_submit icon-comment" value="Send Message">
                            </div>
                        </div>
                        <div class="result sc_infobox"></div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>