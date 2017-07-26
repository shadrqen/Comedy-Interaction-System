DB::table('likes')->insert(
['itemId' => $itemId, 'itemType' => $itemType, 'userId' => Auth::user()->id, 'statuss' => 1]
)

<div id="editMeme"style="padding-top: 10px; padding-bottom: 10px" class="">
    <div id="box1" style="">
        <input id="ifile" type="file">
        <br>
    </div>

    <div id="box2" style="display: none;">
        <h2>Write Top & Bottom Lines:</h2>
        <input id="topline" placeholder="TOP LINE">
        <br><br>
        <input id="bottomline" placeholder="BOTTOM LINE">
        <br><br>
        <canvas id="c" width="0" height="0"></canvas>
        <br><br>
        <a href="#" class="buttonLink" id="downloadLink" download>Download Meme!</a>
        <br><br>
        <a href="">Make Another Meme!</a>
    </div>
</div>

<script type="text/javascript">
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
</script>




$(function () {
var form = document.querySelector('#form');
var request = new XMLHttpRequest();
$('#form').submit(function (e) {
e.preventDefault();
var e = {}, // A container for DOM elements
reader = new FileReader(),
image = new Image(),
ctxt = null, // For canvas' 2d context
renderMeme = null, // For a function to render memes
get = function (id) {
// Short for document.getElementById()
return document.getElementById(id);
};
alert(document.getElementById(id));
// Get elements (by id):
e.box1 = get("box1");
e.memeImage = get("memeImage");
e.box2 = get("box2");
e.topline = get("topline");
e.bottomline = get("bottomline");
e.c = get("c"); // canvas;
e.downloadLink = get("downloadLink");
// Get canvas context:
ctxt = e.c.getContext("2d");
});
});