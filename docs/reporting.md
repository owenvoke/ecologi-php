# Reporting API

[Back to the navigation](README.md)

Allows interacting with the [Reporting API](https://docs.ecologi.com/docs/public-api-docs/API/Reporting-API.v1.yaml)

### Get total impact for a user

```php
$response = $client->report()->totalImpact('owenvoke');
```

### Get total tonnes of CO2 offset for a user

```php
$response = $client->report()->totalTonnesOfCarbonOffset('owenvoke');
```

### Get total number of trees for a user

```php
$response = $client->report()->totalNumberOfTrees('owenvoke');
```
