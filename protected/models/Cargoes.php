<?php

/**
 * This is the model class for table "{{cargoes}}".
 *
 * The followings are the available columns in table '{{cargoes}}':
 * @property integer $cargo_id
 * @property string $name
 * @property string $comment
 * @property double $weight
 * @property integer $unit
 * @property string $foto
 * @property integer $porters
 * @property integer $lift_to_floor
 * @property integer $floor
 * @property double $length
 * @property double $width
 * @property double $height
 * @property double $volume
 *
 * The followings are the available model relations:
 * @property BidsCargoes[] $bidsCargoes
 * @property CargoesCategories[] $cargoesCategories
 */
class Cargoes extends CActiveRecord
{
	
	public $DropDownUnitsList;
	public $SelectedUnitsList;
	
	public $UnitsListArray = array(
		1 => array('id' => 1, 'name' => 'кг'),
		2 => array('id' => 2, 'name' => 'тонн'),
	);
	
	public $category1;
	public $name1;
	public $comment1;
	public $unit1;
	public $porters1;
	public $lift_to_floor1;
	public $floor1;
	public $weight1;
	public $length1;
	public $width1;
	public $height1;
	public $volume1;
	public $foto1;
	
	public $category2;
	public $name2;
	public $comment2;
	public $unit2;
	public $porters2;
	public $lift_to_floor2;
	public $floor2;
	public $weight2;
	public $length2;
	public $width2;
	public $height2;
	public $volume2;
	public $foto2;
	
	public $category3;
	public $name3;
	public $comment3;
	public $unit3;
	public $porters3;
	public $lift_to_floor3;
	public $floor3;
	public $weight3;
	public $length3;
	public $width3;
	public $height3;
	public $volume3;
	public $foto3;
	
	public $category4;
	public $name4;
	public $comment4;
	public $unit4;
	public $porters4;
	public $lift_to_floor4;
	public $floor4;
	public $weight4;
	public $length4;
	public $width4;
	public $height4;
	public $volume4;
	public $foto4;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cargoes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, comment, weight, unit, foto, porters, lift_to_floor, floor, length, width, height, volume', 'required'),
			array(
				'unit, porters, lift_to_floor, floor,
				 unit1, porters1, lift_to_floor1, floor1
				 unit2, porters2, lift_to_floor2, floor2
				 unit3, porters3, lift_to_floor3, floor3
				 unit4, porters4, lift_to_floor4, floor4', 
				'numerical', 'integerOnly'=>true
			),
			array(
				'weight, length, width, height, volume, 
				 weight1, length1, width1, height1, volume1, 
				 weight2, length2, width2, height2, volume2, 
				 weight3, length3, width3, height3, volume3, 
				 weight4, length4, width4, height4, volume4', 
				'numerical'
			),
			array(
				'name, foto, 
				 name1, foto1,
				 name2, foto2,
				 name3, foto3,
				 name4, foto4', 
				'length', 'max'=>255
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			/*
			array(
				'cargo_id, name, comment, weight, unit, foto, porters, lift_to_floor, floor, length, width, height, volume, 
				 cargo_id1, name1, comment1, weight1, unit1, foto1, porters1, lift_to_floo1r, floor1, length1, width1, heigh1t, volume1,
				 cargo_id2, name2, comment2, weight2, unit2, foto2, porters2, lift_to_floor2, floor2, length2, width2, height2, volume2,
				 cargo_id3, name3, comment3, weight3, unit3, foto3, porters3, lift_to_floor3, floor3, length3, width3, height3, volume3,
				 cargo_id4, name4, comment4, weight4, unit4, foto4, porters4, lift_to_floor4, floor4, length4, width4, height4, volume4', 
				'safe', 'on'=>'search'),
			*/
			array(
				'cargo_id, name, comment, weight, unit, foto, porters, lift_to_floor, floor, length, width, height, volume, 
				 cargo_id1, name1, comment1, weight1, unit1, foto1, porters1, lift_to_floo1r, floor1, length1, width1, heigh1t, volume1,
				 cargo_id2, name2, comment2, weight2, unit2, foto2, porters2, lift_to_floor2, floor2, length2, width2, height2, volume2,
				 cargo_id3, name3, comment3, weight3, unit3, foto3, porters3, lift_to_floor3, floor3, length3, width3, height3, volume3,
				 cargo_id4, name4, comment4, weight4, unit4, foto4, porters4, lift_to_floor4, floor4, length4, width4, height4, volume4', 
				'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bidsCargoes' => array(self::HAS_MANY, 'BidsCargoes', 'cargo_id'),
			'cargoesCategories' => array(self::HAS_MANY, 'CargoesCategories', 'cargo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cargo_id' => 'Cargo',
			'name' => 'Можете дополнить название груза',
			'comment' => 'Ваш комментарий к грузу',
			'weight' => 'Примерный вес',
			'unit' => ' ',
			'foto' => 'Загрузить фото ',
			'porters' => 'На погрузку выгрузку',
			'lift_to_floor' => 'Подъем на этаж',
			'floor' => 'Этаж',
			'length' => 'Примерные габариты',
			'width' => 'Width',
			'height' => 'Height',
			'volume' => 'Volume',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cargo_id',$this->cargo_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('porters',$this->porters);
		$criteria->compare('lift_to_floor',$this->lift_to_floor);
		$criteria->compare('floor',$this->floor);
		$criteria->compare('length',$this->length);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('volume',$this->volume);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cargoes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	function getDropDownUnitsList()
	{
		$result = CHtml::listData($this->UnitsListArray, 'id', 'name');
		return $result;
	}
	
}
