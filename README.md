# film-similarty
Atolye15 - Internship Camp

Laravel 5.4 (only API part + Eloquent)
- APIs don't use "auth" middleware or anything like that so everyone can use these apis.

**Steps**

```php -S localhost:8080 -t public```

``` GET -> localhost:8080/```

``` GET -> /api/movie ``` Returns movies list (index)

``` POST -> /api/movie ``` Creates a new movie with its categories (create)
```name: MovieName  categories: a,b,c```

``` GET -> /api/movie/1 ``` Not implemented (show)

``` PUT -> /api/movie/1 ``` Not implemented (update)

``` DELETE -> /api/movie/1 ``` Not implemented (delete)

```http://localhost:8080/api/movie/{FilmName}/suggest``` Returns/Lists similarities according to other films
(Note: Of course this parameter should be ID but its just for testing)

```http://localhost:8080/api/find/{FilmName}``` Dump&Die with found result (just for testing)