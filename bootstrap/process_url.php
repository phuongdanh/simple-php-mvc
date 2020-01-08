<?php 
/**
 * ProcessUrl
 */
class ProcessUrl
{
	public static function getUrl() {
		$url = "$_SERVER[REQUEST_URI]";
		$url = substr ($url, 1, strlen($url) - 1);
		if ($url == '' || substr ($url, 0, 1) == '?') {
			return '';
		}
		$UrlSplit = explode('?', $url);
		if (count($UrlSplit) > 0) {
			return $UrlSplit[0];
		}
		return '';
	}

	public function exeUrl() {
		$entityName = self::getUrl();
		$controllerName = "App\Controller\\".$entityName."Controller";
		$userController = new $controllerName;
		echo $userController->index();
	}
}