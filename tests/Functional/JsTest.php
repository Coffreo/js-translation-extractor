<?php

/**
 * This file is part of Coffreo project "coffreo/js-translation-extractor"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Translation\Extractor\Tests\Functional;

use Coffreo\JsTranslationExtractor\Extractor\JsTranslationExtractor;
use Coffreo\JsTranslationExtractor\Model\TranslationCollection;
use Coffreo\JsTranslationExtractor\Model\TranslationString;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @covers \Coffreo\JsTranslationExtractor\Extractor\JsTranslationExtractor
 *
 * @author  Cyril MERY <cmery@coffreo.com>
 */
final class JsTest extends TestCase
{
    public function testExtractTrans()
    {
        $path = 'Js/trans.js';
        $collection = $this->getTranslationStrings($path);

        $this->assertValidExtraction($path, $collection->first(), 'arg-key', [], 1);
        $this->assertValidExtraction($path, $collection->get(1), 'arg-key-params', [], 2);
        $this->assertValidExtraction($path, $collection->get(2), 'arg-key-params-domain', ['domain' => 'domain_name'], 3);
        $this->assertValidExtraction($path, $collection->get(3), 'arg-key-params-filled', [], 4);
        $this->assertValidExtraction($path, $collection->get(4), 'multiline-arg-key-params-filled-domain', ['domain' => 'crazy-domain'], 5);
        $this->assertValidExtraction($path, $collection->get(5), 'multiline-tab-arg-key-params-filled-domain', ['domain' => 'real-crazy-domain'], 10);

        $this->assertCount(6, $collection);
    }

    public function testExtractTransChoice()
    {
        $path = 'Js/transChoice.js';
        $collection = $this->getTranslationStrings($path);

        $this->assertValidExtraction($path, $collection->first(), 'arg-key', [], 1);
        $this->assertValidExtraction($path, $collection->get(1), 'arg-key-params', [], 2);
        $this->assertValidExtraction($path, $collection->get(2), 'arg-key-params-domain', ['domain' => 'domain_name'], 3);
        $this->assertValidExtraction($path, $collection->get(3), 'arg-key-params-filled', [], 4);
        $this->assertValidExtraction($path, $collection->get(4), 'multiline-arg-key-params-filled-domain', ['domain' => 'crazy-domain'], 5);
        $this->assertValidExtraction($path, $collection->get(5), 'multiline-tab-arg-key-params-filled-domain', ['domain' => 'real-crazy-domain'], 10);

        $this->assertCount(6, $collection);
    }

    public function testExtractTransReact()
    {
        $path = 'Js/trans-react.jsx';
        $collection = $this->getTranslationStrings($path);

        $this->assertValidExtraction($path, $collection->first(), 'arg-key', [], 7);
        $this->assertValidExtraction($path, $collection->get(1), 'arg-key-params', [], 8);
        $this->assertValidExtraction($path, $collection->get(2), 'arg-key-params-domain', ['domain' => 'domain_name'], 9);
        $this->assertValidExtraction($path, $collection->get(3), 'arg-key-params-filled', [], 10);
        $this->assertValidExtraction($path, $collection->get(4), 'multiline-arg-key-params-filled-domain', ['domain' => 'crazy-domain'], 11);
        $this->assertValidExtraction($path, $collection->get(5), 'multiline-tab-arg-key-params-filled-domain', ['domain' => 'real-crazy-domain'], 16);

        $this->assertCount(6, $collection);
    }

    protected function assertValidExtraction($file, TranslationString $translation, $message, $context, $line)
    {
        $this->assertNotNull($translation, "No translation extracted ($file:$line)");
        $this->assertEquals($message, $translation->getMessage(), "Invalid message extracted ($file:$line)");
        $this->assertEquals($context, $translation->getContext(), "Invalid context extracted ($file:$line)");
        $this->assertEquals($line, $translation->getLine(), "Invalid line number extracted ($file:$line)");
    }

    private function getTranslationStrings($relativePath)
    {
        $extractor = new JsTranslationExtractor();

        $filename = \mb_substr($relativePath, 1 + \mb_strrpos($relativePath, '/'));
        $path = __DIR__.'/../Resources/'.\mb_substr($relativePath, 0, \mb_strrpos($relativePath, '/'));

        $finder = new Finder();
        $finder->files()->name($filename)->in($path);
        $collection = new TranslationCollection();
        foreach ($finder as $file) {
            $extractor->extract($file->getContents(), $collection);
        }

        return $collection;
    }
}
