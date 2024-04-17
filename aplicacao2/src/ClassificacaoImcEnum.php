<?php


enum ClassificacaoImcEnum: string
{
    case Magreza            = 'Magreza';
    case Normal             = 'Normal';
    case Sobrepeso          = 'Sobrepeso';
    case ObesidadeGrauI     = 'Obesidade grau I';
    case ObesidadeGrauII    = 'Obesidade grau II';
    case ObesidadeGrauIII   = 'Obesidade grau III';

    public static function classifica_adulto(float $imc): string
    {

        if ($imc >= 40) {
            return 'Obesidade grau III';
        }

        if ($imc >= 35 && $imc < 40) {
            return 'Obesidade grau II';
        }

        if ($imc >= 30 && $imc < 35) {
            return 'Obesidade grau I';
        }

        if ($imc >= 25 && $imc < 30) {
            return 'Sobrepeso';
        }

        if ($imc >= 18.5 && $imc < 25) {
            return 'Normal';
        }

        if ($imc < 18.5) {
            return  'Magreza';
        }
    }
    public static function classifica_adolescente(float $imc, string $sexo, int $idade): string
    {
        $Femininos = [
            10 => [14.23, 15.09, 17.00, 20.19, 23.20],
            11 => [14.60, 15.53, 17.67, 21.18, 24.59],
            12 => [14.98, 15.98, 18.35, 22.17, 25.95],
            13 => [15.36, 16.43, 18.95, 23.08, 27.07],
            14 => [15.67, 16.79, 19.32, 23.88, 27.97],
            15 => [16.01, 17.16, 19.69, 24.29, 28.51],
            16 => [16.37, 17.54, 20.09, 24.74, 29.10],
            17 => [16.59, 17.81, 20.36, 25.23, 29.72],
            18 => [16.71, 17.99, 20.57, 25.56, 30.22],
            19 => [16.87, 18.20, 20.80, 25.85, 30.72]
        ];
         
        $Masculinos = [
            10 => [14.42, 15.15, 16.72, 19.60, 22.60],
            11 => [14.83, 15.59, 17.28, 20.35, 23.70],
            12 => [15.24, 16.06, 17.87, 21.12, 24.89],
            13 => [15.73, 16.62, 18.53, 21.93, 25.93],
            14 => [16.18, 17.20, 19.22, 22.77, 26.93],
            15 => [16.59, 17.76, 19.92, 23.63, 27.76],
            16 => [17.01, 18.32, 20.63, 24.45, 28.53],
            17 => [17.31, 18.68, 21.12, 25.28, 29.32],
            18 => [17.54, 18.89, 21.45, 25.95, 30.02],
            19 => [17.80, 19.20, 21.86, 26.36, 30.66]
        ];
    
        $tabela = ($sexo === 'M') ?  $Masculinos[$idade] : $Femininos[$idade];
         
        if ($imc < $tabela[0]) {
            return 'Magreza';
        } elseif ($imc >= $tabela[0] && $imc < $tabela[1]) {
            return 'Normal';
        } elseif ($imc >= $tabela[1] && $imc < $tabela[2]) {
            return 'Sobrepeso';
        } elseif ($imc >= $tabela[2] && $imc < $tabela[3]) {
            return 'Obesidade grau I';
        } elseif ($imc >= $tabela[3] && $imc < $tabela[4]) {
            return 'Obesidade grau II';
        } else {
            return 'Obesidade grau III';
        }
    }

}

