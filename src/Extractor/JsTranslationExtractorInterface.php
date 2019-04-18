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

/**
 * @author  Cyril MERY <cmery@coffreo.com>
 */
interface JsTranslationExtractorInterface
{
    /**
     * @param $content string
     * @param $collection TranslationCollection;
     *
     * @return TranslationCollection
     */
    public function extract($content, TranslationCollection $collection);
}
