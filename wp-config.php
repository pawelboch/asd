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
define('DB_NAME', 'horizoninvestments');

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
define('AUTH_KEY',         '/7N-LcOs7r0S^[0^85+3|1W4]|gG:{vP8nxbl8X?HgKOvqal+</|w=D,Xb ZH%^=');
define('SECURE_AUTH_KEY',  '8ifk{++V:+kdvVuM@,G]b%u6uH!Y-3*{$^X>)V=r.!yPn`*y-JyksxYW#kC447&+');
define('LOGGED_IN_KEY',    'KdN(}rXN_g}A>P3rzzUB#JV)|].pv+V|(4b-b|-amyZ?aG}O+;Ot_c[iq iiSu{V');
define('NONCE_KEY',        'r1R|-m*wR`?[a4y9H?8B~-U,1b7(ZzOJJ{% NtWw+k#L{$}2+`++N}$kF$mFkeAZ');
define('AUTH_SALT',        '0[kZb[!yDT P|/h!BOkQKJ/uflc.=J(sT8rJ*7?xUV-cbEb-G=Jm-wHXhwy[KsCI');
define('SECURE_AUTH_SALT', '^/nYBjM^b*kcl;4[jX8~w|6HQka-69<Luor6=D|wVvW06O}&v-IZBaTEtV_/>Rj^');
define('LOGGED_IN_SALT',   'K2Q-ftq!CG9e+,|+(C:~UE<3GT!6P:*tg3EO-Aa`bu[WS|KLJWbB*~shpl# gMnr');
define('NONCE_SALT',       'F@mYOC6g @/1~%.-$*/;%~86vhbHEEi]*h|ff)Sx1|I%jwPpdqIT5AmMW6pM#4G2');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
