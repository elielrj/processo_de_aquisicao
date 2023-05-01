<?php

interface InterfaceCrudDAO {

    public function criar($objeto);

    public function buscar($indiceInicial, $quantidadeMostrar);

    public function buscarPorId($objetoId);

    public function atualizar($objeto);

    public function desativar($objetoId);
    
    public function ativar($objetoId);

    public function quantidade();

    public function toArray($objeto);

    public function toObject($arrayList);
}
