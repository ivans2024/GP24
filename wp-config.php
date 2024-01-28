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
define( 'DB_NAME', "getpizza" );
/** MySQL database username */
define( 'DB_USER', "root" );
/** MySQL database password */
define( 'DB_PASSWORD', "" );
/** MySQL hostname */
define( 'DB_HOST', "localhost" );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '_T-5bFpH06493Bh%5%]8GEV1k9;eoerDTB|A&1j7UA*0WSSnqj47SM/hP7726fl3');
define('SECURE_AUTH_KEY', '2Yc02@69HBL]51295[8129+n!gNWcqS|I]F/Xe)94)6r37k%b0/1~#II)|X6X|w[');
define('LOGGED_IN_KEY', 'tID)ylH-|:C21u]~&Gh0i:XtwL(2p]92gqx@#5ldy4uF6&_62o+v[61hdG10hz/|');
define('NONCE_KEY', 'I0FRO_J~7S7sJOMQZ6~6C+Ha6~;60;WY:k3ex&4:C]68#NYp2Y/;7|Z(v[#NJb-L');
define('AUTH_SALT', '8;5KtB#Bdm:q)S923&&k)lD4l8CK+bJ+]u7Rc%h4hB+WB+tPuSSd9K6FEPWz52a3');
define('SECURE_AUTH_SALT', '8~yUe)+5F[29~-|35]Pq434nZP]R9i3L[p%YVD~qG%uM9)e*4TFMxRB0#g9tPB8[');
define('LOGGED_IN_SALT', ']:jIcHn[!26c(!K961c|7MLTO(u7q937&Rn6ad1|B%Tu25CZip8Dl:880Hwd:S@1');
define('NONCE_SALT', 'cs6j5T9@!31[-Ib*Q[Ty_eE(g-6]SEuiz1U2]F1h3)!kyQ3my|k9[dyp7(QA4Q93');
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'a6DnLfs_';
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true);
define( 'WP_MEMORY_LIMIT', '128M' );
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';