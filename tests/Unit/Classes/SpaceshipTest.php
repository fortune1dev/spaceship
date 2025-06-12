<?php

declare(strict_types=1);

namespace Tests\Unit\Classes;

use App\Classes\Spaceship;
use App\Classes\Vector;
use PHPUnit\Framework\TestCase;

class SpaceshipTest extends TestCase
{
    private Vector $position;
    private Vector $velocity;
    private Spaceship $spaceship;

    protected function setUp(): void
    {
        $this->position  = new Vector(10, 20);
        $this->velocity  = new Vector(5, -5);
        $this->spaceship = new Spaceship($this->position, $this->velocity);
    }

    public function test_initial_state(): void
    {
        $this->assertEquals($this->position, $this->spaceship->getPosition());
        $this->assertEquals($this->velocity, $this->spaceship->getVelocity());
        $this->assertEquals(0.0, $this->spaceship->getAngle());
    }

    public function test_movement(): void
    {
        $newPosition = new Vector(15, 15);
        $this->spaceship->setPosition($newPosition);
        $this->assertEquals($newPosition, $this->spaceship->getPosition());

        $newVelocity = new Vector(10, 10);
        $this->spaceship->setVelocity($newVelocity);
        $this->assertEquals($newVelocity, $this->spaceship->getVelocity());
    }

    public function test_angle_normalization(): void
    {
        // Проверка нормализации при создании
        $spaceship = new Spaceship(new Vector(0, 0), new Vector(0, 0), 45);
        $this->assertEquals(45.0, $spaceship->getAngle());

        // Проверка нормализации больше 360
        $spaceship->setAngle(370);
        $this->assertEquals(10.0, $spaceship->getAngle());

        // Проверка нормализации отрицательных значений
        $spaceship->setAngle(-10);
        $this->assertEquals(350.0, $spaceship->getAngle());

        // Крайний случай - ровно 360 градусов
        $spaceship = new Spaceship(new Vector(0, 0), new Vector(0, 0), 360);
        $this->assertEquals(0.0, $spaceship->getAngle());
    }

    public function test_velocity_rotation(): void
    {
        // Исходная скорость (5, -5)
        $initialVelocity = $this->spaceship->getVelocity();

        // Поворот на 90°
        $this->spaceship->setAngle(90);
        $this->spaceship->applyRotationToVelocity();
        $this->assertEqualsWithDelta(5, $this->spaceship->getVelocity()->x, 0.0001, 'X after 90°');
        $this->assertEqualsWithDelta(5, $this->spaceship->getVelocity()->y, 0.0001, 'Y after 90°');

        // Поворот на 180° (должен дать (-5, -5))
        $this->spaceship->setAngle(180);
        $this->spaceship->applyRotationToVelocity();
        $this->assertEqualsWithDelta(-5, $this->spaceship->getVelocity()->x, 0.0001, 'X after 180°');
        $this->assertEqualsWithDelta(-5, $this->spaceship->getVelocity()->y, 0.0001, 'Y after 180°');

        // Поворот на 0° (должен оставить без изменений)
        $this->spaceship->setAngle(0);
        $this->spaceship->applyRotationToVelocity();
        $this->assertEqualsWithDelta(-5, $this->spaceship->getVelocity()->x, 0.0001, 'X after 0°');
        $this->assertEqualsWithDelta(-5, $this->spaceship->getVelocity()->y, 0.0001, 'Y after 0°');

        // Поворот на 360° (должен быть эквивалентен 0°)
        $this->spaceship->setAngle(360);
        $this->spaceship->applyRotationToVelocity();
        $this->assertEqualsWithDelta(-5, $this->spaceship->getVelocity()->x, 0.0001, 'X after 360°');
        $this->assertEqualsWithDelta(-5, $this->spaceship->getVelocity()->y, 0.0001, 'Y after 360°');

        // Новый тест для поворота на -90° из начального состояния
        $newSpaceship = new Spaceship($this->position, $this->velocity);
        $newSpaceship->setAngle(-90);
        $newSpaceship->applyRotationToVelocity();
        $this->assertEqualsWithDelta(-5, $newSpaceship->getVelocity()->x, 0.0001, 'X after -90° from initial');
        $this->assertEqualsWithDelta(-5, $newSpaceship->getVelocity()->y, 0.0001, 'Y after -90° from initial');
    }

    public function test_edge_cases(): void
    {
        // Нулевая скорость
        $spaceship = new Spaceship(new Vector(0, 0), new Vector(0, 0));
        $spaceship->setAngle(90);
        $spaceship->applyRotationToVelocity();
        $this->assertEquals(new Vector(0, 0), $spaceship->getVelocity());

        // Очень большой угол
        $spaceship->setAngle(360 * 10 + 45); // 45 градусов после 10 полных оборотов
        $this->assertEquals(45.0, $spaceship->getAngle());
    }
}
