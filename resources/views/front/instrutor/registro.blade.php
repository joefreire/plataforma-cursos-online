@extends('layouts.front')
@section('title', 'Registro')

@section('titulo')
    <div class="title">
        <div class="title-image"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>Registrar-se no Tinele como Instrutor</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

@if (Session::has('errors'))
@foreach ($errors->all() as $error)
<div class="alert alert-danger" align="center">
	<span>
		<b> Erro! </b>{{ $error }}
	</span>
</div>
@endforeach
@endif
@if (Session::has('error'))
<div class="alert alert-danger" align="center">
	<span>
		<b> Erro! </b>{{ Session::get('error') }}
	</span>
</div>
@endif
<br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-offset-2">
			<div >

				<form class="form-signin" method="POST" action="/Instrutor/Registro">
					{{ csrf_field() }}

					<div class="row">

						<div class="form-group">
							<label for="name" class="login-title" style="font-size:10pt;">Nome</label>
							<input type="text" name="name" class="form-control" placeholder="Nome" required autofocus>
						</div>

						<div class="form-group">
							<label for="email" class="login-title" style="font-size:10pt;">E-mail</label>
							<input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
						</div>

						<div class="form-group">
							<label for="password" class="login-title" style="font-size:10pt;">Senha</label>
							<input type="password" name="password" class="form-control" placeholder="******" required autofocus>
						</div>

						<div class="form-group">
							<label for="password_confirmation" class="login-title" style="font-size:10pt;">Corfirmar Senha</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="******" required autofocus>
						</div>
					</div>

					<div class="form-group terms">
						<label class="control-label">Termos de uso</label>
						<div class="col-xs-12">
							<div style="border: 1px solid #e5e5e5; height: 300px; overflow: auto; padding: 10px;">
								<p>Termos e condi&ccedil;&otilde;es do instrutor<br />
									Estes Termos e Condi&ccedil;&otilde;es do Instrutor foram atualizados pela &uacute;ltima vez em 15 de agosto de 2018.<br />
									Esses Termos e Condi&ccedil;&otilde;es &eacute; para o usu&aacute;rio que queria transformar seus conhecimentos em dinheiros atrav&eacute;s de cursos online usando a plataforma Tinele. Este &eacute; um acordo vinculativo entre voc&ecirc; e a Tinele. <br />
									2. Contrato<br />
									O contrato do Instrutor &eacute; celebrado diretamente com a Tinele.<br />
									3. Seu Relacionamento com os Alunos<br />
									Os instrutores n&atilde;o rela&ccedil;&atilde;o contratual direta com os alunos. Ter&aacute; acesso apenas as informa&ccedil;&otilde;es b&aacute;sicas do aluno que ser&aacute; mostrada nos relat&oacute;rios de vendas. Voc&ecirc; compreende e concorda que indenizar&aacute; a Tinele por quaisquer problemas decorrentes do uso feito por Voc&ecirc; de quaisquer Dados Relacionados de Alunos.<br />
									4. Obriga&ccedil;&otilde;es<br />
									Como Instrutor, Voc&ecirc; declara, garante e concorda que:<br />
									Acessar&aacute; o site www.tinele.com e criar&aacute; uma conta como instrutor e se Voc&ecirc; optar por cobrar taxas pelos Seus Cursos, tamb&eacute;m precisar&aacute; concordar novamente com os termos de pre&ccedil;os que s&atilde;o apresentados a voc&ecirc; durante o processo de cria&ccedil;&atilde;o do Curso pago;<br />
									Ser&aacute; respons&aacute;vel por todo o Seu Conte&uacute;do Enviado, concorda que &eacute; propriet&aacute;rio ou que det&eacute;m as licen&ccedil;as, direitos, consentimentos e permiss&otilde;es necess&aacute;rios, e tem autoridade para autorizar a Tinele a reproduzir, distribuir, apresentar publicamente, comunicar ao p&uacute;blico, promover, comercializar, usar e explorar qualquer Conte&uacute;do Enviado nos Servi&ccedil;os e por meio deles, da forma contemplada por estes Termos do Instrutor;<br />
									Nenhum Conte&uacute;do Enviado deve infringir ou apropriar-se indevidamente de qualquer direito de propriedade intelectual de terceiros;<br />
									Voc&ecirc; tem os conhecimentos e habilidades e est&aacute; apto a ensinar para terceiros;<br />
									N&atilde;o publicar&aacute; nem fornecer&aacute; qualquer conte&uacute;do ou informa&ccedil;&atilde;o de car&aacute;ter impr&oacute;prio, ofensivo, racista, agressivo, sexista, pornogr&aacute;fico, falso, enganoso, incorreto, infrator, difamat&oacute;rio ou calunioso;<br />
									Voc&ecirc; n&atilde;o carregar&aacute;, publicar&aacute; ou transmitir&aacute;, sem que seja solicitado ou autorizado, qualquer publicidade, material promocional, lixo eletr&ocirc;nico, spam, corrente, esquema de pir&acirc;mide ou qualquer outra forma de solicita&ccedil;&atilde;o (comercial ou n&atilde;o) por meio dos Servi&ccedil;os ou para qualquer Usu&aacute;rio;<br />
									N&atilde;o usar&aacute; os Servi&ccedil;os para quaisquer neg&oacute;cios, exceto para fornecer servi&ccedil;os instrucionais, de tutoria e de ensino a Alunos;<br />
									N&atilde;o se envolver&aacute; em qualquer atividade que exija que a Tinele obtenha licen&ccedil;as ou pague royalties a qualquer terceiro, como, a t&iacute;tulo de exemplo, o pagamento de royalties para apresenta&ccedil;&atilde;o p&uacute;blica de trabalhos musicais ou grava&ccedil;&otilde;es de &aacute;udio;<br />
									N&atilde;o copiar&aacute;, modificar&aacute;, distribuir&aacute;, far&aacute; engenharia reversa, deformar&aacute;, mutilar&aacute;, invadir&aacute; o sistema operacional ou interferir&aacute; no Conte&uacute;do da Empresa e/ou nos Servi&ccedil;os ou nas opera&ccedil;&otilde;es da mesma, exceto conforme permitido nestes Termos do Instrutor;<br />
									N&atilde;o enquadrar&aacute; ou incorporar&aacute; os Servi&ccedil;os de modo a incorporar uma vers&atilde;o de cupom gratuito de seu curso ou outra funcionalidade semelhante com o intuito de burlar os Servi&ccedil;os;<br />
									N&atilde;o se passar&aacute; por outra pessoa ou obter&aacute; acesso n&atilde;o autorizado &agrave; Conta de outra pessoa;<br />
									O uso dos Servi&ccedil;os feito por Voc&ecirc; est&aacute; sujeito &agrave; aprova&ccedil;&atilde;o da Tinele, que pode ser concedida ou negada segundo Nosso exclusivo crit&eacute;rio;<br />
									Voc&ecirc; n&atilde;o introduzir&aacute; v&iacute;rus, worm, spyware ou qualquer outro c&oacute;digo de computador, arquivo ou programa que possa ou que seja destinado a danificar ou prejudicar o funcionamento de qualquer hardware, software ou equipamento de telecomunica&ccedil;&otilde;es, ou qualquer outro aspecto dos Servi&ccedil;os ou o funcionamento dos mesmos; scrape, spider, usar um rob&ocirc; ou outros meios automatizados de qualquer tipo para acessar os Servi&ccedil;os;<br />
									Voc&ecirc; n&atilde;o interferir&aacute; com outros Instrutores nem os impedir&aacute; de fornecer os servi&ccedil;os ou Cursos deles;<br />
									Voc&ecirc; manter&aacute; as informa&ccedil;&otilde;es da Conta precisas;<br />
									Voc&ecirc; responder&aacute; prontamente a Alunos e garantir&aacute; uma qualidade de servi&ccedil;o compat&iacute;vel com os padr&otilde;es gerais de Sua ind&uacute;stria e dos servi&ccedil;os de instru&ccedil;&atilde;o;<br />
								Voc&ecirc; tem mais de 18 anos, ou tem entre 13 e 17 anos e um pai ou tutor legal aceitou estes Termos do Instrutor, bem como todos os Nossos outros termos e pol&iacute;ticas conforme publica&ccedil;&atilde;o peri&oacute;dica em Nossos Servi&ccedil;os, e assumir&aacute; a responsabilidade por Seu cumprimento e conformidade nos termos deste instrumento.</p>

								<p>
									5. Pre&ccedil;o<br />
									O instrutor &eacute; que define quanto cobrar pelos seus cursos, desde que respeite a nossa Politica de Pre&ccedil;os e aceite que 30% do valor de cada venda &eacute; da Tinele. <br />
									6. Pagamentos<br />
									O instrutor receber&aacute; 70% do valor faturamento bruto menos reembolsos solicitados pelos alunos. O pagamento ser&aacute; feito pela via transfer&ecirc;ncia bancaria pela Tinele no &uacute;ltimo dia de cada m&ecirc;s. O instrutor obriga-se a cadastrar uma conta bancaria para receber seus pagamentos.<br />
									7. Reembolsos<br />
								Como instrutor voc&ecirc; reconhece que nem voc&ecirc; nem a Tinele receber&atilde;o nenhum valor compras que os clientes pedirem reembolso, lembrando que o aluno tem 30 dias para pedi seu dinheiro de volta independe do motivo.</p>

								<p>8. Impostos<br />
									Voc&ecirc; entende e concorda que &eacute; respons&aacute;vel por quaisquer impostos sobre sua renda. N&oacute;s nos reservamos o direito de reter o pagamento se n&atilde;o recebermos a documenta&ccedil;&atilde;o tribut&aacute;ria adequada. No que se refere ao imposto sobre as vendas de Seus Cursos, o seguinte se aplica:<br />
									9. Modifica&ccedil;&otilde;es para Estes Termos do Instrutor<br />
								Estes Termos do Instrutor est&atilde;o sujeitos a atualiza&ccedil;&otilde;es ocasionais com o intuito de esclarecer nossas pr&aacute;ticas ou refletir pr&aacute;ticas novas ou diferentes.</p>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-6 col-xs-offset-3">
							<div class="checkbox">
								<label><input type="checkbox" name="termos" required="">Ao marcar eu aceito os Termos e Condições</label>
							</div>
						</div>
					</div>

				</div>

				<button class="btn btn-lg btn-primary btn-block" type="submit">
				Registrar</button>                
			</form>
		</div>            
		<a href="/Instrutor/Login" class="col-sm-6 col-sm-offset-3 text-center new-account" style="text-decoration:none;">Já possuo uma conta.</a>
	</div>
</div>
</div>
<br><br>
@endsection
