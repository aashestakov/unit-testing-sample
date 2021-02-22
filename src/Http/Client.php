<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 21.02.2021
 * Time: 19:24
 */

namespace Shestakov\Http;


class Client
{
    public function getData(): string
    {
        return file_get_contents('https://jsonplaceholder.typicode.com/posts');
    }
}