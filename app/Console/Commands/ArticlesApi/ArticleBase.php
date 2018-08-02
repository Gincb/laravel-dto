<?php

declare(strict_types = 1);

namespace App\Console\Commands\ArticlesApi;

use App\Services\ClientAPI\ClientAuthorService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

abstract class ArticleBase extends Command
{
    protected $url;
    protected $version;

    /** @var Client  */
    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->client = new Client();

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

    /**
     * @param \stdClass $data
     */
    protected function checkSuccess(\stdClass $data): void
    {
        if(!$data->success){
            $this->error($data->message);
            exit();
        }
    }
}
