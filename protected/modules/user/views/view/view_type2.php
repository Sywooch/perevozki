<?php
$this->breadcrumbs=array(
	$model->username,
);

$this->layout='//layouts/column2';

//echo'<pre>';print_r(dirname(dirname(__FILE__)));echo'</pre>';

$transport_imageLive = $this->app->homeUrl.'files/users/'.$this->app->user->id.'/transport/';

$counter = 1;

$this->app->getClientScript()->registerCoreScript('flexcroll');


?>
<h1><?php echo $model->username ?></h1>
<p class="bid-detail-number narrow-bold-23">Профиль перевозчика</p>

<div class="clearfix">
	<div class="content column2r">
		<? include (dirname(dirname(__FILE__))."/common/perevozchik-contact-info-container.php")?>


	</div>

	<div class="sidebar sideRight">
		<? include (dirname(dirname(__FILE__))."/common/perevozchik-rating-reviews.php")?>

	</div>
</div>

<div class="transport-list-wr blue-border-1 mt-40">
	<div class="p-20 bg_f4fbfe">
		<p class="narrow-bold-23">
			Транспорт перевозчика
			<span class="narrow-regular-18 c_71a72c pl-10">(<? echo count($dataProvider->data).' '.Yii::t('app', 'единица|единицы|единиц', count($dataProvider->data))?>)</span>
		</p>

	</div>


	<ul class="transport-list clearfix">
		<? foreach($dataProvider->data as $row) { ?>

		<?
		$unit_arr = array();
		$value_arr = array();
		if($row->length != '')	{
			$unit_arr[] = 'Д';
			$value_arr[] = $row->length;
		}

		if($row->width != 0)	{
			$unit_arr[] = 'Ш';
			$value_arr[] = $row->width;
		}

		if($row->height != 0)	{
			$unit_arr[] = 'В';
			$value_arr[] = $row->height;
		}

		//$transport_image = $row->foto ? $this->app->params->transport_imageLive.'thumb_'.$row->foto : '/images/transport-no-foto.jpg';
		$transport_image = $row->foto ? $transport_imageLive.'thumb_'.$row->foto : '/images/transport-no-foto.jpg';

		?>

			<li class="pofile-transport-list-item fLeft <? if($counter == 4) { echo 'clear'; $counter = 1; } ?>">

				<? include (dirname(dirname(__FILE__))."/common/transport-list-item.php")?>

				<div class="my-transport-edit">
					<div class="my-transport-edit-top">
						<a href="<?=$this->createUrl('/user/my/transportupdate', array('id'=>$row->transport_id))?>" class="my-transport-edit-btn btn-blue1">Редактировать</a>
						<a href="<?=$this->createUrl('/user/my/transportdelete', array('id'=>$row->transport_id))?>" class="my-transport-delete-btn btn-red" onclick="if(!confirm('Действительно удалить?')) return false;">Удалить х</a>
					</div>
					<? /*<a href="#" class="my-transport-upload-btn btn-blue1">Загрузить фото</a> */ ?>
				</div>
			</li>
			<? $counter++ ?>
		<? } ?>

	</ul>
