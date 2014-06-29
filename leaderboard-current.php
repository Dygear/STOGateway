<?php

require_once('gateway-api.php');

$starbase 	= (new STO\leaderboard((new STO\gateway())->json->states[STO\leaderboard::STARBASE]))->getBoard();
$mine		= (new STO\leaderboard((new STO\gateway())->json->states[STO\leaderboard::MINE]))->getBoard();
$spire		= (new STO\leaderboard((new STO\gateway())->json->states[STO\leaderboard::SPIRE]))->getBoard();
$embassy	= (new STO\leaderboard((new STO\gateway())->json->states[STO\leaderboard::EMBASSY]))->getBoard();

$str = '';
foreach (array_merge($starbase, $mine, $spire, $embassy) as $line)
	$str .= $line->displayname . '	' . $line->contribution . PHP_EOL;

$leaderboard = [];
foreach ((new STO\display)->parse($str) as $line)
{
	list($toon, $handle, $score) = $line;
	if ($handle == '')
		continue;
	if (!isset($leaderboard[$handle]))
		$leaderboard[$handle] = 0;
	$leaderboard[$handle] += $score;
}

arsort($leaderboard);

$Total = array_sum($leaderboard);

?>
<!DOCTYPE html>
<base href="http://gateway.startrekonline.com/" />
<style type="text/css">
@font-face {
    font-family: 'Eurostile';
    src: url('/fonts/eurostileltstd-webfont.eot');
    src: url('/fonts/eurostileltstd-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/eurostileltstd-webfont.woff') format('woff'),
         url('/fonts/eurostileltstd-webfont.ttf') format('truetype'),
         url('/fonts/eurostileltstd-webfont.svg#EurostileLTStdRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'EurostileOblique';
    src: url('/fonts/eurostileltstd-oblique-webfont.eot');
    src: url('/fonts/eurostileltstd-oblique-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/eurostileltstd-oblique-webfont.woff') format('woff'),
         url('/fonts/eurostileltstd-oblique-webfont.ttf') format('truetype'),
         url('/fonts/eurostileltstd-oblique-webfont.svg#EurostileLTStdItalic') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'EurostileDemi';
    src: url('/fonts/eurostileltstd-demi-webfont.eot');
    src: url('/fonts/eurostileltstd-demi-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/eurostileltstd-demi-webfont.woff') format('woff'),
         url('/fonts/eurostileltstd-demi-webfont.ttf') format('truetype'),
         url('/fonts/eurostileltstd-demi-webfont.svg#EurostileLTStdBold') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'EurostileDemiOblique';
    src: url('/fonts/eurostileltstd-demioblique-webfont.eot');
    src: url('/fonts/eurostileltstd-demioblique-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/eurostileltstd-demioblique-webfont.woff') format('woff'),
         url('/fonts/eurostileltstd-demioblique-webfont.ttf') format('truetype'),
         url('/fonts/eurostileltstd-demioblique-webfont.svg#EurostileLTStdBoldItalic') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'EurostileExt';
    src: url('/fonts/eurostileltstd-ex2-webfont.eot');
    src: url('/fonts/eurostileltstd-ex2-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/eurostileltstd-ex2-webfont.woff') format('woff'),
         url('/fonts/eurostileltstd-ex2-webfont.ttf') format('truetype'),
         url('/fonts/eurostileltstd-ex2-webfont.svg#EurostileLTStdExtTwoRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'EurostileExtBold';
    src: url('/fonts/eurostileltstd-boldex2-webfont.eot');
    src: url('/fonts/eurostileltstd-boldex2-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/eurostileltstd-boldex2-webfont.woff') format('woff'),
         url('/fonts/eurostileltstd-boldex2-webfont.ttf') format('truetype'),
         url('/fonts/eurostileltstd-boldex2-webfont.svg#EurostileLTStdExtTwoBold') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'FuturaCondensed';
    src: url('/fonts/futurastd-condensed-webfont.eot');
    src: url('/fonts/futurastd-condensed-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/futurastd-condensed-webfont.woff') format('woff'),
         url('/fonts/futurastd-condensed-webfont.ttf') format('truetype'),
         url('/fonts/futurastd-condensed-webfont.svg#FuturaStdCondensedRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}

html, body {
	font-family: "Eurostile",Verdana,Geneva,sans-serif;
	font-size: 13px;
	background: #000;
	color: #fff;
	line-height: normal;
}
table {
	border-spacing: 2px;
	border-color: gray;
	font-size: 11px;
}
th {
	text-align: center;
}
td:nth-child(n-3) {
	text-align: right;
}
th:hover {
	cursor: pointer;
	background: #243341;
	border: 1px solid #9cbbce;
}
th:active {
	background: #000;
	border: 1px solid #9cbbce;
}
th {
	font-family: "EurostileDemi";
	font-weight: normal;
	color: #c6ddeb;
	text-align: left;
	background: #0a0d10;
	border: 1px solid #3d4f61;
	padding: 6px 18px 6px 5px;
}
th, td {
	font-size: 11px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
	height: 20px;
	padding: 3px 6px;
}
tr td {
	border: 1px solid #3d4f61;
	background-color: #3d4f61;
}
tr td:hover {
	border: 1px solid #9cbbce;
	background-color: #9cbbce;
}
tr td:nth-child(4n+1) {
	border: 1px solid #720000;
	background-color: #720000;
}
tr td:nth-child(4n+1):hover {
	border: 1px solid #fa3f3f;
	background-color: #fa3f3f;
}
tr td:nth-child(4n+2) {
	border: 1px solid #816308;
	background-color: #816308;
}
tr td:nth-child(4n+2):hover {
	border: 1px solid #d9a815;
	background-color: #d9a815;
}
tr td:nth-child(4n+3) {
	border: 1px solid #097F62;
	background-color: #097F62;
}
tr td:nth-child(4n+3):hover {
	border: 1px solid #30F4BF;
	background-color: #30F4BF;
}
table tr td {
	background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,1), rgba(0,0,0,1));
	text-shadow:
	   -1px -1px 0 #000,  
	    1px -1px 0 #000,
	    -1px 1px 0 #000,
	     1px 1px 0 #000;
}
</style>
<table align="center">
	<thead>
		<tr>
			<th colspan="4">Valhalla's Hall's Fleet Holding Leaderboard</th>
		</tr>
		<tr>
			<th>#</th>
			<th>Display Name</th>
			<th>Contribution</th>
			<th>% of Table</th>
		</tr>
	</thead>
	<tbody>
<?	foreach($leaderboard as $Handle => $Score):	?>
		<tr>
			<td><?=++$i?></td>
			<td><?=$Handle?></td>
			<td><?=number_format($Score)?></td>
			<td><?=number_format(($Score / $Total) * 100, 2)?></td>
		</tr>
<?	endforeach;	?>
		<tr>
			<th colspan="2">Total:</th>
			<td><?=number_format($Total)?></td>
			<td>100%</td>
		</tr>
	</tbody>
</table>
