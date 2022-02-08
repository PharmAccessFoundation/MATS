<?php if ($this->method == 'edit'): ?>
	<section class="title">
    	<strong><?php echo sprintf(lang('groups:edit_title'), $group->name) ?></strong>
	</section>
<?php else: ?>
	<section class="title">
    	<strong><?php echo lang('groups:add_title') ?></strong>
	</section>
<?php endif ?>

<section class="item">
	<div class="content">
		<?php echo form_open(uri_string(), 'class="crud"') ?>
		
<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Edit Administrator
        </div>
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                <div class="input form-group">
					<label for="description"><?php echo lang('groups:name');?> <span>*</span></label>
					<?php echo form_input('description', $group->description);?></div>
				
				
				<div class="input form-group">
					<label for="name"><?php echo lang('groups:short_name');?> <span>*</span></label>
					
		
					<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
					<?php echo form_input('name', $group->name);?>
		
					<?php else: ?>
					<p><?php echo $group->name ?></p>
					<?php endif ?>
					
					</div>
            
        <div class="buttons  " >
		
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )) ?>
		</div>
        </div></div></div>
		
		</div>
			
		<?php echo form_close();?>
	</div>
</section>

<script type="text/javascript">
	jQuery(function($) {
		$('form input[name="description"]').keyup($.debounce(300, function(){

			var slug = $('input[name="name"]');

			$.post(SITE_URL + 'ajax/url_title', { title : $(this).val() }, function(new_slug){
				slug.val( new_slug );
			});
		}));
	});
</script>