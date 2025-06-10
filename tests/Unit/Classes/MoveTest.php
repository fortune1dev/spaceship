<?php

declare(strict_types=1);

namespace Tests\Unit\Classes;

use App\Classes\Move;
use App\Classes\Vector;
use App\Contracts\IMovable;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class MoveTest extends TestCase
{
    /**
     * Тест 1: Движение корректно изменяет позицию объекта
     */
    public function test_execute_changes_object_position_correctly(): void
    {
        // Создаем мок-объект, реализующий IMovable
        $movable = $this->createMock(IMovable::class);
        
        // Настраиваем возвращаемые значения
        $movable->method('getPosition')
            ->willReturn(new Vector(12, 5));
        
        $movable->method('getVelocity')
            ->willReturn(new Vector(-7, 3));

        // Проверяем, что setPosition будет вызван с ожидаемым вектором
        $movable->expects($this->once())
            ->method('setPosition')
            ->with($this->equalTo(new Vector(5, 8)));

        // Выполняем операцию движения
        $move = new Move($movable);
        $move->execute();
    }

    /**
     * Тест 2: Ошибка при получении скорости (Exception)
     */
    public function test_execute_throws_exception_when_velocity_unavailable(): void
    {
        $movable = $this->createMock(IMovable::class);
        
        $movable->method('getPosition')
            ->willReturn(new Vector(10, 10));
        
        // Настраиваем выбрасывание исключения при получении скорости
        $movable->method('getVelocity')
            ->willThrowException(new RuntimeException('Velocity service offline'));

        $move = new Move($movable);
        
        // Проверяем тип и сообщение исключения
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Velocity service offline');
        
        $move->execute();
    }

    /**
     * Тест 3: Ошибка при получении скорости (LogicException)
     * (другим типом исключения). Наверное ошибка в задании?
     */
    public function test_execute_throws_runtime_exception_when_velocity_unavailable(): void
    {
        $movable = $this->createMock(IMovable::class);
        
        $movable->method('getPosition')
            ->willReturn(new Vector(5, 5));
        
        // Альтернативный тип исключения для проверки гибкости
        $movable->method('getVelocity')
            ->willThrowException(new \LogicException('Invalid velocity state'));

        $move = new Move($movable);
        
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Invalid velocity state');
        
        $move->execute();
    }

    /**
     * Тест 4: Ошибка при изменении позиции
     */
    public function test_execute_throws_exception_when_position_update_fails(): void
    {
        $movable = $this->createMock(IMovable::class);
        
        $movable->method('getPosition')
            ->willReturn(new Vector(8, 3));
        
        $movable->method('getVelocity')
            ->willReturn(new Vector(2, -1));

        // Исключение при попытке установки позиции
        $movable->method('setPosition')
            ->willThrowException(new RuntimeException('Position write error'));

        $move = new Move($movable);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Position write error');
        
        $move->execute();
    }
}