<?php
function exibir_diex($processo)
{
	foreach ($processo->tipo->listaDeArtefatos as $artefato)
	{
		if($artefato->id == ARTEFATO_DIEX_NO_BANCO_DE_DADOS)
		{
			$numero_do_diex = 'DIEx';

			if($artefato->arquivos != array())
			{
				$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

				if($artefato->arquivos[(count($artefato->arquivos) - 1)]->nome !== '')
				{
					$numero_do_diex = $artefato->arquivos[(count($artefato->arquivos) - 1)]->nome;
				}

				if(file_exists($path)){
					return "<a href='" . base_url($path) . "'>{$numero_do_diex}</a>";
				}else{
					return $numero_do_diex;
				}
			}else{
				return $numero_do_diex;
			}
		}
	}
}
