
<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Filters
        </div>
    <div class="panel-body div_top_hypers" style="">
<fieldset id="filters">
	
	<?php echo form_open('') ?>
	<?php echo form_hidden('f_module', $module_details['slug']) ?>
		 <ul style="list-style: none; display:  inline; " class="col-md-3 ul_top_hypers">
            <li class="form-group input-group" style="float: left;">
				<span class="input-group-addon">Hub Facility</span>
				<?php echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $fac_select, array(0), 'class=form-control' ) ?>
			</li>
			
			<li class="form-group input-group" style="float: left;">
				<span class="input-group-addon">Name</span><?php echo form_input('f_name', '', 'class=form-control') ?></li>
			<li class="form-group input-group"><?php echo anchor(current_url(), lang('buttons:cancel'), 'class="btn btn-danger"') ?></li>
		</ul>
	<?php echo form_close() ?>
</fieldset>