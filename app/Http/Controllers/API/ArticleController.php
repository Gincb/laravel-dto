<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Exceptions\ArticleException;
use App\Services\API\ArticleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class ArticleController extends Controller
{

    private $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function getPaginate(Request $request): JsonResponse
    {
        try {
            /** @var LengthAwarePaginator $articles */
            $articles = $this->articleService->getPaginateData();

            return response()->json([
                'status' => true,
                'data' => $articles,
            ]);
        } catch (ArticleException $exception) {

            logger($exception->getMessage(), [
                    'code' => $exception->getCode(),
                    'page' => $request->page,
                    'url' => $request->fullUrl(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Something wrong',
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getFullData(Request $request): JsonResponse
    {
        try {
            $articles = $this->articleService->getFullData((int)$request->page);
            return response()->json([
                'success' => true,
                'data' => $articles,
            ]);
        } catch (ArticleException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getById(Request $request, int $id): JsonResponse
    {
        try {
            $author = $this->articleService->getById($id);
            return response()->json([
                'success' => true,
                'data' => $author,
            ]);
        } catch (ModelNotFoundException $exception) {
            logger($exception->getMessage(), [
                'code' => $exception->getCode(),
                'author-id' => $id,
                'path' => $request->path(),
                'url' => $request->url(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'No data found.',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $exception) {
            dd($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
