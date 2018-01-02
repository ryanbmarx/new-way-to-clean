function getRandom(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}


function makeStarfield(cycles){
  var starfield = ""
  for (i=0; i<cycles;i++){
    var randoDiameter = Math.random()*4,
    randoOpacity = Math.random(),
    randoX = Math.random() * 100,
    randoY = Math.random() * 100;
    starfield += "<span class='star' style='opacity:"+randoOpacity+";top:"+randoX+"%;left:"+randoY+"%;width:"+randoDiameter+"px;height:"+randoDiameter+"px;'></span>";
  }
  return starfield;
}

function makePillfield(target){
    var randoDiameter = getRandom(10, 20),
    randoColor = getRandom(1,6),
    randoRotate = getRandom(0,361),
    randoPill = getRandom(1,16),
    randoX = Math.random() * 100,
    randoY = Math.random() * 100,
    randoSpeed = getRandom(10000,15000),
    randoID = getRandom(0,1000000000000),
    color="white";

    if(randoColor == 1){
      color = "blue";
    } else if (randoColor == 2){
      color = "pink";
    } else if (randoColor == 3){
      color = "red";
    } else if (randoColor == 4){
      color = "white";
    } else if (randoColor == 5){
      color = "yellow";
    }
    var pill = "<img id='pill"+randoID+"'class='pill' src='img/pills/"+color+"/pill"+randoPill+".png' style='transform: rotate("+randoRotate+"deg);left:"+randoY+"%;width:"+randoDiameter+"px;'/>";
    $(target).append(pill);
    // console.log(randoSpeed);
    $('#pill'+randoID).velocity(
      {
        "top":"110%",
      }, randoSpeed, function(){
        $(this).remove();
      });
  }

$(document).ready(function(){
  console.log("ready");
  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    direction: 'vertical',
    loop: true,
    speed: 400,

    // If we need pagination
    pagination: '.swiper-pagination',

    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',

    // And if we need scrollbar
    scrollbar: '.swiper-scrollbar',
     effect: 'fade'
    });

mySwiper.on('onSlideChangeEnd',function(){
  var visibleID = $(".swiper-slide-active").attr('id');
  if (visibleID == 3){console.log('3')}
});

  $('.starfield-wrapper').append(makeStarfield(1000)).click(function(){
    $(this).find('.star').fadeIn(2000);
  });

  // counter = 0
  // var pills = window.setInterval(function(){
  //   // console.log(counter);
  //   if(counter < 5000){
  //     makePillfield('.swiper-bg-inner');
  //     counter++;
  //   } else {
  //     $('.pill').velocity("stop");
  //     window.clearInterval(pills);
  //   }
  // }, 45);
  
});