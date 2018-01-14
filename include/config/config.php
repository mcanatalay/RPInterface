<?php

return array(
	/**
	 * Configuration for: Base URL
	 * This detects your URL/IP incl. sub-folder automatically. You can also deactivate auto-detection and provide the
	 * URL manually. This should then look like 'http://192.168.33.44/' ! Note the slash in the end.
         * BASE_URL is only for Auth class.
	 */
	'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
        'BASE_URL' => str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
	/**
	 * Configuration for: Folders
	 * Usually there's no reason to change this.
	 */
	'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
	'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/view/',
	/**
	 * Configuration for: Avatar paths
	 * Internal path to save avatars. Make sure this folder is writable. The slash at the end is VERY important!
	 */
	'PATH_AVATARS' => realpath(dirname(__FILE__).'/../../') . '/public/avatars/',
	'PATH_AVATARS_PUBLIC' => 'avatars/',
	/**
	 * Configuration for: Default controller and action
	 */
	'DEFAULT_CONTROLLER' => 'index',
	'DEFAULT_ACTION' => 'index',
	/**
	 * Configuration for: Database
	 * DB_TYPE The used database type. Note that other types than "mysql" might break the db construction currently.
	 * DB_HOST The mysql hostname, usually localhost or 127.0.0.1
	 * DB_NAME The database name
	 * DB_USER The username
	 * DB_PASS The password
	 * DB_PORT The mysql port, 3306 by default (?), find out via phpinfo() and look for mysqli.default_port.
	 * DB_CHARSET The charset, necessary for security reasons. Check Database.php class for more info.
	 */
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'rpinterf_main',
	'DB_USER' => 'rpinterf_public',
	'DB_PASS' => '',
	'DB_PORT' => '3306',
	'DB_CHARSET' => 'utf8',
        /**
         * Configuration for: Language
         */
        'PATH_LANGUAGE' => realpath(dirname(__FILE__).'/../../') . '/include/translations/',
        'DEFAULT_LANGUAGE' => 'en',
	/**
	 * Configuration for: Captcha size
	 * The currently used Captcha generator (https://github.com/Gregwar/Captcha) also runs without giving a size,
	 * so feel free to use ->build(); inside CaptchaModel.
	 */
	'CAPTCHA_WIDTH' => 359,
	'CAPTCHA_HEIGHT' => 100,
	/**
	 * Configuration for: Cookies
	 * 1209600 seconds = 2 weeks
	 * COOKIE_PATH is the path the cookie is valid on, usually "/" to make it valid on the whole domain.
	 * @see http://stackoverflow.com/q/9618217/1114320
	 * @see php.net/manual/en/function.setcookie.php
	 */
	'COOKIE_RUNTIME' => 1209600,
	'COOKIE_PATH' => '/',
	/**
	 * Configuration for: Avatars/Gravatar support
	 * Set to true if you want to use "Gravatar(s)", a service that automatically gets avatar pictures via using email
	 * addresses of users by requesting images from the gravatar.com API. Set to false to use own locally saved avatars.
	 * AVATAR_SIZE set the pixel size of avatars/gravatars (will be 44x44 by default). Avatars are always squares.
	 * AVATAR_DEFAULT_IMAGE is the default image in public/avatars/
	 */
	'AVATAR_SIZE' => 400,
	'AVATAR_JPEG_QUALITY' => 85,
	'AVATAR_DEFAULT_IMAGE' => 'default.jpg',
	/**
	 * Configuration for: Email server credentials
	 *
	 * Here you can define how you want to send emails.
	 * If you have successfully set up a mail server on your linux server and you know
	 * what you do, then you can skip this section. Otherwise please set EMAIL_USE_SMTP to true
	 * and fill in your SMTP provider account data.
	 *
         * EMAIL_VERIFICATION_ACTIVE: You can close mail verification
	 * EMAIL_USED_MAILER: Check Mail class for alternatives
	 * EMAIL_USE_SMTP: Use SMTP or not
	 * EMAIL_SMTP_AUTH: leave this true unless your SMTP service does not need authentication
	 */
        'EMAIL_VERIFICATION_ACTIVE' => false,
	'EMAIL_USED_MAILER' => 'phpmailer',
	'EMAIL_USE_SMTP' => true,
	'EMAIL_SMTP_HOST' => 'mail.rpinterface.com',
	'EMAIL_SMTP_AUTH' => true,
	'EMAIL_SMTP_USERNAME' => 'info@rpinterface.com',
	'EMAIL_SMTP_PASSWORD' => '',
	'EMAIL_SMTP_PORT' => 587,
	'EMAIL_SMTP_ENCRYPTION' => 'tls',
	/**
	 * Configuration for: Email content data
	 */
	'EMAIL_PASSWORD_RESET_URL' => 'login/verifypasswordreset',
	'EMAIL_PASSWORD_RESET_FROM_EMAIL' => 'info@rpinterface.com',
	'EMAIL_PASSWORD_RESET_FROM_NAME' => 'My Project',
	'EMAIL_PASSWORD_RESET_SUBJECT' => 'Password reset for PROJECT XY',
	'EMAIL_PASSWORD_RESET_CONTENT' => 'Please click on this link to reset your password: ',
    
	'EMAIL_VERIFICATION_URL' => 'login/verify',
	'EMAIL_VERIFICATION_FROM_EMAIL' => 'info@rpinterface.com',
	'EMAIL_VERIFICATION_FROM_NAME' => 'My Project',
	'EMAIL_VERIFICATION_SUBJECT' => 'Account activation for PROJECT XY',
	'EMAIL_VERIFICATION_CONTENT' => 'Please click on this link to activate your account: ',
        /**
         * Component Settings wheather they can be used or not
         */
         'USER_INFO_ACTIVE' => true,
        /**
         * User Permission Settings
         */
         'DEFAULT_GUEST_USER_ROLE' => 0,
         'DEFAULT_BANNED_USER_ROLE' => 1,
         'DEFAULT_NEW_USER_ROLE' => 2,
         /**
          * Default Images
          */
         'DEFAULT_GAME_IMG' => 'img/defaultGame.png',
         /**
          * Facebook Settings
          */
         'FACEBOOK_LOGIN_APP_ID' => '',
         'FACEBOOK_LOGIN_APP_SECRET' => '',
         'FACEBOOK_REGISTER_PATH' => 'login/connectToFacebook',
         'FACEBOOK_LOGIN_PATH' => 'login/loginWithFacebook',
         /**
          * WEBSITE SETTINGS
          */
         'NEWS_NUMBER' => '5',
);