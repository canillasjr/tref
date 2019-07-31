<?php define('WPCF7_LOAD_JS', false);
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'telderer_live');

/** MySQL database username */
define('DB_USER', 'telderer_user');

/** MySQL database password */
define('DB_PASSWORD', 'yU%T4Q}aZ9HU');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define( 'WP_MEMORY_LIMIT', '256M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '12qrtyupiuyqw56s35613541231');
define('SECURE_AUTH_KEY',  'wertyuiodfghjkRETHJK#$%^&*(IO)667');
define('LOGGED_IN_KEY',    '!@#$56ERTYUI&*(KJIO%^&*');
define('NONCE_KEY',        'rty%^&*()&%5646543TYUIO56456');
define('AUTH_SALT',        '@#$rtyuERTYUIOP556&*()_');
define('SECURE_AUTH_SALT', '$%^&*()_7856785678ERTYUIoo888%^&*');
define('LOGGED_IN_SALT',   '!@#$%^&*(^76675009#$%^&*');
define('NONCE_SALT',       '!@#$%^gfgjhRYFUTY^&*90986754#$%^&*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
