<section class="title">
	<strong><?php echo lang('faq_index_title'); ?></strong>
        <span style="float: right"><a href="admin/faq/create" class="btn">Create New FAQ</a></span>
</section>
<section class="item">
<?php if(!empty($faq)): ?>
	<?php echo form_open('admin/faq/action', 'class="crud"') ?>
			<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Active Questions
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
		<thead>
                <tr>
                        <th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
                        <th><?php echo lang('faq_question_label') ?></th>
                        <th><?php echo lang('faq_category_label') ?></th>
                        <th class="width-5"><?php echo lang('faq_published_label') ?></th>
                        <th class="width-10"><span><?php echo lang('faq_actions_label');?></span></th>
                </tr>
        </thead>
        <tfoot>
                <tr>
                        <td colspan="5">
                                <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                        </td>
                </tr>
        </tfoot>
        <tbody>
            <?php foreach($faq as $f): ?>
            <tr>
                <td class="action-to"><?php echo form_checkbox('action_to[]', $f->id) ?></td>
                <td><?php echo $f->question; ?></td>
                <td><?php echo $category_options[$f->category_id]; ?></td>
                <td><?php echo $f->published; ?></td>
                <td class="buttons buttons-small">
                    <?php echo anchor('admin/faq/edit/'.$f->id, lang('faq_edit_link'), 'rel="ajax" class="btn btn-success"'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
	</table>
                <div class="table_action_buttons" style="padding-bottom: 20px;">
        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
	</div>
            </div> </div> </div>
	<?php echo form_close(); ?>
<?php else: ?>
    <div class="no_data">
        <?php echo lang('faq_no_questions');?>
    </div>
<?php endif; ?>
</section>