</div>
<?/*

	<div id='mycustomscroll2' class='flexcroll'>
		<div class='fixedwidth'>
		  <p>Top - Fixed width and height sample with both scrollbars</p>
		  <div class='lipsum'>
			<p> <a href="http://www.hesido.com/">Lorem ipsum</a> dolor sit amet, consectetuer adipiscing elit. Pellentesque ultrices facilisis risus. Aenean sollicitudin imperdiet justo. Nam sed nulla sed metus blandit pretium. Morbi odio. Maecenas vestibulum dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam in elit. Nam venenatis urna id diam. Quisque porta. Sed ultricies, sem vel gravida mollis, pede lectus vehicula orci, quis sodales mauris velit vitae dui. Sed tincidunt mauris ut libero. Suspendisse potenti. Praesent adipiscing. Sed sem. Ut non justo. Cras pretium nibh scelerisque nibh hendrerit venenatis. </p>
			<p> Nullam lobortis, dui nec accumsan molestie, ligula libero porta urna, in tincidunt ante lacus ac diam. Vestibulum erat risus, scelerisque non, mattis sit amet, aliquet convallis, enim. Sed mattis. Phasellus tristique. Nullam metus ipsum, sagittis at, tempor non, consectetuer eget, massa. Curabitur metus lacus, fringilla ac, interdum condimentum, hendrerit non, est. Morbi iaculis. Aenean lacus lectus, lacinia eget, hendrerit id, imperdiet ac, nisl. Praesent metus. Morbi mi elit, lacinia fringilla, luctus ut, tempor at, diam. Nulla arcu nibh, condimentum fringilla, nonummy et, volutpat eget, orci. Suspendisse et dui. Integer eget lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Suspendisse vitae odio. Sed risus nisl, mattis vitae, imperdiet et, semper nec, tellus. Quisque adipiscing, neque id faucibus fringilla, eros augue ultricies orci, quis tincidunt tortor elit gravida ligula. Suspendisse suscipit sem sit amet ipsum. Etiam elit. </p>
			<p> Aenean ullamcorper leo a neque. Ut eros risus, ornare sed, luctus sit amet, mollis ut, nisl. Proin dui. Aliquam suscipit. Vestibulum nisl wisi, eleifend at, placerat et, lobortis vitae, dui. Nulla dapibus pretium nulla. In hac habitasse platea dictumst. Cras ultricies nisl eu est. Aliquam ultrices, orci in dapibus facilisis, tortor pede bibendum neque, eget vestibulum lectus wisi vitae orci. Phasellus quis metus. In turpis diam, varius in, pulvinar sit amet, commodo ut, wisi. Donec leo nibh, iaculis in, facilisis non, mollis eget, eros. Morbi sem. </p>
			<p> Nunc sed arcu. Phasellus euismod tincidunt eros. Proin ac purus. In dictum ante vitae libero. Proin pede. Pellentesque tellus ipsum, semper quis, dapibus eget, ultricies ac, pede. Aenean tristique tincidunt lorem. Aenean eget eros quis tellus tincidunt condimentum. Aliquam tempor, erat sit amet condimentum sagittis, ante sapien dapibus lectus, in tempor mauris sem non metus. Nam id orci. Nulla dignissim, felis in euismod tempor, neque turpis suscipit urna, id tristique mauris eros et dui. </p>
			<p> Aliquam eget felis id elit congue tempus. Maecenas a velit. Sed egestas malesuada sapien. In sapien. Integer sit amet massa vitae justo vulputate viverra. Fusce suscipit, mi a lacinia lobortis, urna enim consectetuer risus, et ultrices ante nulla nec mauris. Integer pulvinar aliquet turpis. Phasellus fermentum diam at mauris. Ut nulla est, rhoncus sed, malesuada eget, rutrum ac, nunc. Curabitur in ante. </p>
			<p> Aenean ullamcorper leo a neque. Ut eros risus, ornare sed, luctus sit amet, mollis ut, nisl. Proin dui. Aliquam suscipit. Vestibulum nisl wisi, eleifend at, placerat et, lobortis vitae, dui. Nulla dapibus pretium nulla. In hac habitasse platea dictumst. Cras ultricies nisl eu est. Aliquam ultrices, orci in dapibus facilisis, tortor pede bibendum neque, eget vestibulum lectus wisi vitae orci. Phasellus quis metus. In turpis diam, varius in, pulvinar sit amet, commodo ut, wisi. Donec leo nibh, iaculis in, facilisis non, mollis eget, eros. Morbi sem. </p>
			<p> Nunc sed arcu. Phasellus euismod tincidunt eros. Proin ac purus. In dictum ante vitae libero. Proin pede. Pellentesque tellus ipsum, semper quis, dapibus eget, ultricies ac, pede. Aenean tristique tincidunt lorem. Aenean eget eros quis tellus tincidunt condimentum. Aliquam tempor, erat sit amet condimentum sagittis, ante sapien dapibus lectus, in tempor mauris sem non metus. Nam id orci. Nulla dignissim, felis in euismod tempor, neque turpis suscipit urna, id tristique mauris eros et dui. </p>
			<p> Aliquam eget felis id elit congue tempus. Maecenas a velit. Sed egestas malesuada sapien. In sapien. Integer sit amet massa vitae justo vulputate viverra. Fusce suscipit, mi a lacinia lobortis, urna enim consectetuer risus, et ultrices ante nulla nec mauris. Integer pulvinar aliquet turpis. Phasellus fermentum diam at mauris. Ut nulla est, rhoncus sed, malesuada eget, rutrum ac, nunc. Curabitur in ante. </p>
		  </div>
		  <p>Bottom</p>
		</div>
	</div>
*/?>