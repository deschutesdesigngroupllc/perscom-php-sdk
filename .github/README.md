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

// The following are examples on the user resource, but the same principles
// can be applied to any PERSCOM resource. 
$perscom = new PerscomConnection('YOUR_API_KEY');

// Get a list of a specific resource
$response = $perscom->users()->all();

// Get a specific resource
$response = $perscom->users()->get(id: 1);

// Create a resource
$response = $perscom->users()->create(data: [
    'name' => 'User 1',
    'email' => 'user1@email.com'
]);

// Update a resource
$response = $perscom->users()->update(id: 1, data: [
    'name' => 'User 1 New Name'
]);

// Delete a resource
$response = $perscom->users()->delete(id: 1);

// Search for a resource
$response = $perscom->users()->search(
    value: 'foobar', 
    sort: new SortObject('first_name', 'asc'), 
    filter: new FilterObject('created_at', '<', '2024-01-01')
);

// Batch create a resource
$response = $perscom->users()->batchCreate([
    new ResourceObject(data: [
        'name' => 'User 1',
        'email' => 'user1@email.com'
    ]),
    new ResourceObject(data: [
        'name' => 'User 2',
        'email' => 'user2@email.com'
    ])
]);

// Batch update a resource
$response = $perscom->users()->batchUpdate([
    new ResourceObject(id: 1, data: [
        'name' => 'User 1 New Name'
    ]),
    new ResourceObject(id: 2, data: [
        'name' => 'User 2 New Name'
    ])
]);

// Batch delete a resource
$response = $perscom->users()->batchDelete([
    new ResourceObject(id: 1),
    new ResourceObject(id: 2)
]);

// Uploading an attachment
$response = $perscom->users()->attachments(id: 1)->create(data: [
    'name' => 'Attachment 1',
    'file' => fopen('/../file.pdf', 'r')
]);

// Other examples
$response = $perscom->users()->profile_photo(id: 1)->create(filePath: 'image.jpg');
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

## Error Handling

The PERSCOM SDK throws exceptions when an API error occurs. You can catch these exceptions and handle them accordingly with a standard `try/catch` block. For a more elegant approach to error handling, consider using the [promise-based](#promise-support) approach.

```php
try {
  $perscom = new PerscomConnection('YOUR_API_KEY');

  $response = $perscom->users()->all()->json();
} catch (AuthenticationException $exception) {
  Log::error('The provided API key is invalid');
}
```

## Promise Support
The PERSCOM SDK can send asynchronous requests using a promise-based approach. This allows you to handle both successful and failed requests in a more fluent way.

```php
// Create a PERSCOM instance
$perscom = new PerscomConnection('YOUR_API_KEY');

// Create a promise
$promise = $plaid->sendAsync(new GetAllUsersRequest());

// Send the request
$promise
    ->then(function (Response $response) {
        // Handle successful response
    })
    ->otherwise(function (RequestException $exception) {
        // Handle failed request
    });

// Resolve the promise
$promise->wait();
```

## Contributing

Please see [here](../.github/CONTRIBUTING.md) for more details about contributing.