# Coffreo/js-translation-extractor

By [Coffreo](https://coffreo.biz)

[![Build Status](https://travis-ci.org/Coffreo/js-translation-extractor.svg?branch=master)](https://travis-ci.com/Coffreo/js-translation-extractor)
[![codecov](https://codecov.io/gh/Coffreo/js-translation-extractor/branch/master/graph/badge.svg)](https://codecov.io/gh/Coffreo/js-translation-extractor)

#### Javascript translations extractor for [`willdurand/js-translation-bundle`](https://github.com/willdurand/BazingaJsTranslationBundle)

This package is a small project existing to store in one place wonderfuls regexps to properly export translations 
strings & metas from javascript source files.  
It can be used standalone, but it's main goal is to be used in :
* [`coffreo/jms-translation-js-extractor-bundle`](https://github.com/Coffreo/jms-translation-js-extractor-bundle)
* [`coffreo/php-translation-js-extractor-bundle`](https://github.com/Coffreo/php-translation-js-extractor-bundle)

## Installation

* You only need to install this package manually for standalone usage and to integrate in your own translation extractor system:

  ```
  composer require coffreo/js-translation-extractor
  ```


* Using with Symfony [JMSTranslationBundle](https://github.com/schmittjoh/JMSTranslationBundle)  

  see  [`coffreo/jms-translation-js-extractor-bundle`](https://github.com/Coffreo/jms-translation-js-extractor-bundle) installation guide.

* Using with Symfony [PHP Translation](https://php-translation.readthedocs.io/en/latest/)

  see [`coffreo/php-translation-js-extractor-bundle`](https://github.com/Coffreo/php-translation-js-extractor-bundle) installation guide.


## Features

* extracts following strings from javascript files like a pro

```js
trans('MESSAGE', {param: 'foo'}, 'DOMAIN')
//    ^ 1st parameter is translation message
//                               ^ 3rd parameter is translation domain

transChoice('MESSAGE_WITH_PLURALS', 3, {param: 'foo'}, 'DOMAIN')
//          ^ 1st parameter is translation message      
//                                                     ^ 4th parameter is translation domain

// others parameters aren't extracted because they are useless. 
```

*Note that this is the syntax used by [`js-translation-bundle`](https://github.com/willdurand/BazingaJsTranslationBundle)*

* allow string delimiters to be  `"` or `'`
* extracts multi-lines commands

## Usage

```php
use Coffreo\JsTranslationExtractor\Extractor\JsTranslationExtractor;
use Coffreo\JsTranslationExtractor\Model\TranslationCollection;

$extractor = new JsTranslationExtractor();
$translationCollection = new TranslationCollection();

$extractor->extract(<<<FILECONTENT
import Translator from 'bazinga-translator';

export default () => Translator.trans('This is awesome', {}, 'foo');
export {
    bad: () => Translator.trans('This is ugly');
};
FILECONTENT
    , $translationCollection);

$first = $translationCollection->first();
$first->getMessage();  // This is awesome
$first->getLine();     // 3
$first->getContext();  // ['domain' => 'foo']

$second = $translationCollection->get(1);
$second->getMessage();  // This is ugly
$second->getLine();     // 5
$second->getContext();  // []

```

## Found a bug

Please fill an issue with informations to reproduce bug.

If your translated strings are not extracted properly, please provide a sample failing string.


## Development

* Clone repository
* Execute
```shell
make [install]   # to init composer after install
make test        # to run test
```

## TODO

* Find a way to add and extract desc/meaning values

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) file for details
