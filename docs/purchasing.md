# Purchasing API

[Back to the navigation](README.md)

Allows interacting with the [Purchasing Impact API](https://docs.ecologi.com/docs/public-api-docs/API/Impact-API.v1.yaml).

### Purchase Carbon Offset

The default unit of measurement is `Tonnes`, the alternative is `KG`. The constants `Purchasing::UNIT_TONNES` and `Purchasing::UNIT_KG` can be used to retrieve these.

```php
// Purchase 1 tonne of carbon offset
$response = $client->purchase()->carbonOffset(1);

// Purchase 1 KG of carbon offset
$response = $client->purchase()->carbonOffset(1, Purchasing::UNIT_KG);

// Purchase 1 tonne of carbon offset on the test environment
$response = $client->purchase()->carbonOffset(1, Purchasing::UNIT_TONNES, true);
```

### Purchase Trees

```php
// Purchase 10 trees
$response = $client->purchase()->trees(10);

// Purchase 10 trees with a "Funded by" name
$response = $client->purchase()->trees(10, 'Owen Voke');

// Purchase 10 trees on the test environment
$response = $client->purchase()->trees(10, null, true);
```
