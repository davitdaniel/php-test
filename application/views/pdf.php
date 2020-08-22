<html>
<head>
<script src="/assets/js/jspdf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="content" style="width: 100%">
</div>
<script>
var first_name = `<?php echo $first_name; ?>`;  
var sur_name = `<?php echo $sur_name; ?>`;
var title = `<?php echo $title; ?>`;
var company_website = `<?php echo $company_website; ?>`;
var company_name = `<?php echo $company_name; ?>`;
var textbox1 = `<?php echo $textbox1; ?>`;
var textbox2 = `<?php echo $textbox2; ?>`;
var textbox3 = `<?php echo $textbox3; ?>`;
var textbox4 = `<?php echo $textbox4; ?>`;

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
        orientation: 'portrait',
        format: [800, 1714]
    });
    doc.addImage(logo1, "JPEG", 0, 0, 282, 610);
    doc.setFont("Segoe Print");
    doc.setFontStyle("bold");
    doc.setTextColor(23,28,61);
    doc.setFontSize(28);
    let arr_title = doc.splitTextToSize(`${first_name} ${sur_name}`, 70);
    doc.text(arr_title[0], 155, 24);
    doc.setFontSize(18);
    doc.setFontStyle("normal");
    arr_title = doc.splitTextToSize(`${title}`, 70);
    arr_title = arr_title.slice(0, 3);
    doc.text(arr_title, 155, 34);
    doc.setFontSize(12);
    doc.setTextColor(153,153,153);
    arr_title = doc.splitTextToSize(`${company_website}`, 54);
    doc.text(arr_title[0], 155, 60);

    doc.setTextColor(230, 230, 230);
    doc.setFontSize(24);
    arr_title = doc.splitTextToSize(`${company_name}`, 200);
    doc.text(arr_title[0], 140, 132, null, null, "center");

    doc.setFontStyle("bold");
    doc.setTextColor(43, 43, 43);
    arr_title = doc.splitTextToSize(`${first_name}`, 70);
    doc.text(`Dear ${arr_title[0]}`, 30, 185);
    doc.setFontStyle("normal");
    doc.setFontSize(18);
    let arr_content1 = doc.splitTextToSize(`${textbox1}`, 90);
    arr_content1 = arr_content1.slice(0, 7);
    doc.text(arr_content1, 30, 195);
    let arr_content2 = doc.splitTextToSize(`${textbox2}`, 90);
    arr_content2 = arr_content2.slice(0, 7);
    doc.text(arr_content2, 170, 310);
    let arr_content3 = doc.splitTextToSize(`${textbox3}`, 90);
    arr_content3 = arr_content3.slice(0, 5);
    doc.text(arr_content3, 30, 435);
    let arr_content4 = doc.splitTextToSize(`${textbox4}`, 220);
    arr_content4 = arr_content4.slice(0, 3);
    doc.text(arr_content4, 30, 520);

    doc.setTextColor(23,28,61);
    doc.setFontSize(28);
    arr_title = doc.splitTextToSize(`${first_name} ${sur_name}`, 70);
    doc.text(arr_title[0], 180, 555);
    doc.setFontSize(18);
    doc.setFontStyle("normal");
    arr_title = doc.splitTextToSize(`${title}`, 70);
    arr_title = arr_title.slice(0, 3);
    doc.text(arr_title, 180, 565);
    doc.setFontSize(12);
    doc.setTextColor(153,153,153);
    arr_title = doc.splitTextToSize(`${company_website}`, 70);
    doc.text(arr_title[0], 180, 590);
    // arr_understanding = doc.splitTextToSize("You can only produce a given amount of resource.", 125)
    // doc.text(arr_understanding, 150, 85 + offset);
    // doc.addPage({
    //     orientation: 'landscape',
    //     format: [800, 480]
    // });
    // let logo2 = await loadImage('/img/pdf1.png.jpg');
    // doc.addImage(logo2, "JPEG", 0, 0, 282, 170);
    // doc.setFontSize(26);
    // doc.text("Based on our understanding.", 90, 40);
    // doc.setFontSize(22);
    // doc.text(`${product},`, 150, 70);
    // arr_understanding = doc.splitTextToSize(`${improvement}`, 125)
    // doc.text(arr_understanding, 150, 85);
    // offset = 0;
    // offset = 9 * arr_understanding.length + 5;
    // arr_understanding = doc.splitTextToSize(`A higher value in terms of ${baseline}`, 125)
    // doc.text(arr_understanding, 150, 85 + offset);
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