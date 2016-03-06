# PostcodesIo

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

## Description

A simple interface for querying the Postcodes.io UK postcode API using [GuzzleHttp Version 6](http://docs.guzzlephp.org/en/latest/index.html).

## Install

Via Composer

``` bash
$ composer require PhilKershaw/postcodesio
```

## Usage

Simply import the `PhilKershaw\PostcodesIO\Client` class, create and instance and call any of the following methods:

``` php

use PhilKershaw\PostcodesIO\Client;

$client = new Client;

// Will return a whole host of information pertaining to the given post code.
$response = $client->postcodeLookup('W1A 1AA');

// Array containing postcodes.
$response = $client->bulkPostcodeLookup(['W1A 1AA', 'M50 2EQ']);

// Associative array containing latitude/longitude coordinates.
$response = $client->latLongLookup([
    'longitude' => 0.629834723775309,
    'latitude'  => 51.7923246977375
]);

// Nested associative arrays containing latitude/longitude coordinates and optional radius and limit.
// Radius will limit the range of the search and limit will, well, limit the number of results
// for a particular latitude/longitude lookup.
$response = $client->bulkLatLongLookup([
    [
        "longitude" => 0.629834723775309,
        "latitude"  => 51.7923246977375
    ],
    [
        "longitude" => -2.49690382054704,
        "latitude"  => 53.5351312861402,
        "radius"    => 1000,
        "limit"     => 5
    ]
]);

// Literally returns a random postcode.
$response = $client->getRandomPostcode();

$response = $client->validatePostcode('W1A 1AA');

// Will complete a partial postcode. Not tested thoroughly.
$response = $client->autocompletePostcode('W1A');

// Will return the nearest postcodes to a given post code.
$response = $client->getNearestPostcodes('W1A 1AA');

// Will perform an outcode lookup and return details specific to the outcode.
// NB The outcode refers to the first portion of the postcode.
// For example 'W1A' is the outcode in 'W1A 1AA'.
$response = $client->outcodeLookup();

// Similar to the nearest postcodes lookup but just for outcodes.
$response = $client->getNearestOutcodes();

// Similar to the straight lat/long lookup but just for outcodes.
$response = $client->outcodeLatLongLookup();

```

All responses return an instance of `Psr\Http\Message\ResponseInterface` as is returned in a GuzzleHttp response. Therefore, you are able to fetch the status code simply by calling:
```
$response->getStatusCode();
```
and the headers:
```
$response->getHeaders();
```
a specific header:
```
$response->getHeader('Content-Type');
```
and the response body:
```
$response->getBody();
```

NB: The response from Postcodes.io typically takes the for of:
``` json

{
    "status": 200,
    "result": {...}
}
```
However, since the 'status' duplicates the HTTP response code `getBody()` will actually return just the 'result' allowing for example:

``` php
$postcode = json_decode($response->getBody())->postcode;
// OR
$latitude = json_decode($response->getBody())->latitude;
```

For further reading, checkout out the GuzzleHttp documentation as linked in the description.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/philkershaw/postcodesio.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/philkershaw/postcodesio/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/philkershaw/postcodesio.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/philkershaw/postcodesio.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/philkershaw/postcodesio.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/philkershaw/postcodesio
[link-travis]: https://travis-ci.org/philkershaw/postcodesio
[link-scrutinizer]: https://scrutinizer-ci.com/g/philkershaw/postcodesio/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/philkershaw/postcodesio
[link-downloads]: https://packagist.org/packages/philkershaw/postcodesio
[link-author]: https://github.com/PhilKershaw
[link-contributors]: ../../contributors
