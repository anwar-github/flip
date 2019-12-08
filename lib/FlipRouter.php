<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 08:24
 */

namespace lib;

/**
 * Class FlipRouter
 */
class FlipRouter
{
    /**
     * @var
     */
    private $request;

    /**
     * @var array
     */
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    /**
     * FlipRouter constructor.
     * @param $request
     */
    function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param $name
     * @param $args
     */
    function __call($name, $args)
    {
        list($route, $method) = $args;
//        var_dump($args);die();
        if(!in_array(strtoupper($name), $this->supportedHttpMethods)) $this->invalidMethodHandler();

        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * @param $route
     * @return string
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') return '/';

        return $result;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * Resolves a route
     */
    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];
        if(is_null($method)) {
            $formatedRoute = $this->params();
            $method = $methodDictionary[$formatedRoute];
            if(is_null($method)) return $this->defaultRequestHandler();
        }
        header('Content-Type: application/json');
        echo call_user_func_array($method, array($this->request));
    }

    private function params()
    {
        if ($this->request->requestMethod === 'GET') {
            $explode = explode('/', $this->request->requestUri);
            array_pop($explode);

            return implode('/', $explode) . '/{id}';
        }
    }

    function __destruct()
    {
        $this->resolve();
    }
}