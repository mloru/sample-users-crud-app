# Applicazione CRUD con Laravel e VueJS

Semplice CRUD realizzato con Laravel e VueJS, che permette di creare, leggere, aggiornare e cancellare utenti.

## Avvio del progetto in locale

Per lo sviluppo locale è necessario che la macchina sia equipaggiata con Composer, Docker, NodeJS e npm.<br>

Fare una copia del file `.env.example` nominandola `.env`, successivamente installare le dipendenze backend con

```bash
composer install
```

Poi digitare

```bash
vendor/bin/sail up -d
```

per avviare il progetto. Successivamente, generare la chiave applicazione con


```bash
vendor/bin/sail artisan key:generate
```

installare le dipendenze frontend con 

```bash
npm install
```

e buildare il frontend con

```bash
npm run build
```

o

```bash
npm run dev
```

L'applicazione sarà disponibile all'indirizzo http://localhost<br>

## Test

Per lanciare i test, digitare: 

```bash
vendor/bin/sail artisan test
```
