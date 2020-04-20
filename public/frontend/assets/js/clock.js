$(document).ready(function() {
  function timeLeft(endtime){
  var t =  new Date(endtime) - Date.parse(new Date());
  var seconds = Math.floor( (t/1000) % 60 );
  var minutes = Math.floor( (t/1000/60) % 60 );
  var hours = Math.floor( (t/(1000*60*60)) % 24 );
  var days = Math.floor( t/(1000*60*60*24) );
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
};

$(document).ready(function() {

  var today = new Date();

  // set upcoming new year here
  //auto
  // let upComingNewYear = (today.getFullYear()) + 1;
  //menual
  let upComingNewYear = 2020;

  var deadline = 'May 2 ' + upComingNewYear + " 00:00:00";

  $("#header").hover(function() {
    $(this).toggleClass('bluelight');
  });

  $(".clock").hover(function() {
    $(this).toggleClass('bluelight');
  });

  var setClock = function(newyear){
    var timeinterval = setInterval(function(){
      var t = timeLeft(newyear);
      $('#days').text(t.days);
      $('#hours').text(t.hours);
      $('#mins').text(('0' + t.minutes).slice(-2));
      $('#secs').text(('0' + t.seconds).slice(-2));
      if(t.total<=0){
        clearInterval(timeinterval);
        var now = new Date();
        var yearStr = now.getFullYear().toString();
        $('#header').text("Happy New Year!!!");
        $('#days').text('00');
        $('#days-text').text("Days");
        $('#hours').text('00');
        $('#hours-text').text("Hours");
        $('#mins').text('00');
        $('#mins-text').text("Minutes");
        $('#secs').text('00');
        $('#secs-text').text("Seconds");
      }
    },1000);
  };
  setClock(3171668425);
});
});
