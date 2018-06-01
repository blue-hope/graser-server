function start()
{
    init();
}
//map init setting div:"maps"
function init()
{
  var map = new naver.maps.Map('map', {
    center: new naver.maps.LatLng(37.558473, 126.935960),
    zoom: 11,
    zoomControl: true,
    minZoom: 11
  });
  var smarker;
  var menuLayer = $('<div style="position:absolute;z-index:10000;background-color:#fff;border:solid 1px #333;padding:10px;display:none;"></div>');

  map.getPanes().floatPane.appendChild(menuLayer[0]);
  naver.maps.Event.addListener(map, 'click', function(e) {
      if(smarker != undefined) smarker.setMap(null);
      var marker = new naver.maps.Marker({
          position: e.coord,
          map: map
      });

      smarker = marker;
      var lat = document.getElementById('lat');
      lat.value = smarker.position.y+"";
      var lng = document.getElementById('lng');
      lng.value = smarker.position.x+"";
  });
  naver.maps.Event.addListener(map, 'mousedown', function(e) {
      menuLayer.hide();
  });
  naver.maps.Event.addListener(map, 'rightclick', function(e) {
      var coordHtml = 'Coord: '+ e.coord +'<br />Point: '+ e.point +'<br />Offset: '+ e.offset;

      menuLayer.show().css({
          left: e.offset.x,
          top: e.offset.y
      }).html(coordHtml);
  });
}

addEventListener("load", start, false);
