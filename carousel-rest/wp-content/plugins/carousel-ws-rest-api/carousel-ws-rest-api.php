<!-- Obiettivo:

- Realizzare un plugin Wordpress che implementi un web-service API REST per fornire i dati necessari per la visualizzazione di un ipotetico slider/carousel (es. https://sorgalla.com/jcarousel)

 

Funzionalità:

- Definire e registrare un custom post-type per la gestione delle slide con almeno i seguenti campi: titolo, descrizione, immagine/video.

- Implementare il web-service che restituisca al chiamante la lista delle slide in formato JSON (vedi esempio in calce)

 

Bonus:

- Implementare la gestione multilingua per i campi testuali in Italiano e Inglese

 

Output richiesti

- Codice sorgente, sia del plugin che di Wordpress

- Dump/backup database, con dati di esempio

- Breve documentazione della soluzione

- Snapshot repository Git (locale utilizzato durante lo sviluppo)

 

Esempio dati:

{

       "status": "success",

       "data": [

             {

                    "title": "Prima slide",

                    "description": "Lorem ipsum",

                    "img": https://sorgalla.com/jcarousel/assets/img/pic/img1.jpg

             },

             {

                    "title": "Seconda slide",

                    "description": "Lorem ipsum",

                    "img": https://sorgalla.com/jcarousel/assets/img/pic/img2.jpg

             }

       ]

} -->


<?php


?>