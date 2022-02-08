<script type="text/javascript">
    $(document).ready(function() {

        $('#start').datepicker({
            format: 'dd/mm/yyyy'
        });

        /*
         *  Simple image gallery. Uses default settings
         */

        $('.fancybox').fancybox();

        /*
         *  Different effects
         */

        // Change title type, overlay closing speed
        $(".fancybox-effects-a").fancybox({
            helpers: {
                title: {
                    type: 'outside'
                },
                overlay: {
                    speedOut: 0
                }
            }
        });

        // Disable opening and closing animations, change title type
        $(".fancybox-effects-b").fancybox({
            openEffect: 'none',
            closeEffect: 'none',
            helpers: {
                title: {
                    type: 'over'
                }
            }
        });

        // Set custom style, close if clicked, change title type and overlay color
        $(".fancybox-effects-c").fancybox({
            wrapCSS: 'fancybox-custom',
            closeClick: true,
            openEffect: 'none',
            helpers: {
                title: {
                    type: 'inside'
                },
                overlay: {
                    css: {
                        'background': 'rgba(238,238,238,0.85)'
                    }
                }
            }
        });

        // Remove padding, set opening and closing animations, close if clicked and disable overlay
        $(".fancybox-effects-d").fancybox({
            padding: 0,
            openEffect: 'elastic',
            openSpeed: 150,
            closeEffect: 'elastic',
            closeSpeed: 150,
            closeClick: true,
            helpers: {
                overlay: null
            }
        });

        /*
         *  Button helper. Disable animations, hide close button, change title type and content
         */

        $('.fancybox-buttons').fancybox({
            openEffect: 'none',
            closeEffect: 'none',
            prevEffect: 'none',
            nextEffect: 'none',
            closeBtn: false,
            helpers: {
                title: {
                    type: 'inside'
                },
                buttons: {}
            },
            afterLoad: function() {
                this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
        });


        /*
         *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
         */

        $('.fancybox-thumbs').fancybox({
            prevEffect: 'none',
            nextEffect: 'none',
            closeBtn: false,
            arrows: false,
            nextClick: true,
            helpers: {
                thumbs: {
                    width: 50,
                    height: 50
                }
            }
        });

        /*
         *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
         */
        $('.fancybox-media')
                .attr('rel', 'media-gallery')
                .fancybox({
                    openEffect: 'none',
                    closeEffect: 'none',
                    prevEffect: 'none',
                    nextEffect: 'none',
                    arrows: false,
                    helpers: {
                        media: {},
                        buttons: {}
                    }
                });

        /*
         *  Open manually
         */

        $("#fancybox-manual-a").click(function() {
            $.fancybox.open('1_b.jpg');
        });

        $("#fancybox-manual-b").click(function() {
            //alert('jsj');
            $.fancybox.open({
                href: '{{site:url}}convergy/details/ABJ28864140S',
                type: 'iframe',
                padding: 5
            });
        });

        $("#fancybox-manual-c").click(function() {
            $.fancybox.open([
                {
                    href: '1_b.jpg',
                    title: 'My title'
                }, {
                    href: '2_b.jpg',
                    title: '2nd title'
                }, {
                    href: '3_b.jpg'
                }
            ], {
                helpers: {
                    thumbs: {
                        width: 75,
                        height: 50
                    }
                }
            });
        });


    });
</script>
<script>
    function show()
    {
        var e = document.getElementById("states");
        var sel = e.options[e.selectedIndex].text;
        if (sel == 'Lagos') {
            document.getElementById("areas").style.display = "inline";
        } else {
            document.getElementById("areas").style.display = "none";
        }
    }

</script>
<style>
    #areas{
        display: none;
    }
    #showy2{
        display: none;
    }
</style>
<ul class="breadcrumb">
    <li><i class="icon-home"></i><a href=""> Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li><i class="icon-dashboard"></i><a href="index.php/users/dashboard"> Dashboard</a> <span class="divider"><i class="icon-angle-right"></i></span></li>

    <li class="active">Asset Listings</li>
    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>
</ul>

