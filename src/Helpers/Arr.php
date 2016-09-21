<?php

namespace Spatie\Url\Helpers;

class Arr
{
    public static function map(array $items, callable $callback)
    {
        $keys = array_keys($items);

        $items = array_map($callback, $items, $keys);

        return array_combine($keys, $items);
    }

    public static function mapToAssoc(array $items, callable $callback)
    {
        return array_reduce($items, function (array $assoc, $item) use ($callback) {
            list($key, $value) = $callback($item);
            $assoc[$key] = $value;

            return $assoc;
        }, []);
    }
}
