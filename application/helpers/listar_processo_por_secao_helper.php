<?php
function listar_processo_por_secao($departamento)
{
	switch ($departamento->id) {
		case ID_ALMOX_NO_BANCO_DE_DADOS:
		{
			return "<a  href='" . base_url('index.php/processo-listar-almox') . "'>" . $departamento->sigla . "</a>";
		}
		case ID_SALC_NO_BANCO_DE_DADOS:
		{
			return "<a  href='" . base_url('index.php/processo-listar-salc') . "'>" . $departamento->sigla . "</a>";
		}
		case ID_GARAGEM_NO_BANCO_DE_DADOS:
		{
			return "<a  href='" . base_url('index.php/processo-listar-transporte') . "'>" . $departamento->sigla . "</a>";
		}
		case ID_APROV_NO_BANCO_DE_DADOS:
		{
			return "<a  href='" . base_url('index.php/processo-listar-aprov') . "'>" . $departamento->sigla . "</a>";
		}
		case ID_SAUDE_NO_BANCO_DE_DADOS:
		{
			return "<a  href='" . base_url('index.php/processo-listar-saude') . "'>" . $departamento->sigla . "</a>";
		}
		case ID_INFOR_NO_BANCO_DE_DADOS:
		{
			return "<a  href='" . base_url('index.php/processo-listar-informatica') . "'>" . $departamento->sigla . "</a>";
		}
	}
}
