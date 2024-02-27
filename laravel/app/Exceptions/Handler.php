<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\InformaitionLogsException;
use PDOException;
use Psr\Log\LogLevel;
use App\Models\InformationLog;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
          PDOException::class => LogLevel::CRITICAL,
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

        /**
     * Get the default context variables for logging.
     *
     * @return array<string, mixed>
     */
    protected function context(): array
    {
        return array_merge(parent::context(), [
            'foo' => 'bar',
        ]);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e)
<<<<<<< HEAD
        {  
=======
        {
>>>>>>> origin/master
          $information_log = new InformationLog();
          $information_log->information_log = $e;
          $information_log->saveQuietly();
        });

        $this->reportable(function (InformaitionLogsException $e)
        {
          return false;
        });

    }


}
