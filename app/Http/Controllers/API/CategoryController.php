<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CategoryException;
use App\Services\API\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginate(Request $request): JsonResponse
    {
        try {
            $authors = $this->categoryService->getPaginateData((int)$request->page);
            return response()->json([
                'status' => true,
                'data' => $authors->getCollection(),
                'current_page' => $authors->currentPage(),
                'total_page' => $authors->lastPage(),
            ]);
        } catch (CategoryException $exception) {
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
                    'message' => 'Something wrong',
                    'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getById(Request $request, int $id): JsonResponse
    {
        try {
            $author = $this->categoryService->getById($id);
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
