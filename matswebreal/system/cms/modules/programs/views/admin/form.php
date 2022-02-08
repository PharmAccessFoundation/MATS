<?php if($err): ?>
<div class="error"><?php echo $err;?></div>
<?php endif; ?>
<?php if($er): ?>
<div class="success"><?php echo $er;?></div>
<?php endif; ?>
<section class="title">

    <strong>Create New Programme</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

<div class="panel panel-default" style="margin: 10px;">
       
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
             
            
                <div class="input form-group">
                        <label for="name">Programme Name<span>*</span></label>
                            <?php echo form_input('name', '', 'class=form-control') ?>
                        </div>
                    

                  
                       <div class="input form-group">
                        <label for="code">Sponsoring Organization <span>*</span></label>
                            <?php echo form_input('company', '', 'class=form-control') ?>
                        </div>
            
             <div class="input form-group">
                        <label for="code">Programme Manager <span>*</span></label>
                            <?php echo form_dropdown('mid', $progman, array(0), 'class=form-control') ?>
                        </div>
                   
                    

                    <div class="buttons">
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
                    </div>
              
            </fieldset>
            </div>
        </div>
    </div>
        </div>
    </div></div>
        
        <?php echo form_close(); ?>

    </div>	
</section>