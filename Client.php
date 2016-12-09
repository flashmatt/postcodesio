<?php

namespace flashmatt\PostcodesIO;

use GuzzleHttp;
use GuzzleHttp\Psr7\Response;
use Exceptions\NotFoundException;

class Client extends GuzzleHttp\Client
{
    /**
     * API Endpoint
     * @var string
     */
    protected $endpoint = 'https://api.postcodes.io/';
    /**
     * Sets up the base_uri on the Guzzle Client.
     */
    public function __construct()
    {
        parent::__construct([
            'base_uri' => $this->endpoint
        ]);
    }
    /**
     * Lookup a postcode.
     * @param  string $postcode The postcode to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function postcodeLookup($postcode)
    {
        return $this->get("postcodes/{$postcode}");
    }
    /**
     * Bulk lookup postcodes.
     * @param  array  $postcodes An array of postcodes to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function bulkPostcodeLookup(array $postcodes)
    {
        return $this->post('postcodes', [
            'json' => [
                'postcodes' => $postcodes
            ]
        ]);
    }
    /**
     * Get nearest postcodes for a given longitude & latitude.
     * @param  array  $location The lat/long to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function latLongLookup(array $location)
    {
        return $this->get('postcodes?'.http_build_query($location));
    }
    /**
     * Bulk Reverse Geocoding
     * @param  array  $locations Nested array of lat/long combinations to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function bulkLatLongLookup(array $locations)
    {
        return $this->post('postcodes', [
            'json' => [
                'geolocations' => $locations
            ]
        ]);
    }
    /**
     * Get Random Postcode
     * @return GuzzleHttp\Psr7\Response
     */
    public function getRandomPostcode()
    {
        return $this->get('random/postcodes');
    }
    /**
     * Validates a postcode.
     * @param  string $postcode The postcode to validate.
     * @return GuzzleHttp\Psr7\Response
     */
    public function validatePostcode($postcode)
    {
        return $this->get("postcodes/{$postcode}/validate");
    }
    /**
     * Autocomplete a postcode partial.
     * @param  string $postcode The postcode to autocomplete.
     * @return GuzzleHttp\Psr7\Response
     */
    public function autocompletePostcode($postcode)
    {
        return $this->get("postcodes/{$postcode}/autocomplete");
    }
    /**
     * Nearest postcodes to a postcode.
     * @param  string $postcode The postcode to autocomplete.
     * @return GuzzleHttp\Psr7\Response
     */
    public function getNearestPostcodes($postcode)
    {
        return $this->get("postcodes/{$postcode}/nearest");
    }
    /**
     * Lookup Outward Code.
     * @param  string $outcode The outcode to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function outcodeLookup($outcode)
    {
        return $this->get("outcodes/{$outcode}");
    }
    /**
     * Nearest outward code for outward code.
     * @param  string $outcode The outcode to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function getNearestOutcodes($outcode)
    {
        return $this->get("outcodes/{$outcode}/nearest");
    }
    /**
     * Get nearest outward codes for a given longitude & latitude.
     * @param  array  $location The lat/long to lookup.
     * @return GuzzleHttp\Psr7\Response
     */
    public function outcodeLatLongLookup(array $location)
    {
        return $this->get('outcodes?'.http_build_query($location));
    }
    /**
     * Reduces the response body to exclude the status
     * portion - since it's redundant.
     * @param  string $uri The API URI to query
     * @return GuzzleHttp\Psr7\Response
     */
    protected function get($uri)
    {
        $response = parent::get($uri);

        if (404 === $response->getStatusCode()) {
            throw new NotFoundException;
        }

        return new Response(
            $response->getStatusCode(),
            $response->getHeaders(),
            json_encode(
                json_decode($response->getBody())->result
            )
        );
    }
}
