<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

use DevNet\System\IO\FileAccess;
use DevNet\System\IO\FileMode;
use DevNet\System\IO\FileStream;
use DevNet\System\IO\Stream;

class HttpRequest extends HttpMessage
{
    private string $method;
    private Url $url;
    private Form $form;
    public array $RouteValues = [];

    public function __construct(string $method, string $url, ?Headers $headers = null, ?Stream $body = null, ?Form $form = null)
    {
        $this->method  = strtoupper($method);
        $this->url     = new Url($url);
        $this->headers = $headers ?? new Headers(['Host' => $this->url->Host]);
        $this->cookies = new Cookies($this->Headers);
        $this->body    = $body ?? new FileStream('php://temp', FileMode::Open, FileAccess::ReadWrite);
        $this->form    = $form ?? new Form();
    }

    public function get_Method(): string
    {
        return $this->method;
    }

    public function get_Url(): Url
    {
        return $this->url;
    }

    public function get_Form(): Form
    {
        return $this->form;
    }
}
