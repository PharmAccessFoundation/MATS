<section class="title">
    <strong><?php echo lang('faq_category_index_title'); ?></strong>
    <span style="float: right"><a href="admin/faq/categories/create" class="btn">Create New Category</a></span>
</section>
<section class="item">
<?php if(!empty($categories)): ?>
    <?php echo form_open('admin/faq/categories/action', 'class="crud"') ?>
   
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
                <th><?php echo lang('faq_category_label') ?></th>
                <th class="width-5"><?php echo lang('faq_published_label') ?></th>
                <th class="width-10"><span><?php echo lang('faq_actions_label');?></span></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="4">
                    <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach($categories as $c): ?>
            <tr>
                <td><?php echo form_checkbox('action_to[]', $c->id) ?></td>
                <td><?php echo $c->title; ?></td>
                <td><?php echo $c->published; ?></td>
                <td class="buttons buttons-small">
                    <?php echo anchor('admin/faq/categories/edit/'.$c->id, lang('faq_edit_link'), 'rel="ajax" class="btn btn-success"'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                <div class="table_action_buttons"style="padding-bottom: 20px;">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
    </div> </div> </div> </div>
    <?php echo form_close(); ?>
<?php else: ?>
    <div class="no_data">
        <?php echo lang('faq_no_categories');?>
    </div>
<?php endif; ?>
</section>