<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'etceteraagencytest' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '` $:us?#Wk5F.h,=(TxrziOrW^_y1s.W3 yk86H6pj!y|P;E3r0BND`01klz6;hC' );
define( 'SECURE_AUTH_KEY',  'Am`jAGGyDdtw[J] SFW{UO>v&4f:, VJPxcq ,oIj4JK?4<}>7R1 =f4mWW1Wngo' );
define( 'LOGGED_IN_KEY',    'iBgP6TBj2W*WC]SStjT@y|}rwI7j^p$8>;H|l)Bq}3dBc}n>YcZgi|p]/N0W$YZ=' );
define( 'NONCE_KEY',        '2Uuq7w~C)w0~<4^8w1;?%.8y@<+Jit!`TG1[+?#{F}+Khl3MM}#z}DH>VY}9Hn(D' );
define( 'AUTH_SALT',        '/oJzV/D^{SFxewwALT|OP@]&,bJ(C7{(^4i-|NM]fvCjq+*vBi[L`Flx?)Q;_iOw' );
define( 'SECURE_AUTH_SALT', 'glMW(e<o+y!TD/%0`ApCk7?:]+l}!vaRm({V0s_4{ko$X @>{r8F-azRcV(AgeVJ' );
define( 'LOGGED_IN_SALT',   'uscc3I@M}ulE4x-$IdP@E~?B_N9BOKi0KsQkpx_Tnq[E767vO@kSj.;H *u}O<sO' );
define( 'NONCE_SALT',       'eXOB*oPV0d]4[{?Y(p=(P_915YBsO;5(V$C&a}y3kts{uD<terJ4B.-pVrW:4zqO' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
