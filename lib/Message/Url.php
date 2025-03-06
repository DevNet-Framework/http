<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

class Url
{
    private string $scheme;
    private Host $host;
    private string $path;
    private Query $query;

    public string $Scheme { get => $this->scheme; }
    public Host $Host { get => $this->host; }
    public string $Path { get => $this->path; set => $this->path = $value; }
    public Query $Query { get => $this->query; }

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

    public function __toString(): string
    {
        if (!empty($this->query->__toString())) {
            $this->scheme . "://" . $this->host . $this->path . "/?" . $this->query;
        }

        return $this->scheme . "://" . $this->host . $this->path;
    }
}
