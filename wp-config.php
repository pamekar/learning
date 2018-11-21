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
define('DB_NAME', 'learning');

/** MySQL database username */
define('DB_USER', 'greenwhitedev');

/** MySQL database password */
define('DB_PASSWORD', 'tarzan');

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
define('AUTH_KEY',         'egqrx2ky@9n0uHdmJ~Ap1z!rVqRtwJUB@e:G:A:R&}=C0q+4kvmfWapaTY-!r|!h');
define('SECURE_AUTH_KEY',  'y]@A/X(JYJAH-fJ($w=H.s#9`x5n`@^+9m<:.96w8a8b:ge`|up;-JCb U@v<hIg');
define('LOGGED_IN_KEY',    '5X9rB3,jq]J<:y~xyU;m0S@WqA}ieG;4^y8<o-&|M#VW3W[g2v5*NxcyjBEBj]o6');
define('NONCE_KEY',        '-I6!A#tnoz`2Qz-PpNk7x]nJBfzeB{D5>C6AOr3O|HR]?t>&G?niXObk4`sbNosx');
define('AUTH_SALT',        '9PzDZ^?<1|]mpAfT{/>Pz2|$UF6,3gmFS52w*qL.P)(y{2z%0?rFIT]AGROjCMt ');
define('SECURE_AUTH_SALT', '*/?pz|}QSrbUB3eD)L>[*?;}A:bv*$(Pf%bcNjQ_:p>;gGEoIWoJ4XN@v) HtiBi');
define('LOGGED_IN_SALT',   'ZDrF+XqW})$627^;*zC.aG;r%Yj(:$$^na2q^&g.,24r_.bpk`iug8;nT(MAzoAj');
define('NONCE_SALT',       '&-h1c-9Fn$-Ck0J5Y@gIGYM+a-c;9X.gFo`(s?c5yvK`=;%a`l.!un5SNF wvW/s');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lms_';

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
