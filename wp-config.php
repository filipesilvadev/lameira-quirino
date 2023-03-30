<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
// define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// define( 'FORCE_SSL_ADMIN', true ); // Redirect All HTTP Page Requests to HTTPS - Security > Settings > Enforce SSL
// END iThemes Security - Do not modify or remove this line

// define('DISABLE_WP_CRON', true);

//Begin Really Simple SSL session cookie settings
// @ini_set('session.cookie_httponly', true);
// @ini_set('session.cookie_secure', true);
// @ini_set('session.use_only_cookies', true);
//END Really Simple SSL

//Begin Really Simple SSL Load balancing fix
// if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
// || (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
// || (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
// || (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
// || (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
// || (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
// || (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
// ) {
// $_SERVER["HTTPS"] = "on";
// }
//END Really Simple SSL

define('CONCATENATE_SCRIPTS', false);

define('WP_CACHE_KEY_SALT', 'ad7bbd257dc39911cb43fff53856787b');
// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
define('WP_CACHE', false); // Added by WP Rocket
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */
// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'lameira-quirino');
/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');
/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'root');
/** Nome do host do MySQL */
define('DB_HOST', 'localhost:3306');
/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');
/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');
/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'ZM4A!#i4Nk*8x3X+*&yF5sb+3(2U5o2~63:6Aaz5@r9M5/Ei-8My5&eE:x-#U9Ym');
define('SECURE_AUTH_KEY', 'w9Uh|5gpj0+7ii)0ihN9YFlogRHW9(c[QNy29:7Fe6fAU+bQr@r[IdPK~MDG/3]m');
define('LOGGED_IN_KEY', '0R))alWLdKKidZwd41/)_IlqYl5G32:bI38l6U~E0(|HiKy%U#[u&yY%mB2!v/6;');
define('NONCE_KEY', '5AH73R[d98z!4MbHC]M9n|(uuqMRz760m6E8Qz69d;l&8AJ@FJ;@Wox~7)d3fuo;');
define('AUTH_SALT', 'ZQW7O14uWv)5ghU~[U~&~509;O)Ri%5jr0J+k%NH+%2hJnUN;Hx-y@g9yV:l)jX)');
define('SECURE_AUTH_SALT', '4*9-z5O7!3e/oM5[00)F:Y7k35:C2kF:24*7qIw7e4A_7(1gnCIKHF@Yy07oUW91');
define('LOGGED_IN_SALT', 'n6FalD8SI40&Y1+x;PH5d2Vqz:|P1D86*%)(yoDn1L-Obt#|Mz1B|V5I(;&T~mr6');
define('NONCE_SALT', 'xZu3g9x47*c[T@3@M#OaN;N!*2-8V/J0rJx2GH@#v16;15wm&[lR6B3q~[PR|#L0');
/**#@-*/
/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'eny47zti_';
/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);
/* Isto é tudo, pode parar de editar! :) */
/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
