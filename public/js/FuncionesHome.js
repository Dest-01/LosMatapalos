window.onload = iniciarMap;

function iniciarMap(){
    var coord = {lat:10.617105,lng:-85.45162};
    var map = new google.maps.Map(document.getElementById('map'),{
        zoom: 18,
        center: coord,
        mapTypeId: 'hybrid'
    });
    var marker = new google.maps.Marker({
        position: coord,
        map: map
    })
}



var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mousewheel: {
      invert: false,
    },
    // autoHeight: true,
    pagination: {
      el: '.blog-slider__pagination',
      clickable: true,
    }
  });
