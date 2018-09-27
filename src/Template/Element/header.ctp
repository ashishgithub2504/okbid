<header id="header" class="menu_right with_user_menu noFixMenu">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="topWrap">
                    <div class="container">
                        <div class="mainmenu_area">
                            <div class="logo logo_left with_text">
                                <a href="<?= _BASE_ ?>">
                                 <?php echo $this->Html->image('/uploads/settings/'.$SettingConfig['sitelogo'], ["class" => "logo-default logo_main", "alt" => "","width"=>200]);
                                  echo $this->Html->image('/uploads/settings/'.$SettingConfig['sitelogo'], ["class" => "logo-default logo_fixed", "alt" => "","width"=>200]); ?>
                                </a>
                            </div>
<!--                            <div class="search" title="Open/close search form">
                                <div class="searchForm">
                                    <form method="get" class="search-form" action="#">
                                        <button type="submit" class="searchSubmit" title="Start search">
                                            <span class="icoSearch"></span>
                                        </button>
                                        <input type="text" class="searchField" placeholder="Search …" value="" name="s" title="Search for:">
                                    </form>
                                </div>
                                <div class="ajaxSearchResults"></div>
                            </div>-->
                            <a href="#" class="openResponsiveMenu">Menu</a>
                            <nav id="mainmenu_wrapper" class="menuTopWrap topMenuStyleLine">
                                <ul id="mainmenu" class="nav sf-menu sf-arrows">
                                    <li class="menu-item menu-item-has-children columns custom_view_item active">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Home</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Hourse Basic</a>
                                    </li>
                                    
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Hours Health</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Hours Sports</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Gallery</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Hours Location</a>
                                    </li>
                                </ul>  
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>