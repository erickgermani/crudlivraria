<?php
class Roteador
{
    private $rotas = [];

    public function add(string $rota, callable $metodo, ...$params)
    {
        $this->rotas[$rota] = ["action" => $metodo, "params" => $params];

        return $this;
    }

    public function dispatch(string $rota)
    {
        $rota = $this->rotas[$rota] ?? null;

        if ($rota) {
            return $rota['action'](...$rota['params']);
        }
    }
}
?>