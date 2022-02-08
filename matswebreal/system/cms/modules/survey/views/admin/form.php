<?php if($err): ?>
<div class="error"><?php echo $err;?></div>
<?php endif; ?>
<?php if($er): ?>
<div class="success"><?php echo $er;?></div>
<?php endif; ?>
<section class="title">

    <strong>Add New Hub Facility</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Create New Hub Facility
        </div>
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
             <div class="input form-group">
                        <label for="name">Choose Hub Facility State<span>*</span></label>
            <select name="state" id="state" class="form-control">
							  <option value="" selected="selected" >- Select -</option>
                <?php if($this->current_user->group_id == 12): ?>
							  <option value='<?php echo $this->current_user->state; ?>'><?php echo $this->current_user->state; ?></option>
                
                <?php else: ?>
							  <option value='Abia'>Abia</option>
							  <option value='Adamawa'>Adamawa</option>
							  <option value='AkwaIbom'>AkwaIbom</option>
							  <option value='Anambra'>Anambra</option>
							  <option value='Bauchi'>Bauchi</option>
							  <option value='Bayelsa'>Bayelsa</option>
							  <option value='Benue'>Benue</option>
							  <option value='Borno'>Borno</option>
							  <option value='Cross River'>Cross River</option>
							  <option value='Delta'>Delta</option>
							  <option value='Ebonyi'>Ebonyi</option>
							  <option value='Edo'>Edo</option>
							  <option value='Ekiti'>Ekiti</option>
							  <option value='Enugu'>Enugu</option>
							  <option value='FCT'>FCT</option>
							  <option value='Gombe'>Gombe</option>
							  <option value='Imo'>Imo</option>
							  <option value='Jigawa'>Jigawa</option>
							  <option value='Kaduna'>Kaduna</option>
							  <option value='Kano'>Kano</option>
							  <option value='Katsina'>Katsina</option>
							  <option value='Kebbi'>Kebbi</option>
							  <option value='Kogi'>Kogi</option>
							  <option value='Kwara'>Kwara</option>
							  <option value='Lagos'>Lagos</option>
							  <option value='Nasarawa'>Nasarawa</option>
							  <option value='Niger'>Niger</option>
							  <option value='Ogun'>Ogun</option>
							  <option value='Ondo'>Ondo</option>
							  <option value='Osun'>Osun</option>
							  <option value='Oyo'>Oyo</option>
							  <option value='Plateau'>Plateau</option>
							  <option value='Rivers'>Rivers</option>
							  <option value='Sokoto'>Sokoto</option>
							  <option value='Taraba'>Taraba</option>
							  <option value='Yobe'>Yobe</option>
							  <option value='Zamfara'>Zamafara</option>
                                                          <?php endif; ?>
							</select>
        </div>
            
            <div class="form-group">
							  <label class="control-label">LGA</label>
							  <select name="lga" id="lga" class="form-control" required>
							  </select>
						</div>
            
                <div class="input form-group">
                        <label for="name">Hub Facility Name<span>*</span></label>
                            <?php echo form_input('name', '', 'class=form-control') ?>
                        </div>
                    

                  
                       <div class="input form-group">
                        <label for="code">Hub Facility Email <span>*</span></label>
                            <?php echo form_input('code', '', 'class=form-control') ?>
                        </div>
            <?php if($this->current_user->group_id == 12 || $this->current_user->group_id == 16): ?>
                <div class="input form-group">
                        <label for="name">Sub Recipient<span>*</span></label>
                            <?php echo $srr; ?>
                        </div>
                       <div class="input form-group">
                        <label for="code">Programme <span>*</span></label>
                            <?php echo $progg; ?>
                        </div>
            <?php else: ?>
            
            <?php endif; ?>
                   
                    

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