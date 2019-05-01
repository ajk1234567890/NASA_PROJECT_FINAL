<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

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

if($_POST['submit'] == 'submit')
{
	$s_date=$_POST['start_date'];
	$e_date=$_POST['end_date'];
	
	$ch= curl_init("https://api.nasa.gov/neo/rest/v1/feed?start_date=".date("Y-m-d",strtotime($s_date))."&end_date=".date("Y-m-d",strtotime($e_date))."&api_key=DEMO_KEY");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$var=curl_exec($ch);
	$var1=json_decode($var, true);
	$var2=$var1['near_earth_objects'];
	
	foreach($var2 as $key1=>$value1){
		$dates[]=$key1;
		if($key1===date('Y-m-d',strtotime($s_date))){
		foreach($value1 as $key2=>$value2)
		{
			foreach($value2['close_approach_data'] as $key3=>$value3){
				$fastest1[]=$value3['relative_velocity']['kilometers_per_hour'];
				$count_fastest=count($fastest);
				$closest1[]=$value3['miss_distance']['kilometers'];
				$count_closest=count($closest);
				$avgspeed1[]=$value3['relative_velocity']['kilometers_per_second'];
				$count_avgspeed=count($avgspeed);
			}	
		}
	}
		if($key1===date('Y-m-d',strtotime("+1 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest2[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest2[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed2[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
		if($key1===date('Y-m-d',strtotime("+2 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest3[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest3[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed3[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
		if($key1===date('Y-m-d',strtotime("+3 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest4[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest4[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed4[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
		if($key1===date('Y-m-d',strtotime("+4 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest5[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest5[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed5[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
		if($key1===date('Y-m-d',strtotime("+5 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest6[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest6[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed6[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
		if($key1===date('Y-m-d',strtotime("+6 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest7[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest7[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed7[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
		if($key1===date('Y-m-d',strtotime("+7 day",$s_date))){
			foreach($value1 as $key2=>$value2)
			{
				foreach($value2['close_approach_data'] as $key3=>$value3){
					$fastest8[]=$value3['relative_velocity']['kilometers_per_hour'];
					$count_fastest=count($fastest);
					$closest8[]=$value3['miss_distance']['kilometers'];
					$count_closest=count($closest);
					$avgspeed8[]=$value3['relative_velocity']['kilometers_per_second'];
					$count_avgspeed=count($avgspeed);
				}	
			}
		}
	}
	}
	$count=count($dates);
	$datesvalue=json_encode($dates);
	$closest_value=json_encode(array_slice($closest,0,$count_closest,true));
	$fastest_value=json_encode(array_slice($fastest,0,$count_fastest,true));
	$avgspeed_value=json_encode(array_slice($avgspeed,0,$count_avgspeed,true));
	print_r("closest value".$closest_value.'<br />');
	print_r("fastest value".$fastest_value.'<br />');
	print_r("avgspeed value".$avgspeed_value.'<br />');
	echo '<table><tr><td>Date</td><td>closest </td><td>fastest </td><td>Avg </td></tr>
	<tr><td>'.date('Y-m-d',strtotime($s_date)).'</td><td>'.$closest_value1.'</td><td>'.$fastest_value1.'</td><td>'.$avgspeed_value1.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+1 day",$s_date)).'</td><td>'.$closest_value2.'</td><td>'.$fastest_value2.'</td><td>'.$avgspeed_value2.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+2 day",$s_date)).'</td><td>'.$closest_value3.'</td><td>'.$fastest_value3.'</td><td>'.$avgspeed_value3.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+3 day",$s_date)).'</td><td>'.$closest_value4.'</td><td>'.$fastest_value4.'</td><td>'.$avgspeed_value4.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+4 day",$s_date)).'</td><td>'.$closest_value5.'</td><td>'.$fastest_value5.'</td><td>'.$avgspeed_value5.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+5 day",$s_date)).'</td><td>'.$closest_value6.'</td><td>'.$fastest_value6.'</td><td>'.$avgspeed_value6.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+6 day",$s_date)).'</td><td>'.$closest_value7.'</td><td>'.$fastest_value7.'</td><td>'.$avgspeed_value7.'</td></tr>
	<tr><td>'.date('Y-m-d',strtotime("+7 day",$s_date)).'</td><td>'.$closest_value8.'</td><td>'.$fastest_value8.'</td><td>'.$avgspeed_value8.'</td></tr>
	</table>';
	curl_close();	
}	
?>

<h4>Closest</h4>
<canvas id="myChart" width="400" height="400"></canvas>
<h4>Fastest</h4>
<canvas id="myChart1" width="400" height="400"></canvas>
<h4>Avg Speed</h4>
<canvas id="myChart2" width="400" height="400"></canvas>

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
	            data: <?php echo $avgspeed_value;?>,
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

 