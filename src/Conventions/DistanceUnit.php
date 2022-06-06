<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Conventions;

class DistanceUnit
{
    /**
     * @param int $amount
     * @return string
     */
    public static function mile(int $amount): string
    {
        return $amount . 'mi';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function yard(int $amount): string
    {
        return $amount . 'yd';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function feet(int $amount): string
    {
        return $amount . 'ft';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function inch(int $amount): string
    {
        return $amount . 'in';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function kilometer(int $amount): string
    {
        return $amount . 'km';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function meter(int $amount): string
    {
        return $amount . 'm';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function centimeter(int $amount): string
    {
        return $amount . 'cm';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function millimeter(int $amount): string
    {
        return $amount . 'mm';
    }

    /**
     * @param int $amount
     * @return string
     */
    public static function nauticalMile(int $amount): string
    {
        return $amount . 'nmi';
    }
}