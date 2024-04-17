<?php

require_once __DIR__ . '/src/Usuario.php';
require_once __DIR__ . '/src/CalculadoraImc.php';
require_once __DIR__ . '/src/SexoEnum.php';
require_once __DIR__ . '/src/ClassificacaoImcEnum.php';

if ($_POST['sexo'] === 'F')
    {
    $sexo = SexoEnum::F;
    } 
else
    {
    $sexo = SexoEnum::M;
    }

/*
$usuario = new Usuario( nome: $_POST['nome'], 
                        peso: $_POST['peso'], 
                        altura: $_POST['altura'],
                        sexo: SexoEnum::from($_POST['sexo']),
                        dataNascimento: new DateTimeImmutable($_POST['data_nascimento']));
*/
function armazenaDadosUsuario()
{
    $usuario = new Usuario( nome: $_POST['nome'], 
    peso: $_POST['peso'], 
    altura: $_POST['altura'],
    sexo: SexoEnum::from($_POST['sexo']),
    dataNascimento: new DateTimeImmutable($_POST['data_nascimento']));

    if(!isset($nome) || !isset($dataNascimento) || !isset($peso) || !isset($altura) || !isset($sexo)) // caso usuario deixe o campo vazio
    {
     throw new Exception("Usuario deixou um campo vazio.");
    }

    iniciaCalculadoraImc($usuario); // passa objeto para nao limitar seu escopo
    calculaIdade($usuario);
    classificaAdolescenteAdulto($usuario);
    trocaValorEstaticoPeloScript($usuario);
}

function iniciaCalculadoraImc($usuario)
{
    $calculadora = new CalculadoraImc($usuario);
}

function calculaIdade($usuario)
{
    $idade = $usuario->getIdadeAtual();
}

function defineSexo($usuario)
{
    $sexo = $usuario->getSexo()->value;
}

function ClassificaAdolescenteAdulto($usuario)
{
    if($idade<=18)
    {
    $resultado = ClassificacaoImcEnum::classifica_adolescente($calculadora->calcular(), $sexo, $idade); 
    }
    else
    {
    $resultado = ClassificacaoImcEnum::classifica_adulto($calculadora->calcular());
    }
}

// 1) ler o template de resposta
$template = file_get_contents(__DIR__ . '/src/templates/resultado.html');

// 2) trocar cada valor estatico pelo valor do script
function trocaValorEstaticoPeloScript($usuario){
    $template = str_replace(
        [
            '{{USUARIO}}',
            '{{PESO}}',
            '{{ALTURA}}',
            '{{IDADE}}',
            '{{SEXO}}',
            '{{ICM}}',
            '{{CLASSIFICACAO}}'
        ],
        [
            $usuario->getNome(),
            $usuario->getPeso(),
            $usuario->getAltura(),
            $usuario->getIdadeAtual(),
            $usuario->getSexo()->value,
            $calculadora->calcular(),
            $resultado
        ],
        $template);
}



echo $template;