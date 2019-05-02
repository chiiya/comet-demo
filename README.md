<p align="center"><img src="https://i.postimg.cc/0QZsGfyb/comet-demo-logo.png" alt="Comet Demo"></p>
<p align="center"><strong>Example project illustrating  [comet](https://github.com/chiiya/comet) abilities.</strong></p>

## Index
<pre>
<a href="#introduction"
>> Introduction .....................................................................</a>
<a href="#setup"
>> Setup ............................................................................</a>
<a href="#testing"
>> Testing ..........................................................................</a>
<a href="#documentation"
>> Documentation ....................................................................</a>
</pre>

## Introduction
This project contains the implementation of a simple Laravel example RESTful API for travel books.
We have several different models: countries, languages, authors and books. Travel books are written by one author,
in one language, for one country. Some endpoints allow additional filtering or including of relationships.

The different API routes and their parameters are:
```http request
# Countries
GET /countries{?include}
GET /countries/{code}{?include}
POST /countries
PATCH /countries/{code}
DELETE /countries/{code}

# Languages
GET /languages{?include}
GET /languages/{id}{?include}
POST /languages
PATCH /languages/{id}
DELETE /languages/{id}

# Authors
GET /authors{?filter[name],include}
GET /authors/{id}{?include}
POST /authors
PATCH /authors/{id}
DELETE /authors/{id}

# Books
GET /books{?filter[title],filter[publisher],filter[author],filter[country],filter[language],include}
GET /books/{id}{?include}
POST /books
PATCH /books/{id}
DELETE /books/{id}
```

## Setup
After cloning the repository, initialize the project with:
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
yarn # or npm install
```
When using Homestead (recommended), don't forget to update your site configuration and add an entry to your local hosts file.

## Testing
For this relatively simple API with 20 endpoints, Comet is able to generate 112 test-cases.
By executing `npx comet make:tests specification.yml` all test-cases will be generated. What this does is: 
1. Add a Comet test suite to your `phpunit.xml` file, if not already present.
2. Add the necessary dependencies to your `composer.json` (Make sure to run `composer install` afterwards).
3. Generate the hook trait and the actual test cases (@`tests/Comet`)
To execute the tests, run `make test`. In order to generate a code-coverage report, run `make code-coverage`.

## Documentation
Coming soon.
