<?php

namespace App\Exceptions;

use Exception;

class UnprocessableException extends Exception
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
		return response()->view('errors.422', ['message' => $this->getMessage()], 422);
	}
}
