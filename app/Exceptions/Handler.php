<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Pingpong\Trusty\Exceptions\ForbiddenException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\Process\Exception\InvalidArgumentException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    { 
    	if ($e instanceof ModelNotFoundException) {
    		$e = new NotFoundHttpException($e->getMessage(), $e);
    	}
    	
    	if ($e instanceof ForbiddenException) {
    		return response()->view('admin::403', [], 403);
    	}
    	
    	if ($e instanceof NotFoundHttpException) {
    		return response()->view('admin::404', [], 404);
    	}
    	
    	if ($e instanceof MethodNotAllowedHttpException) {
    		return response()->view('admin::404', [], 404);
    	}
    	
    	if ($e instanceof TokenMismatchException) {
    		return \Redirect::to('admin/login')->withFlashMessage('Please login first!')->withFlashType('danger');
    	}
    	
    	if ($e instanceof FatalErrorException){
    	   	return \Redirect::to('admin/login')->withFlashMessage('Some error occured, Please login first!')->withFlashType('danger');
    	}
    	
     	if ($e instanceof \ErrorException){
        	return response()->view('admin::500', [], 500);
      	}
      	
      	if($e instanceof InvalidArgumentException){
      		return response()->view('admin::500', [], 500);
      	}
    	
        return parent::render($request, $e);
    }
}
