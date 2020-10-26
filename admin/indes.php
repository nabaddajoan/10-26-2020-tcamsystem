<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Live stream-<small class="breadcrumb">Video Record</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Live stream</li>
                </ol>
            </section>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
                <script type="text/javascript" src="http://evanw.github.io/glfx.js/glfx.js"></script>
                <script type="text/javascript" src="jsmanipulate.min.js"></script>
                <script src="whammy.js"></script>
                <script src="video.js?v=<?php echo time(); ?>"></script>
                <script type="text/javascript" src="../js/bootstrap.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

            </head>
            <style type="text/css">
                body {
                    padding-top: 20px;
                    padding-bottom: 40px;
                }

                /* Custom container */
                .container-narrow {
                    margin: 0 auto;
                    max-width: 700px;
                }

                .container-narrow>hr {
                    margin: 30px 0;
                }

                /* Main marketing message and sign up button */
                .jumbotron {
                    margin: 60px 0;
                    text-align: center;
                }

                .jumbotron h1 {
                    font-size: 72px;
                    line-height: 1;
                }

                .jumbotron .btn {
                    font-size: 21px;
                    padding: 14px 24px;
                }

                /* Supporting marketing content */
                .marketing {
                    margin: 60px 0;
                }

                .marketing p+h4 {
                    margin-top: 28px;
                }

                .mast {
                    margin-left: 8px
                }
            </style>

            <body>
                <div class="container-narrow">



                    <div class="page-header">
                        <center>
                            <h2><b class="class_room_name"></b></h2>
                        </center>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Select Filter</p>
                            <select id="dropdown">
                                <option value="normal">normal</option>
                                <option value="greyscale">greyscale</option>
                                <option value="multiply">multiply</option>
                                <option value="blur">blur</option>
                                <option value="water">water</option>
                                <option value="sparkle">sparkle</option>
                                <option value="kaleidoscope">kaleidoscope</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <p>Select Class room</p>
                            <select id="class_room_select"></select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 50px">
                        <div class="span12">
                            <div class="span5 pull-left">
                                <video width="320" height="240" id="campreview" autoplay="true" muted></video>
                            </div>
                            <div class="span5 pull-left">
                                <video width="320" height="240" id="result" controls="controls"></video>
                            </div>
                        </div>
                    </div>



                    <div class="page-header">
                        <h1><small>Manual Video Recording Options</small></h1>
                    </div>

                    <progress id="progress" style="visibility: hidden;"></progress><br />
                    <div id="information"></div>
                    <div class="row">
                        <div class="span2">

                            <input class="uiButton btn btn-primary pull-left" id="startButton" value="Start" type="button" onclick="startCapture();" />


                            <input class="uiButton btn btn-danger pull-right" id="stopButton" value="Stop" type="button" onclick="stopCapture();" disabled="disabled" />

                        </div>
                    </div>



                    <div class="page-header">
                        <!--<h1><small>Manual Audio Recording Options</small></h1>-->
                    </div>

                    <div class="row">
                        <div class="span2">

                            <!--<button class="pull-left btn btn-primary" onclick="startRecording(this);" id="audbut">record</button>
    
   
      <button class="pull-right btn btn-danger" onclick="stopRecording(this);" id="audbut2" disabled>stop</button>-->

                        </div>
                    </div>

                    <!--<h2>Recordings</h2>-->
                    <ul id="recordingslist"></ul>

                    <!--<h2>Log</h2>-->
                    <pre id="log"></pre>

                    <div class="page-header">
                        <!--<h1>Recording Options</h1>-->
                    </div>
                    <div class="row">
                        <div class="span12">

                            <!-- <div class="mast mastrecord btn btn-primary pull-left">record it</div>
    
    
      <div class="mast maststop btn btn-danger pull-left">stop recording</div>
    
    
      <div class="mast mastplay btn btn-info pull-left">play</div>
    
    
      <div class="mast mastsave btn btn-success pull-left">save</div>-->
                        </div>
                    </div>


                    <script src="recorder.js"></script>
                    <script src="js/autoCapture.js"></script>
                    <script type="text/javascript">
                        var filterType = 'normal';
                        var multiplyColor = [255, 105, 0];

                        var class_room_id = "<?php echo $_GET['room']; ?>";

                        $(document).ready(function() {
                            console.log('doc ready');
                            $('.mastrecord').click(function() {
                                console.log('you clicked the red button yo');
                                $('#startButton').click();
                                $('#audbut').click();
                            });
                            $('.maststop').click(function() {
                                console.log('you clicked the red button yo');
                                $('#stopButton').click();
                                $('#audbut2').click();

                            });

                            $('.mastplay').click(function() {
                                console.log('you clicked the red button yo');
                                thevid = document.getElementById("result");
                                thevid.play();
                                var theaudio = document.getElementsByTagName("audio")[0];
                                theaudio.play();


                            });
                            $('#dropdown').change(function() {
                                var filter = $(this).val();
                                filterType = filter
                                alert(filterType);
                            });
                            $('.mastsave').click(function() {
                                var daaudiopath = $('#recordingslist li a').attr('href');
                                var davideopath = $('video#result').attr('href');
                            });

                            $("#class_room_select").change(function() {
                                location.href = "?room=" + $(this).val();
                            });

                        });
                    </script>


                    <script>
                        function __log(e, data) {
                            log.innerHTML += "\n" + e + " " + (data || '');
                        }

                        var audio_context;
                        var audio = document.querySelector('audio');
                        var recorder;
                        var localStream;

                        function startUserMedia(stream) {
                            var input = audio_context.createMediaStreamSource(stream);
                            video.src = window.URL.createObjectURL(stream);
                            __log('Media stream created.');

                            var zeroGain = audio_context.createGain();
                            zeroGain.gain.value = 0;
                            input.connect(zeroGain);
                            zeroGain.connect(audio_context.destination);
                            __log('Input connected to muted gain node connected to audio context destination.');

                            recorder = new Recorder(input);
                            __log('Recorder initialised.');
                        }

                        function startRecording(button) {
                            recorder && recorder.record();
                            button.disabled = true;
                            button.nextElementSibling.disabled = false;
                            console.log('Recording...');
                        }

                        function stopRecording(button) {
                            recorder && recorder.stop();
                            button.disabled = true;
                            button.previousElementSibling.disabled = false;
                            console.log('Stopped recording.');

                            // create WAV download link using audio data blob
                            createDownloadLink();

                            recorder.clear();
                        }

                        function createDownloadLink() {
                            recorder && recorder.exportWAV(function(blob) {
                                var url = URL.createObjectURL(blob);
                                var li = document.createElement('li');
                                var au = document.createElement('audio');
                                var hf = document.createElement('a');

                                au.controls = true;
                                au.src = url;
                                hf.href = url;
                                hf.download = new Date().toISOString() + '.wav';
                                hf.innerHTML = hf.download;
                                li.appendChild(au);
                                li.appendChild(hf);
                                recordingslist.appendChild(li);

                                upload(blob);
                            });
                        }


                        function upload(blobOrFile) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', 'saveaudio.php', true);
                            xhr.onload = function(e) {
                                var result = e.target.result;
                            };

                            xhr.send(blobOrFile);
                        }



                        window.onload = function init() {
                            try {
                                initvideo();

                                // webkit shim
                                window.AudioContext = window.AudioContext || window.webkitAudioContext;
                                navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
                                window.URL = window.URL || window.webkitURL;


                                audio_context = new AudioContext;
                                __log('Audio context set up.');
                                __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
                            } catch (e) {
                                alert('No web audio support in this browser!');
                            }

                            navigator.getUserMedia({
                                audio: true,
                                video: true
                            }, startUserMedia, function(e) {
                                __log('No live audio input: ' + e);
                            });
                        };

                        classRooms()

                        function classRooms() {
                            $.get('src/get.php', // url
                                {
                                    token: 'class_rooms',
                                },
                                function(response) { // success callback
                                    var data = JSON.parse(response);
                                    var rows = "";
                                    if (!(class_room_id > 0)) {
                                        rows += "<option value=''> Select Class</option>";
                                    }
                                    $.each(data, function(i, s) {
                                        if (class_room_id == s.id) {
                                            $('.class_room_name').text(s.name.toUpperCase());
                                        }
                                        rows += "<option value='" + s.id + "'>" + s.name + "</option>";
                                    });

                                    $("#class_room_select").html(rows);
                                    $("#class_room_select").val(class_room_id);
                                })
                        }
                        autoProcess(class_room_id);
                    </script>


            </body>


            </html>