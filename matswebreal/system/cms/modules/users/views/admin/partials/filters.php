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
				<span class="input-group-addon"><?php echo lang('user:active', 'f_active') ?></span>
				
				<?php echo form_dropdown('f_active', array(0 => lang('global:select-all'), 1 => lang('global:yes'), 2 => lang('global:no') ), array(0), 'class=form-control') ?>
			</li>

			<li class="form-group input-group" style="float: left;">
				<span class="input-group-addon"><?php echo lang('user:group_label', 'f_group') ?></span>
				<?php echo form_dropdown('f_group', array(0 => lang('global:select-all')) + $groups_select, array(0), 'class=form-control') ?>
			</li>
			
			<li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon"><strong>Keyword</strong></span>
                                    <?php echo form_input('f_keywords', '' , 'class=form-control') ?></li>
			<li><?php echo anchor(current_url(), lang('buttons:cancel'), 'class="btn btn-danger"') ?></li>
		</ul>
	<?php echo form_close() ?>
</fieldset>