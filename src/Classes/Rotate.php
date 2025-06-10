<?php

declare(strict_types=1);

namespace App\Classes;

use App\Contracts\IRotatable;

class Rotate
{
    public function __construct(
        private IRotatable $rotatable,
        private float $angleDelta
    ) {
    }

    public function execute(): void
    {
        $currentAngle = $this->rotatable->getAngle();
        $this->rotatable->setAngle($currentAngle + $this->angleDelta);
    }
}