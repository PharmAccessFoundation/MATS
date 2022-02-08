<script type="text/javascript">
    $(document).ready(function() {
        $("#formWizard").formToWizard({submitButton: 'submitForm'})
    });
</script>
<style>
    .review{
        padding-left: 15px;
    }
    .element{
        color: #990000;
    }
    .element span{
        color: steelblue;
    }
</style>
<ul class="breadcrumb">
    <li><i class="icon-arrow-left"></i><a href="index.php/convergy/listings"> Back</a> <span class="divider"></span></li>

    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>
</ul>

<!-- ==================== MASTER ACTIONS ROW ==================== -->
<div class="row-fluid" >
    <div class="span5" >
        <?php if (@$assets): $ass = 'yes'; ?>
            <?php $my = array_shift($assets); ?>
            <div class="containerHeadline">
                <i class="icon-list-ol"></i><h2><strong><?php echo strtoupper($my->title) ?></strong></h2>

                <div class="pull-right btn-toolbar"> <i class="icon-print"></i><h2><a onclick="window.print();" >Print</a></h2></div>
                <div class="pull-right btn-toolbar">
                    <div class="controlButton pull-right">
                    </div>
                    <div class="controlButton pull-right">
                    </div>
                </div>
            </div>
            <div class="floatingBox formWizard">
                <div class="container-fluid">

                    <div style="padding:10px; font-size:14px">
                        <div style="padding: 10px;">
                            <span>

                                <span class="icon-map-marker"> <strong> <?php echo ' ' . $my->address . ' ' ?></span> <span class="icon-desktop" style="float:right"><strong><?php echo '  ' . $my->type ?></strong> </span> 

                                <span style="float:right; font-size: 25px"><strong><?php echo '' ?></strong></span>
                            </span>
                        </div>



                        <div class="" style="float:left">
                            <div id="physical" style="width:auto;height: auto; border: whitesmoke solid medium">
                                <img src="{{ url:site }}files/large/<?php echo $my->upload ?>" width="470" />
                            </div>
                            <div id="map" style="width:470px;height: 400px; border: whitesmoke solid medium">

                            </div>

                            <script type="text/javascript">
                                var locations = [
                                    ["<?php echo '<strong>' . $my->title . '</strong> <br> Type: ' . $my->type . ' <br> Address: ' . $my->address . ' <br> Price: ' . $my->price . ' [' . $my->currency . ']' ?>",<?php echo $my->location_lat ?>, <?php echo $my->location_long ?>, <?php echo '1' ?>],
                                ];
                                var lat_center = <?php echo $my->location_lat ?>,
                                        long_center = <?php echo $my->location_long ?>;

                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: new google.maps.LatLng(lat_center, long_center),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                });

                                var infowindow = new google.maps.InfoWindow();

                                var marker, i, text;

                                for (i = 0; i < locations.length; i++) {

                                    marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                        map: map
                                    });

                                    text = locations[i][0];

                                    if (locations[i][1] === lat_center && locations[i][2] === long_center) {

                                        marker.setAnimation(google.maps.Animation.DROP);
                                        marker.setIcon('http://maps.google.com/intl/en_us/mapfiles/ms/micons/purple.png');
                                        text += '<br> <a href="index.php/convergy/details/<?php echo $my->id ?>">More Information</a>';
                                    }

                                    google.maps.event.addListener(marker, 'click', (function(marker, text) {
                                        return function() {
                                            infowindow.setContent(text);
                                            infowindow.open(map, marker);
                                        }
                                    })(marker, text));
                                }

                            </script>


                        </div >
                        <!--
                                            <div style="float:left;padding-left: 5px;">
                        
                                            </div>-->
                    </div>
                <?php else: ?>
                    <div class="review">
                        <h5><?php echo $msg; ?></h5>
                    </div>

                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
