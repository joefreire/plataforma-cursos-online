@extends('layouts.front')
@section('title', 'Registro')
@section('titulo')
    <div class="title">
        <div class="title-image"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>Registrar-se no Tinele como Aluno</h2>
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
				
				<form class="form-signin" method="POST" action="/Aluno/Adicionar">
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
								<p>Termos de uso <br />
									Estes Termos de Uso (&quot;Termos&quot;) foram atualizados pela &uacute;ltima vez em agosto de 2018.<br />
									A Miss&atilde;o da Tinele &eacute; ajudar as pessoas atrav&eacute;s do ensino e aprendizagem, a encontrarem seus prop&oacute;sitos e transformarem o mundo como suas miss&otilde;es de vida. A nossa Vis&atilde;o &eacute; Ser a maior plataforma de educa&ccedil;&atilde;o online do mundo antes de 2025. Nosso Valores S&atilde;o Liberdade, Efici&ecirc;ncia, &Eacute;tica, Meritocracia, Excel&ecirc;ncia, seriedade, agilidade, respeito aos parceiros, clientes e colaboradores.<br />
									Aqui voc&ecirc; pode transformar seus conhecimentos em dinheiro ou adquirir conhecimentos e habilidades para ganhar dinheiro. Para sermos a melhor solu&ccedil;&atilde;o para instrutores ensinarem e alunos aprenderem e transformarem suas vidas precisamos de regras, para manter a seguran&ccedil;a de nossa plataforma e nossos servi&ccedil;os para o usu&aacute;rio, para nossa empresa e nossa comunidade de alunos e instrutores. Estes Termos se aplicam a todas as atividades do usu&aacute;rio no site da Tinele.<br />
									Ao publicar um curso na Tinele, o instrutor dever&aacute; tamb&eacute;m concordar com o Contrato do Instrutor. Al&eacute;m disso deve respeitar a nossa Pol&iacute;tica de Privacidade, temos um grande cuidado e respeito com os dados de nossos usu&aacute;rios.<br />
									1. Contas<br />
									Para usar a maioria dos nossos produtos e servi&ccedil;os o usu&aacute;rio precisa criar uma conta em nosso site, temos basicamente tr&ecirc;s tipos de contas, s&atilde;o elas: Aluno, Instrutor e Afiliado (funcionalidade ainda em desenvolvimento). Para se cadastrar como qualquer uma das fun&ccedil;&otilde;es acima o usu&aacute;rio n&atilde;o pagar&aacute; absolutamente nada. Cobramos apenas por produtos e servi&ccedil;os que o usu&aacute;rio venha contratar.<br />
									2. Inscri&ccedil;&atilde;o em cursos e acesso vital&iacute;cio<br />
									Ao se matricular em um curso na Tinele seja gratuito ou pago o aluno recebe uma licen&ccedil;a de acesso vital&iacute;cio ao conte&uacute;do do curso, sendo que s&oacute; pode consumir o conte&uacute;do em nossa pr&oacute;pria plataforma, &eacute; proibido compartilhar qualquer conte&uacute;do. O aluno s&oacute; pode fazer download dos conte&uacute;dos complementares, para fins de seu pr&oacute;prio aprendizado sem poder compartilhar ou vender para ningu&eacute;m.<br />
									3. Pagamentos e reembolsos<br />
									Ao efetuar o pagamento de qualquer um dos cursos Tinele o aluno concorda em usar um m&eacute;todo de pagamento v&aacute;lido e seguro. Ap&oacute;s a confirma&ccedil;&atilde;o do pagamento o aluno ter&aacute; acesso imediato ao curso comprado e conta com garantia de 30 dias, sendo que poder&aacute; pedi reembolso do valor investido no curso.<br />
									3.1 Pre&ccedil;os<br />
									Os pre&ccedil;os dos cursos vendidos na Tinele s&atilde;o determinados pelo nosso Contrato com Instrutor com base na nossa pol&iacute;tica de pre&ccedil;os. O instrutor tem a possibilidade de criar cursos gratuitos ou pagos, fica a seu crit&eacute;rio essa decis&atilde;o.<br />
									A Tinele tem autoriza&ccedil;&atilde;o para realizar promo&ccedil;&otilde;es de todos os cursos do nosso cat&aacute;logo, portanto em alguns momentos vamos criar promo&ccedil;&otilde;es com descontos nossos cursos e tamb&eacute;m cupom de desconto para nossos clientes.<br />
									3.2 Pagamentos<br />
									Ao optar pela compra de um curso pago o usu&aacute;rio concorda em pagar a taxa &uacute;nica referente ao determinado curso adquirido, bem como nos autoriza cobrar atrav&eacute;s do seu meio de pagamento escolhido, seja cart&atilde;o de credito, debito, transfer&ecirc;ncia bancaria ou boleto.<br />
									Todos as nossas transa&ccedil;&otilde;es financeiras s&atilde;o processadas por parceiros de processamento de pagamentos terceirizados para oferecer ao usu&aacute;rio os m&eacute;todos de pagamento mais convenientes poss&iacute;veis no pa&iacute;s em que residem e para manter a seguran&ccedil;a das informa&ccedil;&otilde;es de pagamento do usu&aacute;rio. <br />
									3.3 Reembolsos<br />
									Ao adquirir e pagar por um curso na Tinele o cliente conta com uma garantia incondicional de 30 dias, se por qualquer motivo ele entender que o curso adquirido n&atilde;o &eacute; pra ele, poder&aacute; no per&iacute;odo de 30 dias pedi seu dinheiro de volta sem a necessidade de nenhuma explica&ccedil;&atilde;o. Basta enviar um e-mail com as informa&ccedil;&otilde;es da compra para reembolso@tinele.com.<br />
									4. Regras sobre conte&uacute;do e comportamento<br />
									O usu&aacute;rio s&oacute; poder&aacute; usar a Tinele para fins l&iacute;citos. O usu&aacute;rio &eacute; respons&aacute;vel por qualquer conte&uacute;do que venha publicar na nossa plataforma. Cabe ao usu&aacute;rio manter as avalia&ccedil;&otilde;es, perguntas, publica&ccedil;&otilde;es, cursos e outros conte&uacute;dos transferidos sendo de sua responsabilidade a an&aacute;lise desse conte&uacute;do, sempre respeitando a lei e respeitando o direito de propriedade intelectual.<br />
									5. Direitos da Tinele sobre o conte&uacute;do publicado pelo usu&aacute;rio<br />
									&Eacute; de propriedade do usu&aacute;rio o conte&uacute;do publicado por ele em nossa plataforma, inclusive os cursos. Ao publicar um conte&uacute;do o usu&aacute;rio nos da permiss&atilde;o para compartilhar esse conte&uacute;do em qualquer m&iacute;dia, inclusive promove-lo em publicidade em outros sites e ve&iacute;culos de comunica&ccedil;&atilde;o.<br />
									6. Riscos ao Utilizar a Tinele<br />
								Qualquer pessoa pode usar a Tinele para criar e publicar cursos, os instrutores e alunos podem interagir para fins de ensino e aprendizagem, assim como em qualquer outra plataforma essa intera&ccedil;&atilde;o e utiliza&ccedil;&atilde;o dos conte&uacute;dos &eacute; de responsabilidades dos usu&aacute;rios, mesmo a gente se esfor&ccedil;ando para oferecer a melhor solu&ccedil;&atilde;o estamos sujeitos a falhas, portanto o usu&aacute;rio concorda que pode haver falhas. N&atilde;o revisamos nem editamos os cursos publicados na Tinele, portanto &eacute; de total responsabilidade do instrutor o conte&uacute;do de seu curso.</p>

								<p>7. Direitos da Tinele<br />
									A Tinele &eacute; propriet&aacute;ria de toda tecnologia, metodologia e modelo de neg&oacute;cios, inclusive sites, logotipos, API, c&oacute;digos e conte&uacute;do criados por nossos funcion&aacute;rios. &Eacute; proibido adulter&aacute;-los ou us&aacute;-los sem autoriza&ccedil;&atilde;o.<br />
									8. Termos legais - Diversos<br />
									Esse termo tem efeito de qualquer outro contrato, portanto &eacute; fundamental que a Tinele e o usu&aacute;rio respeitem esse acordo e regras para evitar conflitos e problemas. <br />
									9. Resolu&ccedil;&atilde;o de conflitos<br />
									Em caso de conflitos a nossa equipe de suporte se esfor&ccedil;ar&aacute; ao m&aacute;ximo para solucionar o problema da melhor forma poss&iacute;vel. N&atilde;o havendo acordo o usu&aacute;rio poder&aacute; recorrer ao tribunal de pequenas causas ou apresentar a reivindica&ccedil;&atilde;o em arbitragem. &Eacute; proibido apresentar a reivindica&ccedil;&atilde;o em outro tribunal ou participar de a&ccedil;&atilde;o coletiva n&atilde;o individual contra a Tinele.<br />
									10. Atualiza&ccedil;&atilde;o destes Termos<br />
									Buscando melhorar a cada dia a Tinele de tempos em tempos vai atualizar esse termo para esclarecer nossas pr&aacute;ticas ou para refletir pr&aacute;ticas novas ou e reserva-se o direito, a seu exclusivo crit&eacute;rio, de modificar e/ou fazer altera&ccedil;&otilde;es nestes Termos, a qualquer momento.<br />
									11. Como entrar em contato conosco<br />
									A melhor maneira de entrar em contato conosco &eacute; atrav&eacute;s da nossa equipe de atendimento e suporte. &Eacute; uma satisfa&ccedil;&atilde;o atender nossos usu&aacute;rios, portanto sinta-se livre para entrar em contato.<br />
								</p>
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
		<a href="/Aluno/Logar" class="col-sm-6 col-sm-offset-3 text-center new-account" style="text-decoration:none;">Já possuo uma conta.</a>
	</div>
</div>
</div>
<br><br>
@endsection
