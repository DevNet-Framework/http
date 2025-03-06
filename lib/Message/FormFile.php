<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

class FormFile
{
    private ?string $name;
    private ?string $type;
    private ?string $temp;
    private ?int $size;
    private ?int $error;

    public ?string $Name { get => $this->name; }
    public ?string $Type { get => $this->type; }
    public ?string $Temp { get => $this->temp; }
    public ?int $Size { get => $this->size; }
    public ?int $Error { get => $this->error; }

    public function __construct(string $name, string $type, string $temp, int $size, int $error)
    {
        $this->name  = $name;
        $this->type  = $type;
        $this->temp  = $temp;
        $this->size  = $size;
        $this->error = $error;
    }

    public function copyTo(string $target): bool
    {
        return copy($this->temp, $target);
    }
}
