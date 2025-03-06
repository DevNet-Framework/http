<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Client;

use DevNet\Http\Message\HttpRequest;
use DevNet\System\Async\Task;

class HttpClient extends HttpClientHandler
{
    protected HttpClientOptions $options;

    public HttpClientOptions $Options { get => $this->options; }

    public function __construct(?HttpClientOptions $options = null)
    {
        if (!$options) {
            $options = new HttpClientOptions();
        }

        $this->options = $options;
    }

    public function requestAsync(string $method, string $url, ?HttpRequestContent $requestContent = null): Task
    {
        if (!empty($this->Options->BaseAddress)) {
            $url = $this->Options->BaseAddress . $url;
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (!$scheme) {
            $url = "http://" . $url;
        }

        $request = new HttpRequest($method, $url);
        $request->setProtocol($this->Options->HttpVersion);
        if ($requestContent) {
            $request->Headers->add('Content-Type', $requestContent->ContentType);
            $request->Headers->add('Content-Length', $requestContent->ContentLength);
            $request->Body->write($requestContent->Content);
        }

        return $this->sendAsync($request);
    }

    public function getStringAsync(string $url, ?HttpRequestContent $requestContent = null): Task
    {
        $task = $this->getAsync($url, $requestContent);
        return $task->then(function (Task $antecedent) {
            $response = $antecedent->Result;
            if ($response->Body->IsReadable) {
                if ($response->Body->Length > 0) {
                    return $response->Body->read($response->Body->Length);
                }

                return '';
            }
        });
    }

    public function getAsync(string $url, ?HttpRequestContent $requestContent = null): Task
    {
        return $this->requestAsync('GET', $url, $requestContent);
    }

    public function postAsync(string $url, ?HttpRequestContent $requestContent): Task
    {
        return $this->requestAsync('POST', $url, $requestContent);
    }

    public function putAsync(string $url, ?HttpRequestContent $requestContent): Task
    {
        return $this->requestAsync('PUT', $url, $requestContent);
    }

    public function deleteAsync(string $url): Task
    {
        return $this->requestAsync('DELETE', $url);
    }
}
