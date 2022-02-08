<section class="title">
    <strong>Spoke Facilities</strong> 
</section>

<section class="item">
	<div class="content">
	
		<?php template_partial('filters') ?>
	
		<?php echo form_open('admin/users/action') ?>
		
			<div id="filter-stage">
				<?php template_partial('tables/log') ?>
			</div>
		
			<div class="table_action_buttons">
				<?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') )) ?>
			</div>
	
		<?php echo form_close() ?>
	</div>
</section>
