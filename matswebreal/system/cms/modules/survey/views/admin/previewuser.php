<?php if (!empty($pri)): ?>
<?php $lnglat = explode(':', $pri->longlat); ?>
   

    <section class="item">
        <div class="content">


            
        <div id="map" class="" style="width:100%;height:400px;"></div>

        <script>

            function initMap() {
                var myLatLng = {lat: <?php echo $lnglat[1]; ?>, lng: <?php echo $lnglat[0]; ?>}; //6.581235,3.3940500000000005

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: myLatLng
                });

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    animation: google.maps.Animation.DROP,
                    map: map,
                    title: 'Hello World!'
                });

                var contentString = '<div id="content">' +
                        '<div id="siteNotice">' +
                        '</div>' +
                        '<h5 id="firstHeading" class="firstHeading"><?php echo ucfirst($pri->fname).' '.$pri->fadd.' '.$pri->flga.' '.$pri->fstate.' ('.$pri->fphone.')'; ?></h5>' +
                        '<div id="bodyContent">' +
                        '<p>Patient Name: <?php echo $pri->firstname; ?> <br><br><br>Patient Contact: <?php echo ucfirst($pri->mobile); ?> </p>' +
                        '</div>' +
                        '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                });

            }

        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvZmBrApRCisyaxMJ2BWxN_5ShXLH7e3I&callback=initMap">
        </script>

            
            </div>
        </div>
    </section>
<?php endif; ?>
