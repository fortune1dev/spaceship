<?php

declare(strict_types=1);

namespace Tests\Unit\Classes;

use App\Classes\Spaceship;
use App\Classes\Vector;
use PHPUnit\Framework\TestCase;

class SpaceshipTest extends TestCase
{
    public function test_movement(): void
    {
        $position  = new Vector(10, 20);
        $velocity  = new Vector(5, -5);
        $spaceship = new Spaceship($position, $velocity);

        $this->assertEquals($position, $spaceship->getPosition());
        $this->assertEquals($velocity, $spaceship->getVelocity());

        $newPosition = new Vector(15, 15);
        $spaceship->setPosition($newPosition);
        $this->assertEquals($newPosition, $spaceship->getPosition());
    }

    public function test_rotation(): void
    {
        $spaceship = new Spaceship(new Vector(0, 0), new Vector(0, 0), 45);
        $this->assertEquals(45.0, $spaceship->getAngle());

        $spaceship->setAngle(370);
        $this->assertEquals(10.0, $spaceship->getAngle());

        $spaceship->setAngle(-10);
        $this->assertEquals(350.0, $spaceship->getAngle());
    }

    public function test_velocity_rotation(): void
    {
        $spaceship = new Spaceship(new Vector(0, 0), new Vector(1, 0));
        $spaceship->setAngle(90);
        $spaceship->applyRotationToVelocity();

        $velocity = $spaceship->getVelocity();
        $this->assertEqualsWithDelta(0, $velocity->x, 0.0001);
        $this->assertEqualsWithDelta(1, $velocity->y, 0.0001);
    }
}
