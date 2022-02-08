<?php 
 if((int)$this->current_user->group_id == 9 && (int)$this->current_user->sub_recipient_type != 0){
        $tyype =  'srcreate';
        } elseif((int)$this->current_user->group_id == 7){
            $tyype =  'prcreate';
            } elseif((int)$this->current_user->group_id == 12 || (int)$this->current_user->group_id == 16){
            $tyype =  'srcreate';
            }else {
          $tyype =  'create';  
}
?>
<section class="title">
	<strong><?php echo lang('user:list_title') ?></strong>
        <span style="float: right"><a href="index.php/admin/users/<?php echo $tyype; ?>" class="btn">Create New User</a></span>
</section>

<section class="item">
	<div class="content">
	
		<?php template_partial('filters') ?>
	
		<?php echo form_open('admin/users/action') ?>
		
			<div id="filter-stage">
				<?php template_partial('tables/users') ?>
			</div>
		
			<div class="table_action_buttons">
				<?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') )) ?>
			</div>
	
		<?php echo form_close() ?>
	</div>
</section>
