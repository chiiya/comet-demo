# Comet Demo
This project contains the implementation of a simple Laravel example RESTful API for travel books.
We have several different models: countries, languages, authors and books. Travel books are written by one author,
in one language, for one country.

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
GET /books{?filter[title]}{?filter[publisher]}{?filter[title]}{?filter[author]}{?filter[country]}{?filter[language]}{?include}
GET /books/{id}{?include}
POST /books
PATCH /books/{id}
DELETE /books/{id}
```
