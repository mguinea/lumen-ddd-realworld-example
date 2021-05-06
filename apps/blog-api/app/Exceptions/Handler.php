<?php

namespace Apps\BlogApi\App\Exceptions;

use App\Shared\Domain\NotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $e)
    {
        $response = [
            'error' => $e->getMessage()
        ];

        if (true === config('app.debug')) {
            $response['exception'] = get_class($e);
            $response['message'] = $e->getMessage();
            $response['trace'] = $e->getTrace();
        }

        return $this->handleException($e, $response);
    }

    private function handleException(Throwable $e, array $response = []): JsonResponse
    {
        if ($e instanceof InvalidArgumentException) {
            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof NotFoundException) {
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof AuthorizationException) {
            return new JsonResponse('Not authorized', Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return new JsonResponse('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($e instanceof HttpException) {
            return new JsonResponse($e->getMessage(), $e->getStatusCode());
        }

        return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
