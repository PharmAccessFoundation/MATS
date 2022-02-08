<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $template['title'] . ' - ' . lang('cp:admin_title') ?></title>
        <base href="<?php echo base_url(); ?>" />
        <!-- 
 BOOTSTRAP STYLES-->


        <?php echo Asset::css('bootstrap.css'); ?>
        <?php echo Asset::css('font-awesome.css'); ?>
        <?php echo Asset::css('morris-0.4.3.min.css'); ?>
        <?php echo Asset::css('custom.css'); ?>
        <?php echo Asset::css('open.css'); ?>
        <?php echo Asset::css('dataTables.bootstrap.css'); ?>
        <?php echo Asset::css('select2.min.css'); ?>
        <?php echo Asset::js('select2.min.js'); ?>

        <?php  echo Asset::js('Chart.js'); ?>

        <?php
        $vars = $this->load->_ci_cached_vars;
        if ($vars['lang']['direction'] == 'rtl') {
            echo Asset::css('workless/rtl/rtl.css');
        }
        ?>
        <style type="text/css">
            #chart-container {
                width: auto;
                height: auto;
            }
        </style>
        
        <!-- Load up some favicons -->
        <link rel="shortcut icon" href="favicon.ico">
            <link rel="apple-touch-icon" href="apple-touch-icon.png">
                <link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png">
                    <link rel="apple-touch-icon" href="apple-touch-icon-57x57-precomposed.png">
                        <link rel="apple-touch-icon" href="apple-touch-icon-72x72-precomposed.png">
                            <link rel="apple-touch-icon" href="apple-touch-icon-114x114-precomposed.png">

                                <!-- metadata needs to load before some stuff -->
                                <?php file_partial('metadata'); ?>
                                </head>
                                <body>
                                    <div id="wrapper">
                                        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>

                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                                <a class="navbar-brand">MATS Admin</a> 
                                            </div>
                                            <div style="color: white;
                                                 padding: 15px 50px 5px 50px;
                                                 float: right;
                                                 font-size: 16px;"> Last Login : <?php echo date("D jS F, Y H:i:s", $this->current_user->last_login); ?> &nbsp; <a href="index.php/admin/logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
                                        </nav>   
                                        <!-- /. NAV TOP  -->
                                        <?php file_partial('sidenav'); ?>  
                                        <!-- /. NAV SIDE  -->
                                        <div id="page-wrapper" >
                                            <div id="page-inner">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2>MATS  <?php echo lang('cp:admin_title') . ' - ' . $template['title'] ?></h2>   
                                                        <h5>Welcome <?php echo $this->current_user->display_name ?>! You are signed in as a <?php echo ' '.$this->current_user->group_description ?> </h5>
                                                    </div>
                                                </div> 


                                                <!-- /. ROW  -->
                                                <hr />
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <?php file_partial('notices'); ?>
                                                            <?php echo $template['body']; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>
                                            </div>
                                            <!-- /. PAGE INNER  -->
                                        </div>
                                        <!-- /. PAGE WRAPPER  -->
                                    </div>
                                    <!-- /. WRAPPER  -->
                                    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
                                    <!-- JQUERY SCRIPTS -->

                                    <script>
                                                $(document).ready(function () {
                                        $('.dataTables-example').dataTable();
                                        });                                    </script>
                                    <script>
                                                $(document).ready(function () {
                                        $('.example').dataTable({
                                        "iDisplayLength": 10
                                        });
                                        });                                    </script>
                                    <script>
                                                $(document).ready(function () {
                                        // alert('ueueu');
                                        var datay = $("#countj").val();
                                                // alert(data);
                                               // console.log(datay);
                                                var player = [];
                                                var score = [];
                                                var data = jQuery.parseJSON(datay);
                                                for (var i in data) {
                                       // console.log(i);
                                                var pp = (i == 'total') ? 'Total Screened Data' : 'Presumptive Screened Data'
                                                player.push(pp);
                                                score.push(data[i]);
                                        }
                                        //console.log(player);
                                                //console.log(score);
                                                var chartdata = {
                                                labels: player,
                                                        datasets: [
                                                        {
                                                        label: 'Screened Data',
                                                                backgroundColor: '#990000',
                                                                borderColor: 'red',
                                                                hoverBackgroundColor: 'red',
                                                                hoverBorderColor: '#990000',
                                                                borderWidth: 3,
                                                                data: score
                                                        }
                                                        ]
                                                };
                                                var ops = {
                                                scales: {
                                                yAxes: [{
                                                ticks: {
                                                beginAtZero: true
                                                }
                                                }]
                                                }
                                                };
                                                var ctx = $("#mycanvas");
                                                var barGraph = new Chart(ctx, {
                                                type: 'bar',
                                                        data: chartdata,
                                                        options: ops
                                                });
                                        });
                                    </script>
                                </body>
                                </html>
