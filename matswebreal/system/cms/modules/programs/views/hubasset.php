<script type="text/javascript">
    $(document).ready(function() {
        $("#formWizard").formToWizard({submitButton: 'submitForm'})
    });
</script>
<script>
    function show()
    {
        var e = document.getElementById("type");
        var sel = e.options[e.selectedIndex].text;
        var options;
        document.getElementById("subtypediv").style.display = "inline";
        var select = document.getElementById("subtype");

        var selectbox = document.getElementById("subtype");
        var i;
        for (i = selectbox.options.length - 1; i >= 0; i--)
        {
            selectbox.remove(i);
        }

        if (sel == 'Airport' || sel == 'Buses' || sel == 'Taxis' || sel == 'Transit Vans' || sel == 'Mobile LED Vans') {
            if (sel == 'Taxis') {
                options = ["Roof-top", "Rear Mirror", "Side Doors"];
            }

            if (options) {
                var opt = '';
                for (var i = 0; i < options.length; i++) {
                    opt = options[i];
                    var el = document.createElement("option");
                    el.textContent = opt;
                    el.value = opt;
                    select.appendChild(el);
                }
            } else {
                var el = document.createElement("option");
                el.textContent = sel;
                el.value = sel;
                select.appendChild(el);
            }

            document.getElementById("showy2").style.display = "inline";
            document.getElementById("showy").style.display = "none";
        } else {
            if (sel == 'Billboards')
                options = ["LED","Super 48 Sheet", "96 Sheet", "Unipoles", "Portrait", "Bulletin", "Backlit", "Bridge Panel", "Long Banner", "Wall Panel", "Inflatable", "Scrollers", "Trivision"];
            if (sel == 'Lampost')
                options = ["Banner", "Backlit"];
            if (sel == 'Street Furniture')
                options = ["Bus Shelter", "Benches", "Sidewalk Posters"];
            if (sel == 'Mural')
                options = ["Wall Drape", "Wall Panels", "Building Wrap"];
            if (sel == 'Malls')
                options = ["Muppies", "Lampost", "LED Panels", "Drop-down", "Wall Panels"];

            if (options) {
                var opt = '';
                for (var i = 0; i < options.length; i++) {
                    opt = options[i];
                    var el = document.createElement("option");
                    el.textContent = opt;
                    el.value = opt;
                    select.appendChild(el);
                }
            } else {
                var el = document.createElement("option");
                el.textContent = sel;
                el.value = sel;
                select.appendChild(el);
            }

            document.getElementById("showy").style.display = "inline";
            document.getElementById("showy2").style.display = "none";
        }
    }

    function show2()
    {
        var e = document.getElementById("states");
        var sel = e.options[e.selectedIndex].text;
        if (sel == 'Lagos') {
            document.getElementById("areas").style.display = "inline";
        } else {
            document.getElementById("areas").style.display = "none";
        }
    }

    function show3()
    {
        var e = document.getElementById("face");
        var sel = e.options[e.selectedIndex].value;
        //alert(sel);
        if (sel == '') {
            document.getElementById("showy3").style.display = "none";
        } else {
            document.getElementById("showy3").style.display = "inline";
            optiony = ["A", "B", "C", "D", "E"];
            var ely = document.getElementById("showy3");
            ely.innerHTML = '';
            var county = '<text type="hidden" name="county" id="county" value="'+sel+'" /> ';
            ely.innerHTML += county;
            for (var i = 0; i < sel; i++) {
                var inc = i+1;
                var name = 'description'+inc;
                var text = '<div class="control-group"><label class="control-label" for="'+name+'">DESCRIPTION (SIDE ' + optiony[i] + ') *</label><div class="controls"><textarea id="'+name+'" class="span10 parsley-validated" type="text" data-minlength="1" data-required="true" data-trigger="change" data-validation-minlength="0" name="'+name+'"></textarea></div></div>';
                ely.innerHTML += text;
            }
        }
    }
</script>

