[![Code Climate](https://codeclimate.com/github/joridos/harvest-php/badges/gpa.svg)](https://codeclimate.com/github/joridos/harvest-php)
[![Test Coverage](https://codeclimate.com/github/joridos/harvest-php/badges/coverage.svg)](https://codeclimate.com/github/joridos/harvest-php/coverage)
[![Issue Count](https://codeclimate.com/github/joridos/harvest-php/badges/issue_count.svg)](https://codeclimate.com/github/joridos/harvest-php)

# harvest-php

PHP wrapper Library for the Harvest API with Laravel 5 support

## Usage

### Configuration

Add the key `harvest` to the `config/services.php` file with an array of options:
- `username`: The username
- `password`: The password
- `account`: The account

### Using the wrapper

Inject the service into one of your controller constructors like so:
```
public function __construct(\Harvest\Harvest $harvest)
{
  $this->harvest = $harvest;
}
```

Then you can use it anywhere in the controller:
```
public function index()
{
  $clients = $this->harvest->getClients();
}
```
