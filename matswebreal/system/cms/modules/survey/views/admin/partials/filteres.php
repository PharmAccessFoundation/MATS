

<div class="panel panel-default" style="margin: 10px;">
    <div class="panel-heading">
        Search Filters
    </div>
    <div class="panel-body div_top_hypers" style="">
        <fieldset id="filters">



            <?php echo form_open('') ?>
            <?php echo form_hidden('f_module', $module_details['slug']) ?>

            <ul style="list-style: none; display:  inline; " class="col-md-3 ul_top_hypers">
               <!-- <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Status</span>
                    <?php // echo form_dropdown('f_active', array(1 => 'Active', 0 => 'Not Active', 2 => 'All'), array(2), 'class=form-control') ?>
                </li>-->
                
                       
                
            <?php echo form_close() ?>
        </fieldset>
    </div>
</div>