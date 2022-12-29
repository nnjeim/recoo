<?php

namespace App\Exceptions;

use Exception;

class RecordNotFoundException extends Exception
{
	/**
	 * Report the exception.
	 *
	 * @return bool|null
	 */
	public function report()
	{
		return null;
	}

	/**
	 * Render the exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function render($request)
	{
		return response()->view('errors.404', ['message' => $this->getMessage()], 404);
	}
}
