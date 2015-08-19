<?php

namespace Porous\Database\Connectors;

interface ConnectorInterface
{
    /**
     * @param array $config
     * @return mixed
     */
    public function connect(array $config);
}