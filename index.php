<?php
/*
Plugin Name: Post Tweets
Plugin URI: http://viaviweb.com
Description: This plugin allows wordpress authors to post their tweets from post and pages.
Version: 1.0.0
Author: viaviwebtech
Author URI: http://viaviweb.com
Wordpress version supported: 3.0 and above
License: GPL2
*/

$pluginsURI = plugins_url('/post-tweets/');

function viavi_tweet_script() {
	global $pluginsURI;
	wp_enqueue_script( 'jquery' );	
	
	wp_register_script('viavi_js', $pluginsURI . 'js/word_count.js', array(), '1.0' );
	wp_enqueue_script( 'viavi_js' );
		
	wp_register_style('viavi_css', $pluginsURI . 'style/tweet_style.css', array(), '1.0' );
	wp_enqueue_style( 'viavi_css' );	
}
add_action('init', 'viavi_tweet_script');

 /*Add Menu Options Page*/
add_action('admin_menu', 'viavi_add_menu_pages');


function viavi_add_menu_pages() {
	add_menu_page('Post Tweets', 'Post Tweets', 'manage_options', 'viavi_tweet_page', 'viavi_tweets_option',plugins_url('/style/twitter_icon.png', __FILE__) );	
	add_submenu_page('viavi_tweet_page', 'Post Tweets', 'Post Tweets', 'manage_options', 'viavi_tweet_page', 'viavi_tweets_option');	 
	
	add_submenu_page('viavi_tweet_page', 'Tweets Settings', 'Tweets Settings', 'manage_options', 'viavi_tweets_option_page', 'viavi_tweets_option_fn');
	
	 
}

function viavi_tweets_option() {
	 
	 include("tweets-post.php");
}

function viavi_tweets_option_fn() {
	 
	 include("tweets-settings.php");
}

  
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function twplugin_add_custom_box() {

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'twplugin_sectionid',
            __( 'Tweet This Post', 'twplugin_textdomain' ),
            'twplugin_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'twplugin_add_custom_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function twplugin_inner_custom_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'twplugin_inner_custom_box', 'twplugin_inner_custom_box_nonce' );

  
  echo ' <input type="radio" name="tweet_check" value="tweet_yes">Yes';
 echo ' <input type="radio" name="tweet_check" value="tweet_no" checked="checked">No';
 
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function twplugin_save_postdata( $post_id ) {

 
		if($_POST['tweet_check']=="tweet_yes")
		{
			require_once('twitteroauth.php');
			
			$tConsumerKey       = get_option('twitter_key');
			$tConsumerSecret    = get_option('twitter_secret'); 
			$tAccessToken       = get_option('twitter_AccessToken');
			$tAccessTokenSecret = get_option('twitter_AccessTokenSecret');
			
			// start connection
			$tweet = new TwitterOAuth($tConsumerKey, $tConsumerSecret, $tAccessToken, $tAccessTokenSecret);
			 
			$content = $tweet->get('account/verify_credentials');
			 
			// the message
			$message = get_the_title($post_id);
			$message .= get_permalink( $post_id );  
			
			$status = $tweet->post('statuses/update', array('status' => $message));
		}
   
}
add_action( 'save_post', 'twplugin_save_postdata' );

?>

 