<?php

class CriadorDeBotoes
{
	private $controller;
	private $quantidae_de_registros_no_banco_de_dados;
	private $quantidae_de_itens_por_botao_para_mostrar;
	private $botao_inicial;// #1# 2 3 4 5 6 7 = 1
	private $botao_atual;// 1 2 3 4 5 6 #7# = 2
	private $botao_final;// 1 2 3 3 4 5 6 #7# = 7

	private $pagina_inicial = 1; // sempre = 1			1 default ou vem ao clicak em botão
	private $pagina_final; // sempre igual a  $quantidae_de_registros_no_banco_de_dados/mostrar				qtd_reg_db / qtd_exibir_em_tela (página final é igual a qtd de botões)

	public function __construct($array)
	{
		$this->controller = $array['controller'];
		$this->quantidae_de_registros_no_banco_de_dados = $array['quantidae_de_registros_no_banco_de_dados'];
	}

	public function listar($botao_atual, $quantidae_de_itens_por_botao_para_mostrar = 10)
	{
		$this->botao_atual = ++$botao_atual;

		$this->quantidae_de_itens_por_botao_para_mostrar = $quantidae_de_itens_por_botao_para_mostrar;

		return $this->primeiroBotao() . $this->botoes() . $this->ultimoBotao();
	}

	public function botoes()
	{
		$quantidade_de_botoes = $this->quantidae_de_registros_no_banco_de_dados / $this->quantidae_de_itens_por_botao_para_mostrar;

		$quantidade_de_botoes = is_float($quantidade_de_botoes) ? ((int)$quantidade_de_botoes + 1) : $quantidade_de_botoes;

		$this->pagina_final = $quantidade_de_botoes;

		return $this->botoesParaExibir();
	}

	public function botoesParaExibir()
	{
		$value = '';

		if ($this->pagina_final == 1) {
			$this->botao_final = $this->pagina_final;
			$this->botao_inicial = $this->pagina_final;
		} else if ($this->pagina_final <= 5) {
			$this->botao_final = $this->pagina_final;
			$this->botao_inicial = 1;
		} else {

			if ($this->botao_atual == 1) {
				$this->botao_final = 5;
			} else if ($this->botao_atual == 2) {
				$this->botao_final = 5;
			} else {
				$this->botao_final = $this->botao_atual + 2;
			}

			if ($this->botao_final > $this->pagina_final) {
				$this->botao_final = $this->pagina_final;

				if (($this->botao_final - 4) > 0) {
					$this->botao_inicial = $this->botao_final - 4;
				} else {
					$this->botao_inicial = 1;
				}
			} else {
				$this->botao_inicial = $this->botao_atual - 2;

				if ($this->botao_inicial < 1) {
					$this->botao_inicial = 1;
				}
			}
		}


		for ($index = $this->botao_inicial; $index <= $this->botao_final; $index++) {

			$disabled = ($index == $this->botao_atual) ? 'disabled' : '';

			$value .= " <li>
                    <a class='btn btn-primary {$disabled}' 
                    href='" . base_url() . "index.php/{$this->controller}/listar/{$index}'>" . ($index) . "</a></li> ";

		}

		return $value;
	}

	private function primeiroBotao()
	{
		$disabled = ($this->pagina_inicial == $this->botao_atual) ? 'disabled' : '';

		return "<nav aria-label='Page navigation'>
                    <ul class='pagination'>
                        <li>
                            <a class='btn btn-primary {$disabled}' href='" . base_url() . "index.php/{$this->controller}/listar/{$this->pagina_inicial}' aria-label='Previous'>
                                <span aria-hidden='true'>&laquo;</span>
                            </a>
                        </li>";
	}

	private function ultimoBotao()
	{
		$disabled = ($this->pagina_final == $this->botao_atual) ? 'disabled' : '';

		return "<li>
                            <a class='btn btn-primary {$disabled}' href='" . base_url() . "index.php/{$this->controller}/listar/" . ($this->pagina_final) . "' aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>";
	}
}
