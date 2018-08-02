<?php

declare(strict_types = 1);

namespace App\Console\Commands\ArticlesApi;

use App\Services\ClientAPI\ClientArticleService;

/**
 * Class ArticleListCommand
 * @package App\Console\Commands\ArticlesApi
 */
class ArticleListCommand extends ArticleBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get articles list';


    /**
     * @var ClientArticleService
     */
    private $clientArticleService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->clientArticleService = app()->make(ClientArticleService::class);
    }

    /**
     * Execute the console command.
     *
     * @param string|null $url
     * @return mixed
     */
    public function handle(string $url = null): void
    {
        try {
            $response = $this->client->get(($url) ? $url : $this->getCallUrl());

            $context = json_decode($response->getBody()->getContents());

            $this->checkSuccess($context);

            foreach ($context->data->data as $item){
                $article = $this->clientArticleService->saveArticleFromObject($item);
                $this->info('Article saved with ID: ' . $article->id);
            }

            if($url = $context->data->next_page_url){
                $this->handle($url);
            }

        }catch(\Throwable $exception){
            $this->error($exception->getMessage());
        }
    }

    /**
     * @return string
     */
    protected function getCallUrl(): string
    {
        return strtr(':url/article', [
            ':url' => parent::getCallUrl(),
        ]);

    }

}
