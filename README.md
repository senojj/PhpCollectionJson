# PhpCollectionJson
PHP classes for building a Collection+JSON response.

## Installation
```
composer require jjware/phpcollectionjson
```

## Usage
### Creating a response
```php
use PhpCollectionJson\Document;
use PhpCollectionJson\Collection;
use PhpCollectionJson\Item;
use PhpCollectionJson\Data;

$document = new Document();
$collection = new Collection('http://www.somesite.com/users');
$document->setCollection($collection);

$item = new Item('http://www.somesite.com/users/123');
$item->getData()
    ->add(new Data('firstName', 'John'))
    ->add(new Data('lastName', 'Smith'))
    ->add(new Data('username', 'jsmith'));

$collection->getItems()->add($item);

echo json_encode($document);
```
### Building from a response
#### The JSON
```json
{
  "collection": {
    "version": "1.0",
    "href": "http://www.somesite.com/users",
    "items": [
      {
        "href": "http://www.somesite.com/users/123",
        "data": [
          {
            "name": "firstName",
            "value": "John"
          },
          {
            "name": "lastName",
            "value": "Smith"
          },
          {
            "name": "username",
            "value": "jsmith"
          }
        ]
      }
    ]
  }
}
```
#### The PHP
```php
use PhpCollectionJson\Document;

$json = file_get_contents('http://www.somesite.com/users'); // don't do this at home kids

$document = Document::fromJSON($json);

$firstName = $document->getCollection()->getItems()->elementAt(0)->getData()->elementAt(0);

// $firstName === 'John'
```
