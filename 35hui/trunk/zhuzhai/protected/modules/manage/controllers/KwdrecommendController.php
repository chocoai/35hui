<?php

class KwdrecommendController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index',"validatecanbuy","choosesource","setsource","viewsource","historylist"),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $config = Oprationconfig::model()->getConfigByName("keyword_recommend_money");
        $onDayMoney = $config[0];
        
        $this->create($onDayMoney);
		$allKwdRecommend = Kwdrecommend::model()->findAllByAttributes(array(
            "kwr_userid"=>Yii::app()->user->id,
        ));
		$this->render('index',array(
			'allKwdRecommend'=>$allKwdRecommend,
            "onDayMoney" => $onDayMoney,
		));
	}
    public function create($onDayMoney)
	{
        if(isset($_POST["buildtype"])){
            $userId = Yii::app()->user->id;
            $buildtype = @$_POST["buildtype"];
            $sellorrent = @$_POST["sellorrent"];
            $selectString =@$_POST["selectString"];
            $kwords = @$_POST["kwords"];
            $buytime = @$_POST["buytime"];
            $selectArray = explode(",", $selectString);

            if(count($selectArray)!=2){
                Yii::app()->user->setFlash('message','您输入的信息有误，购买失败！');
                $this->redirect('index');
            }
        
            $model=new Kwdrecommend;
            $model->kwr_buildtype = $buildtype;
            $model->kwr_sellorrent = $sellorrent;
            $model->kwr_buildid = $selectArray[1];
            $model->kwr_name = $kwords;
            $model->kwr_buytime = time();
            $model->kwr_expiredtime = strtotime(date("Y-m-d"))+86400*($buytime+1);
            $model->kwr_userid = $userId;

            $nowNum = Kwdrecommend::model()->getAlreadyBuyNum($buildtype, $selectArray[1], $sellorrent);
            if($nowNum>=Kwdrecommend::$oneKwdCanByuNum){//达到上限，不可以继续购买
                Yii::app()->user->setFlash('message','很遗憾，此关键词已经达到多能购买的最大值，不能继续购买！');
                $this->redirect('index');
            }
            if(!$model->validate()){//数据可以保存
                Yii::app()->user->setFlash('message','您输入的信息有误，购买失败！');
                $this->redirect('index');
            }
            //检验新币是否足够
            if(Userproperty::model()->deductMoney($userId, $onDayMoney*$buytime, '购买关键词"'.$kwords.'"成功，扣除{:money}新币')){
                $model->save();
                //保存历史记录。由于主表内容是会被脚本删除的。所有有历史表
                $historyModel=new Kwdrecommendhistory;
                $historyModel->kwrh_id = $model->kwr_id;
                $historyModel->kwrh_buildtype = $model->kwr_buildtype;
                $historyModel->kwrh_name = $model->kwr_name;
                $historyModel->kwrh_sellorrent = $model->kwr_sellorrent;
                $historyModel->kwrh_userid = $model->kwr_userid;
                $historyModel->kwrh_buytime = $model->kwr_buytime;
                $historyModel->kwrh_expiredtime = $model->kwr_expiredtime;
                $historyModel->save();
                
                Yii::app()->user->setFlash('message','恭喜您，购买成功！');
                $this->redirect('index');
            }else{
                Yii::app()->user->setFlash('message','很遗憾，您的新币不够，购买失败！');
                $this->redirect('index');
            }
        }
	}
    public function actionValidateCanBuy(){
        $buildtype = $_POST["buildtype"];
        $sellorrent = $_POST["sellorrent"];
        $selectString = $_POST["selectString"];
        $selectArray = explode(",", $selectString);
        if(count($selectArray)!=2){
            echo "error";
            exit;
        }
        $nowNum = Kwdrecommend::model()->getAlreadyBuyNum($buildtype, $selectArray[1], $sellorrent);
        if($nowNum<Kwdrecommend::$oneKwdCanByuNum){//可以继续购买
            echo $nowNum;
        }else{//达到上限，不能继续购买
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array(
                "kwr_buildtype"=>$buildtype,
                "kwr_buildid"=>$selectArray[1],
                "kwr_sellorrent"=>$sellorrent,
            ));
            $criteria->order = "kwr_expiredtime";
            $model = Kwdrecommend::model()->find($criteria);
            echo "error_".date("m-d H:s", $model->kwr_expiredtime);
        }
        exit;
    }
    public function actionChooseSource(){
        $this->layout = "frame";
        $userId = Yii::app()->user->id;
        $model = $this->loadModel();
        //判断只能是自己购买的位置才能操作
        if($model->kwr_userid!=$userId){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $positiontype = $model->kwr_buildtype;//位置类型

        //得到用户发布的所有房源
        $show = array();
        if($positiontype==1){//写字楼
            $type = "office";
            $criteria=new CDbCriteria();
            $criteria->with = array("offictag","presentInfo");
            $criteria->addColumnCondition(array(
                "ob_uid"=>$userId,
                "ot_check"=>4,
            ));
            if(isset($_POST['name'])&&$_POST['name']!="") {
                $criteria->addSearchCondition("ob_officename",$_POST['name']);
                $show['name'] = $_POST['name'];
            }
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("op_officetitle",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Officebaseinfo";
        }else if($positiontype==2){//商铺
            $type = "shop";
            $criteria=new CDbCriteria();
            $criteria->with = array("shopTag","presentInfo");
            $criteria->addColumnCondition(array(
                "sb_uid"=>$userId,
                "st_check"=>4,
            ));
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("sp_shoptitle",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Shopbaseinfo";
        }else if($positiontype==3){//住宅
            $type = "residence";
            $criteria=new CDbCriteria();
            $criteria->with = array("residenceTag","community");
            $criteria->addColumnCondition(array(
                "rbi_uid"=>$userId,
                "rt_check"=>4,
            ));
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("rbi_title",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Residencebaseinfo";
        }else{
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $dataProvider=new CActiveDataProvider($className, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('choosesource',array(
            'dataProvider'=>$dataProvider,
            'type'=>$type,
            "show"=>$show,
            'id'=>$_GET['id'],
        ));
    }
	public function actionSetSource()
	{
		$model = $this->loadModel();
        $sourceid =$_GET['sourceid'];//要显示的资源id
        $userId = Yii::app()->user->id;
        //先判断格子是否属于当前用户。
        if($model->kwr_userid!=$userId){
            echo "禁止操作！";
            exit;
        }
        //查看房源是否被重复设置
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array(
            "kwr_buildtype"=>$model->kwr_buildtype,
            "kwr_buildid"=>$model->kwr_buildid,
            "kwr_sellorrent"=>$model->kwr_sellorrent,
            "kwr_sourceid"=>$sourceid,
        ));
        $count = Kwdrecommend::model()->count($criteria);
        if($count>0){
            echo "当前关键词已经设置本房源，不能重复设置！";
            exit;
        }
        $model->kwr_sourceid = $sourceid;
        $model->update();
        echo "success";
        exit;
	}
    public function actionViewSource() {
        $model = $this->loadModel();
        $sourceid = $model->kwr_sourceid;
        switch ($model->kwr_buildtype){
            default:
                break;
            case 1: //写字楼
                $officeModel = Officebaseinfo::model()->findByPk($sourceid);
                $url = $officeModel->ob_sellorrent == 1?"officebaseinfo/rentView":"officebaseinfo/saleView";
                $this->Redirect(array($url,"id"=>$sourceid));
                break;
            case 2: //商铺
                $this->Redirect(array("shop/view","id"=>$sourceid));
                break;
            case 3: //住宅
                $this->Redirect(array("communitybaseinfo/viewResidence","id"=>$sourceid));
                break;
        }
    }
    public function actionHistoryList(){
        $userId = Yii::app()->user->id;
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array(
                "kwrh_userid"=>$userId,
            ));
        $criteria->order = "kwrh_buytime desc";
        $dataProvider=new CActiveDataProvider("Kwdrecommendhistory", array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>30,
            ),
        ));
        $this->render('historylist',array(
            'dataProvider'=>$dataProvider,
        ));
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Kwdrecommend::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
