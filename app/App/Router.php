<?php
namespace PalaganTeam\MuhKansai\App;
class Router{
    private static $routes = [];

    /**
     * Add Route Path
     * 
     * Menambahkan Route path URL, sudah dapat membaca RegEx
     */
    public static function add(string $method, string $path, string $controller, string $function): void{
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function
        ];
    }

    /**
     * Run All Route
     * 
     * Menjalankan semua route yang sudah ditambahkan
     */
    public static function run(): void{
        // define default path
        $path = "/";

        if(isset($_SERVER['PATH_INFO'])){
            $path = $_SERVER['PATH_INFO'];
        }

        // define methode yang digunakan
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            // define pattern
            $pattern = "#^" . $route['path'] . "$#";
            if(preg_match($pattern, $path, $variabels) && $route['method'] == $method){
                // define controller dan function
                $controller = new $route['controller'];
                $funtion = $route['function'];

                array_shift($variabels);
                call_user_func_array([$controller, $funtion], $variabels);

                // return value
                return;
            }
        }

        // jika path tidak terdaftar
        http_response_code(404);
        echo "Path Tidak Ada";

    }
}