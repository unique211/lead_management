<?php
/**
 * Author: sagar <sam.coolone70@gmail.com>
 *
 */

namespace Outlook\ApiRequester;

use GuzzleHttp\Psr7\Request;
use Outlook\Authorizer\Token;
use Outlook\Exceptions\Authorizer\TokenException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var array
     */
    protected $requestOptions;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var Token
     */
    protected $accessToken;

    /**
     * Client constructor.
     * @param Token $token
     * @param string $baseUri
     * @param array $requestOptions
     */
    public function __construct(Token $token, $baseUri = '', $requestOptions = [])
    {
       
        $this->baseUri = $baseUri;
        $this->accessToken = $token;
        $this->requestOptions = $requestOptions;
        $this->client = new \GuzzleHttp\Client();

       // print_r($this->client);
    }

    public function call($uri = '/me', $method = "get", $params = [])
    {
        if ($this->accessToken->isExpired()) {
            throw new TokenException('Token is expired or invalid');
        }
        if (count($params)) {
            if ($method === 'get') {
                $uri .= '?'. $this->buildQuery($params);
            } else {
                $this->requestOptions['json'] = $params;
            }
        }
       // print_r($this->baseUri.$uri);
        $request = new Request($method, $this->baseUri.$uri);
        //print_r($request);
        //print_r($this->requestOptions);
        //$response = $this->client->send($request, $this->requestOptions);
        //print_r($response);
       // return $this->decode($response);
        try {
            $response = $this->client->send($request, $this->requestOptions);
           
            return $this->decode($response);
        } catch (\Exception $e) {
            // catch guzzle exceptions
           
           // print_r($this->requestOptions);
            return $this->decode($e->getResponse());
        }
    }

    /**
     * @param array $params
     * @return string
     */
    protected function buildQuery($params = [])
    {
        $queryString = '';
        foreach ($params as $key => $value) {
            $queryString .= "$key=$value&";
        }
        return rtrim($queryString, '&');
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    protected function decode(ResponseInterface $response)
    {
        $exception = json_decode((string) $response->getBody());

        //print_r($response);
        @$exception->statusCode = $response->getStatusCode();
        return $exception;
    }
}
