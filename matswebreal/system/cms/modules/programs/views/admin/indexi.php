
<section class="title">
    <strong>MATS Medical Programmes</strong>
</section>

<section class="item">
	<div class="content">
	
		<?php template_partial('filters') ?>
	
		<?php echo form_open('admin/users/action') ?>
		
			<div id="filter-stage">
				<?php template_partial('tables/survi') ?>
			</div>
		
			
	
		<?php echo form_close() ?>
	</div>
</section>
