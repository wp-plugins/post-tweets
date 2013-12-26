  <form method="post" action="options.php">
        <?php wp_nonce_field('update-options') ?>
<h2 class="hndle"><span>Twitter Settings</span></h2>

 <div id="post_tweets" class="postbox">
						<div class="inside">
							<table cellpadding="0" class="links-table">
								<tbody>
																		<tr>
										<th scope="row"><label for="social[twitter][key]">Consumer key</label></th>
										<td><input type="text" value="<?php echo get_option('twitter_key'); ?>" id="twitter_key" class="code" name="twitter_key"></td>
									</tr>
									<tr>
										<th scope="row"><label for="social[twitter][secret]">Consumer secret</label></th>
										<td><input type="text" value="<?php echo get_option('twitter_secret'); ?>" id="twitter_secret" class="code" name="twitter_secret"></td>
									</tr>
                                    
                                    <tr>
										<th scope="row"><label for="social[twitter][AccessToken]">Access Token</label></th>
										<td><input type="text" value="<?php echo get_option('twitter_AccessToken'); ?>" id="twitter_AccessToken" class="code" name="twitter_AccessToken"></td>
									</tr>
									<tr>
										<th scope="row"><label for="social[twitter][AccessTokenSecret]">Access Token Secret</label></th>
										<td><input type="text" value="<?php echo get_option('twitter_AccessTokenSecret'); ?>" id="twitter_AccessTokenSecret" class="code" name="twitter_AccessTokenSecret"></td>
									</tr>
                                    <tr>
                                    	<td>&nbsp;</td>
                                        <td align="right">
<input type="submit" class="button-primary" name="save-fav-icon" value="<?php _e('Save Changes') ?>"/>
        <input type="hidden" name="action" value="update"/>
        <input type="hidden" name="page_options" value="twitter_key,twitter_secret,twitter_AccessToken,twitter_AccessTokenSecret" />
                                        
                                        </td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>
							<div><strong>Need Help?</strong><p><em>Enter Your Twitter Account APP Consumer key, Consumer secret, Access Token and Access Token Secret. <a target="_blank" href="https://dev.twitter.com/apps">Click Here</a> For More Details.</em></p>
							</div>
							<div class="clear"></div>
                    
</form>