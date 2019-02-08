# Comet Demo
This project contains the implementation of a simple Laravel example RESTful API for travel books.
We have several different models: countries, languages, authors and books. Travel books are written by one author,
in one language, for one country.
For this relatively simple API with 20 endpoints, Comet is able to generate 112 test-cases.

The different API routes and their parameters are:
```http request
# Countries
GET /countries{?include}
GET /countries/{id}{?include}
POST /countries
PATCH /countries/{id}
DELETE /countries/{id}

# Languages
GET /countries{?include}
GET /countries/{id}{?include}
POST /countries
PATCH /countries/{id}
DELETE /countries/{id}

# Authors
GET /authors{?filter[name]}{?include}
GET /authors/{id}{?include}
POST /authors
PATCH /authors/{id}
DELETE /authors/{id}

# Books
GET /books{?filter[title]}{?filter[publisher]}{?filter[author]}{?filter[country]}{?filter[language]}{?include}
GET /books/{id}{?include}
POST /books
PATCH /books/{id}
DELETE /books/{id}
```

## Installation
After cloning the repository, initialize the project with:
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
yarn # or npm install
```
When using Homestead (recommended), don't forget to update your site configuration and add an entry to your local hosts file.

## Comet usage
By executing `npx comet make:tests specification.yml` all test-cases will be generated.
