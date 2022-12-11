<?php 
    namespace Lib;  

    class TextFormatting
    {
        public static function amount_in_words( $number = '0', $decimals = 2, $int_only = false ) 
        { 
            $number = (string)$number;  
            $symbol = null; 
            $symbolPlural = null; 
         
            if ( $number > '99999999999999999999999' ) {
                $number = bcdiv( $number, '1000000000000000000000000', $decimals);
                $symbol = 'Septilião';
                $symbolPlural = "Septilhões";  
            }  
            elseif ( $number > '999999999999999999999' ) {
                $number = bcdiv( $number, '1000000000000000000000', $decimals);
                $symbol = 'Sextilião';
                $symbolPlural = "Septilhões";  
            } 
            elseif ( $number > '999999999999999999' ) {
                $number = bcdiv( $number, '1000000000000000000', $decimals);
                $symbol = 'Quintilião'; 
                $symbolPlural = "Quintilhões";  
            } 
            elseif ( $number > '999999999999999' ) {
                $number = bcdiv( $number, '1000000000000000', $decimals);
                $symbol = 'Quatrilião'; 
                $symbolPlural = "Quatrilião";  
            } 
            elseif ( $number > '999999999999' ) {
                $number = bcdiv( $number, '1000000000000', $decimals);
                $symbol = 'Trilião';
                $symbolPlural = "Trilhões";  
            } 
            elseif ( $number > '999999999' ) {
                $number = bcdiv( $number, '1000000000', $decimals);
                $symbol = 'Bilião';
                $symbolPlural = "Bilhões";  
            } 
            elseif ( $number > '999999' ) {
                $number = bcdiv( $number, '1000000', $decimals);
                $symbol = 'Milhão';
                $symbolPlural = 'Milhões';
            } 
            elseif ( $number > '999' ) {
                $number = bcdiv( $number, '1000', $decimals);
                $symbol = 'Mil';
                $symbolPlural = 'Mil';
            }else{
                $symbol = '';
                $symbolPlural = '';
            } 
            
            $currentsymbol =  $number > 1 ? $symbolPlural : $symbol; 

            if ( $int_only ) return "R$ ". (int)$number . " " .  $currentsymbol;

            $var = str_replace(",0", "", number_format($number ,1,",",".") );
           
            return "R$ ".  $var . " " . $currentsymbol; 
        }
    }

/*
1 – Um ou Uma
2 - Dois ou Duas
3 - Três
4 - Quatro
5 - Cinco
6 - Seis
7- Sete
8 - Oito
9 - Nove
10 - Dez
11 - Onze
12 - Doze
13 - Treze
14 - Catorze ou Quatorze
15 - Quinze
16 - Dezesseis
17 - Dezessete
18 - Dezoito
19 - Dezenove
20 - Vinte
21 - Vinte e um
30 - Trinta
40 - Quarenta
50 - Cinquenta
60 - Sessenta
70 - Setenta
80 - Oitenta
90 - Noventa
100 - Cem
101 - Cento e um
200 - Duzentos
300 - Trezentos
400 - Quatrocentos
500 - Quinhentos
600 - Seiscentos
700 - Setecentos
800 - Oitocentos
900 - Novecentos
1000 - Mil
2000 - Dois mil
3000 - Três mil
4000 - Quatro Mil
5000 - Cinco Mil
6000 - Seis Mil
7000 - Sete Mil
8000 - Oito Mil
9000 - Nove Mil
10.000 - Dez Mil
1.000.000 - Um Milhão
1.000.000.000 - Um Bilhão ou Bilião
1.000.000.000.000 - Um Trilhão ou Trilião
1.000.000.000.000.000 - Um Quatrilhão ou Quatrilião
1.000.000.000.000.000.000 - Um Quintilhão ou Quintilião
1.000.000.000.000.000.000.000 - Um Sextilhão ou Sextilião
1.000.000.000.000.000.000.000.000 - Um Septilhão ou Septilião
1.000.000.000.000.000.000.000.000.000 - Um Octilhão ou Octilião
1.000.000.000.000.000.000.000.000.000.000 - Um Nonilhão ou Nonilião
1.000.000.000.000.000.000.000.000.000.000.000 - Um Decilhão ou Decilião
*/