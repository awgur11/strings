<?php


class Controller {

    protected $format;

    protected $request;

    function __construct($format, $request)
    {
      $this->format = $format;//формат, в котором необходимо предоставить ответ

      $this->request = $request;//экземпляр класса запроса
    }
//передаём данные в экземпляр класса response в требуемом формате
    public function response( array $response)
    {
      if($this->format == 'json')
      {
          $response = json_encode($response);
          $response = new Response($response);
          $response->setHeader('Content-Type: application/json');

          return $response->send();
      }
      else
      {
        $response = new ArrayToXml($response);

        $response = $response->xml();

        $response = new Response($response);
        $response->setHeader('Content-Type: text/xml');

        return $response->send();        
      }
    }
}