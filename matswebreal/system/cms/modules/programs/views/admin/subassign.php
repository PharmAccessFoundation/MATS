<?php if($err): ?>
<div class="error"><?php echo $err;?></div>
<?php endif; ?>
<?php if($er): ?>
<div class="success"><?php echo $er;?></div>
<?php endif; ?>
<section class="title">
<?php 
$srprogs = array();
foreach($srs as $sr){
   // echo $sr->name.' '.$sr->program_id.'<br>';
    if(!array_key_exists($srprogs,$sr->program_id)){
        $srprogs[$sr->program_id] = $srprogs[$sr->program_id]."<option value='".$sr->id."'>".$sr->name."</option>";
		//echo '<br>step11';
    }else{
		//echo '<br>step2';
        $srprogs[$sr->program_id] =  $srprogs[$sr->program_id]."<option value='".$sr->id."'>".$sr->name."</option>";
    }
}
/*echo '<br>';
var_dump($srs);
echo '<br><br>';
var_dump($srprogs); exit; */
?>
    <strong>Re-Assign Sub-Recipient</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

<div class="panel panel-default" style="margin: 10px;">
        
    <div class="panel-body div_top_hypers" style="">
        <!-- Content tab -->
        <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">

                
        <div class="input form-group">
                        <label for="name">Current Programme<span></span></label>
                        <li class="form-group input-group" style="margin-top: 10px;">
                        <span class="info"><?php echo $pro; ?></span>
                        </li>
                        </div>       
        <div class="input form-group">
                        <label for="name">Current Sub-Recipient<span></span></label>
                        <li class="form-group input-group" style="margin-top: 10px;">
                        <span class="info"><?php echo $sub; ?></span>
                        </li>
                        </div>      
        <div class="input form-group">
                        <label for="name">Current Manager<span></span></label>
                        <li class="form-group input-group" style="margin-top: 10px;">
                        <span class="info"><?php echo $uid->display_name; ?></span>
                        </li>
                        </div>    
        <div class="input form-group">
                        <label for="name">Current State<span></span></label>
                        <li class="form-group input-group" style="margin-top: 10px;">
                        <span class="info"><?php echo $uid->state; ?></span>
                        </li>
                        </div>

             <div class="input form-group">
                        <label for="name">Select Sub-Recipient Programme<span>*</span></label>
                
            <select name="program" id="program" class="form-control">
                 <option value="" selected="selected" >- Select -</option>
							  <?php
                                foreach($progs as $pp){
                                    echo '<option value="'.$pp->id.'">'.strtoupper($pp->name).'</option>';
                                }
                              ?>
              
							</select>
        </div>
            
            <div class="form-group">
							  <label class="control-label">Select New Sub-Recipient</label>
							  <select name="sr" id="sr" class="form-control" required>
                              
							  </select>
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

<script>
    $(document).ready(function () {
        $("#sr").html("<option value=''>-Choose Sub-Recipient Programme First-</option>");
    $("#program").change(function () {
        var val = $(this).val();
        <?php foreach ($srprogs as $pk => $pv): ?>
            if (val == "<?php echo $pk; ?>") {
            $("#sr").html("<?php echo $pv; ?>");
            }else if(val == ""){
                $("#sr").html("<option value=''>-Choose Sub-Recipient Programme First-</option>");
            }
        <?php endforeach; ?>
       /* if (val == "8") {
            $("#sr").html("<option value='test'>item1: test 1</option><option value='test2'>item1: test 2</option>");
        } else if (val == "9") {
            $("#sr").html("<option value='test'>item2: test 1</option><option value='test2'>item2: test 2</option>");
        } else if (val == "10") {
            $("#sr").html("<option value='test'>item3: test 1</option><option value='test2'>item3: test 2</option>");
        } else if (val == "11") {
            $("#sr").html("<option value=''>--select one--</option>");
        }*/
    });
});
</script>