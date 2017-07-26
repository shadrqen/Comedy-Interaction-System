function storeCode() {
    var b_canvas = document.getElementById("canvas");
    var context = b_canvas.getContext("2d");
    for (var x = 0.5; x < 500; x += 10) {
        context.moveTo(x, 0);
        context.lineTo(x, 375);
    }
    for (var y = 0.5; y < 375; y += 10) {
        context.moveTo(0, y);
        context.lineTo(500, y);
    }

    context.beginPath();
    context.moveTo(0, 40);
    context.lineTo(240, 40);
    context.moveTo(260, 40);
    context.lineTo(500, 40);
    context.moveTo(495, 35);
    context.lineTo(500, 40);
    context.lineTo(495, 45);

    context.moveTo(60, 0);
    context.lineTo(60, 153);
    context.moveTo(60, 173);
    context.lineTo(60, 375);
    context.moveTo(65, 370);
    context.lineTo(60, 375);
    context.lineTo(55, 370);

    context.strokeStyle = "#eee";
    context.stroke();
}

function uploadMeme() {
    var value = $('textarea#ta').val();
    var image = $('input[type=file]').val().split('\\').pop();
    $.ajax({
       dataType: 'json',
        url: '../ajaxUploadMeme',
        type: 'POST',
        data: {
            image: image
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('error');
        }
    });
}

function showTextarea(memeId) {
        $('#'+memeId).removeClass('hidden');
}

function submitComment(memeId, memeImage,type) {
    window.comment = document.getElementById(memeImage).value;
    if(comment == '')
    {
        $('#'+memeId).addClass('hidden');
    }
    else
    {
        $.ajax({
            dataType: 'json',
            url: '../uploadComment',
            type: 'POST',
            data: {
                itemId:memeId,
                itemType: type,
                comment: comment
            },
            success: function (data) {
                $('#'+memeId).addClass('hidden');
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}

function addLike(memeId, memeType) {
    $.ajax({
        dataType: 'json',
        url: '../addLike',
        type: 'POST',
        data: {
            itemId:memeId,
            itemType: memeType
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function reqListener () {
    console.log(this.responseText);
}

$(function () {
    var form = document.querySelector('#form');
    var request = new XMLHttpRequest();
    $('#form').submit(function (e) {
        var image = $('input[type=file]').val().split('\\').pop();
        e.preventDefault();
        var formData = new FormData(form);
        var token = $('meta[name=csrf-token]').attr('content');
        request.addEventListener("load", reqListener);
        request.open('post', 'submit', true);
        request.setRequestHeader('X-CSRF-Token', token);
        request.send(formData);

        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                var response = JSON.parse(request.responseText);
                if (request.status === 200 || response === 'file uploaded successfully!') {
                    var folder = "uploads/";
                    var image = response;
                    var html = "<img src='"+ folder + image +"' width='500'; height='300'>";
                    $("#editMeme").append($(html).fadeIn(3000));
                    $("#upload").hide();
                    $("#editMeme").removeClass('hidden');
                } else {
                    console.log('failed');
                }
            }
        }

    });
});


function draw_b() {
    var b_canvas = document.getElementById("canvas");
    var context = b_canvas.getContext("2d");

    context.font = "bold 12px sans-serif";
    context.fillText("abcd", 248, 43);
    context.fillText("wxyz", 248, 300);
}

function dumb() {
    var e = {}, // A container for DOM elements
        reader = new FileReader(),
        image = new Image(),
        ctxt = null, // For canvas' 2d context
        renderMeme = null, // For a function to render memes
        get = function (id) {
            // Short for document.getElementById()
            return document.getElementById(id);
        };
// Get elements (by id):
    e.box1 = get("box1");
    e.ifile = get("ifile");
    e.box2 = get("box2");
    e.topline = get("topline");
    e.bottomline = get("bottomline");
    e.c = get("c"); // canvas;
    e.downloadLink = get("downloadLink");
// Get canvas context:
    ctxt = e.c.getContext("2d");

    renderMeme = function () {
        var writeText = function (text, x, y) {
            var f = 36; // Font size (in pt)
            for (; f >= 0; f -=1) {
                ctxt.font = "bold " + f + "pt Impact, Charcoal, sans-serif";
                if (ctxt.measureText(text).width < e.c.width - 10) {
                    ctxt.fillText(text, x, y);
                    ctxt.strokeText(text, x, y);
                    break;
                }
            }
        };
        e.c.width = image.width;
        e.c.height = image.height;
        ctxt.drawImage(image, 0, 0, e.c.width, e.c.height);
        ctxt.textAlign = "center";
        ctxt.fillStyle = "white";
        ctxt.strokeStyle = "black";
        ctxt.lineWidth = 2;
        writeText(e.topline.value, e.c.width / 2, 50);
        writeText(e.bottomline.value, e.c.width / 2, e.c.height - 20);
        e.downloadLink.href = e.c.toDataURL("image/jpeg");
    };
    e.ifile.onchange = function () {
        reader.readAsDataURL(e.ifile.files[0]);
        reader.onload = function () {
            image.src = reader.result;
            image.onload = function () {
                renderMeme();
                e.box1.style.display = "none";
                e.box2.style.display = "";
            };
        };
    };
    e.topline.onkeyup = renderMeme;
    e.bottomline.onkeyup = renderMeme;
}