<?php if (@$ass == 'yes'): ?>
    <div style="padding-right:5px"></div>

    <div class="span3">
        <div class="containerHeadline">
            <i class="icon-list-ol"></i><h2>Asset Details</h2>
            <div class="pull-right btn-toolbar">
                <div class="controlButton pull-right">
                </div>
                <div class="controlButton pull-right">
                </div>
            </div>
        </div>

        <div class="floatingBox">
            <div class="container-fluid">
                <div class="span12" >
                    <!-- <div style="width:600px;height: 400px; border: whitesmoke solid medium;float:left;">
                         <img src="<?php

                    //echo site_url() . 'uploads/default/'          
                    function formatMoney($number, $fractional = false) {
                        if ($fractional) {
                            $number = sprintf('%.2f', $number);
                        }
                        while (true) {
                            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                            if ($replaced != $number) {
                                $number = $replaced;
                            } else {
                                break;
                            }
                        }
                        return $number;
                    }
                    ?>"  />
                     </div>-->
                    <div >
                        <div class="containerHeadline">
                            <i class="icon-table"></i><h2>Rating&Pricing</h2>
                        </div>
                        <div class="floatingBox table">
                            <div class="container-fluid">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><strong>Price/Rate</strong></td>
                                            <td><?php echo 'NGN' . formatMoney($my->price); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Production</strong></td>
                                            <td><?php echo 'NGN' . formatMoney($my->production); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Posting</strong></td>
                                            <td><?php echo 'NGN'  . formatMoney($my->posting); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Frequency</strong></td>
                                            <td><?php echo $my->frequency ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="containerHeadline">
                            <i class="icon-table"></i><h2>Dimension (Meters)</h2>
                        </div>
                        <div class="floatingBox table">
                            <div class="container-fluid">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><strong>Height</strong></td>
                                            <td><?php echo $my->hieght ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Width</strong></td>
                                            <td><?php echo $my->width; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQM</strong></td>
                                            <td><?php echo $my->width * $my->hieght; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="containerHeadline">
                            <i class="icon-table"></i><h2>Creative Advice</h2>
                        </div>
                        <div class="floatingBox table">
                            <div class="container-fluid">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="min-height:20px" ><?php echo $my->creative_advice ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tables">
                            <div class="containerHeadline">
                                <i class="icon-table"></i><h2>General</h2>
                            </div>
                            <div class="floatingBox table">
                                <div class="container-fluid">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Approve Status</strong></td>
                                                <td><?php echo $my->approve_status ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Face Count</strong></td>
                                                <td><?php echo $my->face ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Restriction</strong></td>
                                                <td><?php echo $my->restriction; ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="containerHeadline">
                                <i class="icon-table"></i><h2>Production Info</h2>
                            </div>
                            <div class="floatingBox table">
                                <div class="container-fluid">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Trim Height</strong></td>
                                                <td><?php echo $my->trim_length ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Trim Width</strong></td>
                                                <td><?php echo $my->trim_width; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Substrate</strong></td>
                                                <td><?php echo $my->substrate; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Orientation</strong></td>
                                                <td><?php echo $my->orientation; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><strong>Production Notes</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $my->pro_notes; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="span4">
        <?php //var_dump($bookings);   ?>
        <div class="containerHeadline">
            <i class="icon-list-ol"></i><h2>Booking Details</h2> 
            <div class="pull-right btn-toolbar">
                <div class="controlButton pull-right">

                </div>
                <div class="controlButton pull-right">
                </div>
            </div>
        </div>

        <div class="floatingBox">
            <div class="container-fluid">
                <div class="span12" >
                    <!-- <div style="width:600px;height: 400px; border: whitesmoke solid medium;float:left;">
                         <img src="<?php //echo site_url() . 'uploads/default/'                 ?>"  />
                     </div>-->

                    <div >
                        <?php
                        $face_id = 0;
                        foreach ($bookings as $bks):
                            ?>
                            <div class="containerHeadline">
                                <i class="icon-table"></i><h2>Face <?php
                        $alp = array('', 'A', 'B', 'C', 'D', 'E');
                        ++$face_id;
                        
                        echo $alp[$face_id];
                            ?></h2>
                            </div>
                            <div class="floatingBox table">
                                <div class="container-fluid">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td><strong>Period</strong></td>
                                                <td><strong>Status</strong></td>
                                                <td><strong>Description</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    if ($bks) :
        foreach ($bks as $bk):
            ?>
                                                    <tr>
                                                        <td><?php
                                        $ex = explode('/', $bk->sta);
                                        $datey = $ex[1] . '-' . $ex[0] . '-' . $ex[2];
                                        //$datey = str_replace('/', '-', $camp->stay);
                                        $start = date('dS F, Y', strtotime($datey));

                                        $mon = (int) $bk->month;
                                        $strtime = $mon * 60 * 60 * 24 * 30 + strtotime($datey);
                                        $end = date('d/m/Y', $strtime);
                                        echo $datey . ' - ' . $end;
            ?></td>

                                                        <td><?php echo $bk->status ?></td>

                                                        <td><?php echo $bk->description ?></td>
                                                    </tr>
                                                    <?php endforeach;
                                                else: ?>
                                                <tr>
                                                    <td colspan="3">No Booking Yet!</td>
                                                </tr>
                                                
                                            <?php endif;
                                           // if ($bk->campaign_id != 0): 
                                                if (TRUE):
                                                ?>
                                                <tr>
                                                    <td><i class="icon-plus"></i><a href="index.php/convergy/add/<?php echo $eid.'/'.$face_id ?>"> Add To Campaign</a></td>
                                                    <td colspan="2"><i class="icon-sitemap"></i><a href="<?php echo $eid.'/'.$face_id ?>"> More Details</a></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>   
                    </div>
                </div></div></div>
    </div>
<?php endif; ?>

    <style>
        .head{
            background-color: #333333;
            color: white;
            font-weight: bold;
        }
        .tables{
            padding-bottom: 10px;
        }
    </style>