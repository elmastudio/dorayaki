<?php
/**
 * Available Dorayaki Custom Widgets
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Include Dorayaki Flickr Widget
/*-----------------------------------------------------------------------------------*/

class dorayaki_flickr extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_flickr', __( 'Flickr', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_flickr',
			'description' => __( 'A number of Flickr preview images', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$id = $instance['id'];
		$number = $instance['number'];
		$type = $instance['type'];
		$sorting = $instance['sorting'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title">'.$title.'</h3>'; ?>

				<div class="flickr_badge_wrapper"><script type="text/javascript" src="https://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>&amp;size=s"></script>
			<div class="clear"></div>
		</div><!-- end .flickr_badge_wrapper -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$title = esc_attr($instance['title']);
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		$type = esc_attr($instance['type']);
		$sorting = esc_attr($instance['sorting']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos:','dorayaki'); ?></label>
						<select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
								<?php for ( $i = 1; $i <= 10; $i += 1) { ?>
								<option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
								<?php } ?>
						</select>
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Choose user or group:','dorayaki'); ?></label>
						<select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
								<option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'dorayaki'); ?></option>
								<option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'dorayaki'); ?></option>
						</select>
				</p>
				<p>
						<label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Show latest or random pictures:','dorayaki'); ?></label>
						<select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
								<option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'dorayaki'); ?></option>
								<option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'dorayaki'); ?></option>
						</select>
				</p>
		<?php
	}
}

register_widget('dorayaki_flickr');

/*-----------------------------------------------------------------------------------*/
/* Dorayaki Header Info Widget
/*-----------------------------------------------------------------------------------*/

