<?php

/**
 * This file is part of Coffreo project "coffreo/js-translation-extractor"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\JsTranslationExtractor\Model;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class TranslationCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var TranslationString[]
     */
    private $translationStrings = [];

    public function getIterator()
    {
        return new \ArrayIterator($this->translationStrings);
    }

    public function count()
    {
        return count($this->translationStrings);
    }

    /**
     * @param TranslationString $translation
     */
    public function addTranslation(TranslationString $translation)
    {
        $this->translationStrings[] = $translation;
    }

    /**
     * @return TranslationString|null
     */
    public function first()
    {
        if (empty($this->translationStrings)) {
            return;
        }

        return reset($this->translationStrings);
    }

    /**
     * @param $key
     *
     * @return TranslationString|null
     */
    public function get($key)
    {
        if (!isset($this->translationStrings[$key])) {
            return;
        }

        return $this->translationStrings[$key];
    }
}
