<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
         \Illuminate\Auth\AuthenticationException::class,
     \Illuminate\Auth\Access\AuthorizationException::class,
     \Symfony\Component\HttpKernel\Exception\HttpException::class,
     \Illuminate\Database\Eloquent\ModelNotFoundException::class,
     \Illuminate\Session\TokenMismatchException::class,
     \Illuminate\Validation\ValidationException::class,
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
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['success'=>'0', 'error' => 'TOKEN_EXPIRED']);
            } else if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['success'=>'0', 'error' => 'TOKEN_INVALID']);
            } else if ($preException instanceof
                     \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                 return response()->json(['success'=>'0', 'error' => 'TOKEN_BLACKLISTED']);
           }
           if ($exception->getMessage() === 'Token not provided') {
               return response()->json(['success'=>'0', 'error' => 'Token not provided']);
           }
        }
        return parent::render($request, $exception);
    }
    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
         return response()->json(['error' => 'Unauthenticated.'],401);
        }
         $guard = array_get($exception->guards(), 0);
          switch ($guard) {
            case 'admin': $login = 'admin.login';
            break;
            default: $login = 'login';
            break;
          }
            return redirect()->guest(route($login));
    }
}
