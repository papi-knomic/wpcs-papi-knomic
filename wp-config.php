<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'slideshow' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(QTxYt|~Si[_)o=S 17?A&2%Dr*|0HM4Ib2t:LJ^54Odo4zxgquo`[LsZU!f_(EX' );
define( 'SECURE_AUTH_KEY',  'MbX3x%[#h4EZFE]d1jZ!yH!:>t/FktGR$2N75e}FJ3{7@z(7j*r4kliU/lCfE+&N' );
define( 'LOGGED_IN_KEY',    'mX*&FS4uW,{awvj#DhGUbN dSgG ZYm5Xvx^auu)Gi~I.l/=0b~*#<Y)99:FT?O^' );
define( 'NONCE_KEY',        'eNMfFE!)Qi5lYg84Uahl]3hDS*{f=xT[o6rIqD`2i+9hX&&UqBE`3WScKM`qsS e' );
define( 'AUTH_SALT',        'h*cs+EXW&4OMl1q%[Z_5WHOSmGK>j`qYg4)<el3yNGi?VBIa4VHSVu<$y7FSI<#D' );
define( 'SECURE_AUTH_SALT', '-p}CBn~3W^ojyh3)o?TP}6@5_[xL*,u0Mr]kZNC&i|teW==wZR-kRM2J[)f%~7&9' );
define( 'LOGGED_IN_SALT',   'G$0^VB}R|3Kf0.Ln=0Y)d~FcMwF4b&<Vot:wo:$P%)$?4^Ue5#Vs--s8WRKsTE5?' );
define( 'NONCE_SALT',       '=YQ6qMq/G9q#C CaoYBwrThb,B-*0jU%>%!J-uEPyXY9*X@@%b827f_,v^DN.VHV' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
