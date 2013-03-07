## Metrics

Metrics is a container for keeping track of counters or any value for that
matter and for tracking time. A common application would be to use it for a
process that takes a few seconds for which various information should be
collected and then logged.

The collected data can be emitted as an array or as a JSON string.

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

The above is a construction with time tracking turned on and a single counter
that is incremented as a result of some process. The metrics container is then
emitted as an array.

#### Initialize multiple counters more efficiently

```php
<?php
$metrics = new Metrics(true);
$metrics->initMembers(array('counter1', 'counter2', 'counter3', 0))
```
This initializes the named counters to 0 with a single call.

#### Output as Array

```php
$arrayResult = $metrics->toArray();
<?php
```

#### Output as JSON

```php
$json = $metrics->toJson();
<?php
```

#### Sample output (JSON)

```json
{
    "counter1": 23,
    "counter2": 569,
    "elapsed-time": "00:00:24"
}
```

#### Note

For a more comprehensive solution take a look at [beberlei/metrics](http://github.com/beberlei/metrics).
