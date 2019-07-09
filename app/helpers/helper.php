<?php

use App\Notificacao;
use App\Acessos;
use App\Categoria;

function tirarAcentos($string){
	return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç)/","/(ç)/"),explode(" ","a A e E i I o O u U n N C c"),$string);
}

function URL_AMIGAVEL($str){
	$URL_AMIGAVEL = urlencode(tirarAcentos($str));
	return $URL_AMIGAVEL;
}

function NOTIFY($para, $evento, $link, $tipo){
	$n = new Notificacao();
	$n->para = $para;
	$n->evento = $evento;
	$n->link = $link;
	$n->tipo = $tipo;
	$n->visualizado = 0;
	$n->save();
}

function ACESSO($view){
	$nivel = DB::table('acessos')->where('id', Auth::user()->acesso_id)->get()->first();
	$ns = explode(',', $nivel->regras);
	if(!in_array($view, $ns)){
		echo '<meta http-equiv="refresh" content="0;URL=/permissao" />';
		exit;
	}
}

function EXCLUIR_CATEGORIA($id){
	$categoriasRemover = Categoria::where('categoria_id', $id)->get();        
	foreach ($categoriasRemover as $categoria) {
		EXCLUIR_CATEGORIA($categoria->id);
	}
	$a = Categoria::find($id);
	$a->delete();
}


function SUBCATEGORIA($id, $pai){
	$html = '';
	$cats = DB::table('categorias')->where('categoria_id', $id)->get();
	
	foreach($cats as $c){
		$html .= '<tr>
		<td>'.$pai.' -> '.$c->nome.'</td>                                
		<td>
		<a href="/categoria/editar/'.$c->id.'" class="btn btn-info btn-xs btn-options">Editar</a>
		<a onclick="REMOVER(\''.$c->id.'\', \''.$c->nome.'\')" class="btn btn-danger btn-xs btn-options">Remover</a>
		<form id="delete-form-'.$c->id.'" action="/categoria/remover/'.$c->id.'" method="POST" style="display: none;">
		'.csrf_field().'
		</form>
		</td>                        
		</tr>';
		$newPai = $pai.' -> '.$c->nome;
		SUBCATEGORIA($c->id, $newPai);
	}
	
	echo $html;
	
}

function SUBCATEGORIA_SELECT($id, $pai, $id_cat){
	$html = '';
	$cats = DB::table('categorias')->where('categoria_id', $id)->orderBy('nome', 'asc')->get();

	foreach($cats as $C){
		
		if($id_cat == $C->id){
			$selected = "selected";
		}else{
			$selected = "";
		}

		$html .= '<option '.$selected.' value="'.$C->id.'">'.$pai.' -> '.$C->nome.'</option>';

		echo $html;

		$newPai = $pai.' -> '.$C->nome;
		SUBCATEGORIA_SELECT($C->id, $newPai, $id_cat);
	}
}

function CONVERTER_NIVEL($cod_nivel){

	$descricao = '';

	switch($cod_nivel){
		case 0: $descricao = 'Nível Iniciante';
		break;
		case 1: $descricao = 'Nível Médio';
		break;
		case 2: $descricao = 'Nível Avançado';
		break;
	}

	return $descricao;
}
function CONVERTER_TIPO($tipo){

	$descricao = '';

	switch($tipo){
		case 0: $descricao = 'Administrador';
		break;
		case 2: $descricao = 'Aluno';
		break;
		case 1: $descricao = 'Instrutor';
		break;
		case 3: $descricao = 'Afiliado';
		break;
	}

	return $descricao;
}
function CONVERTER_DATA($data){

	if($data != null){
		$data = $data->format('d/m/Y');
	}else{
		$data = null;
	}

	return $data;
}


function CALCULAR_COMISSAO($total, $percentual){
	$r = ($total * $percentual) / 100;
	return number_format($r, 2, ',','');
}

function DOWNLOAD($url){
	$file = $url;
	$nome = 'certificado.jpg';
	header("Content-Description: File Transfer");
	header("Content-Type: image/jpeg");
	header('Content-Disposition: attachment; filename="' . ($nome) . '";'); 
	header('Content-Length: ' . strlen(file_get_contents($file)));
	readfile($file); 
}
function myFloatValue($val){
	$val = str_replace(",",".",$val);
	$val = preg_replace('/\.(?=.*\.)/', '', $val);
	return number_format(floatval($val), 2, '.', '');
}

function buscaCEP($cep)
{
	$class = new Jarouche\ViaCEP\BuscaViaCEPJSONP();
	$result = $class->retornaCEP($cep);
    //echo $class->retornaConteudoRequisicao();
	return $result;
}

function round_up ($value, $places=0)
{
	$juros = 1.99; //deve ser alterado conforme taxa do moip
	$juros_cf = $juros/100;
	$cf = $juros_cf / (1-(1/(($juros_cf + 1) ** 5)));

	if ($places < 0) { $places = 0; }
	$mult = pow(10, $places);
	return ceil($value * $mult) / $mult;
}