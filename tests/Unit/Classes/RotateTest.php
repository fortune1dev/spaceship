<?php

declare(strict_types=1);

namespace Tests\Unit\Classes;

use App\Classes\Rotate;
use App\Contracts\IRotatable;
use PHPUnit\Framework\TestCase;

class RotateTest extends TestCase
{
    /**
     * Тест 1: Корректно изменяется угол объекта
     */
    public function test_execute_changes_angle_correctly(): void
    {
        $rotatable = $this->createMock(IRotatable::class);
        
        // Ожидаем вызовы методов с конкретными параметрами
        $rotatable->expects($this->once())
            ->method('getAngle')
            ->willReturn(30.0);
        
        $rotatable->expects($this->once())
            ->method('setAngle')
            ->with(42.0); // 30 + 12 = 42

        $rotate = new Rotate($rotatable, 12.0);
        $rotate->execute();
    }
}