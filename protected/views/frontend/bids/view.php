<?php
/* @var $this BidsController */
/* @var $model Bids */

$this->breadcrumbs=array(
	'Заявки на перевозку грузов'=>array('index'),
	$bid_name,
);

$NumberFormatter = $this->app->NumberFormatter;

//echo'<pre>';print_r($cargoes);echo'</pre>';
?>

<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap, 
            myPlacemark,
			place = "<?=$model->loading_town?>";

        function init(){ 
			//var geocoder = new YMaps.Geocoder(place, {results: 1, boundedBy: map.getBounds()});
			
            myMap = new ymaps.Map("map", {
                center: [52.42837651, 31.01077383],
                zoom: 12,
				controls: ["zoomControl", "fullscreenControl"]
            }); 
            /*
            myPlacemark = new ymaps.Placemark([52.42837651, 31.01077383], {
                hintContent: 'Гомель!',
                balloonContent: 'Гомель'
            });
			*/
            
            //myMap.geoObjects.add(myPlacemark);
			
			//ymaps.route(['Гомель, ул.Советская д. 4','Гомель, Кирова 14', 'Минск'],
			ymaps.route([<?=implode(',', $route_arr)?>],
						{mapStateAutoApply: true, // автоматически позиционировать карту  
						}).then(
				function (route) {
					myMap.geoObjects.add(route);
				},
				function (error) {
					alert('Возникла ошибка: ' + error.message);
				}
			);		
			
        }
		
		//http://javascript.ru/forum/server/29796-vyvod-znacheniya-v-peremennuyu-php-yandeks-karty-api.html
		
		//http://www.forum.mista.ru/topic.php?id=510781
		
    </script>

<h1><?php echo $bid_name; ?></h1>

<p class="bid-detail-number">Заявка №<?=$model->bid_id;?></p>


<div class="bid-detail-route-block">
	<ul class="clearfix">
		<li class="route-start ">
			<p class="route-town counry-by"><?=$model->loading_town?></p>
			<p class="route-address"><?=$model->loading_address?></p>			
		</li>
		<? if($model->add_loading_unloading_town_1 != '')	{	?>
			<li class="route-item">
				<div class="route-item-arrow"></div>
				<div class="route-item-wr">
					<p class="route-town counry-by"><?=$model->add_loading_unloading_town_1?></p>
					<p class="route-address"><?=$model->add_loading_unloading_address_1?></p>
				</div>
			</li>
		<?	}	?>
		<? if($model->add_loading_unloading_town_2 != '')	{	?>
			<li class="route-item">
				<div class="route-item-arrow"></div>
				<div class="route-item-wr">
					<p class="route-town counry-by"><?=$model->add_loading_unloading_town_2?></p>
					<p class="route-address"><?=$model->add_loading_unloading_address_2?></p>
				</div>
			</li>
		<?	}	?>
		<? if($model->add_loading_unloading_town_3 != '')	{	?>
			<li class="route-item">
				<div class="route-item-arrow"></div>
				<div class="route-item-wr">
					<p class="route-town counry-by"><?=$model->add_loading_unloading_town_3?></p>
					<p class="route-address"><?=$model->add_loading_unloading_address_3?></p>
				</div>
			</li>
		<?	}	?>
		
		<li class="route-item route-end ">
			<div class="route-item-arrow"></div>
			<div class="route-item-wr">
				<p class="route-town counry-by"><?=$model->unloading_town?></p>
				<p class="route-address"><?=$model->unloading_address?></p>
			</div>		
		</li>
		
	</ul>
</div>

