<?
/*
	function hasCookie($name)
	{
		return !empty(Yii::app()->request->cookies[$name]->value);
	}

	function getCookie($name)
	{
		return Yii::app()->request->cookies[$name]->value;
	}

	
	function setCookie($name, $value)
	{
		$cookie = new CHttpCookie($name,$value);
		Yii::app()->request->cookies[$name] = $cookie;
	}
	

	function removeCookie($name)
	{
		unset(Yii::app()->request->cookies[$name]);
	}	
*/

function isQuickly($date)
{
    $datetime1 = new DateTime($date);
    $datetime2 = new DateTime(date('Y-m-d'));
    $interval = $datetime2->diff($datetime1);
	//echo'<pre>';print_r($interval);echo'</pre>';
	if($interval->days <= 2 || $interval->invert == 1)	{
		$res = true;
	}	else	{
		$res = false;
	}
	return $res;
}

?>