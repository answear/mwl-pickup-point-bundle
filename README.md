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

### Get Pickup Points

```php
use Answear\MwlBundle\Command\GetPickupPoints;
use Answear\MwlBundle\Request\GetPickupPointsRequest;

/** @var GetPickupPoints $getPickupPointsCommand */
$getPickupPointsResponse = $getPickupPointsCommand->getPickupPoints(new GetPickupPointsRequest());
```

Final notes
------------

Feel free to open pull requests with new features, improvements or bug fixes. The Answear team will be grateful for any comments.

