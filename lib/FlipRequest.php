<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 08:29
 */

namespace lib;

/**
 * Class FlipRequest
 *
 * @package lib\FlipRequest
 */
class FlipRequest
{
    /**
     * FlipRequest constructor.
     */
    function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach($_SERVER as $key => $value)
        {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * @param $string
     * @return mixed|string
     */
    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach($matches[0] as $match)
        {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    /**
     * @return array|void
     */
    public function getBody()
    {
        if($this->requestMethod === "GET")
        {
            return (int) end(explode('/', $this->requestUri));
        }
        if ($this->requestMethod == "POST")
        {
            $body = array();
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }
    }
}