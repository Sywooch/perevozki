<?php 

$this->pageTitle = $this->app->user->username . ' - Личный кабинет перевозчика';

/*
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
*/
/*
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
*/

//echo $app->user->user_type;
?>

<h1>Личный кабинет перевозчика</h1>
<p class="my-username"><?php echo  $this->app->user->username; ?></p>

<? include(Yii::getPathOfAlias('application')."/views/common/_flash-messages.php"); ?>

<div class="my-menu">
	<ul class="my-menu-list clearfix">
		<li class="my-menu-item my-menu-item-zayavki">
			<a class="my-menu-url" href="<?=$this->createUrl('/user/my/requests')?>">Заявки</a>
			<span class="my-menu-descr">54 единиц</span>
		</li>
		<li class="my-menu-item my-menu-item-transport">
			<a class="my-menu-url" href="<?=$this->createUrl('/user/my/transport')?>">Транпорт</a>
			<span class="my-menu-descr"><?=$transport_count.' '. Yii::t('app', 'единица|единицы|единиц', $transport_count) ?></span>
		</li>
		<li class="my-menu-item my-menu-item-documents">
			<a class="my-menu-url" href="<?=$this->createUrl('/user/my/documents')?>">Мои документы</a>
			<span class="my-menu-descr"><?=$documents_count.' '. Yii::t('app', 'единица|единицы|единиц', $documents_count) ?></span>
		</li>
		<li class="my-menu-item my-menu-item-info">
			<a class="my-menu-url" href="<?=$this->createUrl('/user/my/info')?>">Информация о компании, контакты</a>
			<span class="my-menu-descr my-menu-descr-small">Тип компании, количество сотрудников, год основания и т.д.</span>
		</li>
		<li class="my-menu-item my-menu-item-profile">
			<a class="my-menu-url" href="<?=$this->createUrl('/user/my/edit')?>">Регистрационные данные</a>
			<span class="my-menu-descr my-menu-descr-small">Регистрационный email, пароль, регистрационный телефон.</span>
		</li>
	</ul>
</div>


<div class="my-page clearfix">
	<div class="content column2r">
		<p class="my-last-requests-title">Заявки в которых вы отписывались <span>(5 последних)</span> <a href="/my-last/">Смотреть все</a> </p>
		
		<ul class="requests1-list-head clearfix">
			<li class="requests1-list-head-item requests1-list-head-numb">№</li>
			<li class="requests1-list-head-item requests1-list-head-info">Информация о грузе</li>
			<li class="requests1-list-head-item requests1-list-head-date">Дата</li>
			<li class="requests1-list-head-item requests1-list-head-perevozchik">Перевозчик</li>
			<li class="requests1-list-head-item requests1-list-head-rating">Удовлетворенность перевозчика</li>
			<li class="requests1-list-head-item requests1-list-head-zakazchik">Заказчик</li>
			<li class="requests1-list-head-item requests1-list-head-review">Отзыв заказчика</li>
		</ul>
		
		<ul class="requests1-list-items">
			<li class="requests1-list-item clearfix">
				<div class="requests1-list-item-numb">9876544</div>
				<div class="requests1-list-item-info"><a href="/">Личные вещи, Коробки, Холодильник</a></div>
				<div class="requests1-list-item-date">11.06.2015</div>
				<div class="requests1-list-item-perevozchik"> <a href="/">Вася Man</a></div>
				<div class="requests1-list-item-rating"> <div class="rating-stars"><span class="stars-empty"></span><span class="stars-full" style="width:78%;"></span></div> </div>
				<div class="requests1-list-item-zakazchik"><a href="/">Иван Игнатенко</a></div>
				<div class="requests1-list-item-review requests1-list-item-review-good"><span>Невероятные умницы и молодцы...</span></div>
			</li>
			<li class="requests1-list-item clearfix">
				<div class="requests1-list-item-numb">9876544</div>
				<div class="requests1-list-item-info"><a href="/">Личные вещи, Коробки, Холодильник</a></div>
				<div class="requests1-list-item-date">11.06.2015</div>
				<div class="requests1-list-item-perevozchik"> <a href="/">Вася Man</a></div>
				<div class="requests1-list-item-rating"> <div class="rating-stars"><span class="stars-empty"></span><span class="stars-full" style="width:53%;"></span></div> </div>
				<div class="requests1-list-item-zakazchik"><a href="/">Иван Игнатенко</a></div>
				<div class="requests1-list-item-review  requests1-list-item-review-bad"><span>Невероятные умницы и молодцы...</span></div>
			</li>
			<li class="requests1-list-item clearfix">
				<div class="requests1-list-item-numb">9876544</div>
				<div class="requests1-list-item-info"><a href="/">Личные вещи, Коробки, Холодильник</a></div>
				<div class="requests1-list-item-date">11.06.2015</div>
				<div class="requests1-list-item-perevozchik"> <a href="/">Вася Man</a></div>
				<div class="requests1-list-item-rating"> <div class="rating-stars"><span class="stars-empty"></span><span class="stars-full" style="width:95%;"></span></div> </div>
				<div class="requests1-list-item-zakazchik"><a href="/">Иван Игнатенко</a></div>
				<div class="requests1-list-item-review requests1-list-item-review-good"><span>Невероятные умницы и молодцы молодцы...</span></div>
			</li>
		</ul>
		<a href="#" class="requests-more-btn">Показать еще</a>
	</div>
	
	<div class="sidebar sideRight">
		<? include (dirname(dirname(__FILE__))."/common/perevozchik-rating-reviews.php")?>
	</div>
</div>