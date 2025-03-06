<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

class Host
{
    private string $name;
    private int $port;

    public string $Name { get => $this->name; }
    public int $Port { get => $this->port; }

    public function __construct(string $name, int $port)
    {
        $this->name = $name;
        $this->port = $port;
    }

    public function __toString(): string
    {
        if ($this->port == 0 || $this->port == 80 || $this->port == 443) {
            return $this->name;
        }

        return $this->name . ':' . $this->port;
    }
}
