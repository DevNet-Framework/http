<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

use DevNet\System\IO\Stream;

abstract class HttpMessage
{
    protected string $protocol = 'HTTP/1.0';
    protected Headers $headers;
    protected Cookies $cookies;
    protected ?Stream $body;

    public string $Protocol { get => $this->protocol; }
    public Headers $Headers { get => $this->headers; }
    public Cookies $Cookies { get => $this->cookies; }
    public ?Stream $Body { get => $this->body; }

    public function setProtocol(string $protocol)
    {
        $this->protocol = $protocol;
    }
}
