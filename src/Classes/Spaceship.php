<?php

declare(strict_types=1);

namespace App\Classes;

use App\Contracts\IMovable;
use App\Contracts\IRotatable;

class Spaceship implements IRotatable, IMovable
{
    private float $angle = 0.0;
    private Vector $position;
    private Vector $velocity;

    public function __construct(
        Vector $initialPosition,
        Vector $initialVelocity,
        float $initialAngle = 0.0
    ) {
        $this->position = $initialPosition;
        $this->velocity = $initialVelocity;
        $this->angle    = $this->normalizeAngle($initialAngle);
    }

    public function getAngle(): float
    {
        return $this->angle;
    }

    public function setAngle(float $angle): void
    {
        $this->angle = $this->normalizeAngle($angle);
    }

    public function getPosition(): Vector
    {
        return $this->position;
    }

    public function getVelocity(): Vector
    {
        return $this->velocity;
    }

    public function setPosition(Vector $newPosition): void
    {
        $this->position = $newPosition;
    }

    public function setVelocity(Vector $newVelocity): void
    {
        $this->velocity = $newVelocity;
    }

    /**
     * Нормализует угол в диапазон [0, 360) градусов
     */
    private function normalizeAngle(float $angle): float
    {
        $normalized = fmod($angle, 360);
        if ($normalized < 0) {
            $normalized += 360;
        }

        // Нормализация значений, близких к 360
        return $normalized >= 360 ? 0.0 : $normalized;
    }

    /**
     * Дополнительный метод для удобства - поворот вектора скорости согласно текущему углу
     */
    public function applyRotationToVelocity(): void
    {
        $radians = deg2rad($this->angle);
        $x       = $this->velocity->x * cos($radians) - $this->velocity->y * sin($radians);
        $y       = $this->velocity->x * sin($radians) + $this->velocity->y * cos($radians);

        // Округляем до 10 знаков после запятой для стабильности тестов
        $this->velocity = new Vector(
            round($x, 10),
            round($y, 10)
        );
    }
}
