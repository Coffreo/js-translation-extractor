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
final class TranslationLocation
{
    /**
     * Translation key.
     *
     * @var string
     */
    private $message;

    /**
     * @var int
     */
    private $line;

    /**
     * @var array
     */
    private $context;

    /**
     * @param string $message
     * @param int    $line
     * @param array  $context
     */
    public function __construct($message, $line, array $context = [])
    {
        $this->message = $message;
        $this->line = $line;
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param string $key
     *
     * @return array|mixed
     */
    public function getContext($key = null)
    {
        if ($key) {
            return empty($this->context[$key]) ? null : $this->context[$key];
        }

        return $this->context;
    }
}
