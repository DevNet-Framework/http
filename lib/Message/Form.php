<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

class Form
{
    private array $fields;
    private FormFileCollection $files;

    public array $Fields { get => $this->fields; }
    public FormFileCollection $Files { get => $this->files; }

    public function __construct(array $fields = [], ?FormFileCollection $files = null)
    {
        if ($fields == []) {
            $fields = $_POST;
        }

        if (!$files) {
            $files = new FormFileCollection();
        }

        $this->fields = $fields;
        $this->files  = $files;
    }

    public function getValue(string $name)
    {
        return $this->fields[$name] ?? null;
    }

    public function count()
    {
        return count($this->fields);
    }
}
