<section class="title">
    <strong><?php echo lang('faq_category_edit_title'); ?></strong>
</section>
<section class="item">
<?php echo form_open('admin/faq/categories/edit/'.$category->id, 'id="categories" class="crud"'); ?>
<div class="form_inputs">
     <div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Edit Active Category
        </div>
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        
    <fieldset>
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                <div class="input form-group">
                <label for="title"><?php echo lang('faq_category_label'); ?><span class="required-icon tooltip">*</span></label>
               
                    <input name="title" type="text" value="<?php echo $category->title; ?>" />
                </div>
            <div class="input form-group">
                <label for="published"><?php echo lang('faq_published_label'); ?></label>
             
                    <?php echo form_dropdown('published', $publish_options, $category->published); ?>
                <div class="input">
            <div class="input form-group">
                <label for="description"><?php echo lang('faq_category_description_label'); ?></label>
                <textarea name="description" rows="5" cols="80"><?php echo $category->description; ?></textarea>
            </div>
    </fieldset>
</div>
<input type="hidden" name="category_id" value="<?php echo $category->id; ?>" />
<div class="buttons" style="padding-bottom: 20px; padding-left: 20px">
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div></div></div></div>
<?php echo form_close(); ?>
</section>