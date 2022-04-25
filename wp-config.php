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
// define( 'DB_NAME', 'wordpress');

// /** MySQL database username */
// define( 'DB_USER', 'wordpress');

// /** MySQL database password */
// define( 'DB_PASSWORD', 'wordpress');

// /** MySQL hostname */
// define( 'DB_HOST', 'db:3306');

// /** Database Charset to use in creating database tables. */
// define( 'DB_CHARSET', 'utf8');

// /** The Database Collate type. Don't change this if in doubt. */
// define( 'DB_COLLATE', '');


define( 'DB_NAME', 'level5cognitas');

/** MySQL database username */
define( 'DB_USER', 'root');

/** MySQL database password */
define( 'DB_PASSWORD', 'root');

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

@ini_set( 'upload_max_size' , '164M' );
@ini_set( 'post_max_size', '164M');
@ini_set( 'max_execution_time', '300' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2iikzp8kvxbn3fmisegnafebncqzw3pnbtiomk1jqhyj797ctyxfnt4w9rhgeyg5' );
define( 'SECURE_AUTH_KEY',  'pvifgvczp3nmsjazwedmz8jzfoazlkotnci7pt92bxygy3epwkjqtjagdlo4cwly' );
define( 'LOGGED_IN_KEY',    '5cgx12m6g4vqpg9iro1kukuj7kxq02m66znfjbbcut1bydgxrd8gn8ptj8itsxsc' );
define( 'NONCE_KEY',        'jmr1rh7sbohjn3zxu0yfx7hxpou5u4ntkvrup8ccjlzqvzn3zzuv7ohyjbmjcz64' );
define( 'AUTH_SALT',        'ubshrjz2g5ov6ew9nbhu1j60udlp1dvrfyzd59s2lzkmliyvi6dvkciyjstnyxlc' );
define( 'SECURE_AUTH_SALT', 'dvpmyj19lfjubdltmtenwhqzb3n4n6t5rh5apa6wu1jelvnm5eadysqeyv0xnifc' );
define( 'LOGGED_IN_SALT',   'ns7gtwobzsokcqpyk9yyvboym6qpiiavafvia7utnbw3fcn7nhcjnepekd1ondfc' );
define( 'NONCE_SALT',       '9quwjweolhfi8zpmxqpcxvh2pbwjizslk1pxgsmyrqocinv88wyzv7wtvirnjzt0' );

define('WP_HOME','http://localhost:8888');
define('WP_SITEURL','http://localhost:8888');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpcu_';

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
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_AUTO_UPDATE_CORE', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
