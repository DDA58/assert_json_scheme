# Assert Json Scheme

## Description

This package provides an opportunity to assert JSON scheme

## Installation

Add repository to the service composer.json file

```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/DDA58/assert_json_scheme"
    }
]
```

And then require `dda58/assert_json_scheme` package

```bash
$ composer require dda58/assert_json_scheme
```

## Usage

### Usage for dict structure

```php
new RootDictNode([
    new BoolNamedNode('boolResult'),
    new DictNamedNode('dictWithInnerList', [
        new ListNamedNode(
            'listOfObjects',
            new DictNamelessNode([
                new IntNamedNode('id'),
                new StringNamedNode('name'),
                new ListNamedNode('values', new ListNamelessNode(new StringNamelessNode())),
            ])
        ),
    ]),
    new DictNamedNodeWithKeysAssertion(
        'dictWithInnerDict',
        new DictNamelessNode([
            new StringNamedNode('keyOne'),
            new BoolNamedNode('keyTwo'),
            new StringNamedNode('keyThree'),
        ]),
        new StringNamelessNode()
    ),
    new ListNamedNode('listOfStrings', new StringNamelessNode()),
])
```

```json
{
  "boolResult": false,
  "listOfStrings": [
    "Quasi autem laudantium nesciunt quia sit id quo.",
    "Illo itaque eveniet culpa est."
  ],
  "dictWithInnerList": {
    "listOfObjects": [
      {
        "id": 48545127,
        "name": "Accusamus esse et delectus dolor occaecati repellat aut.",
        "values": [
          [
            "eaque",
            "et"
          ]
        ]
      }
    ]
  },
  "dictWithInnerDict": {
    "key": {
      "keyOne": "deserunt",
      "keyTwo": true,
      "keyThree": "ut"
    }
  }
}
```

### Usage for list structure

```php
new RootListNode(
    new DictNamelessNode([
        new IntNamedNode('id'),
        new BoolNamedNode('boolResult'),
        new StringNamedNode('name'),
        new DictNamedNode('dict', [
            new IntNamedNode('int'),
            new FloatNamedNode('float'),
        ]),
    ])
)
```

```json
[
  {
    "id": 1,
    "boolResult": true,
    "name": "corporis",
    "dict": {
      "int": 948,
      "float": 154428400.754312
    }
  },
  {
    "id": 5151719,
    "boolResult": true,
    "name": "doloremque",
    "dict": {
      "int": 8647,
      "float": 0.707
    }
  }
]
```

### Changing from default to custom asserter for scalar or dict or list nodes

```php
AssertersContainer::setScalarAsserter(new class() implements ScalarAsserterInterface {});
AssertersContainer::setDictAsserter(new class() implements DictAsserterInterface {});
AssertersContainer::setListAsserter(new class() implements ListAsserterInterface {});
```

## Change log

Please see the [changelog](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ ./vendor/bin/phpunit tests
```

## Security

If you discover any security related issues, please email dda58denisov@gmail.com instead of using the issue tracker.

## Credits

- [Dmitrii Denisov][link-author]

## License

assert_json_scheme is open-sourced software licensed under the [MIT license](LICENSE).

[link-author]: https://github.com/dda58