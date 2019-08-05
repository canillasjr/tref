<?php
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
define( 'DB_NAME', 'ct-social' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8n/E@$pAv9L:yD]3.H@~e576t^H_PA;Wu5x!:h.3x[3Shq}g*M0uz33#i>9UkEX{' );
define( 'SECURE_AUTH_KEY',  '3#(Q/@fYP3$dY4A)W)l>ri~1bv h?Zs:m:*b(ncJ.IsGnTo.sf?ny].r=g&?R; o' );
define( 'LOGGED_IN_KEY',    '&/c,WobZb4KW/$<zxwl>O&BJ<Ci?7VoDj_P0R.}NiC7 Ae_or/_gEa-pk]!(vbAF' );
define( 'NONCE_KEY',        'oXFA%tn^{lPzot7Y2P^ekrzx^H<5/o9OYX%[81A.c/-SulrQ`KA|y|@@63FvbUK{' );
define( 'AUTH_SALT',        '-NvWW@aU$sAh+8,+vLm6s9%X)d`[)VmJ7M9+7iWp>DI)yu:#*{,=|`UJ}Ew.6ppY' );
define( 'SECURE_AUTH_SALT', 'UcYOUt-<35Bv;[[+(E~CL.},hkYJa_uO{9[h8TGG1B^^h*h~b:p+ d!d94s.rUTw' );
define( 'LOGGED_IN_SALT',   'RP#A&)b%1!AoD6||+sK>dt-Ysd2Ot(gre!quA-`=B%kI2<y_l%=k*^fBG@8T&q<,' );
define( 'NONCE_SALT',       'Y%3l=g#S@`J(TwD<3~w^j$?oN=)5b[Etnj5T+Au]UvJA(SL.)^M$=<jfcK9JI@A5' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
