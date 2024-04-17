<?php
/*
function TipoErradoCalculadora()
{
  if($peso == string){
    throw new \Exception('Campo "peso" de CalculadoraIMC recebeu string quando devia receber float');
    $peso = 0;
    return $peso;
  }
    
}
*/
class Exception
{
  private CalculadoraImc $CalculadoraIMC;

  public function __construct(Usuario $usuario)
  {
      $this->usuario = $usuario;
  }
  
}