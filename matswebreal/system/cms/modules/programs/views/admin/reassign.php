<?php if ($err): ?>
    <div class="error"><?php echo $err; ?></div>
<?php endif; ?>
<?php if ($er): ?>
    <div class="success"><?php echo $er; ?></div>
<?php endif; ?>
<section class="title">

    <strong>Re-assign Spoke Facility To Hub Facility</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

        <div class="panel panel-default" style="margin: 10px;">

            <div class="panel-body div_top_hypers" style="">
                <!-- Content tab -->
                <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                    <div class="input form-group">
                        <label for="code"> Spoke Facility Details: <span></span></label>
                        <br>
                        <span style="color: #0044cc; font-weight: 200"><?php echo '' . $user . ''; ?></span>

                        <?php echo ''; // form_input('name', $user->fullname, 'readonly class=form-control'); echo form_hidden('id', $user->reg_id); ?>

                    </div>
                   <!-- <div class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Hub Facility State</span>
                        <?php// echo $states; ?>
                    </div>

                    <div class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Hub Facility LGA</span>
                        <select name="lga" id="lga" class="form-control" onChange="facpop()">
                        </select>
                    </div>
                    <div class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Hub Facility</span>

                       <?php 
                        //echo form_dropdown('facility', $states, array(), 'class=form-control id=facccc');
                        ?>
                    </div>-->
                    
                    <div class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Hub Facility</span>
                        <?php echo $states; ?>
                    </div>



                    <div class="buttons">
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
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
<script>
    function facpop() {
     // alert(window.location.hostname); exit;
        var url = "http://192.3.137.194/~matslagos/pharm/auth_new.php?callback=?";
        var lga = $("#lga").val();
        var state = $("#state").val();
        var userid = <?php echo $this->current_user->id; ?>;
        var dataString = "lga=" + lga + "&state=" + state + "&userid=" + userid + "&getfac=";

        if (true)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    //$("#facccc").html('<button class="button button-block button-positive">Loading Available Communities...</button>');
                },
                success: function (datay) {
                   // alert(datay);
                    var dp = datay;
                    //document.getElementById("faccc").innerHTML = dp;
                    $("#facccc").html(dp);
                }
            });
        }
    }
</script>