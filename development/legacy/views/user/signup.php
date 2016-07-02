<?php require_once(__CONTROLLERS_DIR__.'User.php');if($user->isLoggedIn()){header('Location:'.location('user/'.$user->getUsername(),1));}?>
<fieldset>
	<legend>Registrar</legend>
	<div class="well well-lg">
		<form class="form-horizontal" method="post" action="<?php echo location('user/signup');?>" id="signup-form" name="signup-form" >
			<div class="form-group">
				<label for="<?php echo $i='server';?>" class="col-lg-3 control-label">Servidor</label>
				<div class="col-lg-4">
					<select class="form-control" id="<?php echo $i;?>" name="<?php echo $i;?>">
						<option value="" disabled="disabled" selected="selected">Selecione</option>
						<option value="<?php echo $v='br';?>" <?php if(@$_POST[$i]==$v){echo 'selected="selected"';}?>>Brasil</option>
					</select>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Selecione o servidor.</small> 
				</div>
			</div>
			<div class="form-group">
				<label 	class="col-lg-3 	control-label" for="<?php echo $i='name';?>" ><?php echo $e='Nome de invocador';?></label>
				<div 	class="col-lg-4">
					<input type="text" class="form-control" id="<?php echo $i;?>" name="<?php echo $i;?>" placeholder="<?php echo $e;?>" value="<?php echo @$_POST[$i];?>" autocomplete="off"/>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Use o seu nome de invocador <strong class="text">visível</strong> no jogo.</small> 
				</div>
			</div>
			<div class="form-group has-success">
				<label 	class="col-lg-3 	control-label" >Nome de Usuário</label>
				<div class="col-lg-8 help-block">
					<span class="text-primary lead" id="username">lolcollector.com/<strong class="text-info">nick</strong></span> 
				</div>
			</div>
			<div class="form-group">
				<label 	class="col-lg-3 	control-label" for="<?php echo $i='password';?>" ><?php echo $e='Senha';?></label>
				<div 	class="col-lg-4">
					<input type="password" class="form-control" id="<?php echo $i;?>" name="<?php echo $i;?>" placeholder="<?php echo $e;?>" value="<?php echo @$_POST[$i];?>" autocomplete="off"/>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Cadastre sua senha do <strong class="text">LoL Collector</strong>.</small> 
				</div>
			</div>
			<div class="form-group">
				<label 	class="col-lg-3 	control-label" for="<?php echo $i='passwordConfirm';?>" ><?php echo $e='Senha Repetir';?></label>
				<div 	class="col-lg-4">
					<input type="password" class="form-control" id="<?php echo $i;?>" name="<?php echo $i;?>" placeholder="<?php echo $e;?>" value="<?php echo @$_POST[$i];?>" autocomplete="off"/>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Repita a senha.</small> 
				</div>
			</div>
			<div class="form-group">
				<label 	class="col-lg-3 	control-label" for="<?php echo $i='email';?>" ><?php echo $e='Email';?></label>
				<div 	class="col-lg-4">
					<input type="email" class="form-control" id="<?php echo $i;?>" name="<?php echo $i;?>" placeholder="<?php echo $e;?>" value="<?php echo @$_POST[$i];?>" autocomplete="off"/>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Cadastre um email <strong class="text">válido</strong>.</small> 
				</div>
			</div>
			<div class="form-group">
				<label 	class="col-lg-3 	control-label" for="<?php echo $i='emailConfirm';?>" ><?php echo $e='Email Repetir';?></label>
				<div 	class="col-lg-4">
					<input type="email" class="form-control" id="<?php echo $i;?>" name="<?php echo $i;?>" placeholder="<?php echo $e;?>" value="<?php echo @$_POST[$i];?>" autocomplete="off"/>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Repita o email.</small> 
				</div>
			</div>
			<div class="form-group">
				<label 	class="col-lg-3 control-label" for="<?php echo $i='sex';?>" ><?php echo $e='Sexo';?></label>
				<div 	class="col-lg-4">
					<label class="btn btn-primary">
						<input type="radio" name="<?php echo $i;?>" id="<?php echo $i;?>1" value="<?php echo $v='1';?>" <?php if(@$_POST[$i]==$v){echo 'checked="checked"';}?>>
						Masculino
					</label>
					<label class="btn btn-info">
						<input type="radio" name="<?php echo $i;?>" id="<?php echo $i;?>2" value="<?php echo $v='2';?>" <?php if(@$_POST[$i]==$v){echo 'checked="checked"';}?>>
						Feminino
					</label>
				</div>
				<div class="col-lg-5 help-block">
					<small class="text">Seu sexo.</small> 
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<button type="submit" class="btn btn-lolc btn-lg btn-block" disabled="disabled">Cadastrar</button>
				</div>
				<div class="col-lg-1"></div>
			</div>
		</form>
	</div>
</fieldset>
<?/** /?>
<div class="jumbotron">
	<h1>Caro Invocador</h1>
	<h2>Este serviço esta temporariamente <strong>desabilitado</strong>.</h2>
	<p>Nós estamos modificando o modo de cadastro, para oferecer um serviço diferenciado e melhor!</p>
	<p><a href="<?php echo location('list-summoners'); ?>" class="btn btn-default btn-lg btn-block">Você ainda pode ver a lista de Invocadores registrados.</a></p>
</div>
<?/**/?>