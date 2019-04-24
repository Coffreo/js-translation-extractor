<?php

/**
 * This file is part of Coffreo project "coffreo/js-translation-extractor"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\JsTranslationExtractor\Extractor;

use Coffreo\JsTranslationExtractor\Model\TranslationCollection;
use Coffreo\JsTranslationExtractor\Model\TranslationString;

/**
 * @author  Cyril MERY <cmery@coffreo.com>
 */
class JsTranslationExtractor implements JsTranslationExtractorInterface
{
    /**
     * @param $content string
     * @param $collection TranslationCollection;
     *
     * @return TranslationCollection
     */
    public function extract($content, TranslationCollection $collection)
    {
        $this->addTransMessages($content, $collection);
        $this->addTransChoiceMessages($content, $collection);

        return $collection;
    }

    /**
     * Extract `trans(...)` parts from javascript string.
     *
     * @param string                $fileContent
     * @param TranslationCollection $collection
     */
    private function addTransMessages($fileContent, $collection)
    {
        // see https://regex101.com/r/SV1m7G/1/
        $pattern = '/trans\(\s*("(?:[^"\\\\]|\\\\.)*"|\'(?:[^\'\\\\]|\\\\.)*\')((?:,|\))\s*{.*?}((?:\))|,\s*("(?:[^"\\\\]|\\\\.)*"|\'(?:[^\'\\\\]|\\\\.)*\'))|\))/ms';
        if (\preg_match_all($pattern, $fileContent, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[1] as $i => $keyInfo) {
                $line = $this->getLineNumber($fileContent, $matches[0][$i][1]);
                $message = $this->cleanQuotedString($keyInfo[0]);
                $quotedDomain = empty($matches[4][$i]) ? null : $matches[4][$i][0];
                $context = $quotedDomain ? ['domain' => $this->cleanQuotedString($quotedDomain)] : [];
                $collection->addTranslation(new TranslationString($message, $line, $context));
            }
        }
    }

    /**
     * Extract `transChoice(...)` parts from javascript string.
     *
     * @param string                $fileContent
     * @param TranslationCollection $collection
     */
    private function addTransChoiceMessages($fileContent, $collection)
    {
        // see https://regex101.com/r/FZufaJ/3
        $pattern = '/transChoice\(\s*("(?:[^"\\\\]|\\\\.)*"|\'(?:[^\'\\\\]|\\\\.)*\')((?:,|\)))\s*((?:,|[A-Za-z0-9.,]*))((?:,|\)))\s*({.*?}((?:\))|,\s*("(?:[^"\\\\]|\\\\.)*"|\'(?:[^\'\\\\]|\\\\.)*\'))|\))?/ms';
        if (\preg_match_all($pattern, $fileContent, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[1] as $i => $keyInfo) {
                $line = $this->getLineNumber($fileContent, $matches[0][$i][1]);
                $message = $this->cleanQuotedString($keyInfo[0]);
                $quotedDomain = empty($matches[7][$i]) ? null : $matches[7][$i][0];
                $context = $quotedDomain ? ['domain' => $this->cleanQuotedString($quotedDomain)] : [];
                $collection->addTranslation(new TranslationString($message, $line, $context));
            }
        }
    }

    /**
     * Return line number of character at supplied offset inside string.
     *
     * @param $str string string
     * @param $offset integer
     *
     * @return int line number of offset char in str
     */
    private function getLineNumber($str, $offset)
    {
        return \count(\explode("\n", \mb_substr($str, 0, $offset)));
    }

    /**
     * remove string delimiter (' or ").
     *
     * @param $str
     *
     * @return bool|string
     */
    private function cleanQuotedString($str)
    {
        return \mb_substr($str, 1, -1);
    }
}
