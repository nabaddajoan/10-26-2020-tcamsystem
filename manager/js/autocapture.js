
function autoProcess(room_id) {
    $.get('src/get.php',  // url
        {
            token: 'class_room',
            id: room_id,
        },
        function (response) {  // success callback
            if (response != 'null')
                setInterval(checkAttendance, 2000, room_id)
        }
    );
}

function checkAttendance(room_id) {
    $.get('src/get.php',  // url
        {
            token: 'class_room',
            id: room_id,
        },
        function (response) {  // success callback
            var data = JSON.parse(response);
            if (parseInt(data.camera_on) == 1)
                autoStart()
            else
                autoStop()
        }
    );
}

function autoStart() {
    console.log('camera for class enabled');
    if (!capturing)
        $('#startButton').click();
}

function autoStop() {
    console.log('camera for class disabled');
    if (capturing)
        $('#stopButton').click();
}
