var player,
    time_update_interval = 0;
var get_token = $("#get_token").val();

function progressbar(){
    
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $.ajax({
       url:'/video/progressbar',
       dataType: "html",
       type:'post',
       success:  function (response) {
        $("div.progress_bar").html(response);
       },
       statusCode: {
          404: function() {
             alert('web not found');
          }
       },
       error:function(x,xs,xt){
          //window.open(JSON.stringify(x));
          //alert("error")
       }
    });

}

function show_items(){
    
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    var get_token = $("#get_token").val();

    $.ajax({
       url:'/video/show_items',
       data:{ 
        'get_token' : get_token
        },
       dataType: "html",
       type:'get',
       success:  function (response) {
        $("ul.more-videos").html(response);
       },
       statusCode: {
          404: function() {
             alert('web not found');
          }
       },
       error:function(x,xs,xt){
          //window.open(JSON.stringify(x));
          //alert("error")
       }
    });

}

show_items();
progressbar();

setInterval(function(){
  show_items();
  progressbar();
}, 4000);



function get_video( multi_media_id, videoId ){

    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    var ready_videoId = videoId;
    var current       = "0:00";
    var duration      = "0:00";
    var viewed        = 0;
    var get_token     = $("#get_token").val();

    $.ajax({
       url:'/video/register',
       data:{ 
        'ready_videoId' : ready_videoId, 
        'current' : current, 
        'duration' : duration,
        'multi_media_id' : multi_media_id,
        'viewed' : viewed,
        'get_token' : get_token
        },
       dataType: "html",
       type:'post',
       success:  function (response) {
        //alert("exito")
        location.reload();
       },
       statusCode: {
          404: function() {
             alert('web not found');
          }
       },
       error:function(x,xs,xt){
          //window.open(JSON.stringify(x));
          alert("error")
       }
    });

}

function onYouTubeIframeAPIReady() {
    var list_videoId = $("#ready_videoId").val();
    player = new YT.Player('video-player', {
        width: 890,
        height: 500,
        videoId: list_videoId,
        playerVars: {
            color: 'white',
            controls: 0,
            autoplay: 0,
            modestbranding: 0,
            disablekb: 0,
            rel: 0,
            fs: 0,
            loop: 0,
            playlist: list_videoId
        },
        events: {
            onReady: initialize
        }
    });
    
}

function initialize(){

    // Update the controls on load
    updateTimerDisplay();
    updateProgressBar();

    // Clear any old interval.
    clearInterval(time_update_interval);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval = setInterval(function () {
        updateTimerDisplay();
        updateProgressBar();
    }, 1000);


    $('#volume-input').val(Math.round(player.getVolume()));
}


// This function is called by initialize()
function updateTimerDisplay(){
    // Update current time text display.
    $('#current-time').text(formatTime( player.getCurrentTime() ));
    $('#duration').text(formatTime( player.getDuration() ));

    if( $('#current-time').text() == "0:00" && $('#duration').text() == "0:00" ){
      $("span.mensaje").text("");
    } else if( $('#current-time').text() == $('#duration').text() ){
      $("span.mensaje").text("Felicidades, ha completado el video");
      // Ajax player pause video
      player.pauseVideo();

      ajax_media();
      show_items();
      progressbar();

    }
}


// This function is called by initialize()
function updateProgressBar(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
}


// Progress bar

$('#progress-bar').on('mouseup touchend', function (e) {

    // Calculate the new time for the video.
    // new time in seconds = total duration in seconds * ( value of range input / 100 )
    var newTime = player.getDuration() * (e.target.value / 100);

    // Skip video to new time.
    player.seekTo(newTime);

});


// Playback

function ajax_media(){
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    var ready_videoId = $("#ready_videoId").val();
    var current       = $('#current-time').text();
    var duration      = $('#duration').text();
    var viewed        = 1;

    $.ajax({
       url:'/video/register',
       data:{ 
        'ready_videoId' : ready_videoId, 
        'current' : current, 
        'duration' : duration,
        'viewed' : viewed
        },
       dataType: "json",
       type:'post',
       success:  function (response) {

       },
       statusCode: {
          404: function() {
             alert('web not found');
          }
       },
       error:function(x,xs,xt){
          //window.open(JSON.stringify(x));
          //alert("error")
       }
    });

}

$('#play').on('click', function () {
    player.playVideo();
});


$('#pause').on('click', function () {
    player.pauseVideo();

    // Ajax player pause video
    ajax_media();
    show_items();
    progressbar();

});


// Sound volume


$('#mute-toggle').on('click', function() {
    var mute_toggle = $(this);

    if(player.isMuted()){
        player.unMute();
        mute_toggle.text('on');
    }
    else{
        player.mute();
        mute_toggle.text('off');
    }
});

$('#volume-input').on('change', function () {
    player.setVolume($(this).val());
});


// Other options


$('#speed').on('change', function () {
    player.setPlaybackRate($(this).val());
});

$('#quality').on('change', function () {
    player.setPlaybackQuality($(this).val());
});


// Playlist

$('#next').on('click', function () {
    player.nextVideo()
});

$('#prev').on('click', function () {
    player.previousVideo()
});


// Load video

$('.thumbnail').on('click', function () {

    var url = $(this).attr('data-video-id');

    player.cueVideoById(url);

});


// Helper Functions

function formatTime(time){
    time = Math.round(time);

    var minutes = Math.floor(time / 60),
        seconds = time - minutes * 60;

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return minutes + ":" + seconds;
}


$('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
});