<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni del database
 * * Chiavi segrete
 * * Prefisso della tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'carousel_rest' );

/** Nome utente del database */
define( 'DB_USER', 'root' );

/** Password del database */
define( 'DB_PASSWORD', 'root' );

/** Hostname del database */
define( 'DB_HOST', 'localhost' );

/** Charset del database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di collazione del database. Da non modificare se non si ha idea di cosa sia. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chiavi univoche di autenticazione e di sicurezza.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tutti i cookie esistenti.
 * Ciò forzerà tutti gli utenti a effettuare nuovamente l'accesso.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jvfPe-mB!jXKBm}bR/KJctdU:=0@kLe4Pum?J620`=8mzf64{/oSEX~w#uK?yHIZ' );
define( 'SECURE_AUTH_KEY',  'e UW[QE[~|JLD:2+b)^!`6=fQr^Z/M8L7T;~@vbz9b#E3~?P9!>L#.q<+C=5]$RO' );
define( 'LOGGED_IN_KEY',    'jFtDTP$8_=j&gODe9TCcQh3gYxkZ=f#xjWhfo,d=S6fu_8lE<L=/bft !}zGjB|-' );
define( 'NONCE_KEY',        ';iyo<>`0YZacdeB&y$dBg1HR2X*q>S>wAa;GALiOgXa~tG3Za<v.Y50$-.c[IhV/' );
define( 'AUTH_SALT',        'K G8{2n*E(4r>-=KLJ3JTXtW6e-&P0qzRiUBuqE2s^j0##jZ4V,y>EqyGl6eYVN0' );
define( 'SECURE_AUTH_SALT', 'T;%W%zDj/iirz|JS([jHNh.<b.%u7%Mb@M=<aZmVJkLGl@$L8ts)hz!5eXVJFeEU' );
define( 'LOGGED_IN_SALT',   ':O_lXS:{O|p2p/L$M5s.jKmSg:}4dQ~7v3[:80}xzH#$l>7v8}R%ry+Sc9~A{grq' );
define( 'NONCE_SALT',       'f`>O0b8>p_d%$Ak{T]43EIs]R}GMD:n]W3&KkdsLelQVejlxeYQT+buPcxo aEg?' );

/**#@-*/

/**
 * Prefisso tabella del database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco. Solo numeri, lettere e trattini bassi!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli sviluppatori di temi e plugin di utilizzare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Aggiungi qualsiasi valore personalizzato tra questa riga e la riga "Finito, interrompere le modifiche". */



/* Finito, interrompere le modifiche! Buona pubblicazione. */

/** Path assoluto alla directory di WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Imposta le variabili di WordPress ed include i file. */
require_once ABSPATH . 'wp-settings.php';
