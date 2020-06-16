<html>
<head>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="content" style="width: 100%">
</div>
<script>
var name = "<?php echo $name ?>";
var understanding = "<?php echo $understanding ?>";
var product = "<?php echo $product ?>";
var improvement = "<?php echo $improvement ?>";
var baseline = "<?php echo $baseline ?>";
function loadImage(url) {
    return new Promise((resolve) => {
        let img = new Image();
        img.onload = () => resolve(img);
        img.src = url;
    })
}

async function printPDF() {
    let logo1 = await loadImage('/img/pdf.png.jpg');
    $("#content").height($("body").height());
    const doc = new jsPDF({
        orientation: 'landscape',
        format: [800, 480]
    });
    doc.addImage(logo1, "JPEG", 0, 0, 282, 170);
    doc.setFont("Segoe Print");
    doc.setFontStyle("bolditalic");
    doc.setTextColor(255,255,255);
    doc.setFontSize(22);
    doc.text(`Dear ${name},`, 150, 70);
    let arr_understanding = doc.splitTextToSize(`Based on our converstation. ${understanding}`, 125)
    let offset = 0;
    offset = 9 * arr_understanding.length + 5;
    doc.text(arr_understanding, 150, 85);
    arr_understanding = doc.splitTextToSize("You can only produce a given amount of resource.", 125)
    doc.text(arr_understanding, 150, 85 + offset);
    doc.addPage({
        orientation: 'landscape',
        format: [800, 480]
    });
    let logo2 = await loadImage('/img/pdf1.png.jpg');
    doc.addImage(logo2, "JPEG", 0, 0, 282, 170);
    doc.setFontSize(26);
    doc.text("Based on our understanding.", 90, 40);
    doc.setFontSize(22);
    doc.text(`${product},`, 150, 70);
    arr_understanding = doc.splitTextToSize(`${improvement}`, 125)
    doc.text(arr_understanding, 150, 85);
    offset = 0;
    offset = 9 * arr_understanding.length + 5;
    arr_understanding = doc.splitTextToSize(`A higher value in terms of ${baseline}`, 125)
    doc.text(arr_understanding, 150, 85 + offset);
    const pdfData = doc.output('datauristring');
    $("#content").html(`<embed style="width: 100%; height: 100%" src="${pdfData}" />`);
}

$(document).ready(function() {
    $("#content").height($("body").height());
    printPDF();
});
</script>
</body>
</html>