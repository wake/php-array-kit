# PHP Array Kit

Simple functions help using array in php.

## keyi ($array, $key, $gather = false)

```php

  //
  // Input
  //

  $input = [
    ['id' => 'A', 'title' => 'A apple', 'value' => 10],
    ['id' => 'B', 'title' => 'B bear',  'value' => 27],
    ['id' => 'C', 'title' => 'C Cat',   'value' => 10],
  ];


  //
  // Split array base on key
  //

  $output = keyi ($input, 'id');

  /*
  $output = [
    'A' => ['id' => 'A', 'title' => 'A apple', 'value' => 10],
    'B' => ['id' => 'B', 'title' => 'B bear',  'value' => 27],
    'C' => ['id' => 'C', 'title' => 'C Cat',   'value' => 10],
  ];
  */


  //
  // Base on multiple keys
  //

  $output = keyi ($input, ['id', 'title']);

  /*
  $output = [
    'A' => [
      'A apple' => ['id' => 'A', 'title' => 'A apple', 'value' => 10]
    ],
    'B' => [
      'B bear'  => ['id' => 'B', 'title' => 'B bear',  'value' => 27]
    ],
    'C' => [
      'C Cat'   => ['id' => 'C', 'title' => 'C Cat',   'value' => 10]
    ],
  ];
  */


  //
  // Gather elements
  //

  $output = keyi ($input, 'value', true);

  /*
  $output = [
    '10' => [
      ['id' => 'A', 'title' => 'A apple', 'value' => 10],
      ['id' => 'B', 'title' => 'B bear',  'value' => 27],
    ],
    '27' => [
      ['id' => 'C', 'title' => 'C Cat',   'value' => 10],
    ]
  ];
  */

```

## dig ($array, $key = false, $deep = 1)

```php

  //
  // Input
  //

  $input = [
    'A' => [
      'id' => 'A',
      'A apple' => [
        'value' => 10
      ]
    ],
    'B' => [
      'id' => 'B',
      'B bear' => [
        'value' => 27
      ]
    ],
    'C' => [
      'id' => 'C',
      'C Cat' => [
        'value' => 10
      ]
    ],
  ];

  //
  // Dig value from array
  //

  $output = dig ($input, 'id');

  /*
  $output = [
    0 => 'A',
    1 => 'B',
    2 => 'C',
  ];
  */

  //
  // Dig deeply
  //

  $output = dig ($input, 'value', 2);

  /*
  $output = [
    0 => 10,
    1 => 27,
    2 => 10,
  ];
  */

```

## otoa ($object)

Object to array, get array from object values.

## Installation

Add in your `composer.json` with following require entry:

```json
{
  "require": {
    "wake/php-array-kit": "*"
  }
}
```

or using composer:

```bash
$ composer require wake/php-array-kit:*
```

then run `composer install` or `composer update`.

## Feedback

Please feel free to open an issue and let me know if there is any thoughts or questions :smiley:

## License

Released under the MIT license