<div class="row mb-40">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<div id="map" style="width: 100%; height: 350px"></div>
	</div>
	
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-3">
		<div class="bid-detail-date <? if( $model->quickly) echo 'bid-detail-date-quickly'?>">
			<?php echo $this->app->dateFormatter->format('dd.MM.yyyy', $model->created); ?>
			<?php if( $model->quickly)	{	?>
				<span class="bid-detail-date-quickly-val">Срочно</span>
			<?	}	?>
			
		</div>
		<div class="bid-detail-price">
			<span class="bid-detail-price-title">Заказчик предлагает:</span>
			<span class="bid-detail-price-wr">до <? echo $NumberFormatter->formatDecimal($model->price)?>р.</span>
		</div>
		
		<a href="#" id="bid-detail-respond-btn" class="btn-blue-66 bid-detail-respond-btn">Откликнуться</a>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-3 bid-detail-cargo-list">
		<ul>
		<? foreach($cargoes as $cargo)	{	?>
			<li class="bid-detail-cargo-listitem bid-detail-cargo-listitem-cat-<?=$model->category_id ?>">
				<div class="bid-detail-cargo-listitem-row">
					<p class="bid-detail-cargo-listitem-cargo-name"><?=$cargo['name']?></p>
					<?
					$info_arr = array();
					if($cargo['weight']) {
						$info_arr[] = "Вес: ".$cargo['weight'].$this->app->params['UnitsListArray'][$cargo['unit']]['name'];
					}
						
					if($cargo['volume']) {
						$info_arr[] = "объем: ".$cargo['volume']."м<sup>3</sup>";
					}
						
					?>
					<p><?=implode(' / ', $info_arr)?></p>
				</div>
				
				<?
				$unit_arr = array();
				$value_arr = array();
				if($cargo['length'] != 0)	{
					$unit_arr[] = 'Д';
					$value_arr[] = $cargo['length'];
				}

				if($cargo['width'] != 0)	{
					$unit_arr[] = 'Ш';
					$value_arr[] = $cargo['width'];
				}

				if($cargo['height'] != 0)	{
					$unit_arr[] = 'В';
					$value_arr[] = $cargo['height'];
				}

				?>
				<? if(count($value_arr))	{	?>
					<p class="bid-detail-cargo-listitem-row"><? echo implode('x', $unit_arr).': '.implode('x', $value_arr).'м'; ?></p>
				<?	}	?>
				
				<? if($cargo['porters'] == 1 || $cargo['lift_to_floor'] == 1 || $cargo['lift'] == 1 || $cargo['floor'] != 0 )	{	?>
					<?
						$value_arr = array();
						if($cargo['porters'] == 1) {
							$value_arr[] = 'Нужна погрузка/выгрузка';
						}																									 
						if($cargo['lift_to_floor'] == 1 && $cargo['floor'] != 0 ) {
							$value_arr[] = 'Нужен подъем на '.$cargo['floor'].'й этаж';
						} elseif($cargo['lift_to_floor'] == 1) {
							$value_arr[] = 'Нужен подъем на этаж';
						}																								 
						if($cargo['lift'] == 1) {
							$value_arr[] = 'Лифт есть';
						} else {
							$value_arr[] = 'Лифта нет';
						}																							 
					
					?>
					<p class="bid-detail-cargo-listitem-row bid-detail-cargo-listitem-porters"><? echo implode('<br>', $value_arr); ?></p>
				<?	}	?>
				
				<? if($cargo['comment'] != '')	{	?>
					<p class="bid-detail-cargo-listitem-comment"><?=$cargo['comment']?></p>
				<?	}	?>
				
			</li>
		<?	}	?>
		</ul>
	</div>
</div>

