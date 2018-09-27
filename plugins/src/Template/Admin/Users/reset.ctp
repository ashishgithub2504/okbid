<section id="topOfPage" class="topTabsWrap color_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="pageTitle h3">Reset your password</h3>
            </div>
        </div>
    </div>
</section>

<section class="mainWrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sc_contact_form sc_contact_form_contact">
                    <h1 class="title">Reset Password</h1>
                    <?= $this->Form->create('User', ['role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]) ?>
                    <div class="columnsWrap">
                        <div class="col-sm-6">
                            <label class="required" for="sc_contact_form_password">Password</label>
                            <?= $this->Form->input('password', ['placeholder' => 'Password', 'div' => false, 'label' => false, 'required' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <label class="required" for="sc_contact_form_c_password">Confirm Password</label>
                            <?= $this->Form->input('confirm_password', ['type' => 'password','placeholder' => 'Confirm Password', 'div' => false, 'label' => false, 'required' => true]) ?>
                        </div>
                    <div class="sc_contact_form_button">
                        <div class="squareButton ico margin_top_mini">
                            <input type="submit" class="sc_contact_form_submit icon-comment" value="Submit">
                        </div>
                    </div>
                    <div class="result sc_infobox"></div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>