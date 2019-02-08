<?php

namespace Tests\Comet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EnricoStahn\JsonAssert\Assert as JsonAssert;

class CometApiTest extends TestCase
{
    use RefreshDatabase, JsonAssert, HasHooks;

    /**
     * Run seeds.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testCountriesIndex()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/countries', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/countries-index.json');
    }

    public function testCountriesIndexWithInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/countries?include=languages', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/countries-index.json');
    }

    public function testCountriesStore()
    {
        $body = '{"name":"Sweden","code":"SE"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/countries', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/countries-store.json');
    }

    public function testCountriesStoreWithFaultyCodeMinLength()
    {
        $body = '{"name":"Sweden","code":"K"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/countries', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testCountriesStoreWithFaultyCodeMaxLength()
    {
        $body = '{"name":"Sweden","code":"cdQ"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/countries', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testCountriesShowWithCode()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/countries/DE', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/countries-show.json');
    }

    public function testCountriesShowWithCodeInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/countries/DE?include=languages', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/countries-show.json');
    }

    public function testCountriesUpdateWithCode()
    {
        $body = '{"name":"Sweden","code":"SE"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/countries/DE', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/countries-update.json');
    }

    public function testCountriesUpdateWithCodeWithFaultyCodeMinLength()
    {
        $body = '{"name":"Sweden","code":"q"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/countries/DE', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testCountriesUpdateWithCodeWithFaultyCodeMaxLength()
    {
        $body = '{"name":"Sweden","code":"nve"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/countries/DE', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testCountriesDeleteWithCode()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('DELETE', '/api/countries/DE', $headers, $body);
        $response->assertSuccessful();
        
    }

    public function testLanguagesIndex()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/languages', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/languages-index.json');
    }

    public function testLanguagesIndexWithInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/languages?include=countries', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/languages-index.json');
    }

    public function testLanguagesStore()
    {
        $body = '{"name":"Swedish","code":"se"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/languages', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/languages-store.json');
    }

    public function testLanguagesStoreWithFaultyCodeMinLength()
    {
        $body = '{"name":"Swedish","code":"m"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/languages', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testLanguagesStoreWithFaultyCodeMaxLength()
    {
        $body = '{"name":"Swedish","code":"Cxo"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/languages', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testLanguagesShowWithCode()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/languages/de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/languages-show.json');
    }

    public function testLanguagesShowWithCodeInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/languages/de?include=countries', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/languages-show.json');
    }

    public function testLanguagesUpdateWithCode()
    {
        $body = '{"name":"Swedish","code":"se"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/languages/de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/languages-update.json');
    }

    public function testLanguagesUpdateWithCodeWithFaultyCodeMinLength()
    {
        $body = '{"name":"Swedish","code":"C"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/languages/de', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testLanguagesUpdateWithCodeWithFaultyCodeMaxLength()
    {
        $body = '{"name":"Swedish","code":"aoH"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/languages/de', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testLanguagesDeleteWithCode()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('DELETE', '/api/languages/de', $headers, $body);
        $response->assertSuccessful();
        
    }

    public function testAuthorsIndex()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/authors', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-index.json');
    }

    public function testAuthorsIndexWithFilterName()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/authors?filter[name]=John', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-index.json');
    }

    public function testAuthorsIndexWithInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/authors?include=books', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-index.json');
    }

    public function testAuthorsIndexWithFilterNameInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/authors?filter[name]=John&include=books', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-index.json');
    }

    public function testAuthorsStore()
    {
        $body = '{"last_name":"Doe","first_name":"John","date_of_birth":"2002-12-14 00:00:00","homepage":"http://example.org","country_code":"DE"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/authors', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-store.json');
    }

    public function testAuthorsShowWithId()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/authors/1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-show.json');
    }

    public function testAuthorsShowWithIdInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/authors/1?include=books', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-show.json');
    }

    public function testAuthorsUpdateWithId()
    {
        $body = '{"last_name":"Doe","first_name":"John","date_of_birth":"2002-12-14 00:00:00","homepage":"http://example.org","country_code":"DE"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/authors/1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/authors-update.json');
    }

    public function testAuthorsDeleteWithId()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('DELETE', '/api/authors/1', $headers, $body);
        $response->assertSuccessful();
        
    }

    public function testBooksIndex()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitle()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisher()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthor()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisher()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthor()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthor()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthor()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorFilterCountry()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&filter[country]=CH', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterAuthorFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[author]=1&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorFilterCountryFilterLanguage()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&filter[country]=CH&filter[language]=de', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorFilterCountryInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&filter[country]=CH&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterAuthorFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[author]=1&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterPublisherFilterAuthorFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[publisher]=Example&filter[author]=1&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksIndexWithFilterTitleFilterPublisherFilterAuthorFilterCountryFilterLanguageInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books?filter[title]=Explore&filter[publisher]=Example&filter[author]=1&filter[country]=CH&filter[language]=de&include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-index.json');
    }

    public function testBooksStore()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"DE","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-store.json');
    }

    public function testBooksStoreWithFaultyPriceDataType()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":"voxJE","author_id":1,"country_code":"DE","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksStoreWithFaultyAuthorIdDataType()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":"RyrIS","country_code":"DE","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksStoreWithFaultyCountryCodeMinLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"M","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksStoreWithFaultyCountryCodeMaxLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"zlt","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksStoreWithFaultyLanguageCodeMinLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"DE","language_code":"t"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksStoreWithFaultyLanguageCodeMaxLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"DE","language_code":"vUH"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('POST', '/api/books', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksShowWithId()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books/1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-show.json');
    }

    public function testBooksShowWithIdInclude()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('GET', '/api/books/1?include=author', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-show.json');
    }

    public function testBooksUpdateWithId()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"DE","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $response->assertSuccessful();
        $responseContent = $response->getContent();
        $this->assertJsonMatchesSchema(json_decode($responseContent), base_path().'/tests/Comet/schemas/books-update.json');
    }

    public function testBooksUpdateWithIdWithFaultyPriceDataType()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":"TUqpQ","author_id":1,"country_code":"DE","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksUpdateWithIdWithFaultyAuthorIdDataType()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":"RTGUY","country_code":"DE","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksUpdateWithIdWithFaultyCountryCodeMinLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"G","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksUpdateWithIdWithFaultyCountryCodeMaxLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"SyH","language_code":"de"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksUpdateWithIdWithFaultyLanguageCodeMinLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"DE","language_code":"s"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksUpdateWithIdWithFaultyLanguageCodeMaxLength()
    {
        $body = '{"title":"Exploring the Andes","description":"An exciting journey across the Andes","publisher":"Example Publishing","price":6,"author_id":1,"country_code":"DE","language_code":"fCM"}';
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('PATCH', '/api/books/1', $headers, $body);
        $this->assertHasClientError($response);
    }

    public function testBooksDeleteWithId()
    {
        $body = null;
        $headers = $this->getJsonHeaders($body);
        $response = $this->executeRequest('DELETE', '/api/books/1', $headers, $body);
        $response->assertSuccessful();
        
    }

    /**
     * Assert that a test response returned a client error (4xx).
     * @param \Illuminate\Foundation\Testing\TestResponse $response
     */
    protected function assertHasClientError($response)
    {
        $this->assertTrue(
            $response->isClientError(),
            'Response status code ['.$response->getStatusCode().'] is not a client error status code.'
        );
    }

    /**
     * Get default JSON request headers.
     * @param string $body
     * @return array
     */
    protected function getJsonHeaders($body)
    {
        return  [
            'CONTENT_LENGTH' => mb_strlen($body, '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * Execute the test request.
     * @param $method
     * @param $path
     * @param $headers
     * @param $body
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function executeRequest($method, $path, $headers, $body)
    {
        return $this
            ->before()
            ->call($method, $path, [], [], [], $this->transformHeadersToServerVars($headers), $body);
    }
}
    