<header id="header" class="menu_right with_user_menu noFixMenu">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="topWrap">
                    <div class="usermenu_area">
                        <div class="container">
                            <div class="menuUsItem menuItemRight">
                                <ul id="usermenu" class="usermenu_list sf-arrows">
                                    <?php if(!empty($userData)){ ?>
                                    <li class="usermenu_login usermenu_profile">
                                        Hi, <?= $userData['username'] ?>
                                    </li>
                                    <li class="usermenu_login"> | </li>
                                    <li class="usermenu_logout">
                                        <a href="<?= _BASE_ ?>users/logout" class="fa-sign-out">Logout</a>
                                    </li>
                                    <?php } else { ?>
                                    <li class="usermenu_login">
                                        <a href="#user-popUp" class="user-popup-link fa-sign-in">Login</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="menuUsItem menuItemLeft">
                                <marquee direction="left" behavior="alternate" style="color:white; font-size: 15px;">
                                      Horse vaccine is due
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="topWrap">
                    <div class="container">
                        <div class="mainmenu_area">
                            <div class="logo logo_left with_text">
                                <a href="<?= _BASE_ ?>">
                                 <?php echo $this->Html->image('/uploads/settings/'.$SettingConfig['sitelogo'], ["class" => "logo-default logo_main", "alt" => ""]);
                                  echo $this->Html->image('/uploads/settings/'.$SettingConfig['sitelogo'], ["class" => "logo-default logo_fixed", "alt" => ""]); ?>
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
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Horse details</a>
                                    </li>
                                    
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Horse Performance</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Horse Passport</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_ ?>" class="sf-with-ul">Horse Vaccine</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children columns custom_view_item">
                                        <a href="<?= _BASE_.'pages/gallery' ?>" class="sf-with-ul">Gallery</a>
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