<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>TEST</title>
     <style type="text/css">
        body
        {
            font-family: Arial;
            font-size: 10pt;
        }
        table
        {
            border: 1px solid #ccc;
            border-collapse: collapse;
        }
        table th
        {
            background-color: #F7F7F7;
            color: #333;
            font-weight: bold;
        }
        table th, table td
        {
            padding: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>

<?php

$data = '{
	"name": "Aragorn",
	"race": "Human"
}';

echo '<b>'. "FIRST OUTPUT". '</b>'. '<br>';
$character = json_decode($data);
echo $character->name . '<br><br>';



$url = 'data.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed

echo '<b>'. "SECOND OUTPUT READ FROM JSON FILE". '</b>'. '<br>';
echo $characters[0]->name . '<br><br>';

echo '<b>'. "THIRD OUTPUT". '</b>'. '<br>';
foreach ($characters as $character) {
	echo $character->name . '<br>';
}

//ASSOCIATIVE ARRAY
echo '<br><br>'. '<b>'. "FOURTH OUTPUT". '</b>'. '<br>';
$characters = json_decode($data, true); // decode the JSON feed and make an associative array
echo  $characters[0]['race'] . '<br><br>';

echo '<b>'. "FIFTH OUTPUT". '</b>'. '<br>';
foreach ($characters as $character) {
	echo $character['race'] . "<br>";
}





//JAVASCRIPT PDFMAKE ASSOCIATIVE ARRAY
echo '<br><br>'. '<b>'. "JAVASCRIPT PDFMAKE OUTPUT". '</b>'. '<br>';
$url1 = 'alpha.json'; // path to your JSON file
$data1 = file_get_contents($url1); // put the contents of the file into a variable
$characters1 = json_decode($data1, true); // decode the JSON feed and make an associative array
echo  $characters1[0]['IP'] . '<br><br>';

echo '<b>'. "JAVASCRIPT PDFMAKE OUTPUT". '</b>'. '<br>';
foreach ($characters1 as $character1) {
	echo $character1['IP'] . ' IP has ' .
	implode(",",$character1['PORTS']) . ' open ports and ' .
	implode(",", $character1['VULN']) . ' vulnerabitities ' . '<br>' ;
}




echo '<br><br>'. '<b>'. "TABLE BELOW". '</b>';
?>

<br>
<table>
	<tbody>
		<tr>
			<th>Name</th>
			<th>Race</th>
		</tr>
		<?php foreach ($characters as $character) : ?>
        <tr>
            <td> <?php echo $character['name']; ?> </td>
            <td> <?php echo $character['race']; ?> </td>
        </tr>
		<?php endforeach; ?>
	</tbody>
</table>
<br><br>

<!-- JAVASCRIPT PDFMAKE -->
<br>
<table id="tblCustomers" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<th>IP</th>
			<th>PORTS</th>
			<th>PORTS NO</th>
			<th>VULN</th>
			<th>VULN NO</th>
		</tr>
		<?php foreach ($characters1 as $character1) : ?>
        <tr>
            <td> <?php echo $character1['IP']; ?> </td>
            <td> <?php echo implode(",",$character1['PORTS']); ?> </td>
            <td> <?php echo count($character1['PORTS']); ?></td>
            <td> <?php echo implode(",",$character1['VULN']); ?> </td>
            <td> <?php echo count($character1['VULN']); ?></td>

        </tr>
		<?php endforeach; ?>
	</tbody>
</table>

	<input type="button" id="btnExport" value="Export" onclick="Export()" />

<br><br>

<?php

$url = 'wizards.json';
$data = file_get_contents($url);
$wizards = json_decode($data, true);

foreach ($wizards as $wizard) {
	echo $wizard['name'] . '\'s wand is ' .
	$wizard['wand'][0]['wood'] . ', ' .
	$wizard['wand'][0]['length'] . ', with a ' .
	$wizard['wand'][0]['core'] . ' core. <br>' ;
}

?>

<br><br>

<?php

$data = [
	'name' => 'Aragorn',
	'race' => 'Human'
];

echo json_encode($data);

?>


<script>
	var data = '[ { "name": "Aragorn", "race": "Human" }, { "name": "Gimli", "race": "Dwarf" } ]'
	data = JSON.parse(data);
	console.log(data[1].name)

//LOOP
	for (var i = 0; i < data.length; i++) {
  console.log(data[i].name + ' is a ' + data[i].race + '.')
}

// GET DATA FROM EXTERNAL FILE AND LOOP TTHROUGH
var request = new XMLHttpRequest()

request.open('GET', 'data.json', true)

request.onload = function() {
  // begin accessing JSON data here
  var data = JSON.parse(this.response)

  for (var i = 0; i < data.length; i++) {
    console.log(data[i].name + ' is a ' + data[i].race + '.')
  }
}

request.send()

</script>






<script>

// JAVASCRIPT PDFMAKE GET DATA FROM EXTERNAL FILE AND LOOP TTHROUGH
var request = new XMLHttpRequest()

request.open('GET', 'alpha.json', true)

request.onload = function() {
  // begin accessing JSON data here
  var data = JSON.parse(this.response)

  for (var i = 0; i < data.length; i++) {
    console.log(data[i].IP + ' has ' + data[i].PORTS.length  + ' as it\'s open ports and ' + data[i].VULN + ' vulnerabitities.')
  }
}

request.send()
</script>


    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('tblCustomers'), {
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