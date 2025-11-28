# Applicazione CRUD con Laravel e VueJS

Semplice CRUD realizzato con Laravel e VueJS, che permette di creare, leggere, aggiornare e cancellare utenti.

## Avvio del progetto in locale

Per lo sviluppo locale è necessario che la macchina sia equipaggiata con Composer e Docker.<br>
Installare le dipendenze backend con

```bash
composer install
```

Poi digitare

```bash
vendor/bin/sail up
```

per avviare il progetto. L'applicazione sarà disponibile all'indirizzo http://localhost

## Test

Per lanciare i test, digitare: 

```bash
vendor/bin/sail artisan test
```
