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
#define('DB_NAME', 'wordpress');
define('DB_NAME', 'sex3');

/** MySQL database username */
define('DB_USER', 'adminGw2CxXC');

/** MySQL database password */
define('DB_PASSWORD', 'TXS1snURah4x');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'k8GkT|?fG~ov@ic:g*,|wN~kSd1vl|i6/.h6[%iL(jtG5xQ$u%ZPKp@|X++Em{d&');
define('SECURE_AUTH_KEY',  'iN:;K+#iIMT]XJ>kXo:J|V31Twq_fwt#A*&xF-n($7[/y-Mq|Z_mNs2W+u$Q3Kxz');
define('LOGGED_IN_KEY',    '].QB?-&YYdO2MJm}Twa{+}^6.k?+H$#+3SURayIb,z!nnP:>4B5s]iJGRwsV6lYJ');
define('NONCE_KEY',        '3]CZQYDTf=bXqKMwWtM0{kd9-4Vt-dCG/;(YgRft29u~hs[aD$Fn+c+.`2]7-EjZ');
define('AUTH_SALT',        '>m:cjB;2W3mD.m3uR{tn4VeEGU5|7{+!y<S-II)&G!$-2Esa@-0c3Lz.iFVs/|I^');
define('SECURE_AUTH_SALT', 'bQJB0k$!%pNU:/~(}Rx;/XnHT?aW_kcW~/g]I__eP_c9B$xhW-ssmI`cetB$a(mF');
define('LOGGED_IN_SALT',   't2}E3q+IH=[2Z*,5q~.CI-,. cOa8]5f&{$a=Ess-2@Pyv~9I.rjWGoGOm*8Y5tt');
define('NONCE_SALT',       'SiXL=AV0,$2^T#M0IFM#$8-Tx|`S`11v1fO/>6D>_|66(0oeB)*Z3u^d7P9V7Nv`');

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
