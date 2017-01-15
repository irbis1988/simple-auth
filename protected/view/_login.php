<div class="col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-md-4 col-sm-6 col-xs-12">
	<div class="container-fluid">
		<div class="page-header">
			<h1 class="text-center text-info"><?php echo Helper::t('Authorisation');?></h1>
			<?php require(APP_PATH."/view/_lang.php");?>
		</div>
		<?php if($act->message!==''):?>
		<div class="alert alert-success" role="alert">
			<?php echo $act->message;?><br>
		</div>
		<?php elseif(isset($act->data['error'])):?>
		<div class="alert alert-danger" role="alert">
			<?php echo $act->data['error'];?><br>
		</div>
		<?php endif;?>
		
		<form action="/sign-in" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="email" class="col-sm-4 control-label col-xs-12">E-mail</label>
				<div class="col-sm-8 col-xs-12">
					<input placeholder="E-mail" class="form-control" maxlength="250" type="email" required="required" name="auth[email]" value="<?php echo @$act->data['email'];?>" />
				</div>
			</div>
			<div class="form-group">
				<label for="pass" class="col-sm-4 control-label col-xs-12"><?php echo Helper::t('Password')?></label>
				<div class="col-sm-8 col-xs-12">
					<input class="form-control" type="password" maxlength="300" required="required" name="auth[pass]" placeholder="<?php echo Helper::t('Password')?>" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="auth[remember]" value="1"> <?php echo Helper::t('Remember me')?>
						</label>
					</div>
				</div>
			</div>
			<div class="row">
				<input type="submit" class="btn btn-primary col-sm-offset-3 col-xs-offset-0 col-sm-6 col-xs-12" value="<?php echo Helper::t('Enter')?>" name="auth[enter]"/>
			</div>
			<hr>
			<div class="text-center row">
				<a href="/sign-up"><?php echo Helper::t('Registration');?></a>
			</div>
			<br>
		</form>
	</div>
</div>