<!-- ==================== MASTER ACTIONS ROW ==================== -->
<div class="row-fluid" style="width: auto;">
    <div class="span2">
        <!-- ==================== OTHER ELEMENTS HEADLINE ==================== -->
        <div class="containerHeadline">
            <i class="icon-list"></i><h2>Refine Selection</h2>
        </div>
        <!-- ==================== END OF OTHER ELEMENTS HEADLINE ==================== -->

        <!-- ==================== OTHER ELEMENTS FLOATING BOX ==================== -->
        <div class="floatingBox">
            <div class="container-fluid">
                <form class="contentForm" name="searchform" method="POST" action="index.php/convergy/listings">
                    <div class="control-group">
                        <label class="control-label">STATE</label>
                        <div class="controls">
                            <select id="states" onchange="show()" name="states">
                                <option id="" value="">Choose State</option>
                                <<option value="Abuja FCT">Abuja FCT</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="Akwa Ibom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="Cross River">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nassarawa">Nassarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group" id="areas">
                        <label class="control-label">AREA</label>
                        <div class="controls">
                            <select id="area" name="area">
                                <option id="" value="all">All Areas</option>
                                <option id="" value="Agbado">Agbado</option>
                                <option id="" value="Oke-Odo">Oke-Odo</option>
                                <option id="" value="Agboyi">Agboyi</option>
                                <option id="" value="Amuwo Odofin">Amuwo Odofin</option>
                                <option id="" value="Agege">Agege</option>
                                <option id="" value="Ajeromi">Ajeromi</option>
                                <option id="" value="Alimosho">Alimosho</option>
                                <option id="" value="Apapa">Apapa</option>
                                <option id="" value="Apapa-Iganmu">Apapa-Iganmu</option>
                                <option id="" value="Ayobo">Ayobo</option>
                                <option id="" value="Ipaja">Ipaja</option>
                                <option id="" value="Badagry West">Badagry West</option>
                                <option id="" value="Badagry">Badagry</option>
                                <option id="" value="Bariga">Bariga</option>
                                <option id="" value="Coker Aguda">Coker Aguda</option>
                                <option id="" value="Egbe Idimu">Egbe Idimu</option>
                                <option id="" value="Ejigbo">Ejigbo</option>
                                <option id="" value="Epe">Epe</option>
                                <option id="" value="Eredo">Eredo</option>
                                <option id="" value="Eti Osa East">Eti Osa East</option>
                                <option id="" value="Eti Osa West">Eti Osa West</option>
                                <option id="" value="Iba">Iba</option>
                                <option id="" value="Isolo">Isolo</option>
                                <option id="" value="Imota">Imota</option>
                                <option id="" value="Ikoyi">Ikoyi</option>
                                <option id="" value="Ibeju">Ibeju</option>
                                <option id="" value="Ifako-Ijaiye">Ifako-Ijaiye</option>
                                <option id="" value="Ifelodun">Ifelodun</option>
                                <option id="" value="Igando">Igando</option>
                                <option id="" value="Ikotun">Ikotun</option>
                                <option id="" value="Igbogbo">Igbogbo</option>
                                <option id="" value="Bayeku">Bayeku</option>
                                <option id="" value="Ijede">Ijede</option>
                                <option id="" value="Ikeja">Ikeja</option>
                                <option id="" value="Ikorodu North">Ikorodu North</option>
                                <option id="" value="Ikorodu West">Ikorodu West</option>
                                <option id="" value="kosi Ejinrin">kosi Ejinrin</option>
                                <option id="" value="Ikorodu">Ikorodu</option>
                                <option id="" value="Iru">Iru</option>
                                <option id="" value="Victoria Island">Victoria Island</option>
                                <option id="" value="Itire">Itire</option>
                                <option id="" value="Ikate">Ikate</option>
                                <option id="" value="Kosofe">Kosofe</option>
                                <option id="" value="Lagos Island">Lagos Island</option>
                                <option id="" value="Lagos Island West">Lagos Island West</option>
                                <option id="" value="Lagos Island East">Lagos Island East</option>
                                <option id="" value="Lagos Mainland">Lagos Mainland</option>
                                <option id="" value="Lekki">Lekki</option>
                                <option id="" value="Mosan">Mosan</option>
                                <option id="" value="Okunola">Okunola</option>
                                <option id="" value="Mushin">Mushin</option>
                                <option id="" value="Odi Olowo">Odi Olowo</option>
                                <option id="" value="Ojuwoye">Ojuwoye</option>
                                <option id="" value="Ojo">Ojo</option>
                                <option id="" value="Ojodu">Ojodu</option>
                                <option id="" value="Ojokoro">Ojokoro</option>
                                <option id="" value="Olorunda">Olorunda</option>
                                <option id="" value="Onigbongbo">Onigbongbo</option>
                                <option id="" value="Oriade">Oriade</option>
                                <option id="" value="Orile Agege">Orile Agege</option>
                                <option id="" value="Oshodi">Oshodi</option>
                                <option id="" value="Oto-Awori">Oto-Awori</option>
                                <option id="" value="Shomolu">Shomolu</option>
                                <option id="" value="Surulere">Surulere</option>
                                <option id="" value="Yaba">Yaba</option>
                                <option id="" value="Iwaya">Iwaya</option>
                                <option id="" value="Akoka">Akoka</option>
                                <option id="" value="Ketu">Ketu</option>
                                <option id="" value="Ketu">Ketu</option>
                                <option id="" value="Ketu">Ketu</option>
                                <option id="" value="Ketu">Ketu</option>
                                <option id="" value="Ketu">Ketu</option>
                                <option id="" value="Ketu">Ketu</option>
                                <option id="" value="Ketu">Ketu</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="control-group">
                        <label class="control-label">MEDIA TYPE</label>
                        <div class="controls">
                            <input type="checkbox" name="Billboards" value="Billboards" checked="checked" /> <strong>Billboards</strong><br>
                            <input type="checkbox" name="Mural" value="Mural" checked="checked"/> <strong>Mural</strong><br>
                            <input type="checkbox" name="Buses" value="Buses" checked="checked"/> <strong>Buses</strong><br>
                            <input type="checkbox" name="Lampost" value="Lampost" checked="checked"/> <strong>Lamp Posts</strong><br>
                            <input type="checkbox" name="Malls" value="Malls" checked="checked"/> <strong>Malls</strong><br>
                            <input type="checkbox" name="Mobile" value="Mobile LED Vans" checked="checked"/> <strong>Mobile LED Vans</strong><br>
                            <input type="checkbox" name="Street" value="Street Furniture" checked="checked"/> <strong>Street Furniture</strong><br>
                            <input type="checkbox" name="Airport" value="Airport" checked="checked"/> <strong>Airport</strong><br>
                            <input type="checkbox" name="Rail" value="Rail" checked="checked"/> <strong>Rail</strong><br>
                            <input type="checkbox" name="Transit" value="Transit Vans" checked="checked"/> <strong>Transit Vans</strong><br>
                            <input type="checkbox" name="Cinema" value="Cinema" checked="checked"/> <strong>Cinema</strong><br>
                            <input type="checkbox" name="Clubs" value="Clubs" checked="checked"/> <strong>Clubs</strong><br>
                            <input type="checkbox" name="Gyms" value="Gyms" checked="checked"/> <strong>Gyms</strong><br>
                            <input type="checkbox" name="Taxis" value="Taxis" checked="checked"/> <strong>Taxis</strong><br>
                            <input type="checkbox" name="Rooftop" value="Rooftop" checked="checked"/> <strong>Rooftop</strong><br>

                        </div>
                    </div><br>
                    <div class="control-group">
                        <label class="control-label">START DATE</label>
                        <div class="controls">
                            <input id="start" type="text" class="span10" name="start">
                        </div>
                    </div><br>
                    <div class="control-group">
                        <label class="control-label">NUMBER OF MONTHS</label>
                        <div class="controls">
                            <input id="start" type="text" class="span10"  placeholder="1">
                        </div>
                    </div><br>

                    <div class="control-group">
                        <label class="control-label">COMPANIES</label>
                        <div class="controls">
                            <?php if ($operators): ?>
                                <?php foreach ($operators as $v): ?>
                                    <input name="<?php echo $v->username ?>" value="<?php echo $v->username ?>" id="<?php echo $v->username ?>" class="css-checkbox" type="checkbox" checked/>
                                    <label for="<?php echo $v->username ?>" class="css-label"><strong><?php echo $v->username ?></strong></label>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <input name="Adhub" id="Adhub" value="Adhub" class="css-checkbox" type="checkbox" checked/>
                                <label for="Adhub" class="css-label"><strong>Convergy</strong></label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div> <input type="submit" name="search" value="Search" id="search"/></div>
                </form>
            </div>
        </div>
        <!-- ==================== END OF OTHER ELEMENTS FLOATING BOX ==================== -->
    </div>


    <!-- ==================== VECTOR MAPS CONTAINER ==================== -->
    <div class="span10 allwayTab allwayTab-left w-200" id="gmaps">
        <!-- ==================== VECTOR MAPS HEADLINE ==================== -->
        <div class="containerHeadline">
            <i class="icon-map-marker"></i><h2>Results</h2>
        </div>
        <!-- ==================== END OF VECTOR MAPS HEADLINE ==================== -->
        <?php if (@$assets != 0): ?>
            <!-- ==================== VECTOR MAPS FLOATING BOX ==================== -->
            <div class="floatingBox">
                <!-- ==================== VECTOR MAPS TABS ==================== -->
                <ul class="nav nav-tabs nav-tabs-normal verticalTab">
                    <?php //$assets = array_shift($assets); //var_dump($assets);?>
                    <?php
                    foreach ($assety as $vi):
                        $type = ((int) $vi->face > 1) ? 'M' : 'S';
                        ?>
                        <li class=""><a href="index.php/convergy/listings/<?php echo $vi->code . $encoder * $vi->hid . $type; ?>" data-id="basic"><?php echo $vi->title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <!-- ==================== END OF VECTOR MAPS TABS ==================== -->
                <div class="container-fluid" style="width: auto; height: 700px; margin-left: 200px" id="map"> </div>
                <script type="text/javascript">
                    var locations = [
    <?php $c = count($assets); ?>
    <?php foreach ($assets as $v) : 
        $uarea = ($assets[0]->subtype && $assets[0]->subtype!='nil') ? $assets[0]->subtype.', ' : '';
        ?>
                            ["<span><?php
        echo '<br><strong>Company: </strong>' . $assets[0]->username .
        '<br><strong>Type: </strong>' . $uarea . ', ' . $assets[0]->type .
        ' <br> <strong>Address</strong>: ' . $assets[0]->address .
        ' <br> <strong>Price</strong>:  [' . $assets[0]->currency . ']' . $assets[0]->price . ' ' . $assets[0]->frequency .
        ' <br> <strong>Posting Fee</strong>: ' . $assets[0]->posting .
        ' <br> <strong>Height x Width</strong> (meters): ' . $assets[0]->hieght . ' x ' . $assets[0]->width .
        ' <br> <strong>Face Count</strong>: ' . $assets[0]->face .
        ' <br> <strong>Status</strong>: ' . $assets[0]->approve_status
        ?></span>",<?php echo $v->location_lat ?>, <?php echo $v->location_long ?>, <?php echo $c-- ?>],
    <?php endforeach; ?>
                    ];
                    var lat_center = <?php echo $assets[0]->location_lat ?>,
                            long_center = <?php echo $assets[0]->location_long ?>;

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: <?php echo $zoom ?>,
                        center: new google.maps.LatLng(lat_center, long_center),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infowindow = new google.maps.InfoWindow();

                    var marker, i, text;

                    for (i = 0; i < locations.length; i++) {

                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map,
                            content: '<img src="{{ url:site }}files/large/<?php echo $my->upload ?>" width="200" />'
                        });
                        text = '<br> <ul class=""><li class=""><span><a href="index.php/convergy/details/<?php echo $assets[0]->code . $assets[0]->hid * $encoder . $type ?>" class="chaty" onClick="">More Information</a></span>\n\
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><a href="index.php/convergy/campaignview/<?php echo $assets[0]->code . $assets[0]->hid * $encoder . $type ?>" class="chaty" onClick="">Add To Campaign</a></span></li></ul>';
                        text += '<span><img src="{{ url:site }}files/large/<?php echo $assets[0]->upload ?>" width="200" /></span>';

                        text += locations[i][0];
                        if (locations[i][1] === lat_center && locations[i][2] === long_center) {

                            marker.setAnimation(google.maps.Animation.DROP);
                            marker.setIcon('http://maps.google.com/intl/en_us/mapfiles/ms/micons/purple.png');
                        }

                        google.maps.event.addListener(marker, 'click', (function(marker, text) {
                            return function() {

                                infowindow.setContent(text);
                                infowindow.open(map, marker);
                            }
                        })(marker, text));
                    }

                </script>

            </div>


        </div>
    </div>
    <!-- ==================== END OF VECTOR MAPS FLOATING BOX ==================== -->

<?php else: ?>
    <div class="floatingBox" style="padding-top: 20px; padding-bottom: 20px;color: #990000">
        <h5 style="margin-left:10px;"><?php echo $msg ?></h5>
    </div>
<?php endif; ?>
</div>
</div>
</div>
</div>
<!--<a id="fancybox-manual-b" href="javascript:;">Open single item, custom options</a> 
<a class="fancybox fancybox.ajax" href="http://localhost:8888/adhub/hubassets/details/ABJ28864140S">Ajax</a>-->