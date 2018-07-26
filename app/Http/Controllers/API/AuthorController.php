<?php

namespace App\Http\Controllers\API;

use App\Exceptions\AuthorException;
use App\Services\API\AuthorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    /**
     * @var AuthorService
     */
    private $authorService;
    /**
     * AuthorController constructor.
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginate(Request $request): JsonResponse
    {
        try {
            $authors = $this->authorService->getPaginateData((int)$request->page);
            return response()->json([
                'status' => true,
                'data' => $authors->getCollection(),
                'current_page' => $authors->currentPage(),
                'total_page' => $authors->lastPage(),
            ]);
        } catch (AuthorException $exception) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        } catch (\Throwable $exception) {
            return response()->json(
                [
                    'status' => false,
                    'message' => dd($exception),
                    'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function getById(Request $request, int $id): JsonResponse
    {
        try {
            $author = $this->authorService->getById($id);
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
