```
 @@@@@@@@&  @@@@@@@@   @@@@@@@@  @@@   @@@   @@@  &@@@@@@@@  @@@@@@@@@   @@@@@@ 
@@@/   @@@  @@@   @@@ (@@   #@@  @@@   @@@   @@@  @@@    @@@ @@@   @@@* @@@     
@@@/   @@@  @@@   @@@  @@@@      @@@   @@@   @@@  @@@  @@@@  @@@   @@@* @@@     
@@@/   @@@  @@@   @@@     @@@@   @@@   @@@   @@@  @@@@@@     @@@   @@@* @@@     
@@@/   @@@  @@@   @@@ @@@   @@@@ @@@   @@@   @@@  @@@    @@@ @@@   @@@* @@@     
,@@@   @@@  @@@   @@@ @@@%  #@@@ @@@   @@@   @@@  @@@   @@@. @@@   @@@* @@@     
 %@@@@@@@@  @@@   @@@  /@@@@@@.   @@@@@@/@@@@@@    @@@@@@@    @@@@@@@@* @@@  @@@
```

# MWL (Meest + Nova Poshta) pickup point bundle
MWL integration for Symfony.  
Documentation of the API can be found here: https://documenter.getpostman.com/view/12823986/TzCTam5v

## Installation

* install with Composer
```
composer require answear/mwl-pickup-point-bundle
```

`Answear\MwlBundle\AnswearMwlBundle::class => ['all' => true],`  
should be added automatically to your `config/bundles.php` file by Symfony Flex.

## Setup

```yaml
# config/packages/answear_mwl.yaml
answear_mwl:
    partnerKey: 'partner-key'
    secretKey: 'secret-key'
```

config will be passed to `\Answear\MwlBundle\ConfigProvider` class.

## Usage

### Get pickup points

```php
use Answear\MwlBundle\Command\GetPickupPoints;
use Answear\MwlBundle\Request\GetPickupPointsRequest;

/** @var GetPickupPoints $getPickupPointsCommand */
$getPickupPointsResponse = $getPickupPointsCommand->getPickupPoints(new GetPickupPointsRequest());
```

### Get pickup points by carriers and country codes

```php
use Answear\MwlBundle\Command\GetPickupPointsByCarriersAndCountryCodes;
use Answear\MwlBundle\Enum\CarrierEnum;
use Answear\MwlBundle\Enum\CountryCodeEnum;
use Answear\MwlBundle\Request\GetPickupPointsByCarriersAndCountryCodesRequest;
use Answear\MwlBundle\Request\Struct\CarrierAndCountryCode;

$requestData = [
    new CarrierAndCountryCode(
        CarrierEnum::Meest,
        CountryCodeEnum::Ukraine
    ),
]

/** @var GetPickupPointsByCarriersAndCountryCodes $getPickupPointsCommand */
$getPickupPointsResponse = $getPickupPointsCommand->getPickupPointsByCarriersAndCountryCodesRequest(
    new GetPickupPointsByCarriersAndCountryCodesRequest($requestData)
);
```

### Get cities

```php
use Answear\MwlBundle\Command\GetCities;
use Answear\MwlBundle\Request\GetCitiesRequest;

/** @var GetCities $getCitiesCommand */
$getCitiesResponse = $getCitiesCommand->getCities(new GetCitiesRequest());
```

Final notes
------------

Feel free to open pull requests with new features, improvements or bug fixes. The Answear team will be grateful for any comments.

