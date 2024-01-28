<?php

/**
 * @Text which is being used in Framework
 *
 */
    global $foodbakery_var_frame_static_text;
    
if ( ! function_exists('foodbakery_var_frame_text_srt') ) {

	function foodbakery_var_frame_text_srt($str = '') {
		global $foodbakery_var_frame_static_text;
		if ( isset($foodbakery_var_frame_static_text[$str]) ) {
			return $foodbakery_var_frame_static_text[$str];
		}
	}

}
if ( ! class_exists('foodbakery_var_frame_all_strings') ) {

	class foodbakery_var_frame_all_strings {

		public function __construct() {

			$this->foodbakery_var_frame_all_string_all();
		}

		function foodbakery_var_login_strings() {
			global $foodbakery_var_frame_static_text;
			/*
			 * Sign Up
			 * Sign In
			 * Forget Password
			 * */
			$foodbakery_var_frame_static_text['foodbakery_var_join_us'] = __(' Register', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_confirm_password'] = __('CONFIRM PASSWORD ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_user_registration'] = __('User Registration is disabled', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_you_have_already_logged_in'] = __(' You have already logged in, Please logout to try again.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_please_logout_first'] = __('Please logout first then try to login again', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_user_login'] = __('User Login', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_username'] = __('USERNAME', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_username_small'] = __('username', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_password'] = __('PASSWORD', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_log_in'] = __('Login', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_forgot_password'] = __('Forgot Password', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_new_to_us'] = __('New to Us?', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_signup_signin'] = __('Signup / Signin with', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_desired_username'] = __('Type desired username', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_phone'] = __('Phone Number', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_phone_hint'] = __('Enter Phone Number', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_register_here'] = __('Register Here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_create_account'] = __('Create Account', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_not_member_yet'] = __('Not a Member yet?', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_Sign_up_now'] = __('Sign Up Now', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_or'] = __('Or', 'cs-framework');
                                                       
                    
			//$foodbakery_var_frame_static_text['foodbakery_var_sign_in'] = __('Log in', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sign_in'] = __('SIGN IN', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_password_should_not_be_empty'] = __('Password should not be empty', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_password_should_not_match'] = __('Password Not Match', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_already_have_account'] = __(' Already have an account', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_login_now'] = __(' Login Now', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_user_sign_in'] = __('User Sign in', 'cs-framework');

			/*
			 *  Login File
			 * */
			$foodbakery_var_frame_static_text['foodbakery_var_edit_register_options'] = __('User Registration Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_set_api_key'] = __('Please set API key', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_signin_with_your_Social_networks'] = __('Signin with your Social Networks', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_google'] = __('google', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_linkedin'] = __('Linkedin', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_linkedin_title'] = __('twitter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_send_email'] = __('Send Email', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_login_here'] = __('Login Here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_enter_email_address'] = __('Enter E-Mail address...', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_signup_now'] = __('Sign up Now', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_password_recovery'] = __('Password Recovery', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_oops_something_went_wrong_updating_your_account'] = __('Oops something went wrong updating your account', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_check_your_email_address_for_new_password'] = __('Check your email for your new password.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_ur_request_has_been_completed_succssfully'] = __('Your request has been completed succssfully, Now you can use following information for login.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_your_new_password'] = __('Your new password', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_your_username_is'] = __('Your username is:', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_your_new_password_is'] = __('Your new password is:', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_from'] = __('From:', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_there_is_no_user_registered'] = __('There is no user registered with that email address.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_invalid_email_address'] = __('Invalid e-mail address.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_username_should_not_be_empty'] = __('User name should not be empty.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_password_should_not_be_empty.'] = __('Password should not be empty.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_email_should_not_be_empty'] = __('Email should not be empty.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_wrong_username_or_password'] = __('Wrong username or password.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_login_successfully'] = __('Login Successfully...', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_valid_username'] = __('Please enter a valid username. You can only enter alphanumeric value and only ( _ ) longer than or equals 5 chars', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_valid_email'] = __('Please enter a valid email.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_user_already_exists'] = __('User already exists. Please try another one.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_user_registration_detail'] = __('User registration Detail', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_check_email'] = __('Please check your email for login details', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_successfully_registered_with_login'] = __('You have been successfully registered <a href="javascript:void(0);" data-toggle="modal" data-target="#cs-login" data-dismiss="modal" class="cs-color" aria-hidden="true">Login</a>.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_currently_issue'] = __('Currently there are and issue', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_successfully_registered'] = __('Your account has been registered successfully, Please contact to site admin for password.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_captcha_api_key'] = __('Please provide google captcha API keys', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_select_captcha_field'] = __('Please select captcha field.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_reload'] = __('Reload', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_already_linked'] = __('This profile is already linked with other account. Linking process failed!', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_error'] = __('ERROR', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_something_went_wrong'] = __('Something went wrong: %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_problem_connecting_to_twitter'] = __(' There is problem while connecting to twitter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_login_error'] = __('Login error', 'cs-framework');

			$foodbakery_var_frame_static_text['foodbakery_var_facebook'] = __('facebook', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_twitter'] = __('twitter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_google_plus_icon'] = __('google-plus', 'cs-framework');





			return $foodbakery_var_frame_static_text;
		}

		public function foodbakery_var_frame_all_string_all() {

			global $foodbakery_var_frame_static_text;

			/* framework */


			$foodbakery_var_frame_static_text['foodbakery_var_add_page_section'] = __('Add Page Sections', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_blog_search'] = __( 'Blog Search', 'foodbakery' );
			$foodbakery_var_frame_static_text['foodbakery_var_Oops_404'] = __('Oops! That page can�t be found. ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_nothing_found_404'] = __('It looks like nothing was found at this location. Maybe try a search?. ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_api_set_msg'] = __('Please set API key', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_subscribe_success'] = __('subscribe successfully', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_noresult_found'] = __('No result found.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_comments'] = __('Comments', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_by'] = __('By', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_article_ads'] = __('Article Bottom Banner', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_next'] = __('Next', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_prev'] = __('PREVIOUS', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tag'] = __('Tags', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_ago'] = __('Ago', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_related_posts'] = __('Related Posts', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_image_edit'] = __('Edit "%s"', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_primary_menu'] = __('Primary Menu', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_social_links_menu'] = __('Social Links Menu', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_widget_display_text'] = __('This widget will be displayed on right/left side of the page.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_widget_display_right_text'] = __('This widget will be displayed on right side of the page.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_footer'] = __('Footer ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_widgets'] = __('Widgets ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_search_result'] = __('Search Results : %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_author'] = __('Author', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_archives'] = __('Archives', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_packages'] = __('Inventory Packages', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tweets'] = __('Tweets', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_tweets_found'] = __('NO tweets found.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tweets_time_on'] = __('On', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_daily_archives'] = __('Daily Archives: %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_monthly_archives'] = __('Monthly Archives: %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_yearly_archives'] = __('Yearly Archives: %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tags'] = __('Tags', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_error_404'] = __('Error 404', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_home'] = __('Home', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_current_page'] = __('Current Page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_theme_options'] = __('CS Theme Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_previous_page'] = __('Previous page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_next_page'] = __('Next page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_previous_image'] = __('Previous Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_next_image'] = __('Next Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_pages'] = __('Pages:', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_page'] = __('Page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_comments_closed'] = __('Comments are closed.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_reply'] = __('Reply', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_full_width'] = __('Full width', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_right'] = __('Sidebar Right', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_left'] = __('Sidebar Left', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_small_left'] = __('Small Left Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_small_right'] = __('Small Right Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_small_left_large_right'] = __('Small Left and Large Right Sidebars', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_large_left_small_right'] = __('Large Left and Small Right Sidebars', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_both_left'] = __('Both Left Sidebars', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_both_right'] = __('Both Right Sidebars', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_delete_image'] = __('Delete image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_edit_item'] = __('Edit Item', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_description'] = __('Description', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_update'] = __('Update', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_delete'] = __('Delete', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_select_attribute'] = __('Select Attribute', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_ads'] = __('CS : Ads', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_select_image_ads'] = __('Select Image from Ads.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flickr_gallery'] = __('CS : Flickr Gallery', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flickr_description'] = __('Type a user name to show photos in widget', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flickr_username'] = __('Flickr username', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flickr_username_hint'] = __('Enter your Flicker Username here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flickr_photos'] = __('Number of Photos', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_error'] = __('Error:', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flickr_api_key'] = __('Please Enter Flickr API key from Theme Options.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_mailchimp'] = __('CS: Mail Chimp', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_mailchimp_desciption'] = __('Mail Chimp Newsletter Widget', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_description_hint'] = __('Enter discription here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_social_icon'] = __('Social Icon On/Off.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_recent_post'] = __('CS : Recent Posts', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_recent_post_des'] = __('Recent Posts from category.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_category'] = __('Choose Category.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_num_post'] = __('Number of Posts To Display.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_availability'] = __('Availability', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_in_stock'] = __('in stock', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_out_stock'] = __('out of stock', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_wait'] = __('Please wait...', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_load_icon'] = __('Successfully loaded icons', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_try_again'] = __('Error: Try Again?', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_load_json'] = __('Load from IcoMoon selection.json', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_are_sure'] = __('Are you sure! You want to delete this', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_hint'] = __('Please enter text for icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_path'] = __('Icon Path', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon'] = __('Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_comment_awaiting'] = __('Your comment is awaiting moderation.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_edit'] = __('Edit', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_you_may'] = __('You may use these HTML tags and attributes: %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_message'] = __('Message', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_view_posts'] = __('View all posts by %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_nothing'] = __('Nothing Found', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_ready_publish'] = __('Ready to publish your first post? Get started here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_nothing_match'] = __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_perhaps'] = __('It seems we can�t find what you�re looking for. Perhaps searching can help.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_you_must'] = __('You must be to post a comment.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_log_out'] = __('Log out', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_log_in'] = __('Logged in as', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_require_fields'] = __('Required fields are marked %s', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_name'] = __('Name *', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_full_name'] = __('full name', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_email'] = __('Email', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_enter_email'] = __('Type your email address', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_website'] = __('Website', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_text_here'] = __('Text here...', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_leave_comment'] = __('Leave us a comment', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_cancel_reply'] = __('Cancel reply', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_comment'] = __('Post comments', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_interested'] = __('I am interested in a price quote on this vehicle. Please contact me at your earliest convenience with your best price for this vehicle.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_dealer'] = __('Dealers Listing', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_page_option'] = __('Page Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_general_setting'] = __('General Settings', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_subheader'] = __('Subheader', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_subheader'] = __('Choose Sub-Header', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_default_subheader'] = __('Default Subheader', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_custom_subheader'] = __('Custom Subheader', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_rev_slider'] = __('Revolution Slider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_map'] = __('Map', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_subheader'] = __('No Subheader', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_style'] = __('Style', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_classic'] = __('Classic', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_with_image'] = __('With Background Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_padding_top'] = __('Padding Top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_padding_top_hint'] = __('Set padding top here.(In px)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_padding_bot'] = __('Padding Bottom', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_padding_bot_hint'] = __('Set padding bottom. (In px)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_margin_top'] = __('Margin Top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_margin_top_hint'] = __('Set Margin top here.(In px) ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_margin_bot'] = __('Margin Bottom', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_margin_bot_hint'] = __('Set Margin bottom. (In px)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_select_layout'] = __('Select Layout', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_page_title'] = __('Page Title', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_page_margin'] = __('Page Margin', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_text_color'] = __('Text Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_text_color_hint'] = __('Provide a hex color code here (with #) for title.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_breadcrumbs'] = __('Breadcrumbs', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sub_heading'] = __('Sub Heading', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sub_heading_hint'] = __('Enter subheading text here.it will display after title.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_bg_image'] = __('Background Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_bg_image_hint'] = __('Choose subheader background image from media gallery or leave it empty for display default image set by theme options.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_parallax'] = __('Parallax', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_parallax_hint'] = __('Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling can be enable with this switch.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_bg_color'] = __('Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_bg_color_hint'] = __('Provide a hex color code here (with #) if you want to override the default, leave it empty for using background image.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_slider'] = __('Select Slider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_map_sc'] = __('Custom Map Short Code', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_header_border'] = __('Header Border Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_header_hint'] = __('Provide a hex color code here (with #) for header border color.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_header_style'] = __('Choose Header Style', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_modern_header'] = __('Modern Header Style', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_default_header'] = __('Default header style', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_side_bar'] = __('Select Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_sidebar'] = __('Choose Sidebar', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_page_bg_color'] = __('Page Background Color', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_page_bg_color_hint'] = __('Please Select Page Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sidebar_hint'] = __('Choose sidebar layout for this post.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_left_sidebar'] = __('Select Left Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_right_sidebar'] = __('Select Right Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_second_right_sidebar'] = __('Select Second Right Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_second_left_sidebar'] = __('Select Second Left Sidebar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_options'] = __('Post Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_social_sharing'] = __('Social Sharing', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_about_author'] = __('About Author', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_product_options'] = __('Product Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_add_element'] = __('Add Element', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_search'] = __('Search', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_show_all'] = __('Show all', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_filter_by'] = __('Filter by', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_insert_sc'] = __('CS: Insert shortcode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_quote'] = __('Blockquote', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_dropcap'] = __('Dropcap', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_edit_options'] = __('%s Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_title'] = __('Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_title_color'] = __('Title Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_title_hint'] = __('This Title will view on top of this section.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_subtitle'] = __('Sub Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_subtitle_hint'] = __('This Sub Title will view below the Title of this section.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_subtitle_color'] = __('Sub Title Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_bg_view'] = __('Background View', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_bg'] = __('Choose Background View.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_none'] = __('None', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_title_sub_title_align'] = __('Alignment', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sub_header_align'] = __('Text Align', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_title_sub_title_align_hint'] = __('Set title/sub title alignment from this dropdown.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_align_left'] = __('Left', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_align_center'] = __('Center', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_align_right'] = __('Right', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_custom_slider'] = __('Custom Slider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_gallery_slider'] = __('Gallery Slider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_video'] = __('Video', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_youtube_vimeo_video_url'] = __('Youtube / Vimeo Video URL', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_bg_position'] = __('Background Image Position', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_bg_position'] = __('Choose Background Image Position', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_center_top'] = __('no-repeat center top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_center_top'] = __('repeat center top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_center'] = __('no-repeat center', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_center_cover'] = __('no-repeat center / cover', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_repeat_center'] = __('repeat center', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_left_top'] = __('no-repeat left top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_repeat_left_top'] = __('repeat left top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_fixed'] = __('no-repeat fixed center', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_fixed_cover'] = __('no-repeat fixed center / cover', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_custom_slider_hint'] = __('Enter Custom Slider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_video_url'] = __('Video Url', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_browse'] = __('Browse', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_mute'] = __('Enable Mute', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_mute'] = __('Choose Mute selection', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_yes'] = __('Yes', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no'] = __('No', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_video_auto'] = __('Video Auto Play', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_video_auto'] = __('Choose Video Auto Play selection', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_enable_parallax'] = __('Enable Parallax', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_section_nopadding'] = __('No Padding', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_section_nomargin'] = __('No Margin', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_select_view'] = __('Select View', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_box'] = __('Box', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_wide'] = __('Wide', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_bg_coor'] = __('Choose background color.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_border_top'] = __('Border Top', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_border_top_hint'] = __('Set the Border top (In px)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_border_bot'] = __('Border Bottom', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_border_bot_hint'] = __('Set the Border Bottom (In px)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_border_color'] = __('Border Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_choose_border_color'] = __('Choose Border color.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_cus_id'] = __('Custom Id', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_cus_id_hint'] = __('Enter Custom Id.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_select_layout'] = __('Select Layout', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_edit_page'] = __('Edit Page Section', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_ads_only'] = __('Ads', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_inventories'] = __('Inventory Listing', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_inventories_search'] = __('Inventory Search', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_compare_inventories'] = __('Inventory Compare', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_gallery'] = __('Gallery', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icons_box'] = __('Icons Box', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_plan'] = __('Pricing Tables', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_wc_feature'] = __('WC Feature Product', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_column'] = __('Columns', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_contact_form'] = __('Contact Form', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_schedule_form'] = __('Schedule Form', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_best_time'] = __('Best time', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_testimonial'] = __('Testimonial', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion'] = __('Accordion', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multi_services'] = __('Multi Services', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_partner'] = __('Partner', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_blog'] = __('Blog - Views', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_heading'] = __('Headings', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_counter'] = __('Counter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_image_frame'] = __('Image Frame', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_flex_editor'] = __('flex editor', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_editor'] = __('Editor', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_call_action'] = __('Call To Action', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance'] = __('maintenance', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list'] = __('List', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_contact_info'] = __('Contact Info', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_divider'] = __('Divider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_promobox'] = __('Promobox', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_auto_heading'] = __('Foodbakery Heading', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_button'] = __('Buttons', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_sitemap'] = __('Site Map', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_listing_price'] = __('Listing Price', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_spacer'] = __('Spacer', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_typography'] = __('Typography', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_common_elements'] = __('Common Elements', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_media_element'] = __('Media Element', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_blocks'] = __('Content Blocks', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_loops'] = __('Loops', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_wpam'] = __('WPAM', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_size'] = __('Size', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_column_hint'] = __('Select column width. This width will be calculated depend page width.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_one_half'] = __('One half', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_one_third'] = __('One third', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_two_third'] = __('Two third', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_one_fourth'] = __('One fourth', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_three_fourth'] = __('Three fourth', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_plz_select'] = __('Please select..', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_text'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_testimonial_text'] = __('Text', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_text_hint'] = __('Enter testimonial content here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_author_hint'] = __('Enter testimonial author name here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_position'] = __('Position', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_position_hint'] = __('Enter position of author here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_image'] = __('Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_image_hint'] = __('Set author image from media gallery.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_active'] = __('Active', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_active_hint'] = __('You can set the accordian section that is open by default on frontend by select dropdown', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_active_hint'] = __('You can set the faq section that is open by default on frontend by select dropdown', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_remove'] = __('Remove', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list_Item'] = __('List Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list_Item_hint'] = __('Enter list title here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_tooltip'] = __('Choose icon for list.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list_sc_icon_color'] = __('Icon Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list_sc_icon_color_hint'] = __('Select icon color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list_sc_icon_bg_color'] = __('Icon Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_list_sc_icon_bg_color_hint'] = __('Select icon background color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_listing_title_hint'] = __('Enter listing_price text here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price'] = __('Price', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_hint'] = __('Enter listing_price author name here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_color'] = __('Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_color_hint'] = __('Set text color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_counter_hint'] = __('Enter counter text here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_counter_author_hint'] = __('Enter counter author name here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_counter_text_hint'] = __('Enter position of author here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_divider_hint'] = __('Divider setting on/off', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_image_url'] = __('Image Url', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_image_url_hint'] = __('Enter image url', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_service'] = __('Multiple Service', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_title'] = __('Content Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_title_hint'] = __('Add service title here..', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_link_url'] = __('Link Url', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_link_hint'] = __('e.g. http://yourdomain.com/.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_title_color'] = __('Content title Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_title_color_hint'] = __('Set title color from here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_bg_color'] = __('Icon Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_bg_color_hint'] = __('Set the Service Background', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_color'] = __('Icon Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_color_hint'] = __('Set the position of service image here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_service_text_hint'] = __('Enter little description about service.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_color'] = __('Content Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_content_color_hint'] = __('Provide a hex colour code here (with #) for text color. if you want to override the default.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_page_builder'] = __('CS Page Builder', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_enter_valid'] = __('Enter Your Email Address...', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_subscribe_success'] = __('subscribe successfully', 'foodbakery');
			$foodbakery_var_frame_static_text['foodbakery_var_api_set_msg'] = __('Please set API key', 'foodbakery');
			$foodbakery_var_frame_static_text['foodbakery_var_inventory_type'] = __('Inventory Makes', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_style'] = __('Style', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_view'] = __('View', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_view_hint'] = __('Select post view from this dropdown. Default view is selected from theme option.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_ad_unit'] = __('Ad Unit', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_select_ad'] = __('Select Ad', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_cover_image'] = __('Cover Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_format'] = __('Format', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_view_thumbnail'] = __(' Thumbnail ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_view_slider'] = __(' Slider ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_format_thumbnail'] = __(' Thumbnail ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_format_slider'] = __(' Slider ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_format_sound'] = __('Sound', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_format_video'] = __('Video', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_inside_thumbnail'] = __('Inside Post Thumbnail', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_soundcloud_url'] = __('SoundCloud URL', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_view_select_format'] = __('Select Format', 'cs-framework');

			/*
			  multi counter
			 */

			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_title'] = __('Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_title_hint'] = __('Enter Title Here', 'cs-framework');

			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter'] = __('Counter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_icon'] = __('Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_icon_tooltip'] = __('Please Select Icon ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_count'] = __('Count', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_count_tooltip'] = __('Enter Counter Range', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_content'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_content_tooltip'] = __('Enter Content Here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_content_color'] = __('Content Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_multiple_counter_content_color_tooltip'] = __('Select Content Color ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_thumbnail_view_demo'] = __('Thumbnail View demo', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_thumbnail_view_demo_hint'] = __('Choose thumbnial view type for this post. None for no image. Single image for display featured image on listings and slider for display slides on thumbnail view.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_single_image'] = __('Single Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_slider'] = __('Slider', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_audio'] = __('Audio', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_thumbnail_audio_url'] = __('Thumbnail Audio URL', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_thumbnail_audio_url_hint'] = __('Enter Audio URL for this Post', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_thumbnail_video_url'] = __('Thumbnail Video URL', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_thumbnail_video_url_hint'] = __('Enter Specific Video Url (Youtube, Vimeo and Dailymotion)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_add_gallery_images'] = __('Add Gallery Images', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_detail_views'] = __('Detail Views', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_simple'] = __('Simple', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_fancy'] = __('Fancy', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_inside_post_view'] = __('Inside Post Thumbnail View', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_inside_post_view_hint'] = __('Choose inside thumbnial view type for this post. None for no image. Single image for display featured image on detail. Slider for display slides on detail. Audio for make this audio post and video for display video inside post.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_audio_url'] = __('Audio Url', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_audio_url_hint'] = __('Enter Mp3 audio url for this post .', 'cs-framework');

			/*			 * accordion Code */
			$foodbakery_var_frame_static_text['foodbakery_var_accordian'] = __('Accordion', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq'] = __('Faq', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_title'] = __('Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_title_hint'] = __('Enter accordion title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_title'] = __('Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_title_hint'] = __('Enter faq title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_text'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_text_hint'] = __('Enter accordian content here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_text'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_text_hint'] = __('Enter faq content here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_icon'] = __('Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_icon_hint'] = __('Select Icon for accordion', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_icon'] = __('Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_icon_hint'] = __('Select Icon for faq', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_title_hint'] = __('Enter accordion title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_view'] = __('View', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_view_hint'] = __('Select View for Accordion', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_view'] = __('View', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_faq_view_hint'] = __('Select View for Accordion', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_view_simple'] = __('Simple', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_accordion_view_modern'] = __('Modern', 'cs-framework');

			/*			 * Site map Short Code */
			$foodbakery_var_frame_static_text['foodbakery_var_edit_sitemap'] = __('Edit SiteMap Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_section_title'] = __('Section Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_settings'] = __('Post Settings', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_post_gallery'] = __('Post Gallery', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_edit_maintain_page'] = __('Edit Maintain Page Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_insert'] = __('Insert', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_logo'] = __('Logo', 'cs-framework');

			$foodbakery_var_frame_static_text['foodbakery_var_no_margin_hint'] = __('Select Yes to remove margin for this section', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_please_select_maintinance'] = __('Please Select a Maintinance Page', 'cs-framework');
			/*			 * Client Short Code */
			$foodbakery_var_frame_static_text['foodbakery_var_clients'] = __('Clients', 'cs-framework');
                        
                        /*			 * Maintenance Short Code */
			
			$foodbakery_var_frame_static_text['foodbakery_var_edit_maintenance_page'] = __('Maintenance Options', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance'] = __('Maintenance', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_title'] = __('Element Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_title_hint'] = __('Enter Maintenance Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_sub_title'] = __('Element Sub Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_sub_title_hint'] = __('Enter Maintenance Subtitle', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_text'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_text_hint'] = __('Enter Maintenance Text', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_views'] = __('Views ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_views_hint'] = __('Select a view for underconstruction page.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_view1'] = __('View 1 ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_view2'] = __('View 2 ', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_image_hint'] = __('Select Image for Maintaince background.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_logo_hint'] = __('Select Image for Maintaince Logo.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_launch_date'] = __('Launch Date', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_launch_date_hint'] = __('Enter launch Date', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_sc_save'] = __('Save', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_save_settings'] = __('Save Settings', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_select_page'] = __('Select A page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_newsletter'] = __('Newsletter ', 'cs-framework');
			/*
			  team
			 */

			$foodbakery_var_frame_static_text['foodbakery_var_team'] = __('Team', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_add_item'] = __('Add Team', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_name'] = __('Name', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_name_hint'] = __('Enter team member name here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_designation'] = __('Designation', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_designation_hint'] = __('Enter team member designation here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_image'] = __('Team Profile Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_image_hint'] = __('Select team member image from media gallery.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_phone'] = __('Phone No', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_phone_hint'] = __('Enter phone number here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_fb'] = __('Facebook', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_fb_hint'] = __('Enter facebook account link here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_twitter'] = __('Twitter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_twitter_hint'] = __('Enter twitter account link here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_google'] = __('Google Plus', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_google_hint'] = __('Enter google+ accoount link here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_linkedin'] = __('Linkedin', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_linkedin_hint'] = __('Enter linkedin account link here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_youtube'] = __('Youtube', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_youtube_hint'] = __('Enter youtube link here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_title'] = __('Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_title_hint'] = __('Enter Team Title Here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_sub_title'] = __('Sub Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc_sub_title_hint'] = __('Enter Team Sub Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_team_sc'] = __('Team', 'cs-framework');
			/*			 * Maintenance Short Code */
			
			/* Maintenance Mode */

			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_save_btn'] = __('Save Settings', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_news_letter'] = __('NEWSLETER', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_logo'] = __('Logo', 'cs-framework');
                        $foodbakery_var_frame_static_text['foodbakery_var_image'] = __('Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_name'] = __('Maintenance Mode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode'] = __('Maintenance Mode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode_hint'] = __('Turn Maintenance Mode On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_logo'] = __('Maintenance Mode Logo', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_logo_hint'] = __('Turn Logo On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_social'] = __('Social Contact', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_social_hint'] = __('Turn Social Contact On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_newsletter'] = __('Newsletter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_newsletter_hint'] = __('Turn newsletter On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_header'] = __('Header Switch', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_header_hint'] = __('Turn Header On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_footer'] = __('Footer Switch', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_footer_hint'] = __('Turn Footer On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_select_page'] = __('Please Select a Page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode_page'] = __('Maintenance Mode Page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode_page_hint'] = __('Choose a page that you want to set for maintenance mode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_save_message'] = __('All Settings Saved', 'cs-framework');
			/*
			  tabs */

			$foodbakery_var_frame_static_text['foodbakery_var_tabs'] = __('Tabs', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab'] = __('Tab', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tabs_desc'] = __('You can manage your tabs using this shortcode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_active'] = __('Active', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_active_hint'] = __('You can set the tab section that is open by default on frontend by select dropdown', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_item_text'] = __('Tab Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_item_text_hint'] = __('Enter tab title here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_desc'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_desc_hint'] = __('Enter tab content here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_icon'] = __('Tab Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_tab_icon_hint'] = __('Select the Icons you would like to show with your tab .', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_saving_changes'] = __('Saving changes...', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_title'] = __('No Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_no_padding_hint'] = __('Select Yes to remove padding for this section', 'cs-framework');




			/* Maintenance Mode */

			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_save_btn'] = __('Save Settings', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_name'] = __('Maintenance Mode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode'] = __('Maintenance Mode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode_hint'] = __('Turn Maintenance Mode On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_logo'] = __('Maintenance Mode Logo', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_logo_hint'] = __('Turn Logo On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_social'] = __('Social Contact', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_social_hint'] = __('Turn Social Contact On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_newsletter'] = __('Newsletter', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_newsletter_hint'] = __('Turn newsletter On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_header'] = __('Header Switch', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_header_hint'] = __('Turn Header On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_footer'] = __('Footer Switch', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_footer_hint'] = __('Turn Footer On/Off here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_select_page'] = __('Please Select a Page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode_page'] = __('Maintenance Mode Page', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_field_mode_page_hint'] = __('Choose a page that you want to set for maintenance mode', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_maintenance_save_message'] = __('All Settings Saved', 'cs-framework');
			/*
			  icos box
			 */
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxs_title'] = __('Icon Box', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxs_views'] = __('Views', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxs_views_hint'] = __('Select the Icon Box style', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_view_option_1'] = __('Simple', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_view_option_2'] = __('Top Center', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_content_title'] = __('Icon Box Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_content_title_hint'] = __('Add Icon Box title here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_link_url'] = __('Title Link', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_link_url_hint'] = __('e.g. http://yourdomain.com/.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_content_title_color'] = __('Content title Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_content_title_color_hint'] = __('Set title color from here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_Icon'] = __('Icon Box Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_Icon_hint'] = __('Select the icons you would like to show with your accordion title.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size'] = __('Icon Font Size', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_hint'] = __('Set the Icon Font Size', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_1'] = __('Extra Small', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_2'] = __('Small', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_3'] = __('Medium', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_4'] = __('Medium Large', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_5'] = __('Large', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_6'] = __('Extra Large', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_font_size_option_7'] = __('Free Size', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_Icon_bg'] = __('Icon Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_Icon_bg_hint'] = __('Set the Icon Box Background.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_Icon_color'] = __('Icon Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_Icon_color_hint'] = __('Set Icon Box icon color from here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_text'] = __('Icon Box Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_boxes_text_hint'] = __('Enter icon box content here.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_type'] = __('Icon Type', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_type_hint'] = __('Select icon type image or font icon.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_type_1'] = __('Icon', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_icon_type_2'] = __('Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_image'] = __('Image', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_icon_box_image_hint'] = __('Attach image from media gallery.', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_register_heading'] = __('User Registration', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_register'] = __('User Registration', 'cs-framework');




			/* Price Table */
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_title'] = __('Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_title_hint'] = __('Enter Price table Title Here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_title_color'] = __('Title Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_title_color_hint'] = __('Set price-table title color from here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_price_color'] = __('Price Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_price_color_hint'] = __('Set Price color from here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_price'] = __('Price', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_price_hint'] = __('Add price without symbol', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_currency'] = __('Currency Symbols', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_currency_hint'] = __('Add your currency symbol here like $', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_time'] = __('Time Duration', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_time_hint'] = __('Add time duration for package or time range like this package for a month or year So wirte here for Mothly and year for Yearly Package', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_link'] = __('Button Link', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_link_hint'] = __('Add price table button Link here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_text'] = __('Button Text', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_text_hint'] = __('Add button text here Example : Buy Now, Purchase Now, View Packages etc', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_color'] = __('Button text Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_color_hint'] = __('Set button color with color picker', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_bg_color'] = __('Button Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_button_bg_color_hint'] = __('Set button background color with color picker', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_featured'] = __('Featured on/off', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_featured_hint'] = __('Price table featured option enable/disable with this dropdown', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_description'] = __('Content', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_description_hint'] = __('Features can be add easily in input with this shortcode 
					    					[feature_item]Text here[/feature_item][feature_item]Text here[/feature_item]', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_column_color'] = __('Column Background Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_price_table_column_color_hint'] = __('Set Column Background color', 'cs-framework');

			/* Progressbar Shortcode */
			$foodbakery_var_frame_static_text['foodbakery_var_progressbars'] = __('Progress Bars', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar'] = __('Progress Bar', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_title'] = __('Progress Bar Title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_title_hint'] = __('Enter progress bar title', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_skill'] = __('Skill (in percentage)', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_skill_hint'] = __('Enter skill (in percentage) here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_color'] = __('Progress Bar Color', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_color_hint'] = __('Set progress bar color here', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_progressbar_add_button'] = __('Add Progress Bar', 'cs-framework');

			/* Table Shortcode */
			$foodbakery_var_frame_static_text['foodbakery_var_table'] = __('Table', 'cs-framework');
			
			/* Page Editor Tabs */
			$foodbakery_var_frame_static_text['foodbakery_var_classic_editor'] = __('Classic Editor', 'cs-framework');
			$foodbakery_var_frame_static_text['foodbakery_var_page_builder'] = __('Page Builder', 'cs-framework');
                        
                        
			$foodbakery_var_frame_static_text['foodbakery_var_gallery_images'] = __('Gallery Images', 'cs-framework');

			return $foodbakery_var_frame_static_text;
		}

	}

}
new foodbakery_var_frame_all_strings;
/*
  $foodbakery_strings = array(
  'foodbakery_var_tabs' => __('Tabs', 'cs-framework'),
  'foodbakery_var_tabs_desc' => __('You can manage your tabs using this shortcode', 'cs-framework'),
  'foodbakery_var_tab_active' => __('Tab Active', 'cs-framework'),
  'foodbakery_var_tab_active_hint' => __('Select Tab ON/OFF option here', 'cs-framework'),
  'foodbakery_var_tab_item_text' => __('Tab Item Text', 'cs-framework'),
  'foodbakery_var_tab_item_text_hint' => __('Enter tab Item text here', 'cs-framework'),
  'foodbakery_var_tab_desc' => __('Tab Description', 'cs-framework'),
  'foodbakery_var_tab_desc_hint' => __('Enter the tab description here.', 'cs-framework'),
  'foodbakery_var_tab_icon' => __('Tab Icon', 'cs-framework'),
  'foodbakery_var_tab_icon_hint' => __('Select the Icons you would like to show with your tab .', 'cs-framework'),
  );
  foreach ($foodbakery_strings as $key => $value) {
  echo '$foodbakery_var_frame_static_text[\'' . $key . '\'] = __(\'' . $value . '\' , 'cs-framework'); ';
  echo '<br />';
  }
 */

//foodbakery_var_frame_all_strings();
?>