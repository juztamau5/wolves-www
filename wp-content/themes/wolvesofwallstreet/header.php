<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>
<?php wp_title(); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_head(); ?>
</head>
<!--/head-->
<body <?php body_class(); ?>>
<?php 
	if( ICL_LANGUAGE_CODE == 'en' ){
		$home_url = site_url();
	}else{
		$home_url = site_url().'?lang=zh-hant';
	}
?>
<!--header section-->
    <header class="header-section">
        <div class="main-header-container">
            <div class="container">
                <div class="top-social-icon">
                   <ul>
                   		<?php if(get_theme_value('weaversweb_github_link') != ""){ ?>
                        <li>
                             <a href="<?php echo get_theme_value('weaversweb_github_link'); ?>" target="_blank"><svg width="25" height="25" xmlns="">
                                  <image href="<?php bloginfo('template_url');?>/images/icons_github.svg" height="25" width="25"/>
                             </svg></a>
                         </li>
                        <?php } if(get_theme_value('weaversweb_etherscan_link') != ""){ ?>
                         <li><a href="<?php echo get_theme_value('weaversweb_etherscan_link'); ?>" target="_blank"><svg width="25" height="25" xmlns="">
                                  <image href="<?php bloginfo('template_url');?>/images/icons_etherscan.svg" height="25" width="25"/>
                             </svg></a>
                        </li>
                        <?php } if(get_theme_value('weaversweb_discord_link') != ""){ ?>
                         <li>
                             <a href="<?php echo get_theme_value('weaversweb_discord_link'); ?>" target="_blank"><svg width="25" height="25" xmlns="">
                                  <image href="<?php bloginfo('template_url');?>/images/icons_discord.svg" height="25" width="25"/>
                             </svg></a>
                          </li>
                        <?php } if(get_theme_value('weaversweb_tg_link') != ""){ ?>
                         <li>
                             <a href="<?php echo get_theme_value('weaversweb_tg_link'); ?>" target="_blank"><svg width="25" height="25" xmlns="">
                                  <image href="<?php bloginfo('template_url');?>/images/icons_TG.svg" height="25" width="25"/>
                             </svg></a>
                         </li>
                        <?php } if(get_theme_value('weaversweb_twitter_link') != ""){ ?>
                         <li><a href="<?php echo get_theme_value('weaversweb_twitter_link'); ?>" target="_blank"><svg width="25" height="25" xmlns="">
                                  <image href="<?php bloginfo('template_url');?>/images/icons_Twitter.svg" height="25" width="25"/>
                             </svg></a>
                         </li>
                        <?php } ?>
                    </ul>
					<?php if ( is_active_sidebar( 'sidebar-lang_change' ) ) : ?>
                        <?php dynamic_sidebar( 'sidebar-lang_change' ); ?>
                    <?php endif; ?>
                </div>
                <div class="inner-panel">
                    <div class="left-panel">
                          <div class="menu-holder">
                                <div class="main-menu">
                                	<?php wp_nav_menu(array('theme_location'=>'primary-left','menu_class'=>'','container_class'=>'','container'=>'')); ?>
                                </div>
                          </div>
                     </div>
                    
                    <div class="logo-holder">
                            <a href="<?php echo $home_url; ?>">
                                <img src="<?php echo get_theme_value('weaversweb_header_logo');?>" class="logo" alt=""/>
                            </a>
                    </div>
                            
                    <div class="right-panel"> 
                         <div class="menu-holder">
                                <div class="main-menu">
                                	<?php wp_nav_menu(array('theme_location'=>'primary-right','menu_class'=>'','container_class'=>'','container'=>'')); ?>
                                </div>
                          </div>    
                    </div>
                </div>
                <div class="hamburger-nav">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="mobile-menu-container">
            <div class="inner-container">
                      <div class="mobile-menu">
                      		<?php wp_nav_menu(array('theme_location'=>'primary-mobile','menu_class'=>'','container_class'=>'','container'=>'')); ?>
                       </div>
            </div>
        </div>
    </header>
    <!--header section-->
    
 <!--content sction-->
<main>
    <div class="container">