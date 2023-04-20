<?php

namespace OwenVoke\Ecologi\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    /**
     * @return array|string
     */
    public static function getContent(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
        }

        return $body;
    }

    /**
     * @return array|void
     */
    public static function getPagination(ResponseInterface $response)
    {
        if (! $response->hasHeader('Link')) {
            return;
        }

        $header = self::getHeader($response, 'Link') ?? '';
        $pagination = [];
        foreach (explode(',', $header) as $link) {
            preg_match('/<(.*)>; rel="(.*)"/i', trim($link, ','), $match);

            if (3 === count($match)) {
                $pagination[$match[2]] = $match[1];
            }
        }

        return $pagination;
    }

    /**
     * Get the value for a single header.
     *
     * @param  string  $name
     * @return string|null
     */
    public static function getHeader(ResponseInterface $response, $name)
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }
}
