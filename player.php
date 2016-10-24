<?php
/**
 * Created by PhpStorm.
 * User: adm_gcs
 * Date: 10/24/2016
 * Time: 9:15 AM
 */
include "includes/php/base.php";
$action = $_GET['action'];
if($action != ""){
    switch($action){
        case 'play':
            $track = $_GET['track'];
            $file = $_GET['file'];
            //TODO select file and track info from db.
            $sql = "SELECT * FROM midi_files WHERE id=".$file;
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) == 0){
                //TODO error
            }
            $file = mysqli_fetch_assoc($query);

            $sql = "SELECT * FROM tracks WHERE id=".$track;
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) == 0){
                //TODO error
            }
            $track = mysqli_fetch_assoc($query);


            break;

    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Mines of MIDIa</title>
    <link rel="icon" type="image/x-icon" href="favicon.png?v=2"/>
    <!-- midi.js css -->
    <link href="includes/css/MIDIPlayer.css" rel="stylesheet" type="text/css"/>
    <!-- shim -->
    <!--<script src="includes/shim/Base64.js" type="text/javascript"></script>-->
    <script src="includes/shim/Base64binary.js" type="text/javascript"></script>
    <script src="includes/shim/WebAudioAPI.js" type="text/javascript"></script>
    <script src="includes/shim/WebMIDIAPI.js" type="text/javascript"></script>
    <!-- jasmid package -->
    <script src="includes/jasmid/stream.js"></script>
    <script src="includes/jasmid/midifile.js"></script>
    <script src="includes/jasmid/replayer.js"></script>
    <!-- midi.js package -->
    <script src="includes/midi-js/js/midi/audioDetect.js" type="text/javascript"></script>
    <script src="includes/midi-js/js/midi/gm.js" type="text/javascript"></script>
    <script src="includes/midi-js/js/midi/loader.js" type="text/javascript"></script>
    <script src="includes/midi-js/js/midi/plugin.audiotag.js" type="text/javascript"></script>
    <script src="includes/midi-js/js/midi/plugin.webaudio.js" type="text/javascript"></script>
    <script src="includes/midi-js/js/midi/plugin.webmidi.js" type="text/javascript"></script>
    <script src="includes/midi-js/js/midi/player.js" type="text/javascript"></script>
    <!-- utils -->
    <script src="includes/midi-js/js/util/dom_request_xhr.js" type="text/javascript"></script>
    <!--<script src="includes/midi-js/js/util/dom_request_script.js" type="text/javascript"></script>-->
    <!-- includes -->
    <script src="includes/js/timer.js" type="text/javascript"></script>
    <script src="includes/js/event.js" type="text/javascript"></script>
</head>
<body>
<input type="hidden" id="song_file" value="<?= $file['file_name'] ?>">
<h1>Mines of MIDIa</h1>

<div style="position: fixed; top: 0; left: 0; z-index: 4; overflow: hidden;" id="colors"></div>
<div style="margin-bottom: 50px; border: 1px solid #000; background: rgba(255,255,255,0.5); border-radius: 11px; float: left; width: 800px; padding-bottom: 15px; position: relative; z-index: 2;">
    <div class="player"
         style="height: 42px; box-shadow: 0 -1px #000; margin-bottom: 0; border-bottom-right-radius: 0; border-bottom-left-radius: 0;">
        <div style="margin: 0 auto; width: 160px; float: right;">
            <input type="image" src="includes/images/pause.png" align="absmiddle" value="pause"
                   onclick="pausePlayStop()" id="pausePlayStop">
            <input type="image" src="includes/images/stop.png" align="absmiddle" value="stop"
                   onclick="pausePlayStop(true)">
            <input type="image" src="includes/images/backward.png" align="absmiddle" value="stop"
                   onclick="player.getNextSong(-1);">
            <input type="image" src="includes/images/forward.png" align="absmiddle" value="stop"
                   onclick="player.getNextSong(+1);">
        </div>
        <div class="time-controls" style="float: left; margin: 0; position: relative; top: 5px;">
            <span id="time1" class="time">0:00</span>
            <span id="capsule">
					<span id="cursor"></span>
				</span>
            <span id="time2" class="time" style="text-align: left;">-0:00</span>
        </div>
    </div>
    <div id="title"
         style="background: rgba(255,255,0,0.5); position: relative;color: #000; z-index: -1;padding: 5px 11px 5px;">
             <?= $track['title']." - ".$track['artist'] ?>
    </div>
    <p>This page is just for testing and figuring out how MIDI.js works. It can be built upon
        as the MIDI player page for our app.</p>
</div>
<script src="includes/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="includes/js/mines_of_midia_player.js" type="text/javascript"></script>
</body>
</html>