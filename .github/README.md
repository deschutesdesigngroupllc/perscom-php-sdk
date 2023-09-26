<p align="center"><img src="/resources/images/header.png" alt="Logo"></p>

<div align="center">

# The Official PERSCOM PHP SDK

A PHP packages that helps kickstart your next [PERSCOM](https://perscom.io) integration.

[![Test Status](https://github.com/DeschutesDesignGroupLLC/perscom-php-sdk/actions/workflows/tests.yml/badge.svg)](https://img.shields.io/github/actions/workflow/status/DeschutesDesignGroupLLC/perscom-php-sdk/tests.yml?label=tests)
![Downloads](https://img.shields.io/packagist/dm/sammyjo20/saloon)

[Documentation](https://docs.pescom.io)

</div>

## Introduction
The PERSCOM PHP SDK is a powerful tool that enables seamless integration with the PERSCOM platform, allowing you to interact with PERSCOM's personnel data programmatically.

```php
<?php

$perscom = new PerscomConnection('api-token', 'perscom-id');

$response = $perscom->users()->all();

$data = $response->json();
```

## Getting Started

Visit our documentation [here](https://docs.perscom.io) to get started.

## Contributing

Please see [here](../.github/CONTRIBUTING.md) for more details about contributing.