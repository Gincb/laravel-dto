<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Exception;

class ApiDataException extends Exception
{
    const NO_DATA_FOUND = 1001;

    /**
     * @return ApiDataException
     */
    public static function noData(): ApiDataException
    {
        return new statis('No data found', self::NO_DATA_FOUND);
    }
}
