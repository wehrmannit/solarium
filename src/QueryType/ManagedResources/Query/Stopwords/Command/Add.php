<?php

/*
 * This file is part of the Solarium package.
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code.
 */

namespace Solarium\QueryType\ManagedResources\Query\Stopwords\Command;

use Solarium\Core\Client\Request;
use Solarium\QueryType\ManagedResources\Query\AbstractCommand;
use Solarium\QueryType\ManagedResources\Query\Stopwords;

/**
 * Add.
 */
class Add extends AbstractCommand
{
    /**
     * Stopwords to add.
     *
     * @var array
     */
    protected $stopwords;

    /**
     * Returns command type, for use in adapters.
     *
     * @return string
     */
    public function getType(): string
    {
        return Stopwords::COMMAND_ADD;
    }

    /**
     * Returns request method.
     *
     * @return string
     */
    public function getRequestMethod(): string
    {
        return Request::METHOD_PUT;
    }

    /**
     * Get stopwords.
     *
     * @return array
     */
    public function getStopwords(): array
    {
        return $this->stopwords;
    }

    /**
     * Set stopwords.
     *
     * @param array $stopwords
     *
     * @return self
     */
    public function setStopwords(array $stopwords): self
    {
        $this->stopwords = $stopwords;

        return $this;
    }

    /**
     * Returns the data to be sent to Solr.
     *
     * @return string
     */
    public function getRawData(): string
    {
        return json_encode($this->stopwords);
    }

    /**
     * Returns the term to be sent to Solr.
     *
     * @return string
     */
    public function getTerm(): string
    {
        return '';
    }
}
