<?php
// phpinfo();
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_wolvesofwallstreet' );

/** MySQL database username */
define( 'DB_USER', 'usr_wolvesofwallstreet' );

/** MySQL database password */
define( 'DB_PASSWORD', 'MXgF8reEhtx5kGJ' );

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
define('AUTH_KEY',         '/@ilZE~>AMPRRh~Aqn=:4Yf(<R:vQ^-FIi?xEz;E`c_,!T_/dxv|qtW|/>$$UQ}%');
define('SECURE_AUTH_KEY',  'rm8hy(s.C,o(1DT945:-ly~u&l@T^ w)v$BzVtVtsz>N`G]y`~bl=p.~cUSP[k|^');
define('LOGGED_IN_KEY',    '$%<W+{!v(Og*hPq7_xfSxW|%7a+bXW${WAMs:`bZkImG2/6!_tIO[XJ_9gOlH`7o');
define('NONCE_KEY',        '`ivPI[)ba!}EGUnzy&&83M%=CD95TO?;ySi,_DadT<%,lE@=zSj =0^#X@A>]peA');
define('AUTH_SALT',        '[;[SU:MmbLa|0Wfs&#nx$UGKCz1ZM`jK@|#A1f[U138`&U$wPQRS8YU&6)ZSi8-}');
define('SECURE_AUTH_SALT', 'rjy[b7_+x[x9krQ,=!y_ hm%&gNg=JV??aD`mZ8Mwq&!I|NqIk3i{Nn1wV6eM[{+');
define('LOGGED_IN_SALT',   'e5;z.+X^FD)Jn5Z<:IWJ0++T*NA1wH9>$ 94:ZVAoq;bc$,.W[B|4H.h;e^%b-0m');
define('NONCE_SALT',       'FT||zHDXT][]CH;X2Nc/!G9]}n`EPy~(Wq@+ORYps&-AP#k;`-MYzzp}M^KH+~l<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wws_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
