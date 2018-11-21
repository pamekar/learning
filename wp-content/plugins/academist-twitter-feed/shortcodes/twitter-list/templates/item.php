<li class="eltdf-tl-item eltdf-item-space">
    <div class="eltdf-tli-inner">
        <div class="eltdf-tli-content">
            <div class="eltdf-twitter-content-top">
                <div class="eltdf-twitter-user clearfix">
                    <div class="eltdf-twitter-image">
                        <img src="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileImage( $tweet ) ); ?>" alt="<?php esc_attr_e( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?>"/>
                    </div>
                    <div class="eltdf-twitter-name">
                        <div class="eltdf-twitter-autor">
                            <h5><?php echo esc_html( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?></h5>
                        </div>
                        <div class="eltdf-twitter-profile">
                            <a href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url">
                                <?php echo esc_html( $twitter_api->getHelper()->getTweetProfileScreenName( $tweet ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <i class="eltdf-twitter-icon social_twitter"></i>
            </div>
            <div class="eltdf-twitter-content-bottom">
                <div class="eltdf-tweet-text">
                    <?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
                </div>
            </div>
            <a class="eltdf-twitter-link-over" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url"></a>
        </div>
    </div>
</li>