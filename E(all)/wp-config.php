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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ws2022_speed_test_e' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3301' );

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
define( 'AUTH_KEY',         '<vdF?~J1MZ}Yx;q8VSDjK37kxhq^cww_R[UPUOqzo^*^l%Ox++1`dMqO,paW9hv8' );
define( 'SECURE_AUTH_KEY',  '7D#fhARxf<*&[:;Oq!|SgKl.8,U]_]_#ZvR:;X`cMRRBmciV$$j|DKi_uZUG[SV2' );
define( 'LOGGED_IN_KEY',    'S*coe&_w1CKpoDnF4t$p8 [:6/?+*$b!q w7YB{JE+o]g!Y-.G4y/PH^)J^Q<vg_' );
define( 'NONCE_KEY',        'H~Qt^guXaIrM(GFi}vl,C10*pMb(a?qAbJn(f2+l*?+Go>^Y 0YyoCC*5sS|vBsT' );
define( 'AUTH_SALT',        'AE/#xCArum9~;Wg@{DG-^g.*$^s4H9}$S,Cy:[q=3?Qvk(wX4E<Fn&pdyQx5TJS ' );
define( 'SECURE_AUTH_SALT', '6x.3ti?=5=3 >K<bIiH>o/m=K+:rM`5Ni>p`_n%iqXTODf{3F<5^(`>v=xf)]<JM' );
define( 'LOGGED_IN_SALT',   '.K$(`IWG,JY_+J.7H2]rnu0$;T_u;.)$!CuqO ~SfHR<sb*7#d$iaW(y8]=O,].e' );
define( 'NONCE_SALT',       'Qb$[B&~8jPkoa>mV47@;DCJ~N>lRH,gULT$dN0AlqNpdw|0~O#PTpIs~{_Vb*+TX' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
