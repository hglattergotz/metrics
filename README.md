[![Build Status](https://travis-ci.org/hglattergotz/metrics.svg)](https://travis-ci.org/hglattergotz/metrics)
[![Latest Stable Version](https://poser.pugx.org/hgg/metrics/v/stable.svg)](https://packagist.org/packages/hgg/metrics)
[![License](https://poser.pugx.org/hgg/metrics/license.svg)](https://packagist.org/packages/hgg/metrics)
[![Code Climate](https://codeclimate.com/github/hglattergotz/metrics/badges/gpa.svg)](https://codeclimate.com/github/hglattergotz/metrics)

Metrics is a container for keeping track of counters or any value for that
matter and for tracking time. A common application would be to use it for a
process that takes a few seconds for which various information should be
collected and then logged.

The collected data can be emitted as an array or as a JSON string.

### Installation

Using Composer:

```json
{
    "require": {
        "hgg/metrics": "*"
    }
}
```

### Usage

#### Simple use case

```php
<?php
$metrics = new Metrics(true);
$metrics->myCounter = 0;

while (1) {
    // Do some work
    ++$metrics->myCounter;
}

print_r($metrics->toArray());
```

The above constructs a Metrics object with time tracking turned on and a single
counter that is incremented as a result of some process. The metrics container
is then emitted as an array.

#### Initialize multiple counters more efficiently

```php
<?php
$metrics = new Metrics(true);
$metrics->initMembers(array('counter1', 'counter2', 'counter3'), 0);
```
This initializes the named counters to 0 with a single call.

#### Output to Array

```php
<?php
$arrayResult = $metrics->toArray();
```

#### Output to JSON

```php
<?php
$json = $metrics->toJson();
```

#### Sample output (JSON)

```json
{
  "counter1": 23,
  "counter2": 569,
  "counter3": 0,
  "elapsed-time": "00:00:24"
}
```

#### Note

For a more comprehensive solution take a look at [beberlei/metrics](http://github.com/beberlei/metrics).
