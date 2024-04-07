### Plugin Wordpress (wp-carousel-ws-rest-api) che implementa un web-server API REST per fornire i dati necessari per la visualizzazione di un ipotetico slider/carousel.


**Funzionalità:**
- Registrazione di un custom post type chiamato 'slides' formato da:
    - Titolo (title)
    - Descrizione (description)
    - Immagine (img)
    - Autore (author)
    - Data (date)
- Registrazione di un endpoint per ottenere i dati delle 'slides' in formato JSON.


**Funzionamento:**

All'attivazione del plugin, tramite l'hook 'init', viene chiamata una funzione che registra il custom post type 'slides' usando la funzione 'register_post_type', alla quale vengono passate le
opzioni e le labels necessarie per customizzare il tipo di post.

All'attivazione dell'API REST ('rest_api_init'), viene registrata la route 'carousel-ws-rest-api/v1/slides' tramite 'register_rest_route', la quale, ad ogni richiesta, richiama
la funzione 'get_slides'. Quest'ultima ritorna i dati (in formato JSON) di tutte le 'slides' presenti nel database, mantenendo solamente quelle che hanno titolo, descrizione e immagine.

Esempio di link per raggiungere l'endpoint: http://localhost/wp-json/carousel-ws-rest-api/v1/slides

Esempio di dati di ritorno:
```json
{
   "status": "success",
   "data": [
      {
         "title": "Slide numero 5",
         "description": "Testo di prova in italiano per l'elemento numero 5",
         "author": "admin",
         "date": "2024-04-07 01:01:47",
         "img": "http://localhost/wp-content/uploads/2024/04/What-is-Stock-Photography_P1_mobile.jpeg"
      },
      {
         "title": "Slide 1",
         "description": "Slide descrizione",
         "author": "admin",
         "date": "2024-04-03 18:14:33",
         "img": "http://localhost/wp-content/uploads/2024/04/igor-savelev-HocQ5RQ4Qpo-unsplash-scaled.jpg"
      }
   ]
}
```
Esempio di dati di ritorno in caso di errore (nessuna slide trovata):
```json
{
   "status": "error",
   "errorMessage": "No slides found"
}
```


**Gestione multilingua Italiano e Inglese:**


È possibile gestire la traduzione dei campi testuali da Italiano a Inglese. Per fare ciò è necessario installare il plugin wordpress [Polylang](https://polylang.pro), settare
come lingua di default Italiano ('it') e aggiungere la lingua Inglese ('en'). Per ogni 'slides' sarà quindi possibile creare la versione in Italiano e quella in Inglese.
Aggiungendo al link dell'endpoint il parametro 'lang' è possibile scegliere di scaricare i dati delle 'slides' in inglese o di quelle in italiano. Di default vengono ritornate
le slides in italiano (quindi anche se non viene inserito il parametro o se viene inserito un valore non corretto).

Esempio di link per raggiungere l'endpoint e ricevere i dati delle 'slides' in inglese: http://localhost/wp-json/carousel-ws-rest-api/v1/slides?lang=en







