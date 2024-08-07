<?php

namespace Ereto\Json;

use DateTime;
use DateTimeZone;
use Psr\Http\Message\ResponseInterface as Response;

class Json {

  static function json(Response $res, string $msg='',int $http=200, $more=null): Response{
    $zone = new DateTimeZone("America/Sao_Paulo");
    $date = new DateTime('now', $zone);

    $arr = array(
      "message" => $msg,
      "http_code" => $http,
      "time" => $date->format("d-m-yy h:m:s")
    );

    if(isset($more)) {
      $arr["more"] = $more;
    }

    $payload = json_encode($arr,JSON_PRETTY_PRINT);

    $res->withStatus( (int) $http)->getBody()->write($payload);

    return $res->withHeader("Content-type", "application/json");
  }
}