<div class="bid-detail-deals-block">
	<p class="narrow-regular-24 mb-20 bid-detail-deals-title">Предложения от перевозчиков</p>
	
	<div class="bid-detail-deals">
		<div class="bid-detail-deals-head clearfix width100">
			<p class="font-12 c_757575 bid-detail-deals-col1 fLeft"> </p>
			<p class="font-12 c_757575 bid-detail-deals-col2 fLeft">Ставка</p>
			<p class="font-12 c_757575 bid-detail-deals-col3 fLeft">Исполнитель</p>
			<p class="font-12 c_757575 bid-detail-deals-col4 fLeft">Услуги</p>
			<p class="font-12 c_757575 bid-detail-deals-col5 fLeft">Дата перевозки</p>
			<p class="font-12 c_757575 bid-detail-deals-col6 fLeft"> </p>
		</div>
		
		<div class="bid-detail-deals-row width100 mb-10 clearfix">
			<div class="bid-detail-deals-col1 fLeft pos-rel">
				<div class="ico-notice-blue bid-detail-notice-blue text_c">0</div>
				<span class="show-deals-comments hide-block">▼</span>
			</div>
			<div class="bid-detail-deals-col2 fLeft">
				<p class="font-17 bold mb-10">до 500 000 р.</p>
				<p class="font-12 c_8e95a1">Доб. 03.12.14 / 11:27 </p>
			</div>
			<div class="bid-detail-deals-col3 fLeft">
				<a href="#" class="profile-link bid-detail-deals-profile-link">Перевозчик Man</a>
				<div class="bid-detail-deals-rating-block mt-5">
					<div class="rating-stars dib"><span class="stars-empty"></span><span class="stars-full-blue" style="width:68%;"></span></div>
					<p class="rewiews-count font-12 c_8e95a1 dib">(52 отзыва)</p>
				</div>
			</div>
			<div class="bid-detail-deals-col4 fLeft">
				<p class="services font-13 bold">Перевозка + грузчик/и</p>
			</div>
			<div class="bid-detail-deals-col5 fLeft">
				<p class="deal-date font-13 bold mb-5">07.06.2015</p>
				<p class="deal-time font-13 c_8e95a1">21:00</p>
				
			</div>
			<div class="bid-detail-deals-col6 fLeft">
				<a href="#" class="btn-grey-33 accept-deal-btn">Принять</a>
				<a href="#" class="ico-close-blue reject-deal-btn">x</a>
			</div>
			
			<div class="bid-detail-deals-row-answer-block-reviews clear hide-block">
				<div class="bid-detail-deals-row-answer-block-reviews-wr">
					<div class="bid-detail-deals-row-answer-block-reviews-row clearfix">
						<div class="bid-detail-deals-row-answer-block-reviews-cell1 fLeft font-12 c_8e95a1">03.12.14 / 11:27</div>
						<div class="bid-detail-deals-row-answer-block-reviews-cell2 fLeft">
							<p class="font-12 mb-5"><a href="#" class="c_1e91da">Макс фургон</a> <span class="c_8e95a1">(перевозчик)</span></p>
							<p class="font-12">Приехал вовремя. Загрузили и разобрали шкафы-купе. Мастерски владеет фургоном в узких дворах! </p>
						</div>
					</div>
					<div class="bid-detail-deals-row-answer-block-reviews-row clearfix">
						<div class="bid-detail-deals-row-answer-block-reviews-cell1 fLeft font-12 c_8e95a1">03.12.14 / 11:27</div>
						<div class="bid-detail-deals-row-answer-block-reviews-cell2 fLeft">
							<p class="font-12 mb-5"><a href="#" class="c_1e91da">Макс фургон</a> <span class="c_8e95a1">(перевозчик)</span></p>
							<p class="font-12">Приехал вовремя. Загрузили и разобрали шкафы-купе. Мастерски владеет фургоном в узких дворах! </p>
						</div>
					</div>
				</div>
				
				<div class="bid-detail-deals-row-answer-block-comment clearfix">
					<textarea name="" id="" class="width100 mb-20" cols="30" rows="10"></textarea>
					<a href="#" class="btn-green-33 bid-detail-send-comment-btn fRight">Написать</a>
				</div>
			</div>
			
		</div>		
		<div class="bid-detail-deals-row width100 mb-10 clearfix">
			<div class="bid-detail-deals-col1 fLeft pos-rel">
				<div class="ico-notice-blue bid-detail-notice-blue text_c">0</div>
				<span class="show-deals-comments hide-block">▼</span>
			</div>
			<div class="bid-detail-deals-col2 fLeft">
				<p class="font-17 bold mb-10">до 500 000 р.</p>
				<p class="font-12 c_8e95a1">Доб. 03.12.14 / 11:27 </p>
			</div>
			<div class="bid-detail-deals-col3 fLeft">
				<a href="#" class="profile-link bid-detail-deals-profile-link">Перевозчик Man</a>
				<div class="bid-detail-deals-rating-block mt-5">
					<div class="rating-stars dib"><span class="stars-empty"></span><span class="stars-full-blue" style="width:68%;"></span></div>
					<p class="rewiews-count font-12 c_8e95a1 dib">(52 отзыва)</p>
				</div>
			</div>
			<div class="bid-detail-deals-col4 fLeft">
				<p class="services font-13 bold">Перевозка + грузчик/и</p>
			</div>
			<div class="bid-detail-deals-col5 fLeft">
				<p class="deal-date font-13 bold mb-5">07.06.2015</p>
				<p class="deal-time font-13 c_8e95a1">21:00</p>
				
			</div>
			<div class="bid-detail-deals-col6 fLeft">
				<a href="#" class="btn-grey-33 accept-deal-btn">Принять</a>
				<a href="#" class="ico-close-blue reject-deal-btn">x</a>
			</div>
			
			<div class="bid-detail-deals-row-answer-block-reviews clear hide-block">
				<div class="bid-detail-deals-row-answer-block-reviews-wr">
					<div class="bid-detail-deals-row-answer-block-reviews-row clearfix">
						<div class="bid-detail-deals-row-answer-block-reviews-cell1 fLeft font-12 c_8e95a1">03.12.14 / 11:27</div>
						<div class="bid-detail-deals-row-answer-block-reviews-cell2 fLeft">
							<p class="font-12 mb-5"><a href="#" class="c_1e91da">Макс фургон</a> <span class="c_8e95a1">(перевозчик)</span></p>
							<p class="font-12">Приехал вовремя. Загрузили и разобрали шкафы-купе. Мастерски владеет фургоном в узких дворах! </p>
						</div>
					</div>
					<div class="bid-detail-deals-row-answer-block-reviews-row clearfix">
						<div class="bid-detail-deals-row-answer-block-reviews-cell1 fLeft font-12 c_8e95a1">03.12.14 / 11:27</div>
						<div class="bid-detail-deals-row-answer-block-reviews-cell2 fLeft">
							<p class="font-12 mb-5"><a href="#" class="c_1e91da">Макс фургон</a> <span class="c_8e95a1">(перевозчик)</span></p>
							<p class="font-12">Приехал вовремя. Загрузили и разобрали шкафы-купе. Мастерски владеет фургоном в узких дворах! </p>
						</div>
					</div>
				</div>
				
				<div class="bid-detail-deals-row-answer-block-comment clearfix">
					<textarea name="" id="" class="width100 mb-20" cols="30" rows="10"></textarea>
					<a href="#" class="btn-green-33 bid-detail-send-comment-btn fRight">Написать</a>
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="add-new-deal-block">
		
		<p class="narrow-regular-24 bold">Добавление моего предложения</p>
		<div class="add-new-deal-form">
			<? $model = $deals; ?>
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'bids-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				//'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					//'validateOnSubmit'=>true,
				),

			)); ?>
			<div class="row">
				<div class="col-md-3 col-lg-3">
					<?php echo $form->labelEx($model,'price', array('class'=>'lbl-block')); ?>
					<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255, 'class'=>'width100')); ?>
					<?php echo $form->error($model,'price'); ?>
				</div>

				<div class="col-md-3 col-lg-3">
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<?php echo $form->labelEx($model,'deal_date', array('class'=>'lbl-block')); ?>
							<?php echo $form->textField($model,'deal_date',array('size'=>60,'maxlength'=>255, 'class'=>'width100')); ?>
							<?php echo $form->error($model,'deal_date'); ?>
						
						</div>
						
						<div class="col-md-6 col-lg-6">
							<?php echo $form->labelEx($model,'deal_time', array('class'=>'lbl-block')); ?>
							<?php echo $form->textField($model,'deal_time',array('size'=>60,'maxlength'=>255, 'class'=>'width100')); ?>
							<?php echo $form->error($model,'deal_time'); ?>
						
						</div>
					</div>
				</div>

			</div>
			
			<?php $this->endWidget(); ?>
		</div>
		
	</div>
	
</div>
