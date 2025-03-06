<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

use DevNet\System\Collections\Enumerator;
use DevNet\System\Collections\IEnumerable;

class Query implements IEnumerable
{
    private string $queryString;
    private array $values;

    public array $Values { get => $this->values; }

    public function __construct(?string $queryString = null)
    {
        $this->queryString = (string) $queryString;
        parse_str($this->queryString, $output);
        $this->values = $output;
    }

    public function Contains(string $key): bool
    {
        return isset($this->values[$key]) ? true : false;
    }

    public function getValue(string $key): ?string
    {
        return $this->values[$key] ?? null;
    }

    public function getIterator(): Enumerator
    {
        return new Enumerator($this->values);
    }

    public function __toString(): string
    {
        return $this->queryString;
    }
}
