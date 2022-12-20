<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Http\Requests\Helpers;

use Illuminate\Database\Eloquent\Model;

final class StubRepository
{
    private static array $repository = [];

    /**
     * <code>
     * Important: Each model you add to the repository should have a
     * unique id otherwise you'll just override the model within the repository.
     * If you are using a ModelBuilder be sure to build it `->withId(?)`
     * </code>
     */
    public static function addToRepository(Model $model): void
    {
        $table = $model->getTable();
        if (str_starts_with($table, 'stub_')) {
            $table = str_replace('stub_', '', $table);
        }

        if (!array_key_exists($table, self::$repository)) {
            self::$repository[$table] = [];
        }

        self::$repository[$table][$model->id] = $model;
    }

    public static function exists(string $tableName, int $columnId, array $extraParameters = []): bool
    {
        if (!array_key_exists($tableName, self::$repository)) {
            return false;
        }

        if (count($extraParameters) > 0) {
            $extraColumnName = $extraParameters[0];
            $extraColumnValue = strtolower($extraParameters[1]) === 'null' ? null : $extraParameters[1];

            return array_key_exists($columnId, self::$repository[$tableName])
                && self::$repository[$tableName][$columnId]->$extraColumnName === $extraColumnValue;
        }

        return array_key_exists($columnId, self::$repository[$tableName]);
    }

    public static function allExist(string $tableName, array $columnIds, array $extraParameters = []): bool
    {
        $truthTable = [];
        foreach ($columnIds as $columnId) {
            $truthTable[] = self::exists($tableName, $columnId, $extraParameters);
        }

        return !in_array(false, $truthTable, true);
    }

    public static function has(string $tableName, string $columnName, string $value): bool
    {
        if (!array_key_exists($tableName, self::$repository)) {
            return false;
        }

        foreach (self::$repository[$tableName] as $model) {
            if ($model->$columnName && $model->$columnName === $value && $model->deleted_at === null) {
                return true;
            }
        }

        return false;
    }

    public static function find(string $tableName, int $id): ?Model
    {
        if (!array_key_exists($tableName, self::$repository)) {
            return null;
        }

        foreach (self::$repository[$tableName] as $model) {
            if (isset($model->id) && $model->id === $id) {
                return $model;
            }
        }

        return null;
    }

    public static function clearRepository(): void
    {
        self::$repository = [];
    }
}
