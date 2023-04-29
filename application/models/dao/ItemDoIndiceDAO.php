<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/ItemDoIndice.php');

class ItemDoIndiceDAO extends CI_Model
{

    public static $TABELA_DB = 'item_do_indice';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($itemDoIndice)
    {
        $this->db->insert(
            self::$TABELA_DB,
            array(
                'ordem' => $itemDoIndice->ordem,
                'status' => $itemDoIndice->status
            )
        );
    }

    public function retrive($indiceInicial, $mostrar)
    {

        $resultado = $this->db->get(
            self::$TABELA_DB,
            $mostrar,
            $indiceInicial
        );

        $listaDeItemDoIndices = array();

        foreach ($resultado->result() as $linha) {

            $itemDoIndice = new ItemDoIndice(
                $linha->id,
                $linha->ordem,
                $linha->status
            );

            array_push($listaDeItemDoIndices, $itemDoIndice);
        }
        return $listaDeItemDoIndices;
    }

    public function retriveId($id)
    {

        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
            );

        foreach ($resultado->result() as $linha) {

            return new ItemDoIndice(
                $linha->id,
                $linha->ordem,
                $linha->status
            );
        }
    }

    public function update($itemDoIndice)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'id' => $itemDoIndice->id,
                'ordem' => $itemDoIndice->ordem,
                'status' => $itemDoIndice->status
            ),
            array('id' => $itemDoIndice->id)
        );
    }

    public function delete($id)
    {
        return $this->db->delete(
            self::$TABELA_DB,
            array('id' => $id)
        );
    }

    public function count_rows()
    {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

}