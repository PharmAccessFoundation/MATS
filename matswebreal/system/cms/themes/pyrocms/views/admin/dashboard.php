
<style>
div.panel-body span {display: none; position: absolute; bottom: 0; left: 0; right: 0; background: #333; color: #fff; }
div.panel-body:hover span {
    font-size: 10px;
    display: block; 
    content: " ";
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent black transparent;
  width: 300px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
}

</style>
<div style="margin: 0px; border: none;">

</div>
<?php 
if ($this->current_user->group_id == 7): ?>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total2 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum2 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities2 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers2 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive2 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
    <?php elseif ($this->current_user->group_id == 9): ?>
<!--
    <div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-ambulance fa-5x"></i>
                <h3>20032 </h3>
            </div>
            <div class="panel-footer back-footer-red">
                Referrals

            </div>{{class:getclass cla='<?php //echo $v->student_class ?>'}}
        </div>
    </div>-->

    <?php  
    
    // echo ((trim($this->current_user->state) == '') || (trim(strtolower($this->current_user->state)) == 'select')) ? '5'.$this->current_user->state : '555'.$this->current_user->state;
    if(((trim($this->current_user->state) == '') || (trim(strtolower($this->current_user->state)) == 'select'))):  
   
?>
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total5 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>


    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum5 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities5 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers5 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive5 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
<?php else: ?>
<div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total555 state='<?php echo $this->current_user->state ?>'}}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>


    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum555 state='<?php echo $this->current_user->state ?>'}} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities555 state='<?php echo $this->current_user->state ?>' }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers555 state='<?php echo $this->current_user->state ?>' }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive555 state='<?php echo $this->current_user->state ?>' }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
<?php endif; ?>
    <?php elseif ($this->current_user->group_id == 44): ?>
     <!--<div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-refresh fa-5x"></i>
                <h3>4730</h3>
            </div>
            <div class="panel-footer back-footer-green">
                Self Referrals

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-ambulance fa-5x"></i>
                <h3>20032 </h3>
            </div>
            <div class="panel-footer back-footer-red">
                Referrals

            </div>
        </div>
    </div>-->

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total6 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum6 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities6 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers6 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive6 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
    
<?php elseif ($this->current_user->group_id == 5): ?>
 <!--<div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-refresh fa-5x"></i>
                <h3>4730</h3>
            </div>
            <div class="panel-footer back-footer-green">
                Self Referrals

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-ambulance fa-5x"></i>
                <h3>20032 </h3>
            </div>
            <div class="panel-footer back-footer-red">
                Referrals

            </div>
        </div>
    </div>
 tooltip <div class="tooltip">Hover over me
  <span class="tooltiptext">Tooltip text</span>
</div>-->

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total3:50 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum3 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities3 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers3 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive3 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
 
<?php elseif ($this->current_user->group_id == 12): ?>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total7 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum7 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities7 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers7 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive7 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
  
<?php elseif ($this->current_user->group_id == 13): ?>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total8 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum8 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities8 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers8 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive8 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
        <?php elseif ($this->current_user->group_id == 16): ?>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
<?php elseif ($this->current_user->group_id == 4): ?>
    
    
    <!--<div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-refresh fa-5x"></i>
                <h3>4730</h3>
            </div>
            <div class="panel-footer back-footer-green">
                Self Referrals

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-ambulance fa-5x"></i>
                <h3>20032 </h3>
            </div>
            <div class="panel-footer back-footer-red">
                Referrals

            </div>
        </div>
    </div>-->

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total4 }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum4 }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities4 }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers4 }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive4 }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
<?php else: ?>
     <!--<div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-refresh fa-5x"></i>
                <h3>4730</h3>
            </div>
            <div class="panel-footer back-footer-green">
                Self Referrals

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-ambulance fa-5x"></i>
                <h3>20032 </h3>
            </div>
            <div class="panel-footer back-footer-red">
                Referrals

            </div>
        </div>
    </div>-->

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-clipboard fa-5x"></i>
                <h3>{{ example:total }}</h3>
                <span>Total number of screened individual(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-red">
                Screened

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-exclamation-triangle fa-5x"></i>
                <h3>{{ example:presum }} </h3>
                <span>Total number of presumptive(s) since inception</span>
            </div>
            <div class="panel-footer back-footer-green">
                Presumptives

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-hospital-o fa-5x"></i>
                <h3>{{ example:facilities }}</h3>
                <span>Total number of facilities</span>
            </div>
            <div class="panel-footer back-footer-red">
                Healthcare Facilities

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="fa fa-user-md fa-5x"></i>
                <h3>{{ example:workers }} </h3>
                <span>Total number of active health personnel(s)</span>
            </div>
            <div class="panel-footer back-footer-green">
                Active Health Personnel

            </div>
        </div>
    </div>
    
    
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fa fa-plus-square-o fa-5x"></i>
                <h3>{{ example:positive }}</h3>
                <span>Total number of confirmed positive TB cases</span>
            </div>
            <div class="panel-footer back-footer-red">
                Positive TB Status

            </div>
        </div>
    </div>
<?php endif; ?>


<!-- /. ROW  -->


