<?php if (@$err): ?>
    <div class="error"><?php echo $err; ?></div>
<?php endif; ?>
<?php if (@$er): ?>
    <div class="success"><?php echo $er; ?></div>
<?php endif; ?>
<section class="title">

    <strong>Assign Administrator To A State</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

        <div class="panel panel-default" style="margin: 10px;">

            <div class="panel-body div_top_hypers" style="">
                <!-- Content tab -->
                <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                    <div class="input form-group">
                        <label for="code"> State Details: <?php echo $states->name; ?><span></span></label>
                        <br>

                        <?php echo ''; // form_input('name', $user->fullname, 'readonly class=form-control'); echo form_hidden('id', $user->reg_id); ?>

                    </div>
                    <div class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Select State Manager</span>
                        <select name="manager" id="manager">
                            <option value="">--Select--</option>
                            <?php
                            foreach ($users as $zo) {
                                echo "<option value=$zo->user_id>$zo->display_name ($zo->organization)</option>"; 
                            }
                            ?>
                        </select>
                    </div>




                <div class="buttons">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
                </div>
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