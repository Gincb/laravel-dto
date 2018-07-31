<?php

declare(strict_types = 1);

namespace App\Console\Commands\ArticlesApi;

use App\Author;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class AuthorByReferenceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:author-by-id {reference_author_id : Reference author ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get author info by reference ID';

    private $url;
    private $version;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        try {
            $client = new Client();

            $result = $client->request('GET', $this->getCallUrl());

            $data = \GuzzleHttp\json_decode($result->getBody()->getContents());

            if(!$data->success){
                $this->error($data->message);
                exit();
            }

            Author::updateOrCreate(
                [
                    'first_name'=>$data->data->first_name,
                    'last_name'=>$data->data->last_name,
                ],
                [
                    'reference_author_id'=>$data->data->author_id,
                ]
            );

            $this->info('Row update or created success with reference  author ID: ', $data->data->author_id);

        }catch (\Throwable $exception){
            $this->error($exception->getMessage());
    }
    }

    /**
     * @return string
     */
    private function getCallUrl()
    {
        return sprintf('%s/%s/author/%d', $this->url, $this->version, $this->argument('reference_author_id'));
    }
}
