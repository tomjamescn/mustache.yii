# Mustache.yii
[![Release](http://img.shields.io/packagist/v/cedx/yii2-mustache.svg?style=flat)](https://packagist.org/packages/cedx/yii2-mustache) [![License](http://img.shields.io/packagist/l/cedx/yii2-mustache.svg?style=flat)](https://github.com/cedx/mustache.yii/blob/master/LICENSE.txt) [![Downloads](http://img.shields.io/packagist/dt/cedx/yii2-mustache.svg?style=flat)](https://packagist.org/packages/cedx/yii2-mustache) [![Build](http://img.shields.io/travis/cedx/mustache.yii.svg?style=flat)](https://travis-ci.org/cedx/mustache.yii)

[Mustache](http://mustache.github.io) templating for [Yii](http://www.yiiframework.com), high-performance [PHP](https://php.net) framework.

This package provides a view renderer, the `yii\mustache\ViewRenderer` class. This renderer allows to use Mustache syntax in view templates.

## Documentation
- [API Reference](http://dev.belin.io/mustache.yii/api)

## Installing via [Composer](https://getcomposer.org)
From a command prompt, run:

```shell
$ composer require cedx/yii2-mustache
```

Now in your application configuration file, you can use the following view renderer:

```php
return [
  'view' => [
    'class' => 'yii\\web\\View',
    'renderers' => [
      'mustache' => 'yii\\mustache\\ViewRenderer'
    ]
  ]
];
```

## License
[Mustache.yii](https://packagist.org/packages/cedx/yii2-mustache) is distributed under the MIT License.
