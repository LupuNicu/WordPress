<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_lab5' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'EIPDit56xSX<#YFWW8pB9%zUDFT`g ^z/?Qb4E_lLAI_RlO;85o0h4eVI{D^mkxL' );
define( 'SECURE_AUTH_KEY',  ')Zm6vOl->p6Drwz!favM3UVkQkk>IT[%glA,HXzY5CZXU-W.M=t/c<PeL)8d;Ao:' );
define( 'LOGGED_IN_KEY',    'P:LMRKrFD}lvIwdW8{]#0X,K7,X`.&#ieg0~kaP,iLXul,f1lIZL$*e%9Y3W:i<V' );
define( 'NONCE_KEY',        '$#`pI_Epu;3=RXCOn(qV(KPHj,e6}t6f.^/<>M@/,6>[/1b9)y14P5(P:uL:*idm' );
define( 'AUTH_SALT',        'E35HP,$=Uco|x)@*+ur6`>GnR?5-c$FsG82;M:<v^gpt=g[I2rs`hfw=K8;iLH}N' );
define( 'SECURE_AUTH_SALT', '~)b?X`m8`y<qn$oP$fEM3aJ`)w:;vrd158qvx4rXI!sERuj]wMUB[lS#gb#A0]}6' );
define( 'LOGGED_IN_SALT',   'B{ZL7<Rj>g?&w2$s+1J[!7AL ;^~jQ6dT.mh./@rT|rF/C!zVX}g++$9,$~60LJW' );
define( 'NONCE_SALT',       'O]wIlq9Jo0=>9d(n0O3AWZ1?`13NH[l_4NfB%Yv7B>m9f?zifMAl1uTx{I=j{zS3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'DISALLOW_FILE_EDIT', true );


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
