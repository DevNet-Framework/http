<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

use DevNet\System\PropertyTrait;

class Url
{
    use PropertyTrait;

    private string $scheme;
    private Host $host;
    public string $path;
    private Query $query;

    public function __construct(string $url)
    {
        $this->scheme  = (string) parse_url($url, PHP_URL_SCHEME);
        if (!$this->scheme) {
            $this->scheme = 'http';
            $url = $this->scheme . '://' . $url;
        }

        $host = parse_url($url, PHP_URL_HOST);
        if ($host == null) {
            throw new HttpException("Invalid Url: {$url}", 400, 1);
        }

        $port = parse_url($url, PHP_URL_PORT);
        if ($port == null) {
            $port = 80;
            if ($this->scheme == "https") {
                $port = 443;
            }
        }

        $this->host = new Host($host, $port);
        $this->path = parse_url($url, PHP_URL_PATH) ?? '/';

        $query = parse_url($url, PHP_URL_QUERY);
        $this->query = new Query($query);
    }

    public function get_Scheme(): string
    {
        return $this->scheme;
    }

    public function get_Host(): Host
    {
        return $this->host;
    }

    public function get_Path(): string
    {
        return $this->path;
    }

    public function get_Query(): Query
    {
        return $this->query;
    }

    public function set_Path(string $value): void
    {
        $this->path = $value;
    }

    public function __toString(): string
    {
        if (!empty($this->query->__toString())) {
            $this->scheme . "://" . $this->host . $this->path . "/?" . $this->query;
        }

        return $this->scheme . "://" . $this->host . $this->path;
    }
}
