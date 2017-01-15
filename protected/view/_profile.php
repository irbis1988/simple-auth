<div class="col-md-offset-4 col-sm-offset-3 col-md-4 col-sm-6 col-xs-12">
	<div class="container-fluid">
		<div class="page-header">
			<h1 class="text-center text-info"><?php echo Helper::t("Your profile");?></h1>
			<?php require(APP_PATH."/view/_lang.php");?>
		</div>
		
		<table class="text-center table table-striped">
			<tbody>
				<tr>
					<td><?php echo Helper::t('Full name');?></td>
					<td><?php echo $act->data['user']->full_name;?></td>
				</tr>
				<tr>
					<td><?php echo Helper::t('Birth date');?></td>
					<td><?php echo date('d.m.Y',strtotime($act->data['user']->date_birth));?></td>
				</tr>
				<tr>
					<td><?php echo Helper::t('E-mail');?></td>
					<td><?php echo $act->data['user']->email;?></td>
				</tr>
				<tr>
					<td><?php echo Helper::t('Gender');?></td>
					<td><?php echo $act->data['user']->getGender();?></td>
				</tr>
				<tr>
					<td><?php echo Helper::t('Registration time');?></td>
					<td><?php echo date('d.m.Y, H:i:s', $act->data['user']->create_time);?></td>
				</tr>
				<?php if($act->data['user']->image):?>
				<tr>
					<td><?php echo Helper::t('Image');?></td>
					<td>
						<img src="/upload/<?php echo $act->data['user']->image;?>" alt="" class="img-thumbnail">
					</td>
				</tr>
				<?php endif;?>
			</tbody>
		</table>
		<hr>
		<div class="text-center row">
			<a href="/sign-out"><?php echo Helper::t('Sign out');?></a>
		</div>
		<br>
	</div>
</div>
