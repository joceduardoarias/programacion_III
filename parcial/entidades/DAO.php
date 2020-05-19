<?php
use \Firebase\JWT\JWT;
class DAO
{   /**Funación Alta
    Recibe como parametro un objeto y lo guarda en un archivo JSON
    */
    public static function Alta($request, $response, $args)
    {
        try {
            $datos =  $arrDatos = $request->getParsedBody();
            if (!empty($datos['email']) && !empty($datos['clave']) && !empty($datos['tipo'])) {
                $file = "users.json";
                $id = rand(0,200);
                $obj = new usuario($datos['email'],$datos['clave'],$datos['tipo'],$id);
                $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
                array_push($array,$obj);
                $json_string = json_encode($array);
                file_put_contents($file,$json_string);
                
                /** */
                $uploadedFiles = $request->getUploadedFiles();
                 
                $contador = 0;
                foreach ($uploadedFiles as $key => $uploadedFile) {
                    $uploadedFile = $uploadedFiles['foto'];
                    $nameFoto = $uploadedFile[$contador]->getClientFilename();
                    $destino= 'images/users/'.$nameFoto.$datos['email'];
                    $uploadedFile[$contador]->moveTo($destino) ;
                    $contador++;
                }
                
                $response->getBody()->write(json_encode($json_string));
                return $response
                    ->withHeader('content-Type','application/json')
                    ->withStatus(200);

            }else {
                $response->getBody()->write(json_encode("No esta los datos completos para realizar el Alta"));
                return $response
                    ->withHeader('content-Type','application/json')
                    ->withStatus(200);
            }
           

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
                "tipo" => $usuario['tipo'],
                "id" => $usuario["id"]
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

                $datos = $request->getParsedBody();
                
                if (DAO::validar($datos)!= true) {
                    $file = 'pizzas.json';
                    
                    $uploadedFiles = $request->getUploadedFiles();
                    $uploadedFile = $uploadedFiles['foto'];
                    $nameFoto = $uploadedFile->getClientFilename();
                    
                    $pizza = new pizza($datos['tipo'],$datos['precio'],$datos['sabor'],$datos['stock'],$nameFoto);
                    $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
                    array_push($array,$pizza);
                    $json_string = json_encode($array);
                    file_put_contents($file,$json_string);
                     
                    //Mover imagen
                     $destino= 'imagenes/'.$nameFoto;
                     $uploadedFile->moveTo($destino) ;

                    $response->getBody()->write(json_encode("Atal exitosa"));
                    return $response
                    ->withHeader('content-Type','application/json')
                    ->withStatus(200);
                }else {
                    $response->getBody()->write(json_encode("Ya existe esa combinacion tipo-sabor."));
                    return $response
                    ->withHeader('content-Type','application/json')
                    ->withStatus(200);
                }    
            }
            $response->getBody()->write(json_encode("No puede relizar alta, solo el encargado puede realizar esta acción."));
            return $response
            ->withHeader('content-Type','application/json')
            ->withStatus(200);
        } catch (Exception $e) {
            echo "Erro realizando el Alta", $e->getMessage(), "\n";
            return false;
        }
    }
    public  static function mensajes($request, $response, $args)
    {
            $jwt =$request->getHeader('token');
            $datos = $request->getParsedBody();
            $key ="pro3-parcial";
            $decoded = JWT::decode($jwt[0],$key,array('HS256'));
            $flag = ($decoded->id == $datos["id_usuario"]) ? true : false ;
            
            $mensaje = new mensaje($datos["id_usuario"],$datos["mensaje"]);
            
            if ($flag) {
                $file = "mensajes.json";
                $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
                array_push($array,$mensaje);
                $json_string = json_encode($array);
                file_put_contents($file,$json_string);

                $response->getBody()->write(json_encode("Mensaje enviado"));
                return $response
                ->withHeader('content-Type','application/json')
                ->withStatus(200);
            }
    }
    /**
     * Buscar uno
     */
    public static function buscarUno($id)
    {   
        try {
                $file = 'users.json';
                $array = DAO::traerTodos($file);

                foreach ($array as $key => $value) {
                    // if ($value['email'] = $id) {
                    //     return $value;
                    // }
                    if (strcasecmp($value['email'],$id) == 0) {
                        return $value;
                    }
                }
            } catch (Exception $e) {
                echo "Erro buscandoUno()", $e->getMessage(), "\n";
                return false;
            }
    
    }
    public static function buscarUnoId($id)
    {   
        try {
                $file = 'users.json';
                $array = DAO::traerTodos($file);

                foreach ($array as $key => $value) {
                    // if ($value['email'] = $id) {
                    //     return $value;
                    // }
                    if (strcasecmp($value['id'],$id) == 0) {
                        return $value;
                    }
                }
            } catch (Exception $e) {
                echo "Erro buscandoUno()", $e->getMessage(), "\n";
                return false;
            }
    
    }
    /** 
     * Validar
     * La combinación tipo - sabor debe ser única.
     */
    public static function validar($datos)
    {   
        $file = 'pizzas.json';
        $array = DAO::traerTodos($file);
        if ($array != null) {
            foreach ($array as $key => $value) {
                if ($value['tipo'].$value['sabor'] == $datos['tipo'].$datos['sabor']) {
                    return true;
                }
            }
        }
        return false;
    }
   public static function taerListaFiltro($request, $response, $args)
   {
        $jwt =$request->getHeader('token');
        $key ="pro3-parcial";
        $decoded = JWT::decode($jwt[0],$key,array('HS256'));
        $file = 'mensajes.json';
        $string = "";
        if ($decoded->tipo == "user") {
            $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
            foreach ($array as $key => $value) {
                $obj = DAO::buscarUnoId($value["id"]);
                $string .= $obj->email ." ".$value["mensaje"]." ".getdate();
            }
            $response->getBody()->write(json_encode($string));
            return $response
            ->withHeader('content-Type','application/json')
            ->withStatus(200);
        }
        $file = 'users.json';
        if ($decoded->tipo == "admin") {
            $array = (file_get_contents($file)) ? DAO::traerTodos($file): array() ;
            foreach ($array as $key => $value) {
                $obj = DAO::buscarUnoId($value["id"]);
                
               
            }
            $response->getBody()->write(json_encode($string));
            return $response
            ->withHeader('content-Type','application/json')
            ->withStatus(200);
        }

        
   }
   public static function prueba($request, $response, $args)
   {
       $string1 = $args['id'];
       $string2 =$args['nombre'];
       $response->getBody()->write(json_encode($string1.$string2));
       return $response
       ->withHeader('content-Type','application/json')
       ->withStatus(200);
   }
}
    