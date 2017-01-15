<div class="col-md-offset-4 col-sm-offset-3 col-md-4 col-sm-6 col-xs-12">
	<div class="container-fluid">
		<div class="page-header">
			<h1 class="text-center text-info"><?php echo Helper::t('Registration');?></h1>
			<?php require(APP_PATH."/view/_lang.php");?>
		</div>
		<div class="alert alert-info" role="alert"><?php echo Helper::t('Fields marked with * are required');?></div>
		<?php if(isset($act->data['error']) && is_array($act->data['error'])):?>
		<div class="alert alert-danger" role="alert">
			<?php foreach($act->data['error'] as $err){
				echo $err.'<br>';
			}?>
		</div>
		<?php endif;?>
			
		<form action="/sign-up" method="post" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12">E-mail <span class="text-danger">*</span></label>
				<div class="col-sm-7 col-xs-12">
					<input placeholder="E-mail" maxlength="250" class="form-control" type="email" required="required" name="reg[email]" value="<?php echo @$act->data['email'];?>" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12"><?php echo Helper::t('Full name')?> <span class="text-danger">*</span></label>
				<div class="col-sm-7 col-xs-12">
					<input class="form-control" maxlength="300" type="text" required="required" name="reg[full_name]" placeholder="<?php echo Helper::t('Full name');?>" value="<?php echo @$act->data['full_name'];?>" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12"><?php echo Helper::t('Gender')?> <span class="text-danger">*</span></label>
				<div class="col-sm-7 col-xs-12">
					<select name="reg[gender]" class="form-control">
						<option <?php if(@$act->data['gender']==Users::GENDER_MALE) echo 'selected="selected"';?> value="<?=Users::GENDER_MALE;?>"><?php echo Helper::t('Male');?></option>
						<option <?php if(@$act->data['gender']==Users::GENDER_FEMALE) echo 'selected="selected"';?>value="<?=Users::GENDER_FEMALE;?>"><?php echo Helper::t('Female');?></option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12"><?php echo Helper::t('Birth date')?> <span class="text-danger">*</span></label>
				<div class="col-sm-7 col-xs-12">
					<input class="form-control" value="<?php echo @$act->data['date_birth'];?>" type="date" required="required" min="1920-01-01" max="2010-01-01" name="reg[date_birth]" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12"><?php echo Helper::t('Password')?> <span class="text-danger">*</span></label>
				<div class="col-sm-7 col-xs-12">
					<input class="form-control" type="password" value="<?php echo @$act->data['pass'];?>" required="required" name="reg[pass]" maxlength="300" placeholder="<?php echo Helper::t('Password');?>" minlength="8" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12"><?php echo Helper::t('Confirm password')?> <span class="text-danger">*</span></label>
				<div class="col-sm-7 col-xs-12">
					<input class="form-control" maxlength="300" type="password" required="required" name="reg[pass_confirm]" value="<?php echo @$act->data['pass_confirm'];?>" placeholder="<?php echo Helper::t('Confirm password')?>" minlength="8" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label col-xs-12"><?php echo Helper::t('Image')?></label>
				<div class="col-sm-7 col-xs-12">
					<input class="form-control" type="file" accept="image/jpeg, image/png, image/gif" name="reg[image]" />
				</div>
			</div>
			
			<div class="row">
				<input type="submit" class="btn btn-primary col-sm-offset-3 col-xs-offset-0 col-sm-6 col-xs-12" value="<?php echo Helper::t('Send')?>" name="reg[send]"/>
			</div>
			<hr>
			<div class="text-center row">
				<a href="/sign-in"><?php echo Helper::t('Login');?></a>
			</div>
			<br>
		</form>
	</div>
</div>

<script src="/js/main.js"></script>
<script>
	window.onload = App.regFormValidate({
		fSize : <?=$GLOBALS['config']['max-file-size'];?>,
		passMess : '<?=Helper::t('Passwords do not match');?>',
		sizeMess : '<?=Helper::t('The allowable file size');?>',
		typeMess : '<?=Helper::t('Acceptable image formats: jpeg, png, gif');?>'
	});
</script>
