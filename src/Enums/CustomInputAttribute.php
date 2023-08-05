<?php

namespace TheRealJanJanssens\Pakka\Enums;

enum CustomInputAttribute: string
{
    case TEXT = 'text';
    case SELECT = 'select';

    public function class(): string
    {
        return match($this) {
            CustomInputAttribute::TEXT => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
            CustomInputAttribute::SELECT => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
        };
    }

    public static function fromName(string $name): string
    {
        foreach (self::cases() as $status) {
            if($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$name is not a valid backing value for enum " . self::class);
    }
}
