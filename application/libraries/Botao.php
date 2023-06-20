<?php
defined('BASEPATH') or exit('No direct script access allowed');

class botao
{
	private $pagina_atual;
	private $quantidadesDeRegistrosParaMostrar;
	private $quantidadeDeRegistrosNoDB;


	private function numeroDePaginas()
	{
		$numeroDePaginas =
			$this->quantidadeDeRegistrosNoDB /
			$this->quantidadesDeRegistrosParaMostrar;

		if (is_float($numeroDePaginas)) {
			$numeroDePaginas = ((int)$numeroDePaginas) + 1;
		}
		return $numeroDePaginas;
	}

	private function ultimaPaginaParaExibir($quantidade_de_registros)
	{
		/*return
		$this->primeiraPaginaParaExibir() == 1
			? ((($this->primeiraPaginaParaExibir() + 4) >= $this->numeroDePaginas())
				? $this->numeroDePaginas()
				: 4)
			: ((($this->primeiraPaginaParaExibir() + 4) >= $this->numeroDePaginas())
				? $this->pagina_atual
				: $this->primeiraPaginaParaExibir() + 4);*/

		$quantidade = ($quantidade_de_registros / $this->quantidadesDeRegistrosParaMostrar);

		if (is_float($quantidade)) {

			$quantidade = ((int)$quantidade) + 1;
		}

		return $quantidade;

	}

	private function ultima_botao_para_exibir()
	{
		switch ($this->pagina_atual){
			case 1:
			case 2: return 5;
			default: return  $this->pagina_atual +2;
		}

	}

	private function primeiraPaginaParaExibir()
	{

		return
			($this->pagina_atual - 2) < 1
				? 1
				: ($this->pagina_atual - 2);
	}


	public function paginar($controller, $indiceInicial, $quantidade, $mostrar)
	{

		$this->pagina_atual = $indiceInicial;

		$this->quantidadeDeRegistrosNoDB = $quantidade;
		$this->quantidadesDeRegistrosParaMostrar = $mostrar;

		$ultima_pagina = $this->ultimaPaginaParaExibir($this->quantidadeDeRegistrosNoDB);

		return
			"
                <nav aria-label='Page navigation'>
                    <ul class='pagination'>
                        <li>
                            <a class='btn btn-primary' href='" . base_url() . "index.php/{$controller}/1' aria-label='Previous'>
                                <span aria-hidden='true'>&laquo;</span>
                            </a>
                        </li> 
                        " . $this->linkDoBatao($controller) . " 
                        <li>
                            <a class='btn btn-primary' href='" . base_url() . "index.php/{$controller}/" . ($ultima_pagina) . "' aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                ";

	}


	private function linkDoBatao($controller)
	{

		$li = "";

		for ($index = $this->primeiraPaginaParaExibir(); $index <= $this->ultima_botao_para_exibir(); $index++) {

			$disabled = ($index == ($this->pagina_atual + 1)) ? 'disabled' : '';

			$li .= " <li>
                    <a class='btn btn-primary {$disabled}' 
                    href='" . base_url() . "index.php/{$controller}/{$index}'>" . ($index) . "</a></li> ";

		}

		return $li;

	}


}
