<?php

/**
 * This file is part of Coffreo project "coffreo/js-translation-extractor"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Coffreo\JsTranslationExtractor\Model\TranslationString;
use PHPUnit\Framework\TestCase;

/**
 * @author Cyril MERY <cmery@coffreo.com>
 *
 * @covers \Coffreo\JsTranslationExtractor\Model\TranslationString
 */
class TranslationStringTest extends TestCase
{
    public function testAIO()
    {
        $translation = new TranslationString('message', 42, ['foo' => 'bar']);
        $this->assertEquals('message', $translation->getMessage());
        $this->assertEquals(42, $translation->getLine());
        $this->assertEquals(['foo' => 'bar'], $translation->getContext());
        $this->assertEquals('bar', $translation->getContext('foo'));
        $this->assertNull($translation->getContext('invalid-key'));
    }
}
