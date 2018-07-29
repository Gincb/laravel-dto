<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-26
 * Time: 18:08
 */

declare(strict_types = 1);

namespace App\Services;

use App\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return User::paginate();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function create(string $name, string $email, string $password)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}