function openNav() {
   document.getElementById("mySidenav").style.width = "200px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function change_iframe(html) {
    document.getElementById("iframe").src =html;
}


$(function(){
  'use strict';
  var $page = $('#main'),
      options = {
        debug: true,
        prefetch: true,
        cacheLength: 2,
        // allowFormCaching: false,
        forms: 'form',
        onStart: {
          duration: 1000, // Duration of our animation
          render: function ($container) {
            // Add your CSS animation reversing class
            $container.addClass('is-exiting');


            // Restart your animation
            smoothState.restartCSSAnimations();
          }
        },
        onReady: {
          duration: 0,
          render: function ($container, $newContent) {
            // Remove your CSS animation reversing class
            $container.removeClass('is-exiting');
            // Inject the new content
            $container.html($newContent);
          }
        }
      },
      smoothState = $page.smoothState(options).data('smoothState');
});



function initialize() {

        var myLatLng = new google.maps.LatLng(14.5788377, 120.97869719999994);

        var map_canvas = document.getElementById('map_canvas');

        var map_options = {
        center: new google.maps.LatLng(14.5788377, 120.97869719999994),
        zoom: 18,
                mapTypeControl: false,
                panControl: false,
        zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_CENTER
        },
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(map_canvas, map_options);

        var contentString =
            '<b>EZ Payroll</b>' +
            '<p>R.A Gapuz Bldg. 1128 Alhambra St. Cor. UN Ave. Ermita, Manila</p>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });

        google.maps.event.trigger(map, 'resize');

        google.maps.event.addListener(marker, 'click', function(){
            infowindow.open(map,marker);
        });

    }

     google.maps.event.addDomListener(window, 'load', initialize);


