<?php

/**
 * yar server 演示
 */
class API
{
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @return
     */
    public function api($parameter, $option = "foo")
    {
        var_dump($parameter, $option);
    }

    protected function client_can_not_see()
    {
    }
}

$service = new Yar_Server(new API());
$service->handle();