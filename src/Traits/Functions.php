<?php

namespace RevendaTeste\Traits;

trait Functions
{
    public function escapeParam(string $param): string
    {
        return addslashes(htmlspecialchars(trim($param)));
    }
}
