<?php

declare(strict_types=1);

namespace App\Classes;


class Vector
{
    public function __construct(
        public readonly float $x,
        public readonly float $y
    ) {
    }

    public function add(Vector $vector): Vector
    {
        return new self(
            $this->x + $vector->x,
            $this->y + $vector->y
        );
    }
}
