<?php

declare(strict_types = 1);

namespace App\Console\Commands\ArticlesApi;

use Illuminate\Console\Command;

abstract class ArticleBase extends Command
{
    protected $url;
    protected $version;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->url = config('articles_api.api_url');
        $this->version = config('articles_api.api_version');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    abstract public function handle(): void;

    /**
     * @return string
     */
    protected function getCallUrl(): string
    {
        return strtr(':domain/:version', [
            ':domain' => $this->url,
            ':version' => $this->version,
        ]);
    }
}
