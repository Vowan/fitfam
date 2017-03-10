<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file. These can then be overridden in the environment config files.
 * 
 * Please note if you add constants in this file (i.e. define statements) 
 * these cannot be overridden in environment config files.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */
  

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uB1M^QrFLIqF1-zb8TP7d$`(TwE{Q@XzlUe+e;%49@3OQPS!>-w-xlh!7SX6Xk/)');
define('SECURE_AUTH_KEY',  'XVVONR:`Svrm)HNpp)y36L*d*6U~OtyvQSg*JSA-!={@8*a8V-}09Y)6yP(*;74G');
define('LOGGED_IN_KEY',    '25hK6mQ_S[i)6@#7QY~.LfI/3;xxGu|zzMx9pHz7<OU&^q-c8v/mhP-4F7B.|W,I');
define('NONCE_KEY',        '8OGHlx#PHhs]]C_??Pe^0gcV<~Ul]Q{i&54fS!Q4W`f$@?Wa,E$ZYUicIQ30+?ea');
define('AUTH_SALT',        'G.2_5_FJCyK:km?ZBn<SSV91Mp-q0#=N&vyRg1G8QMM>1tV:|{1]]&-_:/%h.sO)');
define('SECURE_AUTH_SALT', 'mr*<*s?#+m&vXenBF>z@%5czIq>,./s1b0>wtv8&G,vTUrrFh4R@@}[yaF%c<%Js');
define('LOGGED_IN_SALT',   'M;<>$EpbI#SwkMo3/fl}(06Vp0j=wQuZ6-)6P#W-Zhp@>`aeJO:!GjU@stS$RdBD');
define('NONCE_SALT',       'Y}46}~bt]T_2WC)UlyC)?uaWA,^;_GvLw~/YrinMJRJ V],Il]n?)M7Z(1uA]7Ql');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fitfam_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * Increase memory limit.
 */
define('WP_MEMORY_LIMIT', '64M');