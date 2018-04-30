<?php
	// config check security
	function wpoa_cc_security() {
		$points = 0;
		if (strpos(site_url(), "https://")) {
			$points += 2;
		}
		if (get_option('wpoa_hide_wordpress_login_form') == 1) {
			$points += 1;
		}
		if (get_option('wpoa_logout_inactive_users') > 0) {
			$points += 1;
		}
		if (get_option('wpoa_http_util_verify_ssl') == 1) {
			$points += 1;
		}
		if (get_option('wpoa_http_util') == 'curl') {
			$points += 1;
		}
		$points_max = 6;
		return floor(($points / $points_max) * 100);
	}
	
	// config check privacy
	function wpoa_cc_privacy() {
		$points = 0;
		if (get_option('wpoa_logout_inactive_users') > 0) {
			$points += 1;
		}
		// TODO: +1 for NOT using email address matching
		$points_max = 1;
		return floor(($points / $points_max) * 100);
	}
	
	// config check user experience
	function wpoa_cc_ux() {
		$points = 0;
		if (get_option('wpoa_logo_links_to_site') == 1) {
			$points += 1;
		}
		if (get_option('wpoa_show_login_messages') == 1) {
			$points += 1;
		}
		$points_max = 2;
		return floor(($points / $points_max) * 100);
	}
	
	// cache the config check ratings:
	$cc_security = wpoa_cc_security();
	$cc_privacy = wpoa_cc_privacy();
	$cc_ux = wpoa_cc_ux();
?>



