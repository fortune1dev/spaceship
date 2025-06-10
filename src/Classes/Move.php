<?php

declare(strict_types=1);

namespace App\Classes;

use App\Contracts\IMovable;

class Move
{
    public function __construct(
        private IMovable $movable
    ) {
    }

    public function execute(): void
    {
        $currentPosition = $this->movable->getPosition();
        $this->movable->setPosition($currentPosition->add($this->movable->getVelocity()));
    }
}