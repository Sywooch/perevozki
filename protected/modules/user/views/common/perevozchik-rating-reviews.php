<?
function getElapsedTime($datetime) 
{
	$datetime1 = date_create($datetime);
	$datetime2 = date_create('now');
	$interval = date_diff($datetime1, $datetime2);

	$elapsed_time = array();
	$year = $interval->format('%y');
	$month = $interval->format('%m');
	$day = $interval->format('%D');

	if($year > 0)	{
		$elapsed_time[] = $year.' '.Yii::t('app', 'год|года|лет', $year);
	}

	if($month > 0)	{
		$elapsed_time[] = $month.' '.Yii::t('app', 'месяц|месяца|месяцев', $month);
	}

	if($day > 0)	{
		$elapsed_time[] = $day.' '.Yii::t('app', 'день|дня|дней', $day);
	}
	if(count($elapsed_time))	{
		$res = implode(' ', $elapsed_time);
	}	else	{
		$res = '';
	}
	return $res;
}
?>
		
<div class="my-rating-container">
	<div class="my-rating">
		Рейтинг
		<div class="my-rating-stars"><span class="my-rating-stars-empty"></span><span class="my-rating-stars-full" style="width:<?=$model->rating?>%;"></span></div>
	</div>
	<div class="my-rating-info clearfix">
		<? if($model->reliability != 0)	{	?>
			<div class="my-rating-info-block1">Уровень надёжности <span><?=$model->reliability?>%</span></div>
		<?	}	?>
		
		<? if($model->done_carriage != 0)	{	?>		
			<div class="my-rating-info-block2">Реализовано перевозок <span><?=$model->done_carriage?></span></div>
		<?	}	?>
	</div>
	<? /* <div class="my-rating-age"><span>2 года 4 месяца 13 дней</span> на сайте</div> */?>
	<div class="my-rating-age"><span><?=getElapsedTime($model->create_at)?></span> на сайте</div>
</div>


<div class="my-rewiews">
	<p class="my-rewiews-head">Отзывы заказчиков</p>
	<table class="my-rewiews-table">
		<tr>
			<td class="head">За месяц</td>
			<td class="head">За полгода</td>
			<td class="head">За все время</td>
		</tr>
		<tr>
			<td class="good">31</td>
			<td class="good">115</td>
			<td class="good">10 601</td>
		</tr>
		<tr>
			<td class="bad">2</td>
			<td class="bad">6</td>
			<td class="bad">40</td>
		</tr>
	</table>
</div>