<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

use DevNet\System\PropertyTrait;

class Host
{
    use PropertyTrait;

    private string $name;
    private int $port;

    public function __construct(string $name, int $port)
    {
        $this->name = $name;
        $this->port = $port;
    }

    public function get_Name(): string
    {
        return $this->name;
    }

    public function get_Port(): ?int
    {
        return $this->port;
    }

    public function __toString(): string
    {
        if ($this->port == 0 || $this->port == 80 || $this->port == 443) {
            return $this->name;
        }

        return $this->name . ':' . $this->port;
    }
}
