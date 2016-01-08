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
define('DB_NAME', 'euescolhivoce');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '9nScIfaC#LKyifLldN<iYtq@.S@Sr2M8w0,Ecw!L[qH_{OQ]6%-VSC.i^xU}G9p!');
define('SECURE_AUTH_KEY',  's*|*J]A+wrY]#)(i>mS%8;qpFaAzP6eB5!w&C[!PZ? (z-@~Z09vxp@hK,r_:}CC');
define('LOGGED_IN_KEY',    'a@|l]AGmKz$M K+rJaE&3HQ5uvc.$36@@9#H/uOPy@DClk5%k_RzhNh?j!GAgF_a');
define('NONCE_KEY',        'JG?_5S@bkYO|0g$-lY+?tfQg}izw27Pv-TdE[s.1b(<|!:v&9R>>hK-T|!@t>nYH');
define('AUTH_SALT',        'c%2ICAh lI!6it|mFe<LH& ZF`JDXzB2b8ODMh([Vazeh-7~`a|NQ%{CJ[%cm$R%');
define('SECURE_AUTH_SALT', 'uMRsz^pHAd?9j|Rx)uX)CXoX*EB51[`J?29`O|%LAqA0`o}AQV2Ze80Git-}1nfg');
define('LOGGED_IN_SALT',   'gE+O }Zp{+2Jm`.)EsW1NVW-v:K]#q#> q>559_gl%~011K[{Ivm<x-IT)ikJ)KI');
define('NONCE_SALT',       '^m7 .RyZ0b@H*&#B=zlYX6d^Yb B@+86nYua<}#3ml*W{VHyM>xCAT^-@oID)|l{');

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
