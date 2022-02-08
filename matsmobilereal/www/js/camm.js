/********************************************************************/
function setOptions(srcType) {
    var options = {
        // Some common settings are 20, 50, and 100
        quality: 50,
        destinationType: Camera.DestinationType.FILE_URI,
        // In this app, dynamically set the picture source, Camera or photo gallery
        sourceType: srcType,
        encodingType: Camera.EncodingType.JPEG,
        mediaType: Camera.MediaType.PICTURE,
        allowEdit: true,
        correctOrientation: true  //Corrects Android orientation quirks
    }
    return options;
}

function openCamera() {

    var srcType = Camera.PictureSourceType.CAMERA;
    var options = setOptions(srcType);
    //var func = getFileEntry;

    navigator.camera.getPicture(function cameraSuccess(imageUri) {
        // alert('yes');
        displayImage(imageUri);
        // alert('no');
        // You may choose to copy the picture, save it somewhere, or upload.
        getFileEntry(imageUri);
        // alert('noyes');

    }, function cameraError(error) {
        alert("Unable to obtain picture: " + error, "app");

    }, options);
}

function displayImage(imgUri) {

    var elem = document.getElementById('myImg');
    elem.src = imgUri;
}


function createNewFileEntry(imgUri) {
    window.resolveLocalFileSystemURL(cordova.file.cacheDirectory, function success(dirEntry) {
        imageup(imgUri);
        // JPEG file
        dirEntry.getFile("tempFile.jpeg", {create: true, exclusive: false}, function (fileEntry) {

            // Do something with it, like write to it, upload it, etc.
            // writeFile(fileEntry, imgUri);
            alert("got file: " + fileEntry.fullPath);
            // displayFileData(fileEntry.fullPath, "File copied to");

        }, onErrorCreateFile);

    }, onErrorResolveUrl);
}
function getFileEntry(imgUri) {
    window.resolveLocalFileSystemURL(imgUri, function success(fileEntry) {

        // Do something with the FileEntry object, like write to it, upload it, etc.
        // writeFile(fileEntry, imgUri);
        console.log("got file: " + fileEntry.fullPath);
        // displayFileData(fileEntry.nativeURL, "Native URL");
        imageup(imgUri);
    }, function () {
        // If don't get the FileEntry (which may happen when testing
        // on some emulators), copy to a new FileEntry.
        createNewFileEntry(imgUri);
    });
}

function updatepix(resp) {
    var url = "http://192.3.137.194/~matslagos/pharm/auth_new.php?callback=?";
    var sid = localStorage.regid;
    var pic = resp;
    var dataString = "pic=" + pic + "&sid=" + sid + "&pix=";

    if ($.trim(sid) == '') {
        alert("Error SID!");
        return false;
    }
    if ($.trim(pic) == '') {
        alert("Error Pix!");
        return false;
    }

    if (true)
    {
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            crossDomain: true,
            cache: false,
            beforeSend: function () {
                //$("#faccc").html('<button class="button button-block button-positive">Loading Available Wards...</button>');
            },
            success: function (datay) {
                alert(datay);
                localStorage.pix = pic;
                //window.location.href = "message.html";
                return true;
            }
        });
    }
    return false;
}


function imageup(fileURL) {
    var win = function (r) {
        //alert("Code = " + r.responseCode);
        //alert("Response = " + r.response);
        //alert("Sent = " + r.bytesSent);
        alert("Passport Photo Uploaded");
        localStorage.pic = r.response;
        updatepix(r.response);
    }

    var fail = function (error) {
        // alert("An error has occurred: Code = " + error.code);
        // alert("upload error source " + error.source);
        alert("upload error target " + error.target);
    }

    var options = new FileUploadOptions();
    options.fileKey = "file";
    options.fileName = fileURL.substr(fileURL.lastIndexOf('/') + 1);
    options.mimeType = "image/jpeg";

    var params = {};
    params.sid = 0;
    params.section = "assessor";

    options.params = params;

    var ft = new FileTransfer();
    ft.upload(fileURL, encodeURI("http://192.3.137.194/~matslagos/pharm/upload.php"), win, fail, options);
}