<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Message;

class ContentType
{
    public const Html = 'text/html';
    public const Text = 'text/plain';
    public const Gif  = 'image/gif';
    public const Png  = 'image/png';
    public const Jpeg = 'image/jpeg';
    public const Json = 'application/json';
    public const Pdf  = 'application/pdf';
    public const Form = 'application/x-www-form-urlencoded';
    public const Data = 'multipart/form-data';
}
