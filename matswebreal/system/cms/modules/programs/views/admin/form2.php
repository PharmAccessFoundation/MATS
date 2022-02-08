<?php if($err): ?>
<div class="error"><?php echo $err;?></div>
<?php endif; ?>
<?php if($er): ?>
<div class="success"><?php echo $er;?></div>
<?php endif; ?>
<section class="title">

    <strong>Assign Hub Facility</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">
<div class="panel panel-default" style="margin: 10px;">
        
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                <div class="input form-group">
                        <label for="name">Choose Hub Facility<span>*</span></label>
                      
                            <?php 
                            $arr = array();
                            foreach ($facs as $f){
                                if($f->id == 8)  continue;
                                $arr[$f->id] = $f->name;
                            }
                            
                            echo form_dropdown('facility', $arr, array(), 'class=form-control') ;
                            
                            ?>
                    </div>

                     <div class="input form-group">
                        <label for="code">Medical Personnel <span>*</span></label>
                        
                            <?php echo form_input('name', $user->fullname, 'readonly class=form-control'); echo form_hidden('id', $user->reg_id); ?>
                        
                     </div>

                    <div class="buttons">
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
                    </div>
            </fieldset>
        </div>
        <?php echo form_close(); ?>

    </div>	
</section>