<?php
function exibir_ne($processo)
{
	foreach ($processo->tipo->listaDeArtefatos as $artefato)
	{
		if($artefato->id == ARTEFATO_NOTA_DE_EMPENHO_NO_BANCO_DE_DADOS)
		{
			$numero_da_nota_de_empenho = 'NE';

			if($artefato->arquivos != array())
			{
				$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

				if($artefato->arquivos[(count($artefato->arquivos) - 1)]->nome !== '')
				{
					$numero_da_nota_de_empenho = $artefato->arquivos[(count($artefato->arquivos) - 1)]->nome;
				}

				if(file_exists($path)){
					return "<a href='" . base_url($path) . "'>{$numero_da_nota_de_empenho}</a>";
				}else{
					return $numero_da_nota_de_empenho;
				}
			}else{
				return $numero_da_nota_de_empenho;
			}
		}
	}
}
