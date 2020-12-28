</div>
</main>
<!--content sction-->

<!--footer section-->
<footer>  
    <div class="footer-top">    
        <div class="container">     
             <div class="row justify-content-center">
                 <div class="col-md-12 text-center">
                     <div class="footer-logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_theme_value('weaversweb_footer_logo');?>"></a></div>
                     <div class="bottom-social-icon">
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
                     </div>
                     <div class="footer-note t-pink">
                         <?php echo get_theme_value('weaversweb_footer_note');?>
                      </div>
                     <div class="copyright t-pink"><p><?php echo get_theme_value('weaversweb_footer_copyright');?></p></div>
                     <div class="footer-conditions t-white"><p><a href="<?php echo get_permalink(3); ?>">Privacy& Term & Conditions </a></p></div>
                 
              </div>
            </div>
        </div>
    </div>
</footer>
<!--footer section-->
<?php wp_footer(); ?>
</body>
</html>