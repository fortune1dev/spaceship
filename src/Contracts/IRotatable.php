<?php

declare(strict_types=1);

namespace App\Contracts;

interface IRotatable
{
    public function getAngle(): float;

    public function setAngle(float $angle): void;
}

