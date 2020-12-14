<?php
//Khadija SUBTAIN-40040952
class rout
{
    // Default controller, method, params
    public $controller = "welcome";
    public $method = "index";
    public $params = [];

    public function __construct()
    {
        $url = $this->url();
        if (!empty($url)) {
            //Path is relative from index.php
            if (file_exists("../application/controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry  " . $url[0] . ".php not found</div>";
            }
        }

        // Include controller
        require_once "../application/controllers/" . $this->controller . ".php";

        // Instantiate controller
        $this->controller = new $this->controller;

        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);

            } else {
                echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry  method " . $url[1] . " not found</div>";
            }
        }

        // Only parameters left in the url since we unset controller name and method name
        if (isset($url)) {
            $this->params = $url;
        } else {
            $this->params = [];
        }

        //Calling the requested method.
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function url()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}

?>