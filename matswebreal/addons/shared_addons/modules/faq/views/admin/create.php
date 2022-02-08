<section class="title">
    <strong><?php echo lang('faq_create_title'); ?></strong>
</section>
<section class="item">
<?php echo form_open('admin/faq/create', 'id="faq" class="crud"'); ?>
<div class="form_inputs">
   <div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Add Active Question
        </div>
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        
    <fieldset>
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                <div class="input form-group">
                <label for="question"><?php echo lang('faq_question_label'); ?><span>*</span></label>
              
                     <input name="question" type="text" value="<?php echo set_value('question'); ?>" />
                </div>
             <div class="input form-group">
                <label for="published"><?php echo lang('faq_published_label'); ?></label>
                
                    <?php echo form_dropdown('published', $publish_options, set_value('published')); ?>
                </div>
             <div class="input form-group">
                <label for="category"><?php echo lang('faq_category_label'); ?></label>
             
                    <?php echo form_dropdown('category', $category_options, set_value('category')); ?>
                </div>
             <div class="input form-group">
                <label for="answer"><?php echo lang('faq_answer_label'); ?></label><br style="clear: both;"/>
                <textarea name="answer" rows="5" cols="80" class="wysiwyg-simple"><?php echo set_value('answer'); ?></textarea>
               </div>
    </fieldset>
</div>
        <div class="buttons" style="padding-bottom: 20px; padding-left: 30px">
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div>
<?php echo form_close(); ?>
</section>