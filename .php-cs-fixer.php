<?php

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        // Включает набор правил, соответствующих стандарту PSR-12.
        '@PSR12' => true,

        // Настройка пробелов вокруг бинарных операторов.
        'binary_operator_spaces' => [
            'default'   => 'single_space', // Выравнивает все операторы по умолчанию.
            'operators' => [
                '=>'  => 'align_single_space', // Выравнивает оператор => с одним пробелом.
                '='   => 'align_single_space', // Выравнивает оператор = с одним пробелом.
                '+='  => 'align_single_space', // Выравнивает оператор += с одним пробелом.
                '-='  => 'align_single_space', // Выравнивает оператор -= с одним пробелом.
            ]
        ],

        // Выравнивание многострочных комментариев и конструкций
        'align_multiline_comment' => true,

        // Выравнивание цепочек методов
        'method_chaining_indentation' => true,

        // Включает правильное отступление для элементов массивов.
        'array_indentation' => true,

        // Использует короткий синтаксис для массивов (`[]` вместо `array()`).
        'array_syntax' => ['syntax' => 'short'],

        // Объединяет несколько вызовов `unset()` в один, если они идут подряд.
        'combine_consecutive_unsets' => true,

        // Управляет разделением элементов класса (свойств, методов, констант).
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one', // Добавляет одну пустую строку между методами.
            ]
        ],

        // Использует одинарные кавычки (`'`) вместо двойных (`"`), если это возможно.
        'single_quote' => true,

        // Добавляет пустую строку после открывающего тега `<?php`.
        'blank_line_after_opening_tag' => true,

        // Добавляет пустую строку перед определёнными конструкциями (например, `return`, `throw`, `if`).
        'blank_line_before_statement' => true,

        // Добавляет пробелы после приведения типов (например, `(int) $a`).
        'cast_spaces' => true,

        // Управляет пробелами вокруг оператора конкатенации (`.`).
        'concat_space' => [
            'spacing' => 'one', // Использует один пробел вокруг точки.
        ],

        // Добавляет пробел после типа в объявлениях функций (например, `function test(int $param)`).
        'function_typehint_space' => true,

        // Нормализует использование `include`, `include_once`, `require`, `require_once`.
        'include' => true,

        // Использует нижний регистр для приведения типов (например, `(int)` вместо `(INT)`).
        'lowercase_cast' => true,

        // Удаляет лишние пустые строки в указанных местах.
        'no_extra_blank_lines' => [
            'tokens' => [
                'curly_brace_block', // Удаляет лишние пустые строки внутри фигурных скобок `{}`.
                'extra',             // Удаляет лишние пустые строки в общем случае.
                'parenthesis_brace_block', // Удаляет лишние пустые строки внутри круглых скобок `()`.
                'square_brace_block',      // Удаляет лишние пустые строки внутри квадратных скобок `[]`.
                'throw',                   // Удаляет лишние пустые строки вокруг `throw`.
                'use',                     // Удаляет лишние пустые строки вокруг `use`.
            ]
        ],

        // Запрещает пробелы вокруг индексов в массивах (например, `$array[0]` вместо `$array[ 0 ]`).
        'no_spaces_around_offset' => true,

        // Добавляет пробелы вокруг тернарного оператора (`?` и `:`).
        'ternary_operator_spaces' => true,

        // Удаляет лишние пробелы вокруг элементов массива.
        'trim_array_spaces' => true,

        // Запрещает пробелы перед точкой с запятой в многострочных конструкциях.
        'multiline_whitespace_before_semicolons' => false,

        // Дополнительные правила, характерные для Laravel:

        // Удаляет неиспользуемые импорты.
        'no_unused_imports' => true,

        // Удаляет лишние пробелы вокруг операторов `!`, `++`, `--`.
        'unary_operator_spaces' => true,

        // Удаляет пробелы перед запятыми в массивах.
        'no_whitespace_before_comma_in_array' => true,

        // Добавляет пробелы после запятых в массивах.
        'whitespace_after_comma_in_array' => true,

        // Удаляет лишние пробелы в пустых строках.
        'no_whitespace_in_blank_line' => true,

        // Удаляет лишние пробелы вокруг операторов `->` и `::`.
        'object_operator_without_whitespace' => true,

        // Удаляет лишние пробелы вокруг операторов `new`.
        'new_with_braces' => true,
    ])
    // Указывает, где искать файлы для форматирования.
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__) // Ищет файлы в текущей директории и её поддиректориях.
            ->exclude(['vendor', 'bitrix', 'upload'])
    );
