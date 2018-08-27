<?php

class Route
{
	static function start()
	{
		$controller_name = 'Controller';

		$method = $_SERVER['REQUEST_METHOD'];
		$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // get uri

		$url = explode('/', $url);

//первый параметр должен соответствовать названию таблицы (контроллера, модели) 
   		if($url[1] != 'strings') Route::Error404();
   		$controller_name = ucfirst($url[1]).'Controller';
//второй указывает в каком формате будет ответ (xml, json)
		$format = isset($url[2]) && in_array($url[2], ['json', 'xml']) ? $url[2] : Route::ErrorWroneFormat();
//третий - id изменяемой или удаляемой строки
		$param = isset($url[3]) ? $url[3] : NULL;
//должен быть целым положительным числом
		if($param != null && !preg_match('/^\+?\d+$/', $param)) Route::Error404();
//извлекае переданные данные 
		$data = file_get_contents('php://input');

        if($data != NULL)
        {
        	$data = json_decode($data, true);

        	if($data == NULL)  Route::BadRequest();
        }
//определяем action
		if($method == 'GET' && $param == NULL) $action_name = 'index';
		elseif($method == 'POST' && $param == NULL) $action_name = 'store';
		elseif($method == 'PUT' && $data != NULL) $action_name = 'update';
		elseif($method == 'DELETE' && $param != NULL) $action_name = 'destroy';
		else Route::Error404(); 
//создаём экземпляр класса request и сохраняем его в контроллере
		$request = new Request($data);

		$controller = new $controller_name($format, $request);

		return $controller->$action_name($param);
	}

	static function Error404()
	{
		$response = new Response(['message' => 'Page not found'], 404);
		return $response->send();
    }
    static function ErrorWroneFormat()
	{
		$response = new Response(['message' => 'the response format is not defined'], 404);
		return $response->send();
    }
    static function BadRequest()
	{
		$response = new Response(['message' => 'Wrone format data'], 400);
		return $response->send();
    }

}