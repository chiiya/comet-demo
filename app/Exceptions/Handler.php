<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Convert the given exception to an array.
     *
     * @param Exception $exception
     *
     * @return array
     */
    protected function convertExceptionToArray(Exception $exception): array
    {
        if (config('app.debug')) {
            return [
                'message' => $exception->getMessage(),
                'exception' => \get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => collect($exception->getTrace())->map(function ($trace) {
                    return Arr::except($trace, ['args']);
                })->all(),
            ];
        }
        $body = ['errors' => []];
        $error = [];
        $error['title'] = method_exists($exception, 'getTitle') ? $exception->getTitle() : 'Internal Server Error';
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() === 401) {
                $error['title'] = 'Unauthorized';
                $error['message'] = 'You are not authorized to access this resource.';
            }
            if ($exception->getStatusCode() === 404) {
                $error['title'] = 'Record not found';
                $error['message'] = 'The requested resource could not be found.';
            } elseif ($exception->getStatusCode() === 405) {
                $error['title'] = 'Method Not Allowed';
                $error['message'] = 'The method specified in the request is not allowed for this resource.';
            } else {
                $error['message'] = $exception->getMessage();
            }
            $error['status'] = $exception->getStatusCode();
        } else {
            $error['message'] = 'Whoops, looks like something went wrong.';
            $error['status'] = 500;
        }
        $body['errors'][] = $error;

        return $body;
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param \Illuminate\Http\Request                   $request
     * @param \Illuminate\Validation\ValidationException $exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'errors' => [
                [
                    'title' => 'Invalid Request',
                    'message' => $exception->getMessage(),
                    'errors' => $exception->errors(),
                    'status' => $exception->status,
                ],
            ],
        ], $exception->status);
    }
}
