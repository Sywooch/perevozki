<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_requests_gruzodatel',
	'ajaxUpdate'=>false,
	'template'=>"{items}",
	'itemsCssClass' => 'mb-10',
	'htmlOptions' => array('id'=>'ajax-list', 'class'=>'ajax-list'),
)); ?>