<style>
    #areas{
        display: none;
    }
    #showy{
        display: block;
    }
    #showy2{
        display: none;
    }
    #showy3{
        display: none;
    }
    #subtypediv{
        display: block;
    }
</style>
<ul class="breadcrumb">
    <li><i class="icon-home"></i><a href=""> Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li><i class="icon-dashboard"></i><a href="index.php/users/dashboard"> Dashboard</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li class="active">Add New Asset</li>
    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>
</ul>

<!-- ==================== MASTER ACTIONS ROW ==================== -->
<div class="row-fluid" >
    <div class="containerHeadline">
        <i class="icon-list-ol"></i><h2>Add New Asset</h2>
        <div class="pull-right btn-toolbar">
            <div class="controlButton pull-right">
            </div>
            <div class="controlButton pull-right">
            </div>
        </div>
    </div>
    <div class="floatingBox formWizard">
        <div class="container-fluid">
            <?php if (validation_errors()): ?>
                <div class="alert alert-error">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif ?>

            <?php echo form_open('convergy/index', array('enctype' => 'multipart/form-data', 'id' => 'formWizard', 'class' => 'form-horizontal', 'data-validate' => 'parsley')) ?>

            <fieldset>
                <legend>Details</legend>
                <div class="control-group">
                    <label class="control-label" for="title">Title *</label>
                    <div class="controls">
                        <input id="title" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="title">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="height">Measurement(Height) in meters *</label>
                    <div class="controls">
                        <input id="hieght"class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="hieght">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="width">Measurement(Width)in meters *</label>
                    <div class="controls">
                        <input id="width" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="width">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="type">Media Type *</label>
                    <div class="controls">
                        <?php
                        $list = array('Billboards' => 'Billboards', 'Mobile LED Vans' => 'Mobile LED Vans', 'Lampost' => 'Lampost', 'Street Furniture' => 'Street Furniture', 'Airport' => 'Airport', 'Rail' => 'Rail', 'Transit Vans' => 'Transit Vans', 'Cinema' => 'Cinema', 'Clubs' => 'Clubs', 'Gyms' => 'Gyms', 'Malls' => 'Malls', 'Mural' => 'Mural', 'Buses' => 'Buses', 'Taxis' => 'Taxis', 'Rooftop' => 'Rooftop');
                        echo form_dropdown('type', $list, '', 'id = "type", "required", onchange = show()');
                        ?>
                    </div>
                </div>
                <div class="control-group" id="subtypediv">
                    <label class="control-label" for="type">Media Sub-Type *</label>
                    <div class="controls">
                        <?php
                        $ads = array("LED" => "LED","Super 48 Sheet" => "Super 48 Sheet", "96 Sheet" => "96 Sheet", "Unipoles" => "Unipoles", "Portrait" => "Portrait", "Bulletin" => "Bulletin", "Backlit" => "Backlit", "Bridge Panel" => "Bridge Panel", "Long Banner" => "Long Banner", "Wall Panel" => "Wall Panel", "Inflatable" => "Inflatable", "Scrollers" => "Scrollers", "Trivision" => "Trivision");
                        echo form_dropdown('subtype', $ads, '', 'id = "subtype", "required"');
                        ?>
                    </div>
                </div>

               <!-- <div class="control-group" id="showy">
                    <label class="control-label" for="point1">Transit Point *</label>
                    <div class="controls">
                        <br><strong>Longitude: </strong><input style="" id="transit_long" class="span10 parsley-validated" type="text" data-parsley-required="false" name="transit_long" >
                        <br> <br><strong>Latitude: </strong><input style="" id="transit_lat" class="span10 parsley-validated" type="text" data-parsley-required="false" name="transit_lat" >
                        <br> <br></div>
                </div>-->
               <!-- <div class="control-group" id="showy2">
                    <label class="control-label" for="point2">Transit Point *</label>
                    <div class="controls">
                        <br><strong>Begin Longitude: </strong><input style="" id="btransit_long" class="span10 parsley-validated" type="text" data-parsley-required="false"  name="btransit_long" >
                        <br><br> <strong>Begin Latitude: </strong><input style="" id="btransit_lat" class="span10 parsley-validated" type="text" data-parsley-required="false"  name="btransit_lat" >
                    </div>
                    <div class="controls">
                        <br><strong>End Longitude: </strong><input style="" class="span10 parsley-validated" id="etransit_long"  type="text" data-parsley-required="false"  name="etransit_long" >
                        <br><br> <strong>End Latitude: </strong><input style="" class="span10 parsley-validated" id="etransit_lat"  type="text"  data-parsley-required="false"  name="etransit_lat" >
                        <br><br></div>
                </div>-->
                <div class="control-group">
                    <label class="control-label" for="address">Location Address *</label>
                    <div class="controls">
                        <input id="address" class="span10 parsley-validated" type="text" data-minlength="1" data-required="true" data-trigger="change" data-validation-minlength="0" name="address">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">State</label>
                    <div class="controls">
                        <select id="states" name="states" onchange="show2()" required="required">
                            <option id="" value="Abuja">Abuja</option>
                            <option id="" value="Lagos">Lagos</option>
                            <option id="" value="Enugu">Enugu</option>
                            <option id="" value="Rivers">Rivers</option>
                            <option id="" value="Oyo">Oyo</option>
                        </select>
                    </div>
                </div>
                <div class="control-group" id="areas">
                    <label class="control-label">Area</label>
                    <div class="controls">
                        <select id="area"  name="area">
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
                        </select>
                    </div>
                </div>
                <br>
                <div class="control-group">
                    <label class="control-label" for="location_long">Location Longitude *</label>
                    <div class="controls">
                        <input id="location_long" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="location_long">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="location_lat">Location Latitude *</label>
                    <div class="controls">
                        <input id="location_lat" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="location_lat">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="notes">Notes *</label>
                    <div class="controls">
                        <textarea id="notes" class="span10 parsley-validated" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="notes"></textarea>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="currency">Currency *</label>
                    <div class="controls">
                        <?php echo form_dropdown('currency', array('NGN (Nigeria)' => 'NGN (Nigeria)', '$USD (USA)' => '$USD (USA)'), '', 'id = currency') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="frequency">Rental Duration *</label>
                    <div class="controls">
                        <?php echo form_dropdown('frequency', array('Weekly' => 'Weekly', 'Monthly' => 'Monthly', 'Quarterly' => 'Quarterly', 'Bi-annually' => 'Bi-annually', 'Annually' => 'Annually'), '', 'id = frequency') ?>
                    </div>
                </div>
                <legend>Pricing and Production</legend>
                <div class="control-group">
                    <label class="control-label" for="price">Rate/Price *</label>
                    <div class="controls">
                        <input id="price" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="price">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="production">Production *</label>
                    <div class="controls">
                        <input id="production" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="production">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="posting">Posting *</label>
                    <div class="controls">
                        <input id="posting" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="posting">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="trim_length">Trim Height *</label>
                    <div class="controls">
                        <input id="trim_length" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="trim_length">
                    </div>
                </div><div class="control-group">
                    <label class="control-label" for="trim_width">Trim Width *</label>
                    <div class="controls">
                        <input id="trim_width" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="trim_width">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="substrate">Substrate *</label>
                    <div class="controls">
                        <?php echo form_dropdown('substrate', array('None' => 'None','Vinyl (SAV)' => 'Vinyl (SAV)', 'Flex' => 'Flex', 'Mesh' => 'Mesh'), '', 'id = substrate') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="orientation">Orientation *</label>
                    <div class="controls">
                        <?php echo form_dropdown('orientation', array('Landscape)' => 'Landscape', 'Potrait' => 'Potrait', 'Square'=>'Square'), '', 'id = orientation') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="pro_notes">Production Notes *</label>
                    <div class="controls">
                        <textarea id="pro_notes" class="span10 parsley-validated" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="pro_notes"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="creative_advice">Creative Advice *</label>
                    <div class="controls">
                        <textarea id="creative_advice" class="span10 parsley-validated" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="creative_advice"></textarea>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Physical View</legend>
                <div class="control-group">
                    <label class="control-label" for="userfile"><strong>Upload Physical View * </strong><br>(in JPEG,PNG or GIF)</label>
                    <div class="controls">
                        <input type="file" id="userfile" name="userfile" class="span10 parsley-validated" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0">
                    </div>
                </div>
                <!--<div class="control-group">
                    <label class="control-label" for="production2">Production *</label>
                    <div class="controls">
                        <input id="production2" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="production2">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="footfall">Footfall/Pedestrian *</label>
                    <div class="controls">
                        <input id="footfall" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="footfall">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="ots">Opportunity To See (OTS) *</label>
                    <div class="controls">
                        <input id="ots" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="ots">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="vai">Visibility Adjusted Indices *</label>
                    <div class="controls">
                        <input id="vai" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="vai">
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="time">Exposure Time *</label>
                    <div class="controls">
                        <input id="exposure_time" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="exposure_time">
                <?php //echo form_dropdown('time', array('Seconds' => 'Seconds' , 'Minutes' => 'Minutes', 'Hours' => 'Hours'), '', 'id = time') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="obstruction">Obstruction Factor *</label>
                    <div class="controls">
                <?php //echo form_dropdown('obstruction', array('None' => 'None', 'Good(Minor Obstruction)' => 'Good(Minor Obstruction)'), '', 'id = obstruction') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="view_long">Viewing Angle (Longitude) *</label>
                    <div class="controls">
                        <input id="view_long" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="view_long">
                    </div>
                </div><div class="control-group">
                    <label class="control-label" for="view_lat">Viewing Angle (Latitude) *</label>
                    <div class="controls">
                        <input id="view_lat" class="span10 parsley-validated" type="text" data-minlength="1" data-type="number" data-required="true" data-trigger="change" data-validation-minlength="0" name="view_lat">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="visual">Visual Competition *</label>
                    <div class="controls">
                <?php //echo form_dropdown('visual', array('Very Good (solus)' => 'Very Good (solus)', 'Good (semi solus)' => 'Good (semi solus)', 'Minor clutter' => 'Minor clutter'), '', 'id = visual') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="situated">Situated On *</label>
                    <div class="controls">
                <?php //echo form_dropdown('situated', array('Onside' => 'Onside', 'Roadside' => 'Roadside', 'Interchange' => 'Interchange', 'Median' => 'Median'), '', 'id = situated') ?>
                    </div>
                </div>
               <div class="control-group">
                    <label class="control-label" for="illumination">Illumination *</label>
                    <div class="controls">
                <?php //echo form_dropdown('illumination', array('None' => 'None', 'Yes' => 'Yes'), '', 'id = illumination') ?>
                    </div>
                </div>-->
            </fieldset>
            <fieldset>
                <legend>Others&Submit</legend>
                <div class="control-group">
                    <label class="control-label" for="face">Face Count *</label>
                    <div class="controls">
                       <!-- <input id="face" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="face">-->
                        <?php echo form_dropdown('face', array('' => 'Select Number Of Faces', '1' => '1', '2' => '2', '3' => '3', '3' => '3', '4' => '4', '5' => '5'), '', 'id = "face" onchange="show3()"') ?>

                    </div>
                </div>
                <div id="showy3">

                </div>
                <div class="control-group">
                    <label class="control-label" for="approve_status">Approval Status *</label>
                    <div class="controls">
                        <?php echo form_dropdown('approve_status', array('Approved' => 'Approved', 'Not Approved' => 'Not Approved', 'Under Processing' => 'Under Processing'), '', 'id = approve_status') ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="restriction">Restriction *</label>
                    <div class="controls">
                        <?php echo form_dropdown('restriction', array('None' => 'None', 'Minor' => 'Minor'), '', 'id = restriction') ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_submit('submitForm', 'Review Asset') ?>
                </div>
            </fieldset>

            </p>
            <?php echo form_close() ?>
        </div></div></div>