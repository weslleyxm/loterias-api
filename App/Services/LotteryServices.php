<?php 
    namespace App\Services;   
    
    use Lib\TextFormatting as TextFormatting;   

    class LotteryServices
    {
        public function index()
        { 
            $result = [ 
                'success' => true,
                'code' => 200,   
                'items' => AVAILABLE 
            ]; 
 
            http_response_code($result['code']); 
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);   
        }

        public function latest($item) 
        {
            $context = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ), 
            );   
  
            if ($json = @file_get_contents(URL_BASE . "/" . $item, false, stream_context_create($context)))
            {
                $obj = json_decode($json);  

                $premiacoes = array();
    
                foreach($obj->listaRateioPremio as $row)
                {  
                    $premiacoes[] = array(
                        "descricaoFaixa" =>  $row->descricaoFaixa,
                        "faixa" => $row->faixa,
                        "numeroDeGanhadores" =>  $row->numeroDeGanhadores,
                        "valorPremio" =>"R$ " . number_format($row->valorPremio ,1,",",".")
                    );
                }
    
                $explode = explode('/', $item);
                $current_item = $explode[0];  
     
                $value = array(
                    "loteria" => $current_item,
                    "nome" => $obj->tipoJogo,
                    "concurso" =>  $obj->numero, 
                    "proxConcurso" => $obj->numeroConcursoProximo,
                    "concursoAnterior" => $obj->numeroConcursoAnterior, 
                    "data" =>  $obj->dataApuracao,
                    "local" =>  $obj->localSorteio . " em " .  $obj->nomeMunicipioUFSorteio,
                    "dezenas" => array($obj->listaDezenas, $obj->listaDezenasSegundoSorteio),
                    "premiacoes" => $premiacoes,
                    "estadosPremiados" => $obj->listaMunicipioUFGanhadores,
                    "acumulou" => $obj->acumulado,
                    "acumuladaProxConcurso" => TextFormatting::amount_in_words($obj->valorEstimadoProximoConcurso , 2),
                    "dataProxConcurso" => $obj->dataProximoConcurso,
                    "timeCoracao" => str_replace('\u0000*\u0000','', trim($obj->nomeTimeCoracaoMesSorte)), 
                    "valorAcumuladoConcurso" => "R$ " . number_format($obj->valorAcumuladoConcurso_0_5 ,1,",",".") , 
                    "valorAcumuladoConcursoEspecial" => "R$ " . number_format($obj->valorAcumuladoConcursoEspecial ,1,",",".") ,
                    "valorAcumuladoProximoConcurso" => "R$ " . number_format( $obj->valorAcumuladoProximoConcurso ,1,",","."),
                    "numeroConcursoFinal_0_5" => $obj->numeroConcursoFinal_0_5,  
                    "valorArrecadado" => "R$ " . number_format( $obj->valorArrecadado ,1,",","."), 
                    "ConcursoString" => ESPECIAL[$current_item],
                    "mesSorte" => null 
                ); 
     
                echo json_encode($value,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
            }
            else
            {
                $result = [
                    "success" => false,
                    "code" => 401,
                    "message" => "failed when trying to fetch the item: " . $item
                ]; 
 
                http_response_code($result['code']); 
                echo json_encode($result,  JSON_PRETTY_PRINT);   
                die();
            } 
        } 

         
        public function contest($number)
        {
            $this->latest($number); 
        }
    } 