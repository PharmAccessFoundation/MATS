 <style type="text/css">
 #user_edit ul { list-style: none; margin: 0; padding: 0; }
 #user_edit li {     list-style: none;
    padding-bottom: 20px;margin: .2em 0; }
  
  #user_edit ul li label { 
    //float: left; 
    width: 200px; 
    margin-right: 15px; 
    text-align: right;
    list-style: none;
  }
  #user_edit  ul li input { 
    list-style: none;
  }
  input {color: black}
  </style>
  <h2 id="page_title" class="page-title">
	<?php echo ($this->current_user->id !== $_user->id) ?
					sprintf(lang('user:edit_title'), $_user->display_name) :
					lang('profile_edit') ?>
</h2>
<div>
	<?php if (validation_errors()):?>
	<div class="error-box">
		<?php echo validation_errors();?>
	</div>
	<?php endif;?>

	<?php echo form_open_multipart('', array('id'=>'user_edit'));?>

	
		<li>
				<label for="display_name"><?php echo lang('profile_display_name') ?></label>
				<div class="input">
				<?php echo form_input(array('name' => 'display_name', 'id' => 'display_name', 'value' => set_value('display_name', $display_name), "style" => "color: #000")) ?>
				</div>
			</li>

			<?php foreach($profile_fields as $field): ?>
				<?php if($field['input'] && $field['required']): ?>
					<li>
						<label for="<?php echo $field['field_slug'] ?>">
							<?php echo (lang($field['field_name'])) ? lang($field['field_name']) : $field['field_name'];  ?>
							<?php if ($field['required']) echo '<span>*</span>' ?>
						</label>

						<?php if($field['instructions']) echo '<p class="instructions">'.$field['instructions'].'</p>' ?>
						
						<div class="input">
							<?php echo $field['input'] ?>
						</div>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		

		
				<div class="input">
					<?php echo form_hidden('email', $_user->email) ?>
				</div>
			

	<fieldset id="user_password">
            <legend style="color:white"><?php echo lang('user:password_section') ?></legend>
		<ul>
			<li class="">
                            <label for="password" style="display:unset"><?php echo lang('global:password') ?></label><br/>
				<?php echo form_password(array('name' => 'password', 'id' => 'password', 'value' => '', "style" => "color: #000")) ?>
				
			</li>
                        <li class="">
                            <label for="cpassword" style="display:unset"><?php echo 'Confirm Password' ?></label><br/>
				<?php echo form_password(array('name' => 'cpassword', 'id' => 'cpassword', 'value' => '', "style" => "color: #000")) ?>
				
			</li>
                        
		</ul>
	</fieldset>

	<?php if (Settings::get('api_enabled') and Settings::get('api_user_keys')): ?>
		
	<script>
	jQuery(function($) {
		
		$('input#generate_api_key').click(function(){
			
			var url = "<?php echo site_url('api/ajax/generate_key') ?>",
				$button = $(this);
			
			$.post(url, function(data) {
				$button.prop('disabled', true);
				$('span#api_key').text(data.api_key).parent('li').show();
			}, 'json');
			
		});
		
	});
	</script>
		
	<fieldset>
		<legend><?php echo lang('profile_api_section') ?></legend>
		
		<ul>
			<li <?php $api_key or print('style="display:none"') ?>><?php echo sprintf(lang('api:key_message'), '<span id="api_key">'.$api_key.'</span>') ?></li>
			<li>
				<input type="button" id="generate_api_key" value="<?php echo lang('api:generate_key') ?>" />
			</li>
		</ul>
	
	</fieldset>
	<?php endif ?>

	<?php echo form_submit('', lang('profile_save_btn'), 'class="btn btn-info"') ?>
	<?php echo form_close() ?>
</div>