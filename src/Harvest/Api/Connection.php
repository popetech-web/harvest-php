<?php
namespace Harvest\Api;

use GuzzleHttp\Client as GuzzleClient;
use Exception, InvalidArgumentException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Connection
 *
 * @namespace    Harvest\Api
 * @author     Joridos <joridoss@gmail.com>
 */
class Connection
{
    /**
     * Harvest options.
     *
     * @var array
     */
    protected $options = [
        'username' => '',
        'password' => '',
        'account'  => ''
    ];

    /**
     * The HTTP client to use for the requests.
     *
     * @var GuzzleClient
     */
    private $httpClient;

    /**
     * @param array $options
     */
    function __construct($options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Set the http client.
     *
     * @param GuzzleClient $client
     */
    public function setHttpClient(GuzzleClient $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Get a fresh instance of the http client.
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient))
        {
            $this->httpClient = new GuzzleClient([
                'base_uri' => $this->options['account'],
            ]);
        }

        return clone $this->httpClient;
    }

    /**
     * Builds and performs a request.
     *
     * @param  string $method
     * @param  string $url
     * @param  array  $options
     * @return array
     *
     * TODO: Should allow the user to recieve XML data also if they wish to.
     */
    public function request($method, $url, array $options = [])
    {
        $client = $this->getHttpClient();
        // Set headers to accept only json data.
        $options['headers']['User-Agent'] = 'PHP Wrapper Library for Harvest API';
        $options['headers']['Content-Type'] = 'application/json';
        $options['headers']['Accept'] = 'application/json';
        $options['headers']['Authorization'] = 'Basic (' . base64_encode( $this->options['username'] . ":" . $this->options['password'] ). ')';
        $request = $client->request($method, $url, $options);

        return (string)$request->getBody();
    }

    /**
     * Set the options.
     *
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Get a single option value.
     *
     * @param  string $option
     * @throws Exception
     * @return string
     */
    public function getOption($option)
    {
        if ( !array_key_exists($option, $this->options)) {
            throw new Exception("The requested option [$option] has not been set or is not a valid option key.");
        }

        return $this->options[$option];
    }

    /**
     * Generates a formatted http query string.
     *
     * @param  array $params
     * @return string
     */
    private function httpBuildQuery($params)
    {
        return '?' . http_build_query($params);
    }
}