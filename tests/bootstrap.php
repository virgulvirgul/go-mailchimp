<?php
// Load WordPress test environment
// https://github.com/nb/wordpress-tests
//

// get the path to wordpress-tests' bootstrap.php file from the environment
$bootstrap = getenv( 'WPT_BOOTSTRAP' );
if ( FALSE === $bootstrap )
{
	echo "\n!!! Please set the WPT_BOOTSTRAP env var to point to your\n!!! wordpress-tests/includes/bootstrap.php file.\n\n";
	return;
}

if ( file_exists( $bootstrap ) )
{
	$GLOBALS['wp_tests_options'] = array(
		'pro' => TRUE,
		'active_plugins' => array(
			'go-config/go-config.php',
			'go-syncuser/go-syncuser.php',
			'go-user-profile/go-user-profile.php',
		),
		'template' => 'vip/gigaom5',
		'stylesheet' => 'vip/gigaom5',
	);

	require_once $bootstrap;

	// make sure the go-config dir is set
	update_option( 'go-config-dir', '_accounts' );

	require_once __DIR__ . '/class-go-mailchimp-test-abstract.php';
}//END if
else
{
    exit( "Couldn't find bootstrap file: $bootstrap\n" );
}//END else