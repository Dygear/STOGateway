<?php

require_once('gateway-api.php');

$d = new STO\display();

$leaderboard = $d->compare($d->start, $d->to);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Valhalla's Halls Leaderboard - Jem' Hadar Attack Ship</title>
		<style type="text/css">
			html, body {
				background: #024;
			}
			table, thead, tbody, tfoot, tr, th, td {
				height: 23px;
				font-family: Helvetica, sans-serif;
				font-size: 9pt;
			}
			.SimFIA-Stats, .small, .large, .head {
				height: 23px;
				text-align: center;
				vertical-align: middle;
				font: bold 11px helvetica, sans-serif;
			}
			.small {
				width: 25px;
			}
			.large {
				width:175px;
			}
			.head {
				width:325px;
			}
			.black {
				background: #000000 linear-gradient(rgba(255,255,255,0.5), rgba(0,0,0,0), rgba(0,0,0,0), rgba(0,0,0,0), rgba(255,255,255,.5));
				text-shadow: 0 0 .1em #FFF;
			}
			.gray {
				background-color: #484058;
				text-shadow: 1px 1px .1em #000;
			}
			.red {
				background-color: #C01008;
			}
			.orange {
				background-color: #E09008;
			}
			.green {
				background-color: #088010;
			}
			.blue {
				background-color: #0810C0;
			}
			.yellow {
				background-color: #F0F830;
			}
			.white {
				background-color: #F0F0F0;
			}
			.gray, .red, .orange, .green, .blue, .yellow, .white {
				background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0), rgba(0,0,0,0), rgba(0,0,0,0), rgba(0,0,0,.5));
			}
			.black, .gray, .red, .orange, .green, .blue {
				color: #FFFFFF;
			}
			.red, .orange, .green, .blue, .yellow {
				text-shadow: .1em .1em .1em #000;
			}
			.yellow, .white {
				color: #000000;
			}

		</style>
	</head>
	<body>
		<table align="center">
			<thead>
				<tr class="head">
					<th class="gray" colspan="4">Valhalla's Halls Leaderboard - Jem' Hadar Attack Ship</th>
				</tr>
				<tr class="head">
					<th class="small gray">#</th>
					<th class="large gray">@Handle</th>
					<th class="large gray">Score</th>
					<th class="large gray">Delta</th>
				</tr>
			</thead>
			<tbody>
<?	foreach ($leaderboard as $handle => $score):	?>
				<tr>
					<th class="<?=(!isset($i)) ? 'red' : 'gray'?>"><?=$i = $i + 1?></th>
					<th class="white">@<?=$handle;?></th>
					<th class="gray"><?=number_format($score);?></th>
					<th class="black">
<?php
						if (!isset($last))
							$delta = 0;
						else
							$delta = $last - $score;
						
						echo number_format($delta);
						$last = $score;
?>
					</th> 
				</tr>
<?	endforeach;	?>
			</tbody>
		</table>
	</body>
</html>
