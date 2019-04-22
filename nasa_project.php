
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<style type="text/css">

.container {
    width: 50%;
    margin: 15px auto;
}

</style>

<?php

echo "
<form action='".$_SERVER['PHP_SELF']."' method='post'>
START DATE:
<input type='date' name='start_date'>

END DATE:
<input type='date' name='end_date'>

<input type='submit' value='submit' name='submit'> 
</form>
";

if($_POST['submit']=='submit'){
$s_date=$_POST['start_date'];
$e_date=$_POST['end_date'];

$dates=array();
$closest=array();
$fastest=array();
$avgSpeed=array();

$ch= curl_init("https://api.nasa.gov/neo/rest/v1/feed?start_date=".date("Y-m-d",strtotime($s_date))."&end_date=".date("Y-m-d",strtotime($e_date))."&api_key=DEMO_KEY");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$var=curl_exec($ch);
$var1=json_decode($var,true);
$var2=$var1['near_earth_objects'];
foreach($var2 as $key1=>$value1){
$dates[]=$key1;
foreach($value1 as $key2=>$value2){
foreach($value2['close_approach_data'] as $key3=>$value3){
$fastest[]=$value3['relative_velocity']['kilometers_per_hour'];
$closest[]=$value3['miss_distance']['kilometers'];
}
$avgSpeed[]=$value2['estimated_diameter']['kilometers']['estimated_diameter_max'];
}
}
$count=count($dates);
$datesvalue=json_encode($dates);
$closest_value=json_encode(array_slice($closest,0,$count,true));
$fastest_value=json_encode(array_slice($fastest,0,$count,true));
$avgSpeed_value=json_encode(array_slice($avgSpeed,0,$count,true));
print_r("Closest: ".$closest_value.'<br/>');
print_r("Fastest: ".$fastest_value.'<br/>');
print_r("Avg Speed: ".$avgSpeed_value.'<br/>');
curl_close();
}


?>
<div class="container">
<h4>Closest</h4>
<canvas id="myChart" width="100" height="100"></canvas>
<h4>Fastest</h4>
<canvas id="myChart1" width="100" height="100"></canvas>
<h4>Avg Speed</h4>
<canvas id="myChart2" width="100" height="100"></canvas>
</div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $datesvalue;?>,
        datasets: [{
            label: 'Closest Astroid',
            data: <?php echo $closest_value;?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
var ctx1 = document.getElementById('myChart1').getContext('2d');
var myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: <?php echo $datesvalue;?>,
        datasets: [{
            label: 'Fastest Astroid',
            data: <?php echo $fastest_value;?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
var ctx2 = document.getElementById('myChart2').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo $datesvalue;?>,
        datasets: [{
            label: 'Avg Speeds Astroid',
            data: <?php echo $avgSpeed_value;?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
