<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <title>JAVASCRIPT PDF MAKE</title>
</head>

<body>

<?php

$url1 = 'alpha.json';
$data1 = file_get_contents($url1);
$characters1 = json_decode($data1, true);
?>


<div class="container">
	<div class="row" id="clientsReport">

	<?php foreach ($characters1 as $character1) : ?>
		<div class="panel panel-success">
			<!-- Default panel contents -->

			<div class="panel-heading">VULNERABILITY (<?php echo $character1['IP']; ?> )</div>
				<!-- Table LOOP-->
				<table class="table">
					<tbody>    
					<tr>
						<th>IP</th>
			            <td> <?php echo $character1['IP']; ?> </td>
			        </tr>

			        <tr>
						<th>PORTS</th>
			            <td> <?php echo implode(",",$character1['PORTS']); ?> </td>
					</tr>

					<tr>
						<th>PORTS NO</th>
			            <td> <?php echo count($character1['PORTS']); ?></td>
					</tr>

					<tr>
						<th>VULN</th>
			            <td> <?php echo implode(",",$character1['VULN']); ?> </td>
					</tr>

					<tr>
						<th>VULN NO</th>
			            <td> <?php echo count($character1['VULN']); ?></td>
					</tr>
            	</tbody>  
			</table>
		</div>

			<?php endforeach; ?>

	</div>



		<input type="button" id="btnExport" value="Export" onclick="Export()" />

</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('clientsReport'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Report.pdf");
                }
            });
        }
    </script>



</body>

</html>