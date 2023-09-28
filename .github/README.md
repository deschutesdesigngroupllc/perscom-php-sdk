<p align="center"><img src="../art/header.png" alt="Logo"></p>

<div align="center">

# The Official PERSCOM PHP SDK

A PHP package that helps kickstart your next [PERSCOM](https://perscom.io) integration.

[![Test Suite](https://github.com/DeschutesDesignGroupLLC/perscom-php-sdk/actions/workflows/tests.yml/badge.svg)](https://github.com/DeschutesDesignGroupLLC/perscom-php-sdk/actions/workflows/tests.yml)
![Downloads](https://img.shields.io/packagist/dm/deschutesdesigngroupllc/perscom-php-sdk)

[Documentation](https://docs.perscom.io)

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

You can install the package using [Composer](https://getcomposer.org):

```shell
composer require deschutesdesigngroupllc/perscom-php-sdk
```

## Documentation

Visit our documentation [here](https://docs.perscom.io) to get started.

## Contributing

Please see [here](../.github/CONTRIBUTING.md) for more details about contributing.