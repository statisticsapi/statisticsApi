# Statistics API

[![Build Status](https://travis-ci.org/Tony133/symfony5-api-rest.svg?branch=master)](https://travis-ci.org/Tony133/symfony5-api-rest)



## Install with Composer

```
    $ curl -s http://getcomposer.org/installer | php
    $ composer install
``

## Setting Environment

```
    $ cp .env.dist .env
```

## Getting with Curl

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/reviews/get/1?date_from=2018-12-01&date_to=2020-01-12

```


## Sample response


   {
       "code": 200,
       "data": [
           {
               "review_score": "2.857142857142857",
               "review_count": "14",
               "range": "1"
           }
       ]
   }
```
