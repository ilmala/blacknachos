# Black Nachos

## Article API

Questo mini-progetto è stato realizzato per essere discusso durante il colloquio con l'azinda Black Nachos.

## Installazione
La repository del progetto è scaricabile all'indirizzo https://github.com/ilmala/blacknachos


```shell
# Scarica la repository 
clone git@github.com:ilmala/blacknachos.git blacknachos

# Avvia docker
docker-compose up -d --build

# Installa le dipendenze php
docker-compose run --rm php composer install

# Per accedere al container PHP
docker-compose run --rm php /bin/bash
```

## API
Le api sono disponibili all'indirizzo localhost:8080/api

### Come usare le api:

```bash
# Recupera gli articoli ordinati per data di pubblicazione
/articles

# Recupera gli articoli per categoria
/articles?category=php

# Recupera il dettaglio di un articolo
/articles/<article-slug>
```