<?php
class SiteController extends Controller
{
	
	public $current_controller = '';
	public $current_action = '';
	public $theme_baseUrl = '';
	public $request_baseUrl = '';
	public $app = null;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout = '//layouts/column2r';
		$this->render('index');
	}
	
	public function actionPerevezu()
	{
		$this->render('perevezy');
	}
	
	public function actionZakazhu()
	{
		$this->render('zakazhu');
	}
	
	public function actionEmptypage()
	{
		$this->render('empty-page');
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		//echo'<pre>';print_r(Yii::app()->dpsMailer);echo'</pre>';die;
		/*
		Yii::app()->dpsMailer->sendByView(
			//array( 'aldegtyarev@yandex.ru' => 'получатель' ), // определяем кому отправляется письмо
			array( 'aldegtyarev@yandex.ru'), // определяем кому отправляется письмо
			'emailTpl', // view шаблона письма
			array(
				'sUsername' => 'Участник',
				//'sLogoPicPath' => '/path/to/logo.gif',
				//'sFilePath' => '/path/to/attachment.txt',
			)
		);
		*/
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		
 		
		
		$this->render('contact',array('model'=>$model));
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionGetrandomreviews()
	{
		$rows = ReviewsPerformers::model()->getRandomReviews(Yii::app()->db);
		$this->renderPartial('reviews_list',array('rows'=>$rows));
	}
	
	//аякс запрос на добавление отзыва
	public function actionAddnewreview()
	{
		$this->app = Yii::app();
		
		$u_id = $this->app->request->getParam('u-id', '');
		
		if($u_id == $this->app->user->id)	{
			$review_text = $this->app->request->getParam('review-text', '');
			$rating_value = $this->app->request->getParam('rating-value', '');
			$bid_id = $this->app->request->getParam('bid-id', 0);
			$field = $this->app->request->getParam('fld', '');

			$form = new ReviewForm;
			$form->rating = $rating_value;
			$form->comment = strip_tags($review_text);			
			if($form->validate())	{
				$review = $field.'_review';
				$rating = $field.'_rating';
				$model = Bids::model()->findByPk($bid_id);
				if($model->$rating == 0 && $model->$review == '')	{
					$model->$rating = $form->rating;
					$model->$review = $form->comment;
					$model->save(false);
					
					if($field == 'user')	{
						$user_id = 'performer_id';
					}	else	{
						$user_id = 'user_id';
					}
					
					$user_model = User::model()->findByPk($model->$user_id);
					if($user_model != null)	{
						
						if($user_model->rating == 0 )	{
							$user_model->rating = $form->rating;
						}	else	{
							$user_model->rating = ($user_model->rating + $form->rating) / 2;
						}
						
						$user_model->save(false);
						
					}
					
					$this->app->user->setFlash('success', 'Ваш отзыв успешно размещён.');
					echo 'ok';
				}	else	{
					echo 'Ошибка';
				}

			}	else	{
				$err = array();
				foreach($form->errors as $msg)	{
					$err[] = $msg[0];
				}
				echo implode(' ', $err);
			}
		}	else	{
			throw new CHttpException(500, 'Ошибка доступа');
		}
	}
	
	
}