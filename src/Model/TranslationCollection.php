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
     * @var TranslationLocation[]
     */
    private $translationLocations = [];

    public function getIterator()
    {
        return new \ArrayIterator($this->translationLocations);
    }

    public function count()
    {
        return count($this->translationLocations);
    }

    /**
     * @param TranslationLocation $location
     */
    public function addLocation(TranslationLocation $location)
    {
        $this->translationLocations[] = $location;
    }

    /**
     * @return TranslationLocation|null
     */
    public function first()
    {
        if (empty($this->translationLocations)) {
            return;
        }

        return reset($this->translationLocations);
    }

    /**
     * @param $key
     *
     * @return TranslationLocation|null
     */
    public function get($key)
    {
        if (!isset($this->translationLocations[$key])) {
            return;
        }

        return $this->translationLocations[$key];
    }
}
