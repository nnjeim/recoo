<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnprocessableException extends Exception
{
	/**
	 * Report the exception.
	 *
	 * @return bool|null
	 */
	public function report(): ?bool
	{
		return null;
	}

	/**
	 * Render the exception into an HTTP response.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function render(Request $request): Response
	{
		return response()->view('errors.422', ['message' => $this->getMessage()], 422);
	}
}
