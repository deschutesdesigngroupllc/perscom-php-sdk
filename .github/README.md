<p align="center"><img src="../art/header.png" alt="Logo"></p>

<div align="center">

# The Official PERSCOM PHP SDK

A PHP package that helps kickstart your next [PERSCOM](https://perscom.io) integration.

[![Test Suite](https://github.com/DeschutesDesignGroupLLC/perscom-php-sdk/actions/workflows/tests.yml/badge.svg)](https://github.com/DeschutesDesignGroupLLC/perscom-php-sdk/actions/workflows/tests.yml)
![Downloads](https://img.shields.io/packagist/dm/deschutesdesigngroupllc/perscom-php-sdk)
![Packagist Version](https://img.shields.io/packagist/v/DeschutesDesignGroupLLC/perscom-php-sdk)
![GitHub License](https://img.shields.io/github/license/DeschutesDesignGroupLLC/perscom-php-sdk)
[![codecov](https://codecov.io/gh/DeschutesDesignGroupLLC/perscom-php-sdk/graph/badge.svg?token=uJUiz1Sv6X)](https://codecov.io/gh/DeschutesDesignGroupLLC/perscom-php-sdk)

[Documentation](https://docs.perscom.io)

</div>

## Introduction

The PERSCOM PHP SDK is a powerful tool that enables seamless integration with the PERSCOM platform, allowing you to interact with PERSCOM's personnel data programmatically.

```php
<?php

$perscom = new PerscomConnection('api-token', 'perscom-id');

// Get a list of a specific resource
$response = $perscom->users()->all();

// Creating a resource
$response = $perscom->users()->create(data: [
    'name' => 'My New User'
])

// Updating a resource
$response = $perscom->users()->update(id: 1, data: [
    'name' => 'My New Name'
])

// Deleting a resource
$response = $perscom->users()->delete(id: 1)

// Searching for a resource
$response = $perscom->users()->search(
    value: 'foobar', 
    sort: new SortObject('first_name', 'asc'), 
    filter: new FilterObject('created_at', '<', '2024-01-01')
)

// Other examples
$response = $perscom->users()->profile_photo(id: 1)->create(filePath: 'image.jpg')
$response = $perscom->users()->assignment_records(id: 1)->delete();

// Parse the response into a usable array
$data = $response->json();
```

## Getting Started

You can install the package using [Composer](https://getcomposer.org):

```shell
composer require deschutesdesigngroupllc/perscom-php-sdk
```

## Documentation

Visit our documentation [here](https://docs.perscom.io) to get started.

## Contributing

Please see [here](../.github/CONTRIBUTING.md) for more details about contributing.