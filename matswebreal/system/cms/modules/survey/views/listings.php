<script type="text/javascript">
    $(document).ready(function() {
        $("#formWizard").formToWizard({submitButton: 'submitForm'})
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
    <li><i class="icon-home"></i><a href=""> Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    {{ if user:logged_in }}
    <li><i class="icon-dashboard"></i><a href="index.php/users/dashboard"> Dashboard</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
 {{ endif }}

    <li class="active">My Assets</li>
    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>
</ul>

<!-- ==================== MASTER ACTIONS ROW ==================== -->
<div class="row-fluid" >



    <div class="span3 floatingContainer" id="addNewEvent">
        <div class="containerHeadline">
            <i class="icon-plus-sign"></i><h2>Search Filter</h2>
        </div>

        <div class="floatingBox">
            <div class="container-fluid">
                <form class="contentForm" name="searchform" method="POST" action="index.php/convergy/view">
                    <div class="control-group">
                        <label class="control-label">STATE</label>
                        <div class="controls">
                            <select id="states" onchange="show()" name="states">
                                <option id="" value="">Choose State</option>
                                <option value="Abuja">Abuja FCT</option>
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

                        </div>
                    </div><br>
                    <div class="control-group">
                        <label class="control-label">AVAILABILITY</label>
                        <div class="controls">
                            <input id="datepickerField" type="text" class="span10" value="04/26/2013">
                        </div>
                    </div><br>

                    <div> <input type="submit" name="search" value="Search" id="search"/></div>
                </form>

            </div>
        </div>
    </div>

    <div class="span9">

        <!-- ==================== TABLE HEADLINE ==================== -->
                        <div class="containerHeadline tableHeadline">
                            <i class="icon-list"></i><h2>Results</h2>
                            <form>
                                <div class="input-append">
                                    <input class="inp-mini span8" type="text" placeholder="search in results..." id="memberSearch">
                                    <span class="add-on add-on-first add-on-mini"><i class="icon-search"></i></span>
                                </div>
                            </form>
                            <!-- ==================== TABLE CONTROLS ==================== -->
                            
                            <!-- ==================== END OF TABLE CONTROLS ==================== -->
                        </div>
                        <!-- ==================== END OF TABLE HEADLINE ==================== -->

        <!-- ==================== TABLE FLOATING BOX ==================== -->
        <div class="floatingBox table">
            <div class="container-fluid">
                <?php if (@$assets): ?>
                    <?php
                    // $my = array_shift($assets);
                    ?>
                
                    <table class="tablesorter centerFirstLast" id="membersTable">
                        <thead>
                            <tr>
                                <th class="info"></th>
                                <th data-placeholder="search in usernames...">Location</th>
                                <!--<th data-placeholder="search in dates...">Period</th>-->
                                <th data-placeholder="search in roles...">Number of Faces</th>
                                <th class="">Status</th>
                                <th class="">Action</th><th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($assets as $ur):
                                $face = ($ur->face > 1) ? 'M' : 'S';
                                ?>
                                <tr>
                                    <td><span class="label"><i class="icon-map-marker"></i></span></td>
                                    <td class="username">
                                        <strong><?php echo $ur->type . ' on ' . $ur->address ?></strong><br>
                                        <?php 
                                        $uarea = ($ur->area && $ur->area!='nil') ? $ur->area.', ' : '';
                                        echo $uarea.$ur->state 
                                                ?>
                                    </td>
                                    <!--<td>
                                        <span href="#" class="registrationDate">
                                            <?php //echo $ur->frequency ?>
                                        </span>
                                    </td>-->
                                     <td>
                                        <span href="#" class="memberGroup">
                                            <?php echo $ur->face ?>
                                        </span>

                                         <td>
                                        <span href="#" class="memberGroup">
                                            <?php 
                                            if($ur->confirm == 1){
                                                echo 'Confirmed';
                                            }  else {
                                               echo 'Pending'; 
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td><a href="index.php/convergy/details/<?php echo $ur->code . $ur->hid * $encoder . $face ?>" >View Asset</a></td>
                                    <!--<td><a href="hubassets/add/<?php //echo $ur->code . $ur->hid * $encoder . $face ?>" class="memberGroup">Asset Bookings</a></td>-->
                                    <td><a href="index.php/convergy/edit/<?php echo $ur->code . $ur->hid * $encoder . $face ?>" class="memberGroup">Edit Asset</a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

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
</div>
<script>
        // add parser through the tablesorter addParser method
        $.tablesorter.addParser({
            id: 'checkbox',
            is: function(s) {
                return false;
            },
            format: function(s, table, cell, cellIndex) {
                var $t = $(table), $c = $(cell), c,

                // resort the table after the checkbox status has changed
                resort = false;

                if (!$t.hasClass('hasCheckbox')) {
                    $t
                    .addClass('hasCheckbox')
                    // make checkbox in header set all others
                    .find('thead th:eq(' + cellIndex + ') input[type=checkbox]')
                    .bind('change', function(){
                        c = this.checked;
                        $t.find('tbody tr:visible td:nth-child(' + (cellIndex + 1) + ') input').each(function(){
                          this.checked = c;
                          $(this).trigger('change');
                        });
                    })
                    .bind('mouseup', function(){
                        return false;
                    });
                    $t.find('tbody tr').each(function(){
                        $(this).find('td:eq(' + cellIndex + ')').find('input[type=checkbox]').bind('change', function(){
                            $t.trigger('updateCell', [$(this).closest('td')[0], resort]);
                        });
                    });
                }
                // return 1 for true, 2 for false, so true sorts before false
                c = ($c.find('input[type=checkbox]')[0].checked) ? 1 : 2;
                $c.closest('tr')[ c === 1 ? 'addClass' : 'removeClass' ]('checked');
                return c;
            },
            type: 'numeric'
        });

        $(function() {
            $('#tablesorterDemo').tablesorter({
                sortList: [[1,0]],
                widgets: ['zebra', 'stickyHeaders'],
                headers: {
                    0: {
                        sorter: 'checkbox'
                    },
                }
            });

            /*=============================================================================================
                 ============================== LOAD TABLESORTER PAGER SETTINGS ===============================
                 =============================================================================================*/

                // define pager options
                var pagerOptions = {
                    // target the pager markup - see the HTML block below
                    container: $(".pager"),
                    // output string - default is '{page}/{totalPages}'; possible variables: {page}, {totalPages}, {startRow}, {endRow} and {totalRows}
                    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
                    // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
                    // table row set to a height to compensate; default is false
                    fixedHeight: false,
                    // remove rows from the table to speed up the sort of large tables.
                    // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
                    removeRows: false,
                    // go to page selector - select dropdown that sets the current page
                    cssGoto:   '.gotoPage'
                };

                /*=============================================================================================
                 ======================================= LOAD TABLESORTER =====================================
                 =============================================================================================*/

                $("#membersTable").tablesorter({

                    headers: {
                        0: { sorter: false, filter: false },
                        1: { sorter: 'text' },
                        2: { sorter: 'shortDate' },
                        3: { sorter: 'text' },
                        4: { sorter: 'text' },
                        5: { sorter: false, filter: false }
                    },

                    dateFormat: 'uk',

                    // sort on the first column and third column in ascending order
                    sortList: [[1,0]],

                    // hidden filter input/selects will resize the columns, so try to minimize the change
                    widthFixed : true,

                    // initialize zebra striping and filter widgets
                    widgets: ["zebra", "filter"],

                    widgetOptions : {

                        // If there are child rows in the table (rows with class name from "cssChildRow" option)
                        // and this option is true and a match is found anywhere in the child row, then it will make that row
                        // visible; default is false
                        filter_childRows : false,

                        // if true, a filter will be added to the top of each table column;
                        // disabled by using -> headers: { 1: { filter: false } } OR add class="filter-false"
                        // if you set this to false, make sure you perform a search using the second method below
                        filter_columnFilters : true,

                        // css class applied to the table row containing the filters & the inputs within that row
                        filter_cssFilter : 'tablesorter-filter',

                        // add custom filter functions using this option
                        // see the filter widget custom demo for more specifics on how to use this option
                        filter_functions : null,

                        // if true, filters are collapsed initially, but can be revealed by hovering over the grey bar immediately
                        // below the header row. Additionally, tabbing through the document will open the filter row when an input gets focus
                        filter_hideFilters : true,

                        // Set this option to false to make the searches case sensitive
                        filter_ignoreCase : true,

                        // Delay in milliseconds before the filter widget starts searching; This option prevents searching for
                        // every character while typing and should make searching large tables faster.
                        filter_searchDelay : 300,

                        // Set this option to true to use the filter to find text from the start of the column
                        // So typing in "a" will find "albert" but not "frank", both have a's; default is false
                        filter_startsWith : false,

                        // Filter using parsed content for ALL columns
                        // be careful on using this on date columns as the date is parsed and stored as time in seconds
                        filter_useParsedData : false

                    }

                })

                /*=============================================================================================
                 ================================== LOAD PAGER TO TABLESORTER =================================
                 =============================================================================================*/
                
                .tablesorterPager(pagerOptions);

                $('.pagesize').multiselect();


                /*=============================================================================================
                 ================================ SEARCH FUNCTION FOR WHOLE TABLE =============================
                 =============================================================================================*/

                // Write on keyup event of keyword input element
                $("#memberSearch").keyup(function(){
                    // When value of the input is not blank
                    if( $(this).val() != "")
                    {
                        // Show only matching TR, hide rest of them
                        $("#membersTable tbody>tr").hide();
                        $("#membersTable td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                    }
                    else
                    {
                        // When there is no input or clean again, show everything back
                        $("#membersTable tbody>tr").show();
                    }
                });

                /*=============================================================================================
                 ======================== ADD ROLLER GRIP TO TABLESORTER HIDEME ROW ===========================
                 =============================================================================================*/

                $('.tablesorter-filter-row td:first').append('<div class="tableFilterRoller"></div>');

                /*=============================================================================================
                 ======================= ADD MOREOPTIONS ICON TO HIDDEN ROW WITH FILTERS ======================
                 =============================================================================================*/

                $('.tablesorter-filter-row td').not(':first').not(':last').append('<i class="icon-play-circle moreOptions pull-right"></i>');

                /*=============================================================================================
                 ================================ TABLE ROW INFO / EDIT / DELETE ICON ACTIONS =================
                 =============================================================================================*/


                var showMemberIcon = $('i.info').parent(),
                    editMemberIcon = $('i.edit').parent(),
                    deleteMemberIcon = $('i.delete').parent();

                $(showMemberIcon).tooltip({
                    title: 'View member profile'
                });

                $(editMemberIcon).tooltip({
                    title: 'Edit member profile'
                });

                $(deleteMemberIcon).tooltip({
                    title: 'Delete member'
                });

                $('i.info, i.edit, i.delete').parent().hover(function () {
                    $(this).children().stop().animate({
                        opacity: 1
                    }, 200);
                }, function() {
                    $(this).children().stop().animate({
                        opacity: .7
                    }, 200);
                });

                /*=============================================================================================
                 ===================================== SET FIELDS EDITABLE ====================================
                 =============================================================================================*/

                $('#membersTable a.username').editable({
                    type: 'text',
                    name: 'username',
                    url: '/post',
                    title: 'Enter username',
                    placement: 'right'
                });

                $('#membersTable a.registrationDate').editable({
                    type: 'date',
                    viewformat: 'dd/mm/yyyy',
                    name: 'registrationDate',
                    url: '/post',
                    title: 'Enter date of registration'
                });

                $('#membersTable a.memberGroup').editable({
                    type: 'select',
                    source: [{value: 1, text: 'admin'}, {value: 2, text: 'editor'}, {value: 3, text: 'author'}, {value: 4, text: 'user'}, {value: 5, text: 'second technician'}],
                    name: 'memberGroup',
                    url: '/post',
                    title: 'Choose a role'
                }).click(function(){
                    $(this).next().find('select').multiselect();
                });

                $('#membersTable a.memberStatus').editable({
                    type: 'select',
                    source: [{value: 'active', text: 'active'}, {value: 'inactive', text: 'inactive'}, {value: 'banned', text: 'banned'}, {value: 'pending', text: 'pending'}],
                    name: 'memberStatus',
                    url: '/post',
                    title: 'Choose a status',
                    success: function (){
                        var label = $(this).parent() // define variable for link parent
                        selectVal = $(this).next().find('select').val(); // define variable for selected value


                        $(label).removeClass().addClass('label' + ' ' + selectVal); // remove actual class from label and add new class defined by selected value (this change color of label)
                    }
                }).click(function(){
                    $(this).next().find('select').multiselect();
                });
        });
        </script>