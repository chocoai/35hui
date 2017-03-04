<?php

class HelpController extends Controller
{
    public $layout='help';
    public $pageTitle = "帮助中心-新地标";
	public function actionIndex()
	{   
		$this->render('index');
	}
    public function actionConnect()
	{
		$this->render('connect');
	}
    public function actionContract()
	{
		$this->render('contract');
	}
    	public function actionQjdevice()
	{
		$this->render('qjdevice');
	}
    public function actionQjtakephoto()
	{
		$this->render('qjtakephoto');
	}
    public function actionScfake()
	{
		$this->render('scfake');
	}
    public function actionScoffice()
	{
		$this->render('scoffice');
	}
    public function actionScsol()
	{
		$this->render('scsol');
	}
    public function actionCharge(){
        $this->render('charge');
    }
    public function actionMoney(){
        $this->render('money');
    }
    public function actionKwdrecommend(){
        $this->render('kwdrecommend');
    }
    public function actionBuyregion(){
        $this->render('buyregion');
    }
}