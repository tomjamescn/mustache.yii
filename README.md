# Mustache.yii
[![Release](http://img.shields.io/packagist/v/cedx/yii-mustache.svg?style=flat)](https://packagist.org/packages/cedx/yii-mustache) [![License](http://img.shields.io/packagist/l/cedx/yii-mustache.svg?style=flat)](https://github.com/cedx/mustache.yii/blob/master/LICENSE.txt) [![Downloads](http://img.shields.io/packagist/dt/cedx/yii-mustache.svg?style=flat)](https://packagist.org/packages/cedx/yii-mustache) [![Build](http://img.shields.io/travis/cedx/mustache.yii.svg?style=flat)](https://travis-ci.org/cedx/mustache.yii)

[Mustache](http://mustache.github.io) templating for [Yii](http://www.yiiframework.com), high-performance [PHP](https://php.net) framework.

## Documentation
- [API Reference](http://dev.belin.io/mustache.yii/api)

## Installing via [Composer](https://getcomposer.org)
From a command prompt, run:

```shell
$ composer require cedx/yii-mustache
```

Now in your application configuration file, you can use the following view renderer:

```php
return [
  'aliases' => [
    'mustache' => 'ext.cedx.yii-mustache.lib',
  ],
  'components' => [
    'viewRenderer' => [
      'class' => 'mustache.CMustacheViewRenderer'
    ]
  ]
];
```

Adjust the values as needed. Here, it's supposed that [`CApplication->extensionPath`](http://www.yiiframework.com/doc/api/1.1/CApplication#extensionPath-detail), that is the [`ext`](http://www.yiiframework.com/doc/guide/1.1/en/basics.namespace) root alias, has been set to Composer's `vendor` directory.
The `mustache` alias must be defined prior to use the view renderer. The library classes rely on this alias to function properly.

## License
[Mustache.yii](https://packagist.org/packages/cedx/yii-mustache) is distributed under the MIT License.
