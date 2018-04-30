<?php
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
    include( dirname( __FILE__ ) . '/wp-config-local.php' );
}
/** The name of the database for WordPress. */
if ( !defined( 'DB_NAME' ) ) {
    define( 'DB_NAME', 'krapka' );
}
/** MySQL database user name. */
if ( !defined( 'DB_USER' ) ) {
    define( 'DB_USER', 'krapka' );
}
/** MySQL database password. */
if ( !defined( 'DB_PASSWORD' ) ) {
    define( 'DB_PASSWORD', 'dfk^34*,.)' );
}

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Authentication Unique Keys and Salts (https://api.wordpress.org/secret-key/1.1/salt/) */
define('AUTH_KEY',         '^4!Lp(a6oKugSp^%d(1MK7!^kf2L)W7kYNuCiXVpDD#jk8XiT8Et0nq&PJ%I2B1P');
define('SECURE_AUTH_KEY',  ')es0Uggs2kC07W#)k64PNPGBMV!QCw(@UbMpMD3j6#&)#Rj5Zw0gDK3vMBJB@5h^');
define('LOGGED_IN_KEY',    'CReIfU6jmia@FZY7sWZ1!nt(#2(r9%YTOujew!LVLYc2lW48lt51qh*MK9VnvLpM');
define('NONCE_KEY',        'XH1FPC4b1)%oPO4)G4OML@cR!ZhuD44&*@kTT5^ui4sqRPdD3)^G%TzF@uDyazyi');
define('AUTH_SALT',        'DhpTS9v7YK3Mn^z0doVTmqWm!Jd*1pE^oS1fyuU!Z*xlSs*ynYXyu2KGC@6toSGp');
define('SECURE_AUTH_SALT', 'tM@QVbo#tI@apfODP^b*Hq5cvb)f8!pl*7zBpVPviLMigXw!N*S9Z&fJs#yS7Uni');
define('LOGGED_IN_SALT',   'E31g3X#CukPAtXrNUV&VFPUaP&OL(*W6)6OKK#A!!oZAhZa@n^ZUF!KeobS!LyrX');
define('NONCE_SALT',       'K6h7hvV*fsvC83v18B005OJK)CNUUBKyD5SedUmP4C8Z#PosLA*AJ1XJ2P&ykRhD');

/** WordPress Database Table prefix. */
$table_prefix  = 'wp_';

/** WordPress debugging mode. */
if ( !defined( 'WP_DEBUG' ) ) {
    define( 'WP_DEBUG', false );
}

define('WPCF7_AUTOP', false);

if ( !defined( 'WP_HOME' ) ) {
    define( 'WP_HOME', 'https://krapka.club' );
}
if ( !defined( 'WP_SITEURL' ) ) {
    define( 'WP_SITEURL', 'https://krapka.club' );
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define ('FS_METHOD', 'direct');

define('ALM_UNLIMITED_PATH', get_template_directory() . '/alm_templates/');
