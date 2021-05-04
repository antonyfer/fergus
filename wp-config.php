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
define( 'DB_NAME', 'noizzy' );

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
define( 'AUTH_KEY',         'tKt|WI*6bqt?5C FgQRF$l5RRXk-!T;_ o8aG K.:<LM649kYrjltJ1Hb>UAPpy+' );
define( 'SECURE_AUTH_KEY',  'dzHa ;F[H%YoE0J;&)eFd@XeJ}98Hl+8_.98+DkV4iEO~axHEg.T:sczbfAr`kT|' );
define( 'LOGGED_IN_KEY',    'K-lgZg!dv~{ Rd G2[upNX!^]@dO&i#=sNkQgetwli.%ZS=`>PCKg92_`/},6Dhb' );
define( 'NONCE_KEY',        '4HfQGNt=6p7u^_u}3:ee!P)a&@PcWyNALPQ^Dg{F@uF?FZ4U]C96hdMshAj~,|2y' );
define( 'AUTH_SALT',        'F?/$TZ=;?dNGkhNg%9WoSl~WtNpRqG#4}KM0Fl09Fo(oUDo3%kWvrmw;M%n!mGT5' );
define( 'SECURE_AUTH_SALT', 'QFi?n2&@oK,eX/0rqPsz^yJY?l>Fs%1wQY@@=(Rz@P#xaewPxm?Wz(=_HnCn`@F&' );
define( 'LOGGED_IN_SALT',   '`icq.imh/WxDpwiw$;<u1zuV9-e/B!&t{otr,(N%g|4%PiRA>qsMCcQP^Nk|5S^T' );
define( 'NONCE_SALT',       'GS}2C^Pp`[TldIzO!3#6cww>=B0g#3X?j(X|ZQY)]-wHl6)q%:jk&cByZx3BDz1M' );

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
ini_set('display_errors','Off');
ini_set('error_reporting', 0 );
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
