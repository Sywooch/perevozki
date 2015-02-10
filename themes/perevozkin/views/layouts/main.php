<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?

$theme_baseUrl = Yii::app()->theme->baseUrl;
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo $theme_baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $theme_baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo $theme_baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo $theme_baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $theme_baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="wrapper">
	<div class="wrapperPage">
		<div class="header">
			<div class="top-line">
				<div class="width-wrap">
					<div class="main-menu floatLeft">

						<?php $this->widget('zii.widgets.CMenu',array(
							'items'=>array(

								array('label'=>'Главная', 'url'=>array('/')),
								array('label'=>'тест', 'url'=>array('/pages/view', 'id'=> 1)),
								array('label'=>'Оплата и доставка', 'url'=>array('/site/oplataidostavka')),
								array('label'=>'Контакты', 'url'=>array('/site/contact')),
								//array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
								//array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
								
								array('label'=>'Отзывы', 'url'=>array('/site/feedback'), 'itemOptions'=>array('class'=>'last-item'),),
							),'htmlOptions' => array('class'=>'main-menu clearfix', 'id'=>'main-menu')
						)); ?>
					</div>
					<?php //$this->widget('application.components.MsiLogin'); ?>
					<?php //$this->widget('application.components.CartWidget'); ?>
				</div>
			</div>
			
			<div class="header-block width-wrap clearfix">
				<div class="block1 floatLeft">
					<a href="/" class="logo-top white-color uppercase font-size-13">
						<img src="/img/logo-top.png" alt="магазин автомобильных запчастей" />
						магазин автомобильных запчастей
					</a>
					<?php $this->widget('application.components.SearchWidget'); ?>
				</div>
				<div class="block2 floatRight">
					<?php //$this->widget('application.components.ContactsWidget'); ?>
					<?php //$this->widget('application.components.ConsultantWidget'); ?>					
				</div>
			
				<?php //$this->widget('application.components.CurrencyWidget'); ?>
			
			</div>
		</div>

		<div class="middle">
			<div class="width-wrap">
			
				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
				<?php endif?>
			
			
				<?php //$this->widget('application.components.SearchAutoWidget'); ?>
				<div class="central clearfix"><?php echo $content; ?></div>
				<div class="content-down">

				</div>
			</div>
		</div>
	</div>
	
	<div class="footer">
		<div class="width-wrap clearfix">

				<div class="contacts">
					<p class="footer-hdr">Контакты</p>
					<p class="email">E-mail: info@s-turbo.by</p>
					<p class="phones">Отдел продаж: <br>+375 29 530 22 99 <br>+375 44 530 22 99</p>
					<p class="adress">Мы находимся: <br>г. Минск, АвтоМолл "Кольцо", <br>2-ой этаж, 417 павильон</p>
					<p class="copyright">© <?php echo date('Y'); ?> <span class="site-name">S-TURBO.BY</span> Республика Беларусь</p>
				</div>
				
				<div class="ur-data">
					<p class="footer-hdr">Юридические данные</p>
					<p class="txt">220089 г. Минск ул. Гурского 37, офис 5Н, <br>комната 18/23</p>
					<p class="txt">
						р/с 3012162108013 в Региональной дирекции №700<br>
						ОАО «БПС-Сбербанк» 220035, г. Минск, пр-т Машерова, 80, код 369<br>
						УНП 192025656
					</p>
					<p class="txt">
						Директор Ксензов Евгений Олегович<br>
						Дата регистрации в торговом реестре - 07.08.2013г.	
					</p>
				</div>
				<div class="our-shop">
					<p class="footer-hdr uppercase">Наш магазин</p>
					<a href="#" class="view-map"><img src="/images/map.jpg" alt="Наш магазин" /></a>
				</div>

 		</div>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
