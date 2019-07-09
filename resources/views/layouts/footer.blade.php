		<footer class="footer-bs">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="col-md-4">
							<h6>TINELE</h6>
							<ul class="information">
								<li><a href="/sobre">Sobre a Tinele</a></li>
								<li><a href="#">Ajuda e FAQ</a></li>
								<li><a href="#">Blog</a></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h6>USUÁRIOS</h6>
							<ul class="information">
								<li><a href="/Aluno/Adicionar">Registrar-se</a></li>
								<li><a href="/Instrutor/Registrar">Seja um professor</a></li>
								<li><a href="/Logar">Entrar</a></li>
								<li><a href="/verificar-certificado">Verificar Certificado</a></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h6>CURSOS</h6>
							<ul class="information">
								<li><a href="/Cursos">Recentes</a></li>
								<li><a href="/Cursos">Populares</a></li>
								<li><a href="/Cursos">Grátis</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4 footer-ns animated fadeInRight">
						<h4>Receba as novidades</h4>
						<p>A gente promete enviar só coisas boas!;)</p>
						<p>
							<form action="/newsletter" method="POST">
								{{ csrf_field() }}
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Seu email" name="email" required="" >
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-envelope"></span></button>
									</span>
								</div><!-- /input-group -->
								<input type="hidden" id="aula_assistir_gratis" name="aula_assistir_gratis" value="0">
								<input type="hidden" name="aula_id" value="">
							</form>
						</p>
					</div>
				</div>

				<div class="about">
					<div class='hr'>
						<hr>
						<img src='/images/logo_basic.png' alt=''>
					</div>
					<p>SIGA ESTA CAUSA EDUCACIONAL</p>

					<div class="social-media">
						<ul class="list-inline">
							<li><a href="https://www.facebook.com/tineleead/" title=""><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://www.instagram.com/tineleead/" title=""><i class="fa fa-instagram"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UC20B0sCjtPpnnEtyPHxL0bQ/featured?view_as=subscriber" title=""><i class="fa fa-youtube"></i></a></li>
						</ul>
					</div>
					<p>&copy;2018 Tinele - Todos os direitos reservados</p>
				</div>


			</footer>