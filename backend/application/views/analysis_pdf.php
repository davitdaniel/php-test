<html>
<head>
<script src="/backend/assets/js/jspdf.min.js"></script>
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
// var report = `<?php echo $report;?>`;
var description = `Using a 'SPIN' model to understand your business challenges we were able to explore the issues in more detail.`;
// var description = `<?php echo $description?>`;
var product_name = `<?php echo $product_name; ?>`;
var report = `Based on our understanding of your situation, problem, the implication and your need, we believe that ${product_name} has the ability to work through your challenges and address your needs in a way that solves these problems. We would be happy to explore this in more detail with you.

Sincerely,
`;
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
    const logo1 = await loadImage('/backend/img/analysis/0.jpg');
    var logo2 = undefined;
    var logo3 = undefined;
    if (<?php echo $exist_product_logo; ?> === 1) {
        logo2 = await loadImage('/backend/index.php/Image/analysis_product_logo/<?php echo $id; ?>');
    }
    if (<?php echo $exist_avatar; ?> === 1) {
        logo3 = await loadImage('/backend/index.php/Image/analysis_user_avatar/<?php echo $id; ?>');
    }
    $("#content").height($("body").height());
    const doc = new jsPDF({
        orientation: 'portrait',
        format: [282, 610]
    });
    const width = 20;
    const lastWidth = 37;
    doc.addImage(logo1, "JPEG", 0, 0, 282, 610);
    if (logo2 !== undefined) {
        doc.addImage(logo2, "PNG", 33, 6.4, width, width);
    }
    if (logo3 !== undefined) {
        doc.addImage(logo3, "PNG", 33, 28.5, width, width);
        doc.addImage(logo3, "PNG", 105, 18, lastWidth, lastWidth);
        doc.addImage(logo3, "PNG", 127, 548, 37, 37);
    }

    doc.setFont("Segoe Print");
    doc.setFontStyle("bold");
    doc.setTextColor(23,28,61);
    doc.setFontSize(30);
    let arr_title = doc.splitTextToSize(`${company_name}`, 76);
    doc.text(arr_title[0], 165, 22);
    doc.setFontSize(20);
    doc.setFontStyle("normal");
    arr_title = doc.splitTextToSize(`${title}`, 76);
    arr_title = arr_title.slice(0, 3);
    doc.text(arr_title, 165, 32);
    doc.setFontSize(14);
    doc.setTextColor(153,153,153);
    arr_title = doc.splitTextToSize(`${company_website}`, 62);
    doc.text(arr_title[0], 165, 58);

    doc.setTextColor(230, 230, 230);
    doc.setFontSize(24);
    // doc.addFont("/backend/img/analysis/font.ttf");
    doc.setFontStyle("bold");
    doc.setTextColor(43, 43, 43);
    arr_title = doc.splitTextToSize(`${company_name}`, 205);
    doc.text(`Dear ${arr_title[0]}`, 30, 180);
    doc.setFontStyle("normal");
    doc.setFontSize(18);
    let arr_description = doc.splitTextToSize(`${description}`, 227);
    arr_description = arr_description.slice(0, 2);
    doc.text(arr_description, 30, 190);
    let arr_content1 = doc.splitTextToSize(`${textbox1}`, 90);
    arr_content1 = arr_content1.slice(0, 3);
    doc.text(arr_content1, 30, 256);
    let arr_content2 = doc.splitTextToSize(`${textbox2}`, 95);
    arr_content2 = arr_content2.slice(0, 2);
    doc.text(arr_content2, 160, 303);
    let arr_content3 = doc.splitTextToSize(`${textbox3}`, 90);
    arr_content3 = arr_content3.slice(0, 3);
    doc.text(arr_content3, 30, 351);
    let arr_content4 = doc.splitTextToSize(`${textbox4}`, 95);
    arr_content4 = arr_content4.slice(0, 2);
    doc.text(arr_content4, 160, 400);
    let arr_report = doc.splitTextToSize(`${report}`, 225);
    arr_report = arr_report.slice(0, 6);
    doc.text(arr_report, 30, 485);
    doc.setFontSize(20);
    arr_title = doc.splitTextToSize(`${first_name} ${sur_name}`, 225);
    doc.text(arr_title[0], 30, 530);

    doc.setTextColor(23,28,61);
    doc.setFontSize(30);
    doc.setFontStyle("bold");
    arr_title = doc.splitTextToSize(`${first_name} ${sur_name}`, 70);
    doc.text(arr_title[0], 190, 550);
    doc.setFontSize(20);
    doc.setFontStyle("normal");
    arr_title = doc.splitTextToSize(`${title}`, 70);
    arr_title = arr_title.slice(0, 3);
    doc.text(arr_title, 190, 560);
    doc.setFontSize(14);
    doc.setTextColor(153,153,153);
    arr_title = doc.splitTextToSize(`${company_website}`, 70);
    doc.text(arr_title[0], 190, 585);
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