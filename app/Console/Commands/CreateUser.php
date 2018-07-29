<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        /** @var UserService $service */
        $service = app(UserService::class);

        $service->create($this->getUserName(), $this->getUserEmail(), $this->getUserPassword());

        $this->info('User created!');
    }

    /**
     * @return string
     */
    private function getUserName():string
    {
        $name = $this->ask('Enter your username');

        if(empty($name)){
            $this->error('User name is required!');

            return $this->getUserName();
        }

        return $name;
    }

    /**
     * @return string
     */
    private function getUserEmail(): string
    {
        $email = $this->ask('Enter your email');

        if(empty($email)){
            $this->error('Email is required!');

            return $this->getUserEmail();
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->error('Wrong email structure');

            return $this->getUserEmail();
        };

        return $email;
    }

    /**
     * @return string
     */
    private function getUserPassword(): string
    {
        $password = $this->secret('Enter your password');
        $confirmPassword = $this->secret('Re-enter your password');

        if(empty($password || empty($confirmPassword) || $password !== $confirmPassword)){
            $this->error('Password field empty or do not match');

            return $this->getUserPassword();
        }

        return $password;
    }
}
