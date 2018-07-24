<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 17:55
 */

declare(strict_types = 1);

namespace App\DTO;

use JsonSerializable;

abstract class BaseDTO implements JsonSerializable
{
    /**
     * @return array
     */
    final public function jsonSerialize(): array
    {
        return $this->jsonData();
    }

    /**
     * @return array
     */
    abstract protected function jsonData(): array;
}