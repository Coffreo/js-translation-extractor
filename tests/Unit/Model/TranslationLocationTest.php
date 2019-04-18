<?php

/**
 * This file is part of Coffreo project "coffreo/js-translation-extractor"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Coffreo\JsTranslationExtractor\Model\TranslationLocation;
use PHPUnit\Framework\TestCase;

/**
 * @author Cyril MERY <cmery@coffreo.com>
 *
 * @covers \Coffreo\JsTranslationExtractor\Model\TranslationLocation
 */
class TranslationLocationTest extends TestCase
{
    public function testAIO()
    {
        $location = new TranslationLocation('message', 42, ['foo' => 'bar']);
        $this->assertEquals('message', $location->getMessage());
        $this->assertEquals(42, $location->getLine());
        $this->assertEquals(['foo' => 'bar'], $location->getContext());
        $this->assertEquals('bar', $location->getContext('foo'));
        $this->assertNull($location->getContext('invalid-key'));
    }
}
