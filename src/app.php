<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Classes\Vector;
use App\Classes\Spaceship;
use App\Classes\Move;
use App\Classes\Rotate;

// Инициализация корабля
$initialPosition = new Vector(0, 0);
$initialVelocity = new Vector(1, 0);
$spaceship       = new Spaceship($initialPosition, $initialVelocity);

echo "Начальное состояние:\n";
echo "Позиция: ({$spaceship->getPosition()->x}, {$spaceship->getPosition()->y})\n";
echo "Скорость: ({$spaceship->getVelocity()->x}, {$spaceship->getVelocity()->y})\n";
echo "Угол: {$spaceship->getAngle()}°\n\n";

// Движение корабля
$moveCommand = new Move($spaceship);
$moveCommand->execute();

echo "После движения:\n";
echo "Позиция: ({$spaceship->getPosition()->x}, {$spaceship->getPosition()->y})\n\n";

// Поворот корабля на 90 градусов
$rotateCommand = new Rotate($spaceship, 90.0); // Самый простой приме для проверки
$rotateCommand->execute();

echo "После поворота:\n";
echo "Угол: {$spaceship->getAngle()}°\n";

// Применяем поворот к вектору скорости
$spaceship->applyRotationToVelocity();

echo "Скорость после поворота: ({$spaceship->getVelocity()->x}, {$spaceship->getVelocity()->y})\n\n";

// Движение после поворота
$moveCommand->execute();

echo "После движения с повернутой скоростью:\n";
echo "Позиция: ({$spaceship->getPosition()->x}, {$spaceship->getPosition()->y})\n";
