<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Classes\Vector;

interface IMovable
{
    public function getPosition(): Vector;

    public function getVelocity(): Vector;

    public function setPosition(Vector $newPosition): void;
}
