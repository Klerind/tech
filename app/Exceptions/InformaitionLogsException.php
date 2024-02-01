<?php

namespace App\Exceptions;

use Exception;

class InformaitionLogsException extends Exception
{
  public function render()
  {
      return abort(404);
  }
}
