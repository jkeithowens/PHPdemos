<!DOCTYPE html >
<html>
<head>
    <link rel="stylesheet" href="demos.css" type="text/css" media="screen" />
    
    <script type="text/javascript" src="../libraries/RGraph.common.core.js" ></script>
    <script type="text/javascript" src="../libraries/RGraph.bar.js" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--[if lt IE 9]><script src="../excanvas/excanvas.js"></script><![endif]-->
    
    <title>A basic Bar chart</title>
    
    <meta name="description" content="A basic Bar chart" />
    
</head>
<body>

<?php
$d ="[[4,5,3],[4,8,6],[4,2,4],[4,2,3],[1,2,3],[8,8,4],[4,8,6]]";
?>
    <h1>A basic Bar chart</h1>

    <canvas id="cvs" width="500" height="250">[No canvas support]</canvas>
    
    <script>
        $(document).ready(function ()
        {
           // var data = [[4,5,3],[4,8,6],[4,2,4],[4,2,3],[1,2,3],[8,8,4],[4,8,6]];
		var data = <?php print $d;?>;
            var bar = new RGraph.Bar('cvs', data)
                .set('labels', ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])
                .set('labels.above', true)
                .set('colors', ['red','yellow', 'pink'])
                .set('bevel', !RGraph.ISOLD)
                .set('grouping', 'stacked')
                .set('strokestyle', 'rgba(0,0,0,0)')
                .draw();
        })
    </script>

    <p>
        <a href="./">&laquo; Back</a>
    </p>

</body>
</html>