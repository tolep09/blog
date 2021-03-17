<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponse;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->renderable(function (NotFoundHttpException $e, $request) {
        //     // return response()->json('Error');
        //     return $this->errorResponse('Error', 404, 'El recurso no existe');
        // });


        
        
        $this->renderable(function (Throwable $e, $request) {
            
            if (preg_match_all('.api\/.', $request->path()) > 0)
            {
                if ($e instanceof ModelNotFoundException)
                {
                    return $this->errorResponse('Error', 404, 'El elemento buscado no existe');
                }
                    
                if ($e instanceof NotFoundHttpException)
                {
                    return $this->errorResponse('Error', 404, 'El recurso buscado no existe');
                }
    
                return $this->errorResponse('Error', 500, 'Error inesperado');
            } else{
                
                $this->reportable(function (Throwable $e) {

                });
            }
           
        });

        
    }
}
