<?php

namespace PhilKershaw\PostcodesIO;

use GuzzleHttp;

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
     * @return Psr\Http\Message\ResponseInterface
     */
    public function postcodeLookup($postcode)
    {
        return $this->get("postcodes/{$postcode}");
    }
    /**
     * Bulk lookup postcodes.
     * @param  array  $postcodes An array of postcodes to lookup.
     * @return Psr\Http\Message\ResponseInterface
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
     * @return Psr\Http\Message\ResponseInterface
     */
    public function latLongLookup(array $location)
    {
        return $this->get('postcodes?'.http_build_query($location));
    }
    /**
     * Bulk Reverse Geocoding
     * @param  array  $locations Nested array of lat/long combinations to lookup.
     * @return Psr\Http\Message\ResponseInterface
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
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getRandomPostcode()
    {
        return $this->get('random/postcodes');
    }
    /**
     * Validates a postcode.
     * @param  string $postcode The postcode to validate.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function validatePostcode($postcode)
    {
        return $this->get("postcodes/{$postcode}/validate");
    }
    /**
     * Autocomplete a postcode partial.
     * @param  string $postcode The postcode to autocomplete.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function autocompletePostcode($postcode)
    {
        return $this->get("postcodes/{$postcode}/autocomplete");
    }
    /**
     * Nearest postcodes to a postcode.
     * @param  string $postcode The postcode to autocomplete.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getNearestPostcodes($postcode)
    {
        return $this->get("postcodes/{$postcode}/nearest");
    }
    /**
     * Lookup Outward Code.
     * @param  string $outcode The outcode to lookup.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function outcodeLookup($outcode)
    {
        return $this->get("outcodes/{$outcode}");
    }
    /**
     * Nearest outward code for outward code.
     * @param  string $outcode The outcode to lookup.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getNearestOutcodes($outcode)
    {
        return $this->get("outcodes/{$outcode}/nearest");
    }
    /**
     * Get nearest outward codes for a given longitude & latitude.
     * @param  array  $location The lat/long to lookup.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function outcodeLatLongLookup(array $location)
    {
        return $this->get('outcodes?'.http_build_query($location));
    }
}
