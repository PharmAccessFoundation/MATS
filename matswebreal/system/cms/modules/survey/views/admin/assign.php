<?php if($err): ?>
<div class="error"><?php echo $err;?></div>
<?php endif; ?>
<?php if($er): ?>
<div class="success"><?php echo $er;?></div>
<?php endif; ?>
<section class="title">

    <strong>Assign Spoke Facility</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

<div class="panel panel-default" style="margin: 10px;">
        
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
             <div class="input form-group">
                  <div class="input form-group">
                      <label for="name">Spoke Facility: <span></span></label> <span style="color: green; font-weight: bold;"><?php echo $user->fullname; ?></span> 
                        </div>
                        <label for="name">Hub Facility<span>*</span></label>
                        <?php echo form_dropdown('fac', $arr, array(0));  echo form_hidden('uid', $uid)?>
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