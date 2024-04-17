<?php


class CalculadoraImc
{
    private Usuario $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }


    public function calcular(): float
    {
        $resultado = number_format($this->usuario->getPeso() / ($this->usuario->getAltura() * $this->usuario->getAltura()), 2);
        return $resultado;
    }
}