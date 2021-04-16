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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_db' );

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
define( 'AUTH_KEY',         'y6Jcn19?<z,]:w!aJ^w!/dA ,j%dJNg#mATi=Xsiw?0B0+oVV-;ud2f$VocykE,0' );
define( 'SECURE_AUTH_KEY',  's>V+$&y.9OQK)P2>0pDs~z{5e?VRX0<5xgpP#I2lDHd@/1:8{f0PZg@uX<Rv2T/E' );
define( 'LOGGED_IN_KEY',    'UQ1e!py3k#BL],D2Eaj=B[?p|k>`l0(@0rJGx`_II_HPQCS$u`klQ*wu2.Z%x-U}' );
define( 'NONCE_KEY',        'W4/WLFHw%l[S#s2V&P(X7&Sl9}>)rY=DcnO>D*4NOcq:S`9Yv {H+DENa@ICvc}J' );
define( 'AUTH_SALT',        '.%iV2U]ntI06WTRMCb&,V{@Wf),{ N5^/mE4TE~Ou@TNI|R}xVWN|b0V|H0ly(8Q' );
define( 'SECURE_AUTH_SALT', 'r-the`rgRlJ@^:$`wZPq*OB?yB@{=^L/9SIuIHQoC&_A|?0Ss@V,A.mS.E;/f0l*' );
define( 'LOGGED_IN_SALT',   'k{MCTv26gWRm5{j>>zO2doA}tpMhAg^kfRM*^:j%+0*d4eb@>L&t).Z}&A):|R2&' );
define( 'NONCE_SALT',       'R|1;;UF<!&,<!VfV3lYs`]j~ML5snW6eQsO9u:|U1LApUf}rGMe2a[FYDL4WFZd|' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
