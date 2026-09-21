
var wavesurfer;
var ctx = document.createElement('canvas').getContext('2d');
var linGrad = ctx.createLinearGradient(0, 64, 0, 200);
linGrad.addColorStop(0.5, 'rgba(255, 255, 255, 1.000)');
linGrad.addColorStop(0.5, 'rgba(183, 183, 183, 1.000)');

$('.controls').hide();
$('#loading-controls').show();

document.addEventListener('DOMContentLoaded', function() {
    wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: linGrad,
        progressColor: '#31708f',
        cursorColor: '#fff',
        normalize: true,
        height: 120,
        barWidth: 3
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var playPause = document.querySelector('#wv-playPause');
    playPause.addEventListener('click', function() {
        wavesurfer.playPause();
    });

    wavesurfer.on('play', function() {
        $('#wv-playPause').removeClass('fa-play');
        $('#wv-playPause').addClass('fa-pause');
    });
    wavesurfer.on('pause', function() {
        $('#wv-playPause').removeClass('fa-pause');
        $('#wv-playPause').addClass('fa-play');
    });

    wavesurfer.setVolume(0.2);
    document.querySelector('#volume').value = wavesurfer.backend.getVolume();
    var volumeInput = document.querySelector('#volume');
    var onChangeVolume = function (e) {
      wavesurfer.setVolume(e.target.value);
    };
    volumeInput.addEventListener('input', onChangeVolume);
    volumeInput.addEventListener('change', onChangeVolume);

    var links = document.querySelectorAll('#playlist a');
    var currentTrack = 0;

    var setCurrentSong = function(index) {
        links[currentTrack].classList.remove('active');
        currentTrack = index;
        links[currentTrack].classList.add('active');
        wavesurfer.load(links[currentTrack].href);
    };

    Array.prototype.forEach.call(links, function(link, index) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            setCurrentSong(index);
        });
    });

    wavesurfer.on('ready', function() {
        wavesurfer.playPause();
        $('#loading-controls').hide();
        $('.controls').show();
    });

    wavesurfer.on('error', function(e) {
        console.warn(e);
    });

    wavesurfer.on('finish', function() {
        setCurrentSong((currentTrack + 1) % links.length);
    });

    setCurrentSong(currentTrack);
});

$('.list-group-item').on('click', function() {
    $('#loading-controls').show();
    $('.controls').hide();
});

$('#btn-send-music').hide();
$('#uploadBtn').on('change', function() {
    document.getElementById("uploadFile").value = this.value.replace("C:\\fakepath\\", "");
    $('#btn-send-music').show();
});

$('#btn-send-music').on('click', function() {
    $("#form-upload-music").submit();
});

$('#loading-playlist').hide();
$('#div-add-success').hide();
$('#div-add-error').hide();
$("#form-upload-music").on('submit', function() {
    $('#div-add-success').hide();
    $('#div-add-error').hide();
    $('#loading-playlist').show();
    $.ajax({
        type: 'POST',
        url: '/upload',
        dataType: 'json',
            data: new FormData($('#form-upload-music')[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $("#playlist").load(location.href + " #playlist");
                $('#div-add-success').show();
                $('#loading-playlist').hide();
            },
            error: function(err) {
                $('#div-add-error').show();
                $('#loading-playlist').hide();
                $('#btn-send-music').hide();
                console.log(err);
            }
    });
    return false;
});
