<?php

    class OpcoesProcesso
    {

        public function processo($processos)
        {
            $options = $this->selectCabecalho();

            if(isset($processos))
            {
                foreach($processos as $value)
                {
                    $options .= $this->selectLinha($value);
                }
            }
            return $options;
        }

        private function selectCabecalho()
        {
            return "<option value=''>Selecione uma Processo</option>";
        }

        private function selectLinha($value)
        {
            return "<option value='{$value['id']}'>" . $value['objeto'] . ' (Nup/Nud: ' . $value['nup_nud'] . ')' . "</option>";
        }

    }
?>