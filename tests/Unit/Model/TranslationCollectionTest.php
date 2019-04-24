<?php

/**
 * This file is part of Coffreo project "coffreo/js-translation-extractor"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Coffreo\JsTranslationExtractor\Model\TranslationCollection;
use Coffreo\JsTranslationExtractor\Model\TranslationString;
use PHPUnit\Framework\TestCase;

/**
 * @author Cyril MERY <cmery@coffreo.com>
 *
 * @covers \Coffreo\JsTranslationExtractor\Model\TranslationCollection
 */
class TranslationCollectionTest extends TestCase
{
    public function testEmptyCollection()
    {
        $collection = new TranslationCollection();
        $this->assertNull($collection->first());
        $this->assertNull($collection->get(42));
        $this->assertNull($collection->get('foo'));
        $this->assertCount(0, $collection->getIterator());
    }

    public function testAddTranslation()
    {
        $translation = new TranslationString('message', 42);
        $collection = new TranslationCollection();
        $collection->addTranslation($translation);
        $this->assertEquals($translation, $collection->first());
        $this->assertEquals($translation, $collection->get(0));
        $this->assertCount(1, $collection->getIterator());
        $this->assertEquals(1, $collection->count());
    }
}
