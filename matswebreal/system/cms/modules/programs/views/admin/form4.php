<?php if($err): ?>
<div class="error"><?php echo $err;?></div>
<?php endif; ?>
<?php if($er): ?>
<div class="success"><?php echo $er;?></div>
<?php endif; ?>
<section class="title">

    <strong>Edit Programme</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

<div class="panel panel-default" style="margin: 10px;">
        
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
            <fieldset>
              
                    
                        
                      <div class="input form-group">
                        
            
                <div class="input form-group">
                        <label for="name">Programme Name<span>*</span></label>
                            <?php echo form_input('name',  $curr->name, 'class=form-control') ?>
                        </div>
                    

                  
                       <div class="input form-group">
                        <label for="code">Organization<span>*</span></label>
                            <?php echo form_input('company',  $curr->company, 'class=form-control') ?>
                        </div>
                   
                   
                    

                    <div class="buttons">
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'), 'class' => 'btn' )) ?>
                    </div>
                    <div class="buttons">
                    <label style="padding-top: 25px"></label><?php echo anchor('/admin/programs', lang('buttons:cancel'), 'class=" btn btn-danger"') ?>
               
                      </div>
            </fieldset>
        </div>
        <?php echo form_close(); ?>

    </div>
</div>
    </div>
   
</section>