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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp');

/** Имя пользователя MySQL */
define('DB_USER', 'mysql');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'mysql');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',sQD;R%Gh{K?AG*7aebk9F3Nv ilEd=Q+G4CC[+-?hL+n#D[m<4(X)b`OI>m>e_a');
define('SECURE_AUTH_KEY',  '&!8F~#zO`^c^sE??T%J_Hy4Uy@Mdy)p%X+K,sCs>.NA#)ccn%IF~O! tDxY@:jb9');
define('LOGGED_IN_KEY',    'b*-%N5Iq@Y=NXB1ag2.,!i [)kc$6}4F7q1Q3A#H|X[P`Iwl&i~v:RsTXR#dPH;K');
define('NONCE_KEY',        'C8kvv*itb(Ms{iZC8`*+d@wH<x-~sUkf)JZsHxm]$sc=,^ F83->i#c|yh:!74}W');
define('AUTH_SALT',        'O:KH1;s=qX3:ONvO%(HZbFJs/lA86c2:HO8zI[CaK9a7Xlz$#*36t*COf:1ac$B{');
define('SECURE_AUTH_SALT', 'I i/cMIa~i=Q~SQYEJ-;S*NiVeoZn~vYH:sli~~2xe:ev:tc_%>>`yQzzSKN[:&M');
define('LOGGED_IN_SALT',   'g|)dw1=C1Z7C[2D:9v#!Q6^HE-ODWtT<2rX4^<j+`%xbA,!pCG_+Ox%+2aOa)7T.');
define('NONCE_SALT',       ')YSK*nx]so=>bQkXtTC}w:.aYHp(SV@[G^Z3|m0n=vzV1#|~CoHkBwL>n5}|yISi');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
