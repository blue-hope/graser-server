function start()
{
    init();
}
//map init setting div:"maps"
function init_(lat, long)
{
  var map = new naver.maps.Map('map', {
    center: new naver.maps.LatLng(lat, long),
    zoom: 12,
    zoomControl: true,
    minZoom:11
  });
  //marker -------------------------------------------------------------------------------------------------------------
  var HiteJack = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558167, 126.935519),
    map: map
  });
  var CheapSoju = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558522, 126.934568),
    map: map
  });
  var HoneyTaste = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558558, 126.935746),
    map: map
  });
  var MoonBlade = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558043, 126.934608),
    map: map
  });
  var Bbabbabba = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558826, 126.935705),
    map: map
  });
  var Daekyu = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.557144, 126.935371),
    map: map
  });
  var Gui2 = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558101, 126.936434),
    map: map
  });
  var Hometown = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558487, 126.934078),
    map: map
  });
  var Hungry = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.559076, 126.938286),
    map: map
  });
  var Flower = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558121, 126.934507),
    map: map
  });
  var Gamaksae = new naver.maps.Marker({
    position: new naver.maps.LatLng(37.558599, 126.934002),
    map: map
  });
  //Explain-----------------------------------------------------------------------------------------------------------------
  var HJString = [
        '<div class="iw_inner">',
        '   <h3>하이트잭</h3>',
        '</div>'
    ].join('');
  setName(HJString, HiteJack);

  var CSString = [
        '<div class="iw_inner">',
        '   <h3>싼술을 부탁해</h3>',
        '</div>'
    ].join('');
  setName(CSString, CheapSoju);

  var HTString = [
        '<div class="iw_inner">',
        '   <h3>꿀맛포차</h3>',
        '</div>'
    ].join('');
  setName(HTString, HoneyTaste);

  var MBString = [
        '<div class="iw_inner">',
        '   <h3>달팽이</h3>',
        '</div>'
    ].join('');
  setName(MBString, MoonBlade);

  var BBString = [
        '<div class="iw_inner">',
        '   <h3>빠빠빠</h3>',
        '</div>'
    ].join('');
  setName(BBString, Bbabbabba);

  var DKString = [
        '<div class="iw_inner">',
        '   <h3>깔레</h3>',
        '</div>'
    ].join('');
  setName(DKString, Daekyu);

  var G2String = [
        '<div class="iw_inner">',
        '   <h3>구이마을 2호점</h3>',
        '</div>'
    ].join('');
  setName(G2String, Gui2);

  var HMTString = [
        '<div class="iw_inner">',
        '   <h3>고향</h3>',
        '</div>'
    ].join('');
  setName(HMTString, Hometown);

  var HGString = [
        '<div class="iw_inner">',
        '   <h3>공복</h3>',
        '</div>'
    ].join('');
  setName(HGString, Hungry);

  var FWString = [
        '<div class="iw_inner">',
        '   <h3>향꽃</h3>',
        '</div>'
    ].join('');
  setName(FWString, Flower);

  var GKString = [
        '<div class="iw_inner">',
        '   <h3>가막새</h3>',
        '</div>'
    ].join('');
  setName(GKString, Gamaksae);
//-----------------------------------------------------------------------------------------------------------------
  function setName(contentString, where)
  {
    var infoWindow = new naver.maps.InfoWindow({
      content: contentString
    });

    naver.maps.Event.addListener(where, "click", function(e) {
      if (infoWindow.getMap()) {
        infoWindow.close();
      } else {
        infoWindow.open(map, where);
      }
    });
  }
}

function init()
{
    window.navigator.geolocation.getCurrentPosition(current_position, denied_position);
}

function current_position(position)
{
    init_(position.coords.latitude, position.coords.longitude);
}

function denied_position(position)
{
    init_(37.5575031, 126.9368837)
}




addEventListener("load", start, false);
