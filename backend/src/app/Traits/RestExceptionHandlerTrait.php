<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait RestExceptionHandlerTrait
{
    use RestExcepcionResponse;

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
            return $this->notFound();
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return $this->jsonResponse(401, 'Unauthorized');
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->jsonResponse(405, 'Method Not Allowed');
        }

        if (!$exception instanceof HttpException) {
            return $this->jsonResponse(500, 'Internal Server Error');
        }
    }

    protected function jsonResponse(int $code, $message)
    {
        $response = [
            'error' => [
                'errors' => [
                    'code' => $code,
                    'message' => $message,
                ]
            ]
        ];
        return response()->json($response, $code);
    }
}
