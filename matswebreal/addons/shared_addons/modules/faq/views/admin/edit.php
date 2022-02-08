<section class="title">
    <strong><?php echo lang('faq_edit_title'); ?></strong>
</section>
<section class="item">
<?php echo form_open('admin/faq/edit/'.$faq->id, 'id="faq" class="crud"'); ?>
<div class="form_inputs">
       <div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Edit Active Question
        </div>
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        
    <fieldset>
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                <div class="input form-group">
                <label for="question"><?php echo lang('faq_question_label'); ?><span class="required-icon tooltip">*</span></label>
                    <input name="question" type="text" value="<?php echo $faq->question; ?>" />
                </div>
            
             <div class="input form-group">
                <label for="published"><?php echo lang('faq_published_label'); ?></label>
                    <?php echo form_dropdown('published', $publish_options, $faq->published); ?>
                </div>
            
             <div class="input form-group">
                <label for="category"><?php echo lang('faq_category_label'); ?></label>
                    <?php echo form_dropdown('category', $category_options, $faq->category_id); ?>
                </div>
            
            <div class="input form-group">
                <label for="answer"><?php echo lang('faq_answer_label'); ?></label><br style="clear:both;">
                <textarea class="wysiwyg-simple" name="answer" rows="10" cols="40"><?php echo $faq->answer; ?></textarea>
            </div>
        <input type="hidden" name="faq_id" value="<?php echo $faq->id; ?>" />
    </fieldset>
</div>
        <div class="buttons" style="padding-left: 20px; padding-bottom: 20px">
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div>
         </div> </div> </div>
<?php echo form_close(); ?>
</section>