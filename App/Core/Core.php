<?php 
    namespace App\Core; 
    use App\Models\Authorization;
 
    use App\Core\Contents as Contents;    


    class Core
    {
        public function start()
        {     
            $result = null; 
            $service = "App\Services\LotteryServices"; 

            if(!isset($_GET['url'])) 
            {  
                call_user_func(array(new $service, "index"));     
            }  
            else  
            {       
                $url = explode('/', $_GET['url']);    
                $item = strtolower(array_shift($url)); 
                $contest = strtolower(array_shift($url)); 
  
                if (in_array($item, AVAILABLE))  
                {
                    if(empty($contest)) 
                        call_user_func(array(new $service, "latest"), $item);       
                    else  
                    {   
                        $method =  method_exists($service, $contest) ? $contest : "contest";   
                        $parameters = method_exists($service, $contest) ? $item : $item . "/". $contest;  
 
                        call_user_func(array(new $service, $method),  $parameters);  
                    }
                }
                else 
                { 
                    $this->show_error("Internal server error endpoint not found", $item. "/". $contest); 
                }    
            }  
        }

        public function show_error($message, $path)
        {
            $result = [
                "success" => false,
                "code" => 401,
                "message" => $message
            ]; 

            if(!empty($path))
                $result["path"] = $path;

            if($result != null)
            { 
                http_response_code($result['code']); 
                echo json_encode($result,  JSON_PRETTY_PRINT);   
            }
        } 
    } 