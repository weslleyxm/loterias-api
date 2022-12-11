<?php  
    const URL_BASE = "https://servicebus2.caixa.gov.br/portaldeloterias/api"; 

    const AVAILABLE = array("megasena",
                            "lotofacil",
                            "quina",
                            "lotomania",
                            "timemania",
                            "duplasena",
                            "federal",
                            "diadesorte",
                            "supersete", 
                            "maismilionaria");   

    const ESPECIAL = array("megasena" => "Sorteio Acumulado da Mega da Virada",
                           "lotofacil" => "Sorteio Acumulado Especial da Independência",
                           "quina" => "Sorteio Acumulado Especial de São João",
                           "lotomania" => "",
                           "timemania" => "",
                           "duplasena" => "Sorteio Acumulado Especial de Páscoa",
                           "federal" => "",
                           "diadesorte" => "",
                           "supersete" => "", 
                           "maismilionaria" => "");