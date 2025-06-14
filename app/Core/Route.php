<?php

namespace App\Core;

use Exception;

/**
 * Route class for handling application routing
 */
class Route
{
	/**
	 * @var array Route parameters
	 */
	protected array $params = [];

	/**
	 * Get route parameters
	 * 
	 * @param string $nameParam Parameter name
	 * @param mixed $default Default value if parameter not found
	 * @return mixed Parameter value or default
	 */
	public function getParams(string $nameParam = '', mixed $default = null): mixed
	{
		if (empty($nameParam)) {
			return $this->params;
		}

		return $this->params[$nameParam] ?? $default;
	}

	/**
	 * Set route parameter
	 * 
	 * @param string $nameParam Parameter name
	 * @param mixed $value Parameter value
	 * @throws Exception If parameter name or value is not set
	 */
	public function setParams(string $nameParam, mixed $value): void
	{
		if (empty($nameParam)) {
			throw new Exception("Parameter name is required");
		}

		$this->params[$nameParam] = $value;
	}
}