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

            $json = file_get_contents(URL_BASE . "/" . $item, false, stream_context_create($context)); 
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
 
            $value = array(
                "loteria" => $item,
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
                "timeCoracao" => $obj->nomeTimeCoracaoMesSorte,
                "mesSorte" => null
            ); 
 
             echo json_encode($value,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);   
        } 

         
        public function contest($number)
        {
            $this->latest($number); 
        }
    } 