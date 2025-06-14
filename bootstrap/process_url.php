<?php

namespace App\Bootstrap;

use App\Repository\UserRepository;
use Throwable;

/**
 * ProcessUrl - Handles URL processing and routing
 */
class ProcessUrl
{
	/**
	 * Get controller and action from URL
	 * 
	 * @return array{controller: string, action: string} Entity information
	 */
	public static function getEntity(): array
	{
		$entity = [
			'controller' => DEFAULT_COTROLLER,
			'action' => 'index'
		];

		$url = self::getCleanUrl();
		
		if (empty($url) || $url[0] === '?') {
			return $entity;
		}

		$urlParts = self::parseUrl($url);
		
		if (!empty($urlParts['controller'])) {
			$entity['controller'] = self::formatControllerName($urlParts['controller']);
		}
		
		if (!empty($urlParts['action'])) {
			$entity['action'] = self::formatActionName($urlParts['action']);
		}

		return $entity;
	}

	/**
	 * Execute the URL routing
	 * 
	 * @return void
	 */
	public function exeUrl(): void
	{
		try {
			$entity = self::getEntity();
			$controllerName = "App\\Controller\\{$entity['controller']}Controller";
			
			if (!class_exists($controllerName)) {
				throw new \Exception("Controller {$entity['controller']}Controller not found");
			}

			$controller = new $controllerName(new UserRepository);
			
			if (!method_exists($controller, $entity['action'])) {
				throw new \Exception("Method {$entity['action']} not found in {$entity['controller']}Controller");
			}

			$controller->{$entity['action']}();
		} catch (Throwable $e) {
			echo $this->formatError($e);
		}
	}

	/**
	 * Get clean URL without domain and query string
	 * 
	 * @return string Clean URL
	 */
	private static function getCleanUrl(): string
	{
		// Get the base URL without protocol and port
		$rootUrl = str_replace(['https://', 'http://'], '', APP_PATH);
		$rootUrl = preg_replace('/:\d+$/', '', $rootUrl);

		// Get the current URI and clean it
		$uri = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$uri = preg_replace('/:\d+/', '', $uri);
		
		$url = str_replace($rootUrl, '', $uri);
		return trim($url, '/');
	}

	/**
	 * Parse URL into controller and action parts
	 * 
	 * @param string $url Clean URL
	 * @return array{controller?: string, action?: string} URL parts
	 */
	private static function parseUrl(string $url): array
	{
		$parts = [];
		$urlSplit = explode('?', $url);
		$urlExe = explode('/', $urlSplit[0]);

		if (!empty($urlExe[0])) {
			$parts['controller'] = $urlExe[0];
		}

		if (!empty($urlExe[1])) {
			$parts['action'] = $urlExe[1];
		}

		return $parts;
	}

	/**
	 * Format controller name from URL part
	 * 
	 * @param string $controllerUrl Controller part from URL
	 * @return string Formatted controller name
	 */
	private static function formatControllerName(string $controllerUrl): string
	{
		$parts = explode('-', $controllerUrl);
		return implode('', array_map('ucwords', $parts));
	}

	/**
	 * Format action name from URL part
	 * 
	 * @param string $actionUrl Action part from URL
	 * @return string Formatted action name
	 */
	private static function formatActionName(string $actionUrl): string
	{
		$parts = explode('-', $actionUrl);
		return lcfirst(implode('', array_map('ucwords', $parts)));
	}

	/**
	 * Format error message for display
	 * 
	 * @param Throwable $error Error object
	 * @return string Formatted error message
	 */
	protected function formatError(Throwable $error): string
	{
		return sprintf(
			'<div style="background-color: #f8d7da; padding: 20px; border: 1px solid #f5c6cb; border-radius: 4px; margin: 20px;">
				<h3 style="color: #721c24; margin-top: 0;">Error</h3>
				<p><strong>Message:</strong> %s</p>
				<p><strong>File:</strong> %s</p>
				<p><strong>Line:</strong> %d</p>
				<p><strong>Stack Trace:</strong></p>
				<pre style="background: #fff; padding: 10px; border-radius: 4px;">%s</pre>
			</div>',
			htmlspecialchars($error->getMessage()),
			htmlspecialchars($error->getFile()),
			$error->getLine(),
			htmlspecialchars($error->getTraceAsString())
		);
	}
}