class dorayaki_headerinfo extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_headerinfo', __( 'Header Info', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_headerinfo',
			'description' => __( '2 short header info texts (e.g. your profession and contact information).', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$headerinfotop = $instance['headerinfotop'];
		$headerinfobottom = $instance['headerinfobottom'];

		echo $before_widget; ?>

			<ul class="headerinfo-text">
			<li class="headerinfo-top"><span><?php echo $headerinfotop; ?></span></li>
			<?php if($headerinfobottom != ''){
				echo '<li class="headerinfo-bottom"><span>'.$headerinfobottom.'</span></li>';
			} ?>
			</ul><!-- end .headerinfo-text -->
		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$headerinfotop = esc_attr($instance['headerinfotop']);
		$headerinfobottom = esc_attr($instance['headerinfobottom']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('headerinfotop'); ?>"><?php _e('Header Info Text Top:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('headerinfotop'); ?>" value="<?php echo $headerinfotop; ?>" class="widefat" id="<?php echo $this->get_field_id('headerinfotop'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('headerinfobottom'); ?>"><?php _e('Header Info Text Bottom:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('headerinfobottom'); ?>" value="<?php echo $headerinfobottom; ?>" class="widefat" id="<?php echo $this->get_field_id('headerinfobottom'); ?>" />
				</p>

		<?php
	}
}

register_widget('dorayaki_headerinfo');

/*-----------------------------------------------------------------------------------*/
/* Include Dorayaki Video Widget
/*-----------------------------------------------------------------------------------*/

class dorayaki_video extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_video', __( 'Featured Video', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_video',
			'description' => __( 'Show a featured video', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$embedcode = $instance['embedcode'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title">'.$title.'</h3>'; ?>

				<div class="video_widget">
			<div class="featured-video"><?php echo $embedcode; ?></div>
			</div><!-- end .video_widget -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$title = esc_attr($instance['title']);
		$embedcode = esc_attr($instance['embedcode']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Video embed code:','dorayaki'); ?></label>
				<textarea name="<?php echo $this->get_field_name('embedcode'); ?>" class="widefat" rows="6" id="<?php echo $this->get_field_id('embedcode'); ?>"><?php echo( $embedcode ); ?></textarea>
				</p>

		<?php
	}
}

register_widget('dorayaki_video');


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Social Links Widget
/*-----------------------------------------------------------------------------------*/

 class dorayaki_sociallinks extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_sociallinks', __( 'Social Links', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_sociallinks',
			'description' => __( 'Show icons with links to your social profiles', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$appnet = $instance['appnet'];
		$flickr = $instance['flickr'];
		$instagram = $instance['instagram'];
		$picasa = $instance['picasa'];
		$fivehundredpx = $instance['fivehundredpx'];
		$youtube = $instance['youtube'];
		$vimeo = $instance['vimeo'];
		$dribbble = $instance['dribbble'];
		$ffffound = $instance['ffffound'];
		$pinterest = $instance['pinterest'];
		$behance = $instance['behance'];
		$deviantart = $instance['deviantart'];
		$squidoo = $instance['squidoo'];
		$slideshare = $instance['slideshare'];
		$lastfm = $instance['lastfm'];
		$grooveshark = $instance['grooveshark'];
		$soundcloud = $instance['soundcloud'];
		$foursquare = $instance['foursquare'];
		$github = $instance['github'];
		$linkedin = $instance['linkedin'];
		$xing = $instance['xing'];
		$wordpress = $instance['wordpress'];
		$tumblr = $instance['tumblr'];
		$rss = $instance['rss'];
		$rsscomments = $instance['rsscomments'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title">'.$title.'</h3>'; ?>

				<ul class="sociallinks">
			<?php
			if($twitter != ''){
				echo '<li><a href="'.$twitter.'" class="twitter" title="Twitter">Twitter</a></li>';
			}
			?>

			<?php
			if($facebook != '') {
				echo '<li><a href="'.$facebook.'" class="facebook" title="Facebook">Facebook</a></li>';
			}
			?>

			<?php
			if($googleplus != '') {
				echo '<li><a href="'.$googleplus.'" class="googleplus" title="Google+">Google+</a></li>';
			}
			?>

			<?php
			if($appnet != '') {
				echo '<li><a href="'.$appnet.'" class="appnet" title="App.net">App.net</a></li>';
			}
			?>

			<?php if($flickr != '') {
				echo '<li><a href="'.$flickr.'" class="flickr" title="Flickr">Flickr</a></li>';
			}
			?>

			<?php if($instagram != '') {
				echo '<li><a href="'.$instagram.'" class="instagram" title="Instagram">Instagram</a></li>';
			}
			?>

			<?php if($picasa != '') {
				echo '<li><a href="'.$picasa.'" class="picasa" title="Picasa">Picasa</a></li>';
			}
			?>

			<?php if($fivehundredpx != '') {
				echo '<li><a href="'.$fivehundredpx.'" class="fivehundredpx" title="500px">500px</a></li>';
			}
			?>

			<?php if($youtube != '') {
				echo '<li><a href="'.$youtube.'" class="youtube" title="YouTube">YouTube</a></li>';
			}
			?>

			<?php if($vimeo != '') {
				echo '<li><a href="'.$vimeo.'" class="vimeo" title="Vimeo">Vimeo</a></li>';
			}
			?>

			<?php if($dribbble != '') {
				echo '<li><a href="'.$dribbble.'" class="dribbble" title="Dribbble">Dribbble</a></li>';
			}
			?>

			<?php if($ffffound != '') {
				echo '<li><a href="'.$ffffound.'" class="ffffound" title="Ffffound">Ffffound</a></li>';
			}
			?>

			<?php if($pinterest != '') {
				echo '<li><a href="'.$pinterest.'" class="pinterest" title="Pinterest">Pinterest</a></li>';
			}
			?>

			<?php if($behance != '') {
				echo '<li><a href="'.$behance.'" class="behance" title="Behance Network">Behance Network</a></li>';
			}
			?>

			<?php if($deviantart != '') {
				echo '<li><a href="'.$deviantart.'" class="deviantart" title="deviantART">deviantART</a></li>';
			}
			?>

			<?php if($squidoo != '') {
				echo '<li><a href="'.$squidoo.'" class="squidoo" title="Squidoo">Squidoo</a></li>';
			}
			?>

			<?php if($slideshare != '') {
				echo '<li><a href="'.$slideshare.'" class="slideshare" title="Slideshare">Slideshare</a></li>';
			}
			?>

			<?php if($lastfm != '') {
				echo '<li><a href="'.$lastfm.'" class="lastfm" title="Lastfm">Lastfm</a></li>';
			}
			?>

			<?php if($grooveshark != '') {
				echo '<li><a href="'.$grooveshark.'" class="grooveshark" title="Grooveshark">Grooveshark</a></li>';
			}
			?>

			<?php if($soundcloud != '') {
				echo '<li><a href="'.$soundcloud.'" class="soundcloud" title="Soundcloud">Soundcloud</a></li>';
			}
			?>

			<?php if($foursquare != '') {
				echo '<li><a href="'.$foursquare.'" class="foursquare" title="Foursquare">Foursquare</a></li>';
			}
			?>

			<?php if($github != '') {
				echo '<li><a href="'.$github.'" class="github" title="GitHub">GitHub</a></li>';
			}
			?>

			<?php if($linkedin != '') {
				echo '<li><a href="'.$linkedin.'" class="linkedin" title="LinkedIn">LinkedIn</a></li>';
			}
			?>

			<?php if($xing != '') {
				echo '<li><a href="'.$xing.'" class="xing" title="Xing">Xing</a></li>';
			}
			?>

			<?php if($wordpress != '') {
				echo '<li><a href="'.$wordpress.'" class="wordpress" title="WordPress">WordPress</a></li>';
			}
			?>

			<?php if($tumblr != '') {
				echo '<li><a href="'.$tumblr.'" class="tumblr" title="Tumblr">Tumblr</a></li>';
			}
			?>

			<?php if($rss != '') {
				echo '<li><a href="'.$rss.'" class="rss" title="RSS Feed">RSS Feed</a></li>';
			}
			?>

			<?php if($rsscomments != '') {
				echo '<li><a href="'.$rsscomments.'" class="rsscomments" title="RSS Comments">RSS Comments</a></li>';
			}
			?>
		</ul><!-- end .sociallinks -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$title = esc_attr( isset( $instance['title'] ) ? $instance['title'] : "" );
		$twitter = esc_attr( isset( $instance['twitter'] ) ? $instance['twitter'] : "" );
		$facebook = esc_attr( isset( $instance['facebook'] ) ? $instance['facebook'] : "" );
		$googleplus = esc_attr( isset( $instance['googleplus'] ) ? $instance['googleplus'] : "" );
		$appnet = esc_attr( isset( $instance['appnet'] ) ? $instance['appnet'] : "" );
		$flickr = esc_attr( isset( $instance['flickr'] ) ? $instance['flickr'] : "" );
		$instagram = esc_attr( isset( $instance['instagram'] ) ? $instance['instagram'] : "" );
		$picasa = esc_attr( isset( $instance['picasa'] ) ? $instance['picasa'] : "" );
		$fivehundredpx = esc_attr( isset( $instance['fivehundredpx'] ) ? $instance['fivehundredpx'] : "" );
		$youtube = esc_attr( isset( $instance['youtube'] ) ? $instance['youtube'] : "" );
		$vimeo = esc_attr( isset( $instance['vimeo'] ) ? $instance['vimeo'] : "" );
		$dribbble = esc_attr( isset( $instance['dribbble'] ) ? $instance['dribbble'] : "" );
		$ffffound = esc_attr( isset( $instance['ffffound'] ) ? $instance['ffffound'] : "" );
		$pinterest = esc_attr( isset( $instance['pinterest'] ) ? $instance['pinterest'] : "" );
		$behance = esc_attr( isset( $instance['behance'] ) ? $instance['behance'] : "" );
		$deviantart = esc_attr( isset( $instance['deviantart'] ) ? $instance['deviantart'] : "" );
		$squidoo = esc_attr( isset( $instance['squidoo'] ) ? $instance['squidoo'] : "" );
		$slideshare = esc_attr( isset( $instance['slideshare'] ) ? $instance['slideshare'] : "" );
		$lastfm = esc_attr( isset( $instance['lastfm'] ) ? $instance['lastfm'] : "" );
		$grooveshark = esc_attr( isset( $instance['grooveshark'] ) ? $instance['grooveshark'] : "" );
		$soundcloud = esc_attr( isset( $instance['soundcloud'] ) ? $instance['soundcloud'] : "" );
		$foursquare = esc_attr( isset( $instance['foursquare'] ) ? $instance['foursquare'] : "" );
		$github = esc_attr( isset( $instance['github'] ) ? $instance['github'] : "" );
		$linkedin = esc_attr( isset( $instance['linkedin'] ) ? $instance['linkedin'] : "" );
		$xing = esc_attr( isset( $instance['xing'] ) ? $instance['xing'] : "" );
		$wordpress = esc_attr( isset( $instance['wordpress'] ) ? $instance['wordpress'] : "" );
		$tumblr = esc_attr( isset( $instance['tumblr'] ) ? $instance['tumblr'] : "" );
		$rss = esc_attr( isset( $instance['rss'] ) ? $instance['rss'] : "" );
		$rsscomments = esc_attr( isset( $instance['rsscomments'] ) ? $instance['rsscomments'] : "" );

		?>

		 <p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $twitter; ?>" class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $facebook; ?>" class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google+ URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo $googleplus; ?>" class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" />
				</p>

			<p>
						<label for="<?php echo $this->get_field_id('appnet'); ?>"><?php _e('App.net URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('appnet'); ?>" value="<?php echo $appnet; ?>" class="widefat" id="<?php echo $this->get_field_id('appnet'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" />
				</p>

		 <p>
						<label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instagram; ?>" class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('picasa'); ?>"><?php _e('Picasa URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('picasa'); ?>" value="<?php echo $picasa; ?>" class="widefat" id="<?php echo $this->get_field_id('picasa'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('fivehundredpx'); ?>"><?php _e('500px URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('fivehundredpx'); ?>" value="<?php echo $fivehundredpx; ?>" class="widefat" id="<?php echo $this->get_field_id('fivehundredpx'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $vimeo; ?>" class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e('Dribbble URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('dribbble'); ?>" value="<?php echo $dribbble; ?>" class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('ffffound'); ?>"><?php _e('Ffffound URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('ffffound'); ?>" value="<?php echo $ffffound; ?>" class="widefat" id="<?php echo $this->get_field_id('ffffound'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $pinterest; ?>" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('behance'); ?>"><?php _e('Behance Network URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('behance'); ?>" value="<?php echo $behance; ?>" class="widefat" id="<?php echo $this->get_field_id('behance'); ?>" />
				</p>

		 <p>
						<label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e('deviantART URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('deviantart'); ?>" value="<?php echo $deviantart; ?>" class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('squidoo'); ?>"><?php _e('Squidoo URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('squidoo'); ?>" value="<?php echo $squidoo; ?>" class="widefat" id="<?php echo $this->get_field_id('squidoo'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('slideshare'); ?>"><?php _e('Slideshare URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('slideshare'); ?>" value="<?php echo $slideshare; ?>" class="widefat" id="<?php echo $this->get_field_id('slideshare'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('lastfm'); ?>"><?php _e('Last.fm URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('lastfm'); ?>" value="<?php echo $lastfm; ?>" class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('grooveshark'); ?>"><?php _e('Grooveshark URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('grooveshark'); ?>" value="<?php echo $grooveshark; ?>" class="widefat" id="<?php echo $this->get_field_id('grooveshark'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('soundcloud'); ?>"><?php _e('Soundcloud URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('soundcloud'); ?>" value="<?php echo $soundcloud; ?>" class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php _e('Foursquare URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('foursquare'); ?>" value="<?php echo $foursquare; ?>" class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('github'); ?>"><?php _e('GitHub URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('github'); ?>" value="<?php echo $github; ?>" class="widefat" id="<?php echo $this->get_field_id('github'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $linkedin; ?>" class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('xing'); ?>"><?php _e('Xing URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('xing'); ?>" value="<?php echo $xing; ?>" class="widefat" id="<?php echo $this->get_field_id('xing'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('wordpress'); ?>"><?php _e('WordPress URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('wordpress'); ?>" value="<?php echo $wordpress; ?>" class="widefat" id="<?php echo $this->get_field_id('wordpress'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $tumblr; ?>" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS-Feed URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $rss; ?>" class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('rsscomments'); ?>"><?php _e('RSS for Comments URL:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('rsscomments'); ?>" value="<?php echo $rsscomments; ?>" class="widefat" id="<?php echo $this->get_field_id('rsscomments'); ?>" />
				</p>

		<?php
	}
}

register_widget('dorayaki_sociallinks');


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Testimonial Widget (Left-Aligned)
/*-----------------------------------------------------------------------------------*/

class dorayaki_testimonial extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_testimonial', __( 'Testimonial (left-aligned) for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_testimonial',
			'description' => __( 'Left-aligned testimonial box for your Testimonial page.', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$testimonialtext = $instance['testimonialtext'];
		$testimonialimg = $instance['testimonialimg'];
		$testimonialauthor = $instance['testimonialauthor'];
		$testimoniallink = $instance['testimoniallink'];
		$testimoniallinkurl = $instance['testimoniallinkurl'];
		$testimoniallink2 = $instance['testimoniallink2'];
		$testimoniallinkurl2 = $instance['testimoniallinkurl2'];


		echo $before_widget; ?>

			<div class="testimonial-box">
				<div class="t-text">
					<p><?php echo $testimonialtext; ?></p>
				</div><!-- end .t-text -->
				<div class="t-authorbox">
					<div class="t-info">
						<img src="<?php echo $testimonialimg; ?>" alt="<?php echo $testimonialauthor; ?>" class="t-img">
						<div class="t-name-links">
							<h4><?php echo $testimonialauthor; ?></h4>
							<?php if($testimoniallink != ''){
								echo '<a href="'.$testimoniallinkurl.'" class="t-link">'.$testimoniallink.'</a>';
							} ?>
							<?php if($testimoniallink2 != ''){
								echo '<a href="'.$testimoniallinkurl2.'" class="t-link">'.$testimoniallink2.'</a>';
							} ?>
						</div>
					</div><!-- end .t-info -->
				</div><!-- end .t-authorbox -->
			</div><!-- end .testimonial-box -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$testimonialtext = esc_attr($instance['testimonialtext']);
		$testimonialimg = esc_attr($instance['testimonialimg']);
		$testimonialauthor = esc_attr($instance['testimonialauthor']);
		$testimoniallink = esc_attr($instance['testimoniallink']);
		$testimoniallinkurl = esc_attr($instance['testimoniallinkurl']);
		$testimoniallink2 = esc_attr($instance['testimoniallink2']);
		$testimoniallinkurl2 = esc_attr($instance['testimoniallinkurl2']);
		?>

		<p>
					<label for="<?php echo $this->get_field_id('testimonialtext'); ?>"><?php _e('Testimonial Text:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('testimonialtext'); ?>" class="widefat" rows="8" id="<?php echo $this->get_field_id('testimonialtext'); ?>"><?php echo( $testimonialtext ); ?></textarea>
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('testimonialimg'); ?>"><?php _e('Author Image URL (Image Size 60x60px):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialimg'); ?>" value="<?php echo $testimonialimg; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialimg'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimonialauthor'); ?>"><?php _e('Author Name:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialauthor'); ?>" value="<?php echo $testimonialauthor; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialauthor'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('testimoniallink'); ?>"><?php _e('1. Author Link (Text):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimoniallink'); ?>" value="<?php echo $testimoniallink; ?>" class="widefat" id="<?php echo $this->get_field_id('testimoniallink'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimoniallinkurl'); ?>"><?php _e('1. Author Link (URL):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimoniallinkurl'); ?>" value="<?php echo $testimoniallinkurl; ?>" class="widefat" id="<?php echo $this->get_field_id('testimoniallinkurl'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimoniallink2'); ?>"><?php _e('2. Author Link (Text):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimoniallink2'); ?>" value="<?php echo $testimoniallink2; ?>" class="widefat" id="<?php echo $this->get_field_id('testimoniallink2'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimoniallinkurl2'); ?>"><?php _e('2. Author Link (URL):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimoniallinkurl2'); ?>" value="<?php echo $testimoniallinkurl2; ?>" class="widefat" id="<?php echo $this->get_field_id('testimoniallinkurl2'); ?>" />
				</p>




		<?php
	}
}

register_widget('dorayaki_testimonial');


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Testimonial Widget (Right-Aligned)
/*-----------------------------------------------------------------------------------*/

class dorayaki_testimonialright extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_testimonialright', __( 'Testimonial (right-aligned) for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_testimonialright',
			'description' => __( 'Right-aligned testimonial box for your Testimonial page.', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$testimonialrighttext = $instance['testimonialrighttext'];
		$testimonialrightimg = $instance['testimonialrightimg'];
		$testimonialrightauthor = $instance['testimonialrightauthor'];
		$testimonialrightlink = $instance['testimonialrightlink'];
		$testimonialrightlinkurl = $instance['testimonialrightlinkurl'];
		$testimonialrightlink2 = $instance['testimonialrightlink2'];
		$testimonialrightlinkurl2 = $instance['testimonialrightlinkurl2'];


		echo $before_widget; ?>

			<div class="testimonial-box">
				<div class="t-text-right">
					<p><?php echo $testimonialrighttext; ?></p>
				</div><!-- end .t-text-right -->
				<div class="t-authorbox-right">
					<div class="t-info">
						<img src="<?php echo $testimonialrightimg; ?>" alt="<?php echo $testimonialrightauthor; ?>" class="t-img">
						<div class="t-name-links">
							<h4><?php echo $testimonialrightauthor; ?></h4>
							<?php if($testimonialrightlink != ''){
								echo '<a href="'.$testimonialrightlinkurl.'" class="t-link">'.$testimonialrightlink.'</a>';
							} ?>
							<?php if($testimonialrightlink2 != ''){
								echo '<a href="'.$testimonialrightlinkurl2.'" class="t-link">'.$testimonialrightlink2.'</a>';
							} ?>
						</div>
					</div><!-- end .t-info -->
				</div><!-- end .t-authorbox-right -->
			</div><!-- end .testimonial-box -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$testimonialrighttext = esc_attr($instance['testimonialrighttext']);
		$testimonialrightimg = esc_attr($instance['testimonialrightimg']);
		$testimonialrightauthor = esc_attr($instance['testimonialrightauthor']);
		$testimonialrightlink = esc_attr($instance['testimonialrightlink']);
		$testimonialrightlinkurl = esc_attr($instance['testimonialrightlinkurl']);
		$testimonialrightlink2 = esc_attr($instance['testimonialrightlink2']);
		$testimonialrightlinkurl2 = esc_attr($instance['testimonialrightlinkurl2']);
		?>

		<p>
					<label for="<?php echo $this->get_field_id('testimonialrighttext'); ?>"><?php _e('Testimonial Text:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('testimonialrighttext'); ?>" class="widefat" rows="8" id="<?php echo $this->get_field_id('testimonialrighttext'); ?>"><?php echo( $testimonialrighttext ); ?></textarea>
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('testimonialrightimg'); ?>"><?php _e('Author Image URL (Image Size 60x60px):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialrightimg'); ?>" value="<?php echo $testimonialrightimg; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialrightimg'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimonialrightauthor'); ?>"><?php _e('Author Name:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialrightauthor'); ?>" value="<?php echo $testimonialrightauthor; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialrightauthor'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('testimonialrightlink'); ?>"><?php _e('1. Author Link (Text):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialrightlink'); ?>" value="<?php echo $testimonialrightlink; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialrightlink'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimonialrightlinkurl'); ?>"><?php _e('1. Author Link (URL):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialrightlinkurl'); ?>" value="<?php echo $testimonialrightlinkurl; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialrightlinkurl'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimonialrightlink2'); ?>"><?php _e('2. Author Link (Text):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialrightlink2'); ?>" value="<?php echo $testimonialrightlink2; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialrightlink2'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('testimonialrightlinkurl2'); ?>"><?php _e('2. Author Link (URL):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('testimonialrightlinkurl2'); ?>" value="<?php echo $testimonialrightlinkurl2; ?>" class="widefat" id="<?php echo $this->get_field_id('testimonialrightlinkurl2'); ?>" />
				</p>

		<?php
	}
}

register_widget('dorayaki_testimonialright');





/*-----------------------------------------------------------------------------------*/
/* Dorayaki Team Widget (for Meet the Team Page)
/*-----------------------------------------------------------------------------------*/

class dorayaki_team extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_team', __( 'Team Member for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_team',
			'description' => __( 'Team member box (big) for your About page.', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$teamname = $instance['teamname'];
		$teamimg = $instance['teamimg'];
		$teamposition = $instance['teamposition'];
		$teamtext = $instance['teamtext'];
		$teamquote = $instance['teamquote'];
		$teamlink = $instance['teamlink'];
		$teamlinkurl = $instance['teamlinkurl'];
		$teamlink2 = $instance['teamlink2'];
		$teamlinkurl2 = $instance['teamlinkurl2'];


		echo $before_widget; ?>

			<div class="team-box">
				<div class="tm-info">
					<img src="<?php echo $teamimg; ?>" alt="<?php echo $teamname; ?>" class="tm-img">
					<div class="tm-author">
						<h4><?php echo $teamname; ?></h4>
						<span class="tm-pos"><?php echo $teamposition; ?></span>
							<p class="tm-text"><?php echo $teamtext; ?></p>
							<?php if($teamlinkurl != ''){
								echo '<a href="'.$teamlinkurl.'" class="tm-link">'.$teamlink.'</a>';
							} ?>
							<?php if($teamlinkurl2 != ''){
								echo '<a href="'.$teamlinkurl2.'" class="tm-link">'.$teamlink2.'</a>';
							} ?>
					</div>
				</div><!-- end .tm-info -->
				<div class="tm-quote">
					<p><?php echo $teamquote; ?></p>
				</div><!-- end .tm-quote -->
			</div><!-- end .team-box -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$teamname = esc_attr($instance['teamname']);
		$teamimg = esc_attr($instance['teamimg']);
		$teamposition = esc_attr($instance['teamposition']);
		$teamtext = esc_attr($instance['teamtext']);
		$teamquote = esc_attr($instance['teamquote']);
		$teamlink = esc_attr($instance['teamlink']);
		$teamlinkurl = esc_attr($instance['teamlinkurl']);
		$teamlink2 = esc_attr($instance['teamlink2']);
		$teamlinkurl2 = esc_attr($instance['teamlinkurl2']);


		?>

		<p>
						<label for="<?php echo $this->get_field_id('teamname'); ?>"><?php _e('Team Member Name:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamname'); ?>" value="<?php echo $teamname; ?>" class="widefat" id="<?php echo $this->get_field_id('teamname'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('teamimg'); ?>"><?php _e('Image URL (240x240px):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamimg'); ?>" value="<?php echo $teamimg; ?>" class="widefat" id="<?php echo $this->get_field_id('teamimg'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('teamposition'); ?>"><?php _e('Company Position:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamposition'); ?>" value="<?php echo $teamposition; ?>" class="widefat" id="<?php echo $this->get_field_id('teamposition'); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('teamtext'); ?>"><?php _e('About Text:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('teamtext'); ?>" class="widefat" rows="8" id="<?php echo $this->get_field_id('teamtext'); ?>"><?php echo( $teamtext ); ?></textarea>
				</p>

				 <p>
					<label for="<?php echo $this->get_field_id('teamquote'); ?>"><?php _e('Personal Quote:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('teamquote'); ?>" class="widefat" rows="4" id="<?php echo $this->get_field_id('teamquote'); ?>"><?php echo( $teamquote ); ?></textarea>
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('teamlink'); ?>"><?php _e('1. Link (Text):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamlink'); ?>" value="<?php echo $teamlink; ?>" class="widefat" id="<?php echo $this->get_field_id('teamlink'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('teamlinkurl'); ?>"><?php _e('1. Link (URL):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamlinkurl'); ?>" value="<?php echo $teamlinkurl; ?>" class="widefat" id="<?php echo $this->get_field_id('teamlinkurl'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('teamlink2'); ?>"><?php _e('2.Link (Text):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamlink2'); ?>" value="<?php echo $teamlink2; ?>" class="widefat" id="<?php echo $this->get_field_id('teamlink2'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('teamlinkurl2'); ?>"><?php _e('2. Link (URL):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamlinkurl2'); ?>" value="<?php echo $teamlinkurl2; ?>" class="widefat" id="<?php echo $this->get_field_id('teamlinkurl2'); ?>" />
				</p>


		<?php
	}
}

register_widget('dorayaki_team');


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Team Widget (Small, for Front Page)
/*-----------------------------------------------------------------------------------*/

class dorayaki_team_small extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_team_small', __( 'Team Member (Small) for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_team_small',
			'description' => __( 'Team member box (small) for pages.', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$teamnameSmall = $instance['teamnameSmall'];
		$teamimgSmall = $instance['teamimgSmall'];
		$teampositionSmall = $instance['teampositionSmall'];
		$teamquoteSmall = $instance['teamquoteSmall'];

		echo $before_widget; ?>

			<div class="team-box-small">
				<div class="tm-info">
					<img src="<?php echo $teamimgSmall; ?>" alt="<?php echo $teamnameSmall; ?>" class="tm-img">
					<div class="tm-author">
						<h4><?php echo $teamnameSmall; ?></h4>
						<span class="tms-pos"><?php echo $teampositionSmall; ?></span>
					</div>
				</div><!-- end .tm-info -->
				<div class="tm-quote">
					<p><?php echo $teamquoteSmall; ?></p>
				</div><!-- end .tm-quote -->
			</div><!-- end .team-box-small -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$teamnameSmall = esc_attr($instance['teamnameSmall']);
		$teamimgSmall = esc_attr($instance['teamimgSmall']);
		$teampositionSmall = esc_attr($instance['teampositionSmall']);
		$teamquoteSmall = esc_attr($instance['teamquoteSmall']);


		?>

		<p>
						<label for="<?php echo $this->get_field_id('teamnameSmall'); ?>"><?php _e('Team Member Name:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamnameSmall'); ?>" value="<?php echo $teamnameSmall; ?>" class="widefat" id="<?php echo $this->get_field_id('teamnameSmall'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('teamimgSmall'); ?>"><?php _e('Image URL (240x240px):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teamimgSmall'); ?>" value="<?php echo $teamimgSmall; ?>" class="widefat" id="<?php echo $this->get_field_id('teamimgSmall'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('teampositionSmall'); ?>"><?php _e('Company Position:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('teampositionSmall'); ?>" value="<?php echo $teampositionSmall; ?>" class="widefat" id="<?php echo $this->get_field_id('teampositionSmall'); ?>" />
				</p>

				 <p>
					<label for="<?php echo $this->get_field_id('teamquoteSmall'); ?>"><?php _e('Personal Quote:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('teamquoteSmall'); ?>" class="widefat" rows="4" id="<?php echo $this->get_field_id('teamquoteSmall'); ?>"><?php echo( $teamquoteSmall ); ?></textarea>
				</p>


		<?php
	}
}

register_widget('dorayaki_team_small');


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Recent Posts Widget for Frontpage
/*-----------------------------------------------------------------------------------*/

class dorayaki_recentposts extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_recentposts', __( 'Recent Posts for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_recentposts',
			'description' => __( 'Recent posts on a Page (with or without thumbnails)', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$postnumber = $instance['postnumber'];
		$cat = apply_filters('widget_title', $instance['cat']);
		$thumbnail = $instance['thumbnail'];

		echo $before_widget; ?>

			<ul class="dorayaki-rp">
				<?php
				global $post;
				$dorayaki_post = $post;

				// get the category IDs and the number of posts and place them in an array
				if($cat) {
					$args = array(
						'posts_per_page' => $postnumber,
						'cat' => $cat,
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-quote', 'post-format-link' ),
								'operator' => 'NOT IN'
								)
								),
						'suppress_filters' => false
								);
				} else {
					$args = array(
						'posts_per_page' => $postnumber,
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-quote', 'post-format-link' ),
								'operator' => 'NOT IN'
								)
								),
						'suppress_filters' => false
								);
				}

				$myposts = get_posts( $args );
				foreach( $myposts as $post ) : setup_postdata($post); ?>

					<li class="rp-box">
						<div class="rp-header">
							<a href="<?php the_permalink(); ?>" class="rp-date"><?php echo get_the_date(); ?></a>
							<h3 class="rp-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div><!-- end .rp-header -->
						<div class="rp-summary">
							<?php if($thumbnail == true && has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" class="rp-thumb"><?php the_post_thumbnail();?></a>
							<?php } ?>
							<?php the_excerpt(); ?>
						</div><!-- end .rp-summary -->
						<div class="rp-meta">
							<?php if ( comments_open() ) : ?>
							<div class="rp-comments">
							<?php comments_popup_link( '<span class="leave-reply">' . __( '0 comments', 'dorayaki' ) . '</span>', __( '1 comment', 'dorayaki' ), __( '% comments', 'dorayaki' ) ); ?>
							</div><!-- end .rp-comments -->
							<?php endif; // comments_open() ?>
							<?php // Include Share-Btns
							$options = get_option('dorayaki_theme_options');
							if( $options['share-posts'] ) : ?>
								<?php get_template_part( 'share'); ?>
							<?php endif; ?>
						</div><!-- end .rp-meta -->
					</li>
					<?php endforeach; ?>
					<?php $post = $dorayaki_post; ?>
			</ul><!-- end .dorayaki-rp -->
		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
			 $postnumber = esc_attr($instance['postnumber']);
		$cat = esc_attr($instance['cat']);
		$thumbnail = esc_attr($instance['thumbnail']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to display (e.g. 4, 6 or 8):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo $postnumber; ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category ID numbers (to choose which categories to include):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cat'); ?>" value="<?php echo $cat; ?>" class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" />
				</p>

		<p>
					<input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" value="1" <?php checked( '1', $thumbnail ); ?>/>
					<label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e('Display thumbnails?','dorayaki'); ?></label>
				</p>


		<?php
	}
}

register_widget('dorayaki_recentposts');


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Service Widget (for Front or/and Service Page)
/*-----------------------------------------------------------------------------------*/

class dorayaki_service extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_service', __( 'Service Box for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_service',
			'description' => __( 'Service box for your front or/and service page.', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$servicename = $instance['servicename'];
		$serviceimg = $instance['serviceimg'];
		$serviceinfo = $instance['serviceinfo'];
		$servicelink = $instance['servicelink'];

		echo $before_widget; ?>

			<a class="service-box" href="<?php echo $servicelink; ?>">
				<img src="<?php echo $serviceimg; ?>" alt="<?php echo $servicename; ?>" class="service-img">
				<span class="service-name"><?php echo $servicename; ?></span>
				<span class="service-info"><?php echo $serviceinfo; ?></span>
			</a><!-- end .service-box -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$servicename = esc_attr($instance['servicename']);
		$serviceimg = esc_attr($instance['serviceimg']);
		$serviceinfo = esc_attr($instance['serviceinfo']);
		$servicelink = esc_attr($instance['servicelink']);
		?>

		<p>
						<label for="<?php echo $this->get_field_id('servicename'); ?>"><?php _e('Service Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('servicename'); ?>" value="<?php echo $servicename; ?>" class="widefat" id="<?php echo $this->get_field_id('servicename'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('serviceimg'); ?>"><?php _e('Image URL (380px width / flexible height):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('serviceimg'); ?>" value="<?php echo $serviceimg; ?>" class="widefat" id="<?php echo $this->get_field_id('serviceimg'); ?>" />
				</p>

				 <p>
					<label for="<?php echo $this->get_field_id('serviceinfo'); ?>"><?php _e('Service Info Text:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('serviceinfo'); ?>" class="widefat" rows="4" id="<?php echo $this->get_field_id('serviceinfo'); ?>"><?php echo( $serviceinfo ); ?></textarea>
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('servicelink'); ?>"><?php _e('URL the Service Box will link to:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('servicelink'); ?>" value="<?php echo $servicelink; ?>" class="widefat" id="<?php echo $this->get_field_id('servicelink'); ?>" />
				</p>


		<?php
	}
}

register_widget('dorayaki_service');

/*-----------------------------------------------------------------------------------*/
/* Dorayaki Portfolio Posts Widget for Frontpage
/*-----------------------------------------------------------------------------------*/

class dorayaki_portfolio extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_portfolio', __( 'Portfolio for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_portfolio',
			'description' => __( 'A number of portfolio posts on a Page (with thumbnails)', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$portfolionumber = $instance['portfolionumber'];
		$portfoliocat = apply_filters('widget_title', $instance['portfoliocat']);

		echo $before_widget; ?>

				<?php
				global $post;
				$dorayaki_post = $post;

				// get the category IDs and the number of posts and place them in an array
				$args = array(
					'posts_per_page' => $portfolionumber,
					'category_name' => $portfoliocat,
					'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array( 'post-format-quote', 'post-format-link' ),
							'operator' => 'NOT IN'
							)
							)
					);

				$portfolioposts = get_posts( $args );
				foreach( $portfolioposts as $post ) : setup_postdata($post); ?>

					<div class="portfolio-box">
						<?php if(has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" class="portfolio-thumb"><?php the_post_thumbnail();?></a>
						<?php } ?>
						<h3 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="portfolio-entry-cats"><?php the_category(' &sdot; '); ?></div>
					</div><!-- end .portfolio-box -->
					<?php endforeach; ?>
					<?php $post = $dorayaki_post; ?>
		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();

	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
			 $portfolionumber = esc_attr($instance['portfolionumber']);
		$portfoliocat = esc_attr($instance['portfoliocat']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('portfolionumber'); ?>"><?php _e('Number of portfolio posts to display (e.g. 4, 6 or 8):','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('portfolionumber'); ?>" value="<?php echo $portfolionumber; ?>" class="widefat" id="<?php echo $this->get_field_id('portfolionumber'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('portfoliocat'); ?>"><?php _e('Category slug (NOT name) of your portfolio category:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('portfoliocat'); ?>" value="<?php echo $portfoliocat; ?>" class="widefat" id="<?php echo $this->get_field_id('portfoliocat'); ?>" />
				</p>

		<?php
	}
}

register_widget('dorayaki_portfolio');

/*-----------------------------------------------------------------------------------*/
/* Dorayaki Contact Widget (for Front or/and Contact Page)
/*-----------------------------------------------------------------------------------*/

class dorayaki_contactbox extends WP_Widget {

	public function __construct() {
		parent::__construct( 'dorayaki_contactbox', __( 'Contact Box for Pages', 'dorayaki' ), array(
			'classname'   => 'widget_dorayaki_contactbox',
			'description' => __( 'Contact box for your front or/and contact page.', 'dorayaki' ),
		) );
	}

	public function widget($args, $instance) {
		extract( $args );
		$cbaddress = $instance['cbaddress'];
		$cbinfo = $instance['cbinfo'];
		$cbemailtitle01 = $instance['cbemailtitle01'];
		$cbemail01 = $instance['cbemail01'];
		$cbemailtitle02 = $instance['cbemailtitle02'];
		$cbemail02 = $instance['cbemail02'];
		$cbemailtitle03 = $instance['cbemailtitle03'];
		$cbemail03 = $instance['cbemail03'];
		$cbmapurl = $instance['cbmapurl'];

		echo $before_widget; ?>

			<div class="contact-box clearfix">
				<div class="cb-map">
					<?php if($cbmapurl != ''){
						echo '<iframe src="'.$cbmapurl.'&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>';
					} ?>
				</div><!-- end .cb-map -->
				<div class="cb-info clearfix">
					<div class="cb-address-wrap">
						<div class="cb-address"><?php echo wpautop($cbaddress); ?></div>
						<?php if($cbinfo != ''){
							echo '<div class="cb-additional">'.$cbinfo.'</div>';
						} ?>
						<?php if($cbmapurl != ''){
							echo '<a href="'.$cbmapurl.'" class="cb-maplink" target="_blank">'. __( 'View map in browser', 'dorayaki').'</a>';
						} ?>
					</div><!-- end .cb-address-wrap -->
					<div class="cb-emails">
						<h5><?php _e('Email Us', 'dorayaki') ?></h5>
						<h6><?php echo ($cbemailtitle01); ?></h6>
						<span><?php echo ($cbemail01); ?></span>
						<?php if($cbemailtitle02 != '' || $cbemail02 != ''){
							echo '<h6>'.$cbemailtitle02.'</h6><span>'.$cbemail02.'</span>';
						} ?>
						<?php if($cbemailtitle03 != '' || $cbemail03 != ''){
							echo '<h6>'.$cbemailtitle03.'</h6><span>'.$cbemail03.'</span>';
						} ?>
					</div><!-- end .cb-emails -->
				</div><!-- end .cb-info -->
			</div><!-- end .contact-box -->

		 <?php
		 echo $after_widget;

		 // Reset the post globals as this query will have stomped on it
		 wp_reset_postdata();
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$cbaddress = esc_attr($instance['cbaddress']);
		$cbinfo = esc_attr($instance['cbinfo']);
		$cbemailtitle01 = esc_attr($instance['cbemailtitle01']);
		$cbemail01 = esc_attr($instance['cbemail01']);
		$cbemailtitle02 = esc_attr($instance['cbemailtitle02']);
		$cbemail02 = esc_attr($instance['cbemail02']);
		$cbemailtitle03 = esc_attr($instance['cbemailtitle03']);
		$cbemail03 = esc_attr($instance['cbemail03']);
		$cbmapurl = esc_attr($instance['cbmapurl']);

		?>

		<p>
					<label for="<?php echo $this->get_field_id('cbaddress'); ?>"><?php _e('Company Address:','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('cbaddress'); ?>" class="widefat" rows="5" id="<?php echo $this->get_field_id('cbaddress'); ?>"><?php echo ($cbaddress); ?></textarea>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('cbinfo'); ?>"><?php _e('Additional Info (e.g. Phone Numbers):','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('cbinfo'); ?>" class="widefat" rows="2" id="<?php echo $this->get_field_id('cbinfo'); ?>"><?php echo($cbinfo); ?></textarea>
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('cbemailtitle01'); ?>"><?php _e('1. Email Address Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cbemailtitle01'); ?>" value="<?php echo $cbemailtitle01; ?>" class="widefat" id="<?php echo $this->get_field_id('cbemailtitle01'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('cbemail01'); ?>"><?php _e('1. Email Address:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cbemail01'); ?>" value="<?php echo $cbemail01; ?>" class="widefat" id="<?php echo $this->get_field_id('cbemail01'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('cbemailtitle02'); ?>"><?php _e('2. Email Address Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cbemailtitle02'); ?>" value="<?php echo $cbemailtitle02; ?>" class="widefat" id="<?php echo $this->get_field_id('cbemailtitle02'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('cbemail02'); ?>"><?php _e('2. Email Address:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cbemail02'); ?>" value="<?php echo $cbemail02; ?>" class="widefat" id="<?php echo $this->get_field_id('cbemail02'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('cbemailtitle03'); ?>"><?php _e('3. Email Address Title:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cbemailtitle03'); ?>" value="<?php echo $cbemailtitle03; ?>" class="widefat" id="<?php echo $this->get_field_id('cbemailtitle03'); ?>" />
				</p>

				 <p>
						<label for="<?php echo $this->get_field_id('cbemail03'); ?>"><?php _e('3. Email Address:','dorayaki'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('cbemail03'); ?>" value="<?php echo $cbemail03; ?>" class="widefat" id="<?php echo $this->get_field_id('cbemail03'); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('cbmapurl'); ?>"><?php _e('Google Maps URL (no short URL, please):','dorayaki'); ?></label>
			<textarea name="<?php echo $this->get_field_name('cbmapurl'); ?>" class="widefat" rows="8" id="<?php echo $this->get_field_id('cbmapurl'); ?>"><?php echo($cbmapurl); ?></textarea>
				</p>

		<?php
	}
}

register_widget('dorayaki_contactbox');