<div class='wrap wpoa-settings'>
	<div id="wpoa-settings-meta">Toggle tips: <ul><li><a id="wpoa-settings-tips-on" href="#">On</a></li><li><a id="wpoa-settings-tips-off" href="#">Off</a></li></ul><div class="nav-splitter"></div>Toggle sections: <ul><li><a id="wpoa-settings-sections-on" href="#">On</a></li><li><a id="wpoa-settings-sections-off" href="#">Off</a></li></ul></div>
	<h2>WP-OAuth Settings</h2>
	<!-- START Settings Header -->
	<div id="wpoa-settings-header"></div>
	<!-- END Settings Header -->
	<!-- START Settings Body -->
	<div id="wpoa-settings-body">
	<!-- START Settings Column 1 -->
	<div id="wpoa-settings-col1" class="wpoa-settings-column">
		<form method='post' action='options.php'>
			<?php settings_fields('wpoa_settings'); ?>
			<?php do_settings_sections('wpoa_settings'); ?>
			<!-- START General Settings section -->
			<div id="wpoa-settings-section-general-settings" class="wpoa-settings-section">
			<h3>General Settings</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top' class='has-tip' class="has-tip">
				<th scope='row'>Show login messages: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_show_login_messages' value='1' <?php checked(get_option('wpoa_show_login_messages') == 1); ?> />
					<p class="tip-message">Shows a short-lived notification message to the user which indicates whether or not the login was successful, and if there was an error.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Login redirects to: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_login_redirect'>
						<option value='home_page' <?php selected(get_option('wpoa_login_redirect'), 'home_page'); ?>>Home Page</option>
						<option value='last_page' <?php selected(get_option('wpoa_login_redirect'), 'last_page'); ?>>Last Page</option>
						<option value='specific_page' <?php selected(get_option('wpoa_login_redirect'), 'specific_page'); ?>>Specific Page</option>
						<option value='admin_dashboard' <?php selected(get_option('wpoa_login_redirect'), 'admin_dashboard'); ?>>Admin Dashboard</option>
						<option value='user_profile' <?php selected(get_option('wpoa_login_redirect'), 'user_profile'); ?>>User's Profile Page</option>
						<option value='custom_url' <?php selected(get_option('wpoa_login_redirect'), 'custom_url'); ?>>Custom URL</option>
					</select>
					<?php wp_dropdown_pages(array("id" => "wpoa_login_redirect_page", "name" => "wpoa_login_redirect_page", "selected" => get_option('wpoa_login_redirect_page'))); ?>
					<input type="text" name="wpoa_login_redirect_url" value="<?php echo get_option('wpoa_login_redirect_url'); ?>" style="display:none;" />
					<p class="tip-message">Specifies where to redirect a user after they log in.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Logout redirects to: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_logout_redirect'>
						<option value='default_handling' <?php selected(get_option('wpoa_logout_redirect'), 'default_handling'); ?>>Let WordPress handle it</option>
						<option value='home_page' <?php selected(get_option('wpoa_logout_redirect'), 'home_page'); ?>>Home Page</option>
						<option value='last_page' <?php selected(get_option('wpoa_logout_redirect'), 'last_page'); ?>>Last Page</option>
						<option value='specific_page' <?php selected(get_option('wpoa_logout_redirect'), 'specific_page'); ?>>Specific Page</option>
						<option value='admin_dashboard' <?php selected(get_option('wpoa_logout_redirect'), 'admin_dashboard'); ?>>Admin Dashboard</option>
						<option value='user_profile' <?php selected(get_option('wpoa_logout_redirect'), 'user_profile'); ?>>User's Profile Page</option>
						<option value='custom_url' <?php selected(get_option('wpoa_logout_redirect'), 'custom_url'); ?>>Custom URL</option>
					</select>
					<?php wp_dropdown_pages(array("id" => "wpoa_logout_redirect_page", "name" => "wpoa_logout_redirect_page", "selected" => get_option('wpoa_logout_redirect_page'))); ?>
					<input type="text" name="wpoa_logout_redirect_url" value="<?php echo get_option('wpoa_logout_redirect_url'); ?>" style="display:none;" />
					<p class="tip-message">Specifies where to redirect a user after they log out.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Automatically logout inactive users: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_logout_inactive_users'>
						<option value='0' <?php selected(get_option('wpoa_logout_inactive_users'), '0'); ?>>Never</option>
						<option value='1' <?php selected(get_option('wpoa_logout_inactive_users'), '1'); ?>>After 1 minute</option>
						<option value='5' <?php selected(get_option('wpoa_logout_inactive_users'), '5'); ?>>After 5 minutes</option>
						<option value='15' <?php selected(get_option('wpoa_logout_inactive_users'), '15'); ?>>After 15 minutes</option>
						<option value='30' <?php selected(get_option('wpoa_logout_inactive_users'), '30'); ?>>After 30 minutes</option>
						<option value='60' <?php selected(get_option('wpoa_logout_inactive_users'), '60'); ?>>After 1 hour</option>
						<option value='120' <?php selected(get_option('wpoa_logout_inactive_users'), '120'); ?>>After 2 hours</option>
						<option value='240' <?php selected(get_option('wpoa_logout_inactive_users'), '240'); ?>>After 4 hours</option>
					</select>
					<p class="tip-message">Specifies whether to log out users automatically after a period of inactivity.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> When a user logs out of WordPress, they will remain logged into their third-party provider until they close their browser. Logging out of WordPress DOES NOT log you out of Google, Facebook, LinkedIn, etc...</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END General Settings section -->
			
			<!-- START Login Page & Form Customization section -->
			<div id="wpoa-settings-section-login-forms" class="wpoa-settings-section">
			<h3>Login Forms</h3>
			<div class='form-padding'>
			<table class='form-table'>
				
				<tr valign='top'>
				<th colspan="2">
					<h4>Default Login Form / Page / Popup</h4>
				</th>
				</td>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Hide the WordPress login form: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_hide_wordpress_login_form' value='1' <?php checked(get_option('wpoa_hide_wordpress_login_form') == 1); ?> />
					<p class="tip-message">Use this to hide the WordPress username/password login form that is shown by default on the Login Screen and Login Popup.</p>
					<p class="tip-message tip-warning"><strong>Warning: </strong>Hiding the WordPress login form may prevent you from being able to login. If you normally rely on this method, DO NOT enable this setting. Furthermore, please make sure your login provider(s) are active and working BEFORE enabling this setting.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Logo links to site: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_logo_links_to_site' value='1' <?php checked(get_option('wpoa_logo_links_to_site') == 1); ?> />
					<p class="tip-message">Forces the logo image on the login form to link to your site instead of WordPress.org.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Logo image: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<p>
					<input id='wpoa_logo_image' type='text' size='' name='wpoa_logo_image' value="<?php echo get_option('wpoa_logo_image'); ?>" />
					<input id='wpoa_logo_image_button' type='button' class='button' value='Select' />
					</p>
					<p class="tip-message">Changes the default WordPress logo on the login form to an image of your choice. You may select an image from the Media Library, or specify a custom URL.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Background image: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<p>
					<input id='wpoa_bg_image' type='text' size='' name='wpoa_bg_image' value="<?php echo get_option('wpoa_bg_image'); ?>" />
					<input id='wpoa_bg_image_button' type='button' class='button' value='Select' />
					</p>
					<p class="tip-message">Changes the background on the login form to an image of your choice. You may select an image from the Media Library, or specify a custom URL.</p>
				</td>
				</tr>

			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Login Page & Form Customization section -->

			<!-- START User Registration section -->
			<div id="wpoa-settings-section-user-registration" class="wpoa-settings-section">
			<h3>User Registration</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>Suppress default welcome email: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_suppress_welcome_email' value='1' <?php checked(get_option('wpoa_suppress_welcome_email') == 1); ?> />
					<p class="tip-message">Prevents WordPress from sending an email to newly registered users by default, which contains their username and password.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Assign new users to the following role: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name="wpoa_new_user_role"><?php wp_dropdown_roles(get_option('wpoa_new_user_role')); ?></select>
					<p class="tip-message">Specifies what user role will be assigned to newly registered users.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END User Registration section -->
			
			<!-- START Login with Google section -->
			<div id="wpoa-settings-section-login-with-google" class="wpoa-settings-section">
			<h3>Login with Google</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top'>
				<th scope='row'>Enabled:</th>
				<td>
					<input type='checkbox' name='wpoa_google_api_enabled' value='1' <?php checked(get_option('wpoa_google_api_enabled') == 1); ?> />
				</td>
				</tr>
				
				<tr valign='top'>
				<th scope='row'>Client ID:</th>
				<td>
					<input type='text' name='wpoa_google_api_id' value='<?php echo get_option('wpoa_google_api_id'); ?>' />
				</td>
				</tr>

				<tr valign='top'>
				<th scope='row'>Client Secret:</th>
				<td>
					<input type='text' name='wpoa_google_api_secret' value='<?php echo get_option('wpoa_google_api_secret'); ?>' />
				</td>
				</tr>
			</table> <!-- .form-table -->
			<p>
				<strong>Instructions:</strong>
				<ol>
					<li>Visit the Google website for developers <a href='https://console.developers.google.com/project' target="_blank">console.developers.google.com</a>.</li>
					<li>At Google, create a new Project and enable the Google+ API. This will enable your site to access the Google+ API.</li>
					<li>At Google, provide your site's homepage URL (<?php echo $blog_url; ?>) for the new Project's Redirect URI. Don't forget the trailing slash!</li>
					<li>At Google, you must also configure the Consent Screen with your Email Address and Product Name. This is what Google will display to users when they are asked to grant access to your site/app.</li>
					<li>Paste your Client ID/Secret provided by Google into the fields above, then click the Save all settings button.</li>
				</ol>
			</p>
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Login with Google section -->
			
			<!-- START Login with Facebook section -->
			<div id="wpoa-settings-section-login-with-facebook" class="wpoa-settings-section">
			<h3>Login with Facebook</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top'>
				<th scope='row'>Enabled:</th>
				<td>
					<input type='checkbox' name='wpoa_facebook_api_enabled' value='1' <?php checked(get_option('wpoa_facebook_api_enabled') == 1); ?> />
				</td>
				</tr>
				
				<tr valign='top'>
				<th scope='row'>App ID:</th>
				<td>
					<input type='text' name='wpoa_facebook_api_id' value='<?php echo get_option('wpoa_facebook_api_id'); ?>' />
				</td>
				</tr>
				 
				<tr valign='top'>
				<th scope='row'>App Secret:</th>
				<td>
					<input type='text' name='wpoa_facebook_api_secret' value='<?php echo get_option('wpoa_facebook_api_secret'); ?>' />
				</td>
				</tr>
			</table> <!-- .form-table -->
			<p>
				<strong>Instructions:</strong>
				<ol>
					<li>Register as a Facebook Developer at <a href='https://developers.facebook.com/' target="_blank">developers.facebook.com</a>.</li>
					<li>At Facebook, create a new App. This will enable your site to access the Facebook API.</li>
					<li>At Facebook, provide your site's homepage URL (<?php echo $blog_url; ?>) for the new App's Redirect URI. Don't forget the trailing slash!</li>
					<li>Paste your App ID/Secret provided by Facebook into the fields above, then click the Save all settings button.</li>
				</ol>
			</p>
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Login with Facebook section -->

			<!-- START Back Channel Configuration section -->
			<div id="wpoa-settings-section-back-channel=configuration" class="wpoa-settings-section">
			<h3>Back Channel Configuration</h3>
			<div class='form-padding'>
			<p>These settings are for troubleshooting and/or fine tuning the back channel communication this plugin utilizes between your server and the third-party providers.</p>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>HTTP utility: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_http_util'>
						<option value='curl' <?php selected(get_option('wpoa_http_util'), 'curl'); ?>>cURL</option>
						<option value='stream-context' <?php selected(get_option('wpoa_http_util'), 'stream-context'); ?>>Stream Context</option>
					</select>
					<p class="tip-message">The method used by the web server for performing HTTP requests to the third-party providers. Most servers support cURL, but some servers may require Stream Context instead.</p>
				</td>
				</tr>
				
				<tr valign='top' class="has-tip">
				<th scope='row'>Verify Peer/Host SSL Certificates: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_http_util_verify_ssl' value='1' <?php checked(get_option('wpoa_http_util_verify_ssl') == 1); ?> />
					<p class="tip-message">Determines whether or not to validate peer/host SSL certificates during back channel HTTP calls to the third-party login providers. If your server has an incorrect SSL configuration or doesn't support SSL, you may try disabling this setting as a workaround.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> Disabling this is not recommended. For maximum security it would be a good idea to get your server's SSL configuration fixed and keep this setting enabled.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Back Channel Configuration section -->
			
			<!-- START Maintenance & Troubleshooting section -->
			<div id="wpoa-settings-section-maintenance-troubleshooting" class="wpoa-settings-section">
			<h3>Maintenance & Troubleshooting</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>Restore default settings: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_restore_default_settings' value='1' <?php checked(get_option('wpoa_restore_default_settings') == 1); ?> />
					<p class="tip-message"><strong>Instructions:</strong> Check the box above, click the Save all settings button, and the settings will be restored to default.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> This will restore the default settings, erasing any API keys/secrets that you may have entered above.</p>
				</td>
				</tr>		
				<tr valign='top' class="has-tip">
				<th scope='row'>Delete settings on uninstall: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_delete_settings_on_uninstall' value='1' <?php checked(get_option('wpoa_delete_settings_on_uninstall') == 1); ?> />
					<p class="tip-message"><strong>Instructions:</strong> Check the box above, click the Save all settings button, then uninstall this plugin as normal from the Plugins page.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> This will delete all settings that may have been created in your database by this plugin, including all linked third-party login providers. This will not delete any WordPress user accounts, but users who may have registered with or relied upon their third-party login providers may have trouble logging into your site. Make absolutely sure you won't need the values on this page any time in the future, because they will be deleted permanently.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END  Maintenance & Troubleshooting section -->
		</form> <!-- form -->
	</div>
	<!-- END Settings Column 1 -->
	</div> <!-- #wpoa-settings-body -->
	<!-- END Settings Body -->
</div> <!-- .wrap .wpoa-settings -->