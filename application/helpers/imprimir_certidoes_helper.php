<?php
function imprimir_certidoes($processo)
{
	$tcu = false;
	$cadin = false;
	$sicaf = false;

	foreach ($processo->tipo->listaDeArtefatos as $artefato)
	{
		switch ($artefato->id){
			case ARTEFATO_CERTIDAO_TCU_NO_BANCO_DE_DADOS:
			case ARTEFATO_CERTIDAO_CADIN_NO_BANCO_DE_DADOS:
			case ARTEFATO_CERTIDAO_SICAF_NO_BANCO_DE_DADOS:{

				if($artefato->arquivos != array())
				{
					if(file_exists($artefato->arquivos[(count($artefato->arquivos) - 1)]->path))
					{
						switch ($artefato->id) {
							case ARTEFATO_CERTIDAO_TCU_NO_BANCO_DE_DADOS:
							{
								$tcu = true;
								break;
							}
							case ARTEFATO_CERTIDAO_CADIN_NO_BANCO_DE_DADOS:{
								$cadin = true;
								break;
							}
							case ARTEFATO_CERTIDAO_SICAF_NO_BANCO_DE_DADOS:{
								$sicaf = true;
								break;
							}
						}
					}
				}
			}
		}
	}

	if($sicaf && $cadin && $tcu)
	{
		$href = base_url('index.php/ProcessoController/imprimirCertidoes/' . $processo->id);

		return "<a href='{$href}'><i class='fa fa-print' aria-hidden='true'></i></a>";
	}else{
		return "<i class='fa fa-print' aria-hidden='true' disabled></i>";
	}
}
