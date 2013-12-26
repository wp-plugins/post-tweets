<?php
		if(isset($_REQUEST['post_tweet_submit']))
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
			$message = $_REQUEST['tweet_desc']; 
			
			if(strlen($message) <= 140)
			{
			 
				// send to twitter
				$status = $tweet->post('statuses/update', array('status' => $message));
          	
		 		$_SESSION['msg']="Your tweet was posted";
		  
			}
		  
				 
			 
		}
		
?>
	<?php if(get_option('twitter_key')!="" and get_option('twitter_secret') and get_option('twitter_AccessToken') and get_option('twitter_AccessTokenSecret')){?>
	 
    	
		 <form method="post" action="">
        <?php wp_nonce_field('update-options'); ?>

            <h2 class="hndle"><span>Post Tweets</span></h2>

 			<div id="post_tweets" class="postbox">
						<div class="inside">
							<table cellpadding="0" class="links-table">
								<tbody>
										 
                                    <tr>
										<th scope="row"><strong>Compose new tweets</strong></th>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="2">
                                        
                                        <textarea rows="5" cols="20" name="tweet_desc" id="tweet_desc" maxlength="140"></textarea><br />
                                        </td>
									</tr>
                                    <tr>
                                    	<td style="color:#090; font-size:16px;">
											<?php  if($_SESSION['msg']!='') {  
                         
                                             echo $_SESSION['msg'];
                                             unset($_SESSION['msg']);					 
                                             
                                             } ?>
                     					 </td>
                                        <td align="right"><input type="submit" class="button-primary" name="post_tweet_submit" value="<?php _e('Post Tweet') ?>"/>
        <input type="hidden" name="action" value="update"/>
</td>
                                    </tr>
								</tbody>
							</table>
							 
							 
						</div>
					</div>
</form>


	<?php }else{ ?>
		
        <h2 class="hndle"><span>Post Tweet</span></h2>
        
        		<div id="post_tweets" class="postbox">
						<div class="inside">
							 <table cellpadding="0" class="links-table">
								<tbody>
										 
                                    <tr>
										<td style="color:#900; font-size:16px;">Please configure your tweetes settings...</td>
										<td>&nbsp;</td>
									</tr>
                               </tbody>
                            </table>   
                             
							 
							 
						</div>
					</div>
         
    <?php }?>