<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Conventions;

/**
 * @doc https://www.elastic.co/guide/en/elasticsearch/reference/current/api-conventions.html#time-units
 */
class TimeUnit
{
    /**
     * @param int $amount
     * @return string
     */
    public static function days(int $amount): string
    {
        return $amount . 'd';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function hours(int $amount): string
    {
        return $amount . 'h';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function minutes(int $amount): string
    {
        return $amount . 'm';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function seconds(int $amount): string
    {
        return $amount . 's';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function milliseconds(int $amount): string
    {
        return $amount . 'ms';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function microseconds(int $amount): string
    {
        return $amount . 'micros';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function nanoseconds(int $amount): string
    {
        return $amount . 'nanos';
    }
}