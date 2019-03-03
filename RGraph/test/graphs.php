<?php 
	require_once "dbconnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>

	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
	</style>
 	<link rel="stylesheet" href="demos.css" type="text/css" media="screen" />
    
    	<script type="text/javascript" src="../libraries/RGraph.common.core.js" ></script>
    	<script type="text/javascript" src="../libraries/RGraph.bar.js" ></script>
   	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   	 <!--[if lt IE 9]><script src="../excanvas/excanvas.js"></script><![endif]-->
    
    	<title>A grouped bar chart</title>
    
    <meta name="description" content="This demonstration shows a grouped Bar chart" />

	</head>

	<body>
	<h2> Data Visualization with RGraph </h2>
	
	Compare both  <font color="grey">hourly salary</font> and <font color="green">year salary</font> among different jobs within the "Computer and mathematical science occupations" category. 


		<br/><br/>
 	<canvas id="cvs3" width="900" height="250">[No canvas support]</canvas>

		<?php
			$sql = "select jobCode, jobTitle, houlyMean, annualMean from INDIANA_SALARY where jobcode like '15%' and jobcode !='15-0000' order by jobCode";
			$result = $DB->GetAll($sql);

			$labelArray = '';
			$dataArray = '';
			$legend = '';
                     //prepare data
			foreach ($result as $row)
			{    	$labelArray = $labelArray ."'".$row["jobCode"]."',";

				$dataArray = $dataArray. "[".$row["houlyMean"].",".($row["annualMean"]/1000)."],";
				
				$legend = $legend. 	$row["jobCode"] . " - " . $row["jobTitle"] . "<br/>"; 
			}

			$labelArray = "[" . substr($labelArray, 0, -1)."]";

			$dataArray = "[" . substr($dataArray, 0, -1)."]";
		?>
	
		 <script>
        $(document).ready(function ()
        {
            var bar9 = new RGraph.Bar('cvs3', <?php print $dataArray; ?>)
                .set('labels', <?php print $labelArray;?>)
                .set('colors', ['#C7CFC7','#B2C8B2','#D9E0DE','#CDDED1'])
                .set('hmargin', 15)
                .set('hmargin.grouped', 1)
                .set('gutter.left', 35)
                .set('gutter.bottom', 45)
                .set('background.grid.vlines', false)
                .set('background.grid.border', false)
                .set('strokestyle', 'rgba(0,0,0,0)')
                .set('shadow', false)
                .draw();
                
        
        })
    </script>
    
    <br />
    
   Legend:    <br />

   <?php print $legend; ?>


	</body>
</html>


