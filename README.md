# Applicazione CRUD con Laravel e VueJS

Semplice CRUD realizzato con Laravel e VueJS, che permette di creare, leggere, aggiornare e cancellare utenti.

## Avvio del progetto in locale

Per lo sviluppo locale è necessario che la macchina sia equipaggiata con Composer, Docker, NodeJS e npm.<br>
Lanciare il comando:

```bash
chmod +x tools/build-local-env.sh && ./tools/build-local-env.sh
```

oppure seguire gli step illustrati di seguito:

* Fare una copia del file `.env.example` nominandola `.env`

* installare le dipendenze backend con:

```bash
composer install
```

* digitare:

```bash
vendor/bin/sail up -d
```

* generare la chiave applicazione con:


```bash
vendor/bin/sail artisan key:generate
```

* migrare il database con:

```bash
vendor/bin/sail artisan migrate
```

* installare le dipendenze frontend con:

```bash
npm install
```

buildare il frontend con:

```bash
npm run build
```

oppure:

```bash
npm run dev
```

L'applicazione sarà disponibile all'indirizzo http://localhost<br>

## Test

Per lanciare i test, digitare: 

```bash
vendor/bin/sail artisan test
```
