<?php
use \Firebase\JWT\JWT;
class DAO
{   /**Funación Alta
    Recibe como parametro un objeto y lo guarda en un archivo JSON
    */
    public static function Alta($request, $response, $args)
    {
        try {
            
            $file = "usuarios.json";
            $datos =  $arrDatos = $request->getParsedBody();
            $obj = new usuario($datos['email'],$datos['clave'],$datos['tipo']);
            $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
            array_push($array,$obj);
            $json_string = json_encode($array);
            file_put_contents($file,$json_string);
            
            $response->getBody()->write(json_encode($json_string));
            return $response
                ->withHeader('content-Type','application/json')
                ->withStatus(200);

        } catch (Exception $e) {
            echo "Erro realizando el Alta", $e->getMessage(), "\n";
            return false;
        }
    }
    /**
     * Traer todos
     */
    public static function traerTodos($file)
    {
        //Leemos el JSON
        $datos_clientes = file_get_contents($file);
        $json_clientes = json_decode($datos_clientes, true);
        return $json_clientes;
    }
    /**
     * Login
     */
    public static function Login($request, $response, $args)
    {   
        $datos = $request->getParsedBody();
        $file = "token.json";
        $usuario = DAO::buscarUno( $datos["email"]);
        $flag = ($usuario != null )? true : false;
        
        if ($flag) {

            $key ="pro3-parcial";
            $payload = array(
                "iss" => "http://example.org",
                "aud" => "http://example.com",
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "email"=> $usuario['email'],
                "tipo" => $usuario['tipo']
            );
    
            $jwt = JWT::encode($payload, $key);
           
            file_put_contents($file,$jwt);
            $response->getBody()->write(json_encode($jwt));
            return $response
            ->withHeader('content-Type','application/json')
            ->withStatus(200);
        }
       
    }

    public static function AltaPizza($request, $response, $args)
    {
        try {
            
            $jwt =$request->getHeader('token');
            $key ="pro3-parcial";
            $decoded = JWT::decode($jwt[0],$key,array('HS256'));
            $flag = ($decoded->tipo == "encargado") ? true : false ;
           
            if ($flag) {
                echo "hacer el alta";
                return $response
                ->withHeader('content-Type','application/json')
                ->withStatus(200);
            }
            // $file = "pizzas.json";
            // $datos =  $arrDatos = $request->getParsedBody();
            // $obj = new usuario($datos['email'],$datos['clave'],$datos['tipo']);
            // $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
            // array_push($array,$obj);
            // $json_string = json_encode($array);
            // file_put_contents($file,$json_string);
            
            // $response->getBody()->write(json_encode($json_string));
           

        } catch (Exception $e) {
            echo "Erro realizando el Alta", $e->getMessage(), "\n";
            return false;
        }
    }
public static function buscarUno($id)
{   
    $file = 'usuarios.json';
    $array = DAO::traerTodos($file);

    foreach ($array as $key => $value) {
        if ($value['email'] = $id) {
            return $value;
        }
    }
}
}
    