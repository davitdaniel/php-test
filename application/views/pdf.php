<html>
<head>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="content" style="width: 100%">
</div>
<script>
$(document).ready(function() {
    $("#content").height($("body").height());
    const doc = new jsPDF({
        orientation: 'landscape',
        format: [800, 500]
    });

    doc.text("Hello", 5, 5);
    const pdfData = doc.output('datauristring');
    console.log(pdfData);
    $("#content").html(`<embed style="width: 100%; height: 100%" src="${pdfData}">`);
});
</script>
</body>
</html>