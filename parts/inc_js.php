<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="./js/jquery-3.4.1.slim.min.js"></script>
<script src="./plugins/jquery/jquery.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready( function () {
      $('#data').DataTable();
  } );

  var host = window.location.protocol+"//"+location.host;


  //MAPS
  //GET DATA FROM SERVER USING PHP LANGUAGE, USING AJAX
  get_data("","");
  function get_data(jenis,nama_wisata)
  {
    $.ajax({
      url: host+"/giswisata/config/get_data.php?jenis="+jenis+"&nama="+nama_wisata,
      success: function(results)
      {
        //console.log(results);
        if (results != "0") 
        {
          
          initialize(results);
        }
        if (results == "0") 
        {
          $('#map').load("pages/public-notfound.php");
        }
      }
    })
  }


  function initialize(data) {
    
    var mapOptions = {   
        zoom: 9,
        zoomControl: true,
        mapTypeId: 'roadmap',
        center: new google.maps.LatLng(-8.4614294, 115.0680678), 
        disableDefaultUI: true
    };

    var mapElement = document.getElementById('map');

    var map = new google.maps.Map(mapElement, mapOptions);

    
    
    var data = JSON.parse(data);
    for (var i = 0; i < data.length; i++) {
            var data_wisata = [[data[i].id_wisata,data[i].nama_wisata,data[i].pic_wisata,data[i].long_wisata,data[i].lat_wisata,data[i].jenis_wisata]];

          setMarkers(map, data_wisata);
          }

  }

    

  function setMarkers(map, locations)
  {
      var globalPin = host+'/giswisata/images/marker.png';

      for (var i = 0; i < locations.length; i++) {
         
          var wisata = locations[i];
          var myLatLng = new google.maps.LatLng(wisata[3], wisata[4]);
          var infowindow = new google.maps.InfoWindow({content: contentString});
          //console.log(wisata[3]);
          var contentString = 
              '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<img src="files/'+ wisata[2] + '" style="width: 200px;height:100px" >'+
              '<h6 id="firstHeading" class="firstHeading">'+ wisata[1] + '</h6>'+
              '<div id="bodyContent">'+ 
              '<a href=?page=detail&id='+wisata[0]+'&jenis='+wisata[5]+'>Info Detail</a>&nbsp;&nbsp;|&nbsp;&nbsp;'+
              '<a href="#direction" class="get_direction" data-destination="'+wisata[3]+','+wisata[4]+'">Get Direction Map</a>'+
              '</div>'+
              '</div>';

          var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: wisata[1],
              icon:host+'/giswisata/images/marker.png'
          });

          google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
      }
  }

  function getInfoCallback(map, content) {
      var infowindow = new google.maps.InfoWindow({content: content});
      return function() {
              infowindow.setContent(content); 
              infowindow.open(map, this);
          };
  }

  //initialize();

  $(document).on('click', '.search-wisata', function()
  {
    var jenis = $('.jenis_wisata').val();
    var nama = $('.nama_wisata').val();
    get_data(jenis,nama);
  })


  $(document).on('click','.get_direction', function()
  {
    var end = $(this).attr('data-destination');
    if (navigator.geolocation) 
    {
      navigator.geolocation.getCurrentPosition(myPosition);
    }
    else
    {
      alert("Geolocation is not support by this browser");
    }

    function myPosition(locations)
    {
      var start = locations.coords.latitude+","+locations.coords.longitude;
      var mapOptions = {   
          zoom: 9,
          zoomControl: true,
          mapTypeId: 'roadmap',
          center: new google.maps.LatLng(-8.4614294, 115.0680678), 
          disableDefaultUI: true
      };

      var mapObject = new google.maps.Map(document.getElementById("map"), mapOptions);
      var directionsService = new google.maps.DirectionsService();
      var directionsRequest = 
      {
        origin: start,
        destination: end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
      };
      directionsService.route
      (
        directionsRequest,
        function(response, status)
        {
          if (status == google.maps.DirectionsStatus.OK) 
          {
            new google.maps.DirectionsRenderer
            ({
              map: mapObject,
              directions: response
            });
          }
          else
          {
            alert("Unable to retrieve your route");
          }
        }
      )
    }

  })
</script>