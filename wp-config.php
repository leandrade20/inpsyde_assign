<?php

define('FS_METHOD', 'direct');
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
define( 'DB_NAME', 'juvoclie_inpsyde_db' );

/** MySQL database username */
define( 'DB_USER', 'juvoclie_inpsyde' );

/** MySQL database password */
define( 'DB_PASSWORD', 'em9LMChgBWfy' );

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
define( 'AUTH_KEY',         'B#hP!(+c:ys<uJ,r0hGIM|o|poOkL70>n~9-5XVT1R_% <uS3M71P W|,xQzkeIA' );
define( 'SECURE_AUTH_KEY',  'N>ofMsZd.fpYU+Ro%PTep;J.uecpSxme$$2=AC&gl8l`1y}Ztuh?iw?{E}y}]WY+' );
define( 'LOGGED_IN_KEY',    'Q{}/V^wLND >E3_t_1@bKXPH=.CKbd({pd~_fkgF19iZTI:tddEIs$b[^+1h6t=P' );
define( 'NONCE_KEY',        '<-eT ^nu3@)J;K^lglA?fl<9hgBZv>`jfeGoPg+^Q^3YoV|3i`=d>*n)yC2-1ual' );
define( 'AUTH_SALT',        '3Qv#$dm$Az.QDO3+4$5H}NkA|c798W#v/fVEwtk7<U*Feu-.PrP{]RlI{hzk6$x*' );
define( 'SECURE_AUTH_SALT', 'q>c5Nse`>j!W{BB*x;E|]1I3n^i!:bKOl7}#!SU7R_n5>/h+rDA6P4aBXTX+#uW_' );
define( 'LOGGED_IN_SALT',   'BBusjhNInV?B^*e?dydp.$mR:%&rvXH(I$)<E,:ajlN[&cDDP&9F(p}Jyw YT`6i' );
define( 'NONCE_SALT',       'k^,jB|>boxKFKakX9pLTJeKkeF}HrH3(#dT^hfJT~Ovt]F`i:QgqO+%H#Q8x}QPx' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
