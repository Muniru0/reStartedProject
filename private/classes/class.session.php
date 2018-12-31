

<?php
require_once(PRIVATE_DIR."initialize.php");


// Useful php.ini file settings:
// session.cookie_lifetime = 0
// session.cookie_secure = 1
// session.cookie_httponly = 1
// session.use_only_cookies = 1
// session.entropy_file = "/dev/urandom"

// Must have already called:
// session_start();

 class Session extends DatabaseObject {


// Function to forcibly end the session
 public static function end_session() {
	// Use both for compatibility with all browsers
	// and all versions of PHP.
	session_unset();
    session_destroy();
}

// Does the request IP match the stored value?
 public static function request_ip_matches_session() {
	// return false if either value is not set
	if(!isset($_SESSION['ip']) || !isset($_SERVER['REMOTE_ADDR'])) {
		return false;
	}
	if($_SESSION['ip'] === $_SERVER['REMOTE_ADDR']) {
		return true;
	} else {
		return false;
	}
}

// Does the request user agent match the stored value?
 public static function request_user_agent_matches_session() {
	// return false if either value is not set
	if(!isset($_SESSION['user_agent']) || !isset($_SERVER['HTTP_USER_AGENT'])) {
		return false;
	}
	if($_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT']) {
		return true;
	} else {
		return false;
	}
}

// Has too much time passed since the last login?
 public static function last_login_is_recent() {
	$max_elapsed = 60 * 60 * 24; // 1 day
	// return false if value is not set
	if(!isset($_SESSION['last_login'])) {
		return false;
	}
	if(($_SESSION['last_login'] + $max_elapsed) >= time()) {
		return true;
	} else {
		return false;
	}
}

// Should the session be considered valid?
 public static function is_session_valid() {
	$check_ip = true;
	$check_user_agent = true;
	$check_last_login = true;

	if($check_ip && !self::request_ip_matches_session()) {
		return false;
	}
	if($check_user_agent && !self::request_user_agent_matches_session()) {
		return false;
	}
	if($check_last_login && !self::last_login_is_recent()) {
		return false;
	}
	return true;
}

// If session is not valid, end and redirect to login page.
 public static function confirm_session_is_valid() {
	if(!self::is_session_valid()) {
		self::end_session();
		// Note that header redirection requires output buffering 
		// to be turned on or requires nothing has been output 
		// (not even whitespace).
		header("Location: login.php");
		exit;
	}
}


// Is user logged in already?
 public static function is_logged_in() {
	return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']);
}

// If user is not logged in, end and redirect to login page.
 public static function confirm_user_logged_in() {
	if(!self::is_logged_in()) {
		self::end_session();
		// Note that header redirection requires output buffering 
		// to be turned on or requires nothing has been output 
		// (not even whitespace).
		header("Location: login.php");
		exit;
	}
}


// Actions to preform after every successful login
 public static function after_successful_login() {
	// Regenerate session ID to invalidate the old one.
	// Super important to prevent session hijacking/fixation.
	session_regenerate_id();
	
	$_SESSION['logged_in'] = true;

	// Save these values in the session, even when checks aren't enabled 
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$_SESSION['last_login'] = time();
	
	
}

// Actions to preform after every successful logout
 public static function after_successful_logout() {
	if (session_status() === PHP_SESSION_ACTIVE) {
		$_SESSION['logged_in'] = false;
	end_session();
	}


}

// Actions to preform before giving access to any 
// access-restricted page.
 public static function before_every_protected_page() {
	self::confirm_user_logged_in();
	self::confirm_session_is_valid();
}



 }
?>
