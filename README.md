# Mustache.yii
[![Release](http://img.shields.io/packagist/v/cedx/yii2-mustache.svg)](https://packagist.org/packages/cedx/yii2-mustache) [![License](http://img.shields.io/packagist/l/cedx/yii2-mustache.svg)](https://bitbucket.org/cedx/mustache.yii/src/master/LICENSE.txt) [![Downloads](http://img.shields.io/packagist/dt/cedx/yii2-mustache.svg)](https://packagist.org/packages/cedx/yii2-mustache) ![Build](https://img.shields.io/codeship/fc8e1cd0-bc21-0132-257d-7ab97aac1fb6.svg)

[Mustache](http://mustache.github.io) templating for [Yii](http://www.yiiframework.com), high-performance [PHP](https://php.net) framework.

This package provides a view renderer, the `yii\mustache\ViewRenderer` class. This renderer allows to use [Mustache syntax](http://mustache.github.io/mustache.5.html) in view templates.

## Documentation
- [API Reference](http://api.belin.io/mustache.yii)

## Installing via [Composer](https://getcomposer.org)
From a command prompt, run:

```shell
$ composer require cedx/yii2-mustache
```

## Configuring Application
In order to start using Mustache you need to configure the `view` application component, like the following:

```php
return [
  'components' => [
    'view' => [
      'class' => 'yii\web\View',
      'renderers' => [
        'mustache' => 'yii\mustache\ViewRenderer'
      ]
    ]
  ]
];
```

After it's done you can create templates in files that have the `.mustache` extension (or use another file extension but
configure the component accordingly). Unlike standard view files, when using Mustache you must include the extension
in your `$this->render()` controller call:

```php
return $this->render('template.mustache', [ 'model' => 'The view model' ]);
```

## Template Syntax
The best resource to learn Mustache basics is its official documentation you can find at [mustache.github.io](http://mustache.github.io). Additionally there are Yii-specific syntax extensions described below.

#### Variables
Within Mustache templates the following variables are always defined:

- `app`: the [`\Yii::$app`](http://www.yiiframework.com/doc-2.0/yii-baseyii.html#$app-detail) instance.
- `this`: the current [`View`](http://www.yiiframework.com/doc-2.0/yii-web-view.html) object.
- `yii.debug`: the `YII_DEBUG` constant.
- `yii.env`: the `YII_ENV` constant.

#### Lambdas
- `format`: provides a set of commonly used data formatting methods.
- `html`: provides a set of methods for generating commonly used HTML tags.
- `i18n`: provides features related with internationalization (I18N) and localization (L10N).

#### Partials
There are two ways of referencing partials:

```
{{> post }}
{{> @app/views/layouts/2columns }}
```

In the first case the view will be searched relatively to the current view path. For `post.mustache`
that means these will be searched in the same directory as the currently rendered template.

In the second case we're using path aliases. All the Yii aliases such as `@app` are available by default.

## License
[Mustache.yii](https://packagist.org/packages/cedx/yii2-mustache) is distributed under the MIT License.
