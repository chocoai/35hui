<?php

class AuthmanageController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    public $authItemType = array('operation','task','role');

    /**
     *
     * @param <type> $role
     */
    public function getChildrenDeep($authItem) {
        $operations = array();
        foreach ($authItem->getChildren() as $item) {
            if($item->hasChild($item->getName())) {
                $temp = getChildrenDeep($item);
                foreach($temp as $v)
                    $operations[] = $v;
            }else
                $operations[] = $item;
        }
        return $operations;
    }
    /**
     * 认证授权
     */
    public function actionAuthorization() {
        if(isset($_POST['name']) && !empty($_POST['authItems'])) {
            $name = trim($_POST['name']);
            $authItems = $_POST['authItems'];
            $auth = Yii::app()->getAuthManager();
            $deleteQueue = array();//待删除项目
            $haveItems = array();  //修改之前的项目
            $publicAuth = array(); //本次提交与$haveItems的重合项目

            if( ! empty($_POST['oldAccessItems']) ) {
                $haveItems = explode(',', $_POST['oldAccessItems']);
                $publicAuth = array_intersect($haveItems, $authItems);//重复的授权
                $deleteQueue = array_diff($haveItems, $publicAuth);
            }
            if(is_string($authItems)) $authItems=(array)$authItems;
            $addQueue = array_diff($authItems, $publicAuth);//待添加项目
            if( ($authParent = $auth->getAuthItem($name))!==NULL) {
                foreach($addQueue as $item)
                    $authParent->addChild(trim($item));
                foreach ($deleteQueue as $value)
                    $authParent->removeChild($value);
            }
            Manageuser::model()->clearUserMenuCache();
            header('Location: '.$_SERVER['HTTP_REFERER'], true, 302);
            Yii::app()->end();
        }
    }
    /**
     * View all authItem by name or not.
     */
    public function actionAuthorizationView() {
        $name = isset ($_GET['name'])?strtolower(trim($_GET['name'])):'';
        $authItemsValue = $authItemsValueByType = $authItems = $roleItems = array();
        $auth = Yii::app()->getAuthManager();
        if(empty($name)) {
            $authParent = $auth->getAuthItems(2);//
            foreach($authParent as $role) {
                $roleItems[$role->getName()] = $this->getChildrenDeep($role);
            }
        }else {
            $authParent = $auth->getAuthItem($name);
            $roleItems[$authParent->getName()] = $this->getChildrenDeep($authParent);
        }

        foreach($auth->getAuthItems() as $name=>$item) {
            $authItemsValueByType[$item->getType()][]=$item->getName();
            $itemKeyDescriptions[$item->getName()] = $item->getDescription();
            //$authItems[$item->getType()][]=array($item->getName(),$item->getDescription(),$item->getBizRule());
        }
        for($i=0;$i<3;$i++)
            if(isset($authItemsValueByType[$i])) asort($authItemsValueByType[$i]);
        //asort($authItemsValue);
        $authItemsValue = array_merge(isset($authItemsValueByType[1])?$authItemsValueByType[1]:array(),$authItemsValueByType[0]);
        //array_merge($array1, $array2);
        //print_r($roleOperations);exit;
        $this->render('authorizationview',array(
                'roles'=>$authParent,
                'roleItems'=>$roleItems,
                //'authItems'=>$authItems,
                'authItemsValueByType'=>$authItemsValueByType,
                'authItemsValue'=>$authItemsValue,
                'itemKeyDescriptions'=>$itemKeyDescriptions,
        ));
    }
    /**
     * Page view all operations
     */
    public function actionOperation() {
        $page = isset($_GET['page'])?(int)$_GET['page']:1;
        $auth = Yii::app()->getAuthManager();
        $sql = "SELECT name, description, bizrule, data FROM {$auth->itemTable} WHERE type='0'
            ORDER BY name ASC LIMIT ".(($page-1)*20).", 20";
        $sqlc = "SELECT COUNT(*) AS c FROM {$auth->itemTable} WHERE type='0'; ";
        $command=$auth->db->createCommand($sqlc);
        $count = $command->queryAll();
        $allPage = (int)($count[0]['c']) / 20 +1;
        $command=$auth->db->createCommand($sql);
        $links = array();
        $i = 1;
        while($i++ < $allPage) {
            $iPage = $i - 1;
            $links[] = $page == $iPage?$iPage:CHtml::link($iPage,array("/authmanage/operation",'page'=>$iPage));
        }
        $this->render('operation',array(
                'links'=>$links,
                'qData'=>$command->queryAll(),
        ));

    }
    /**
     * Create a new AuthItem
     */
    public function actionCreate() {
        if(Yii::app()->request->isPostRequest && !empty($_POST['name'])) {
            $name = strtolower(trim($_POST['name']));
            $description = isset($_POST['description'])?$_POST['description']:'';
            $bizrule = isset($_POST['bizrule'])?$_POST['bizrule']:NULL;
            $auth = Yii::app()->getAuthManager();
            switch ($_POST['type']) {
                case 'operation':
                    $auth->createOperation($name,$description,$bizrule);
                    $this->redirect(array('authmanage/operation'));
                    break;
                case 'task':
                    $auth->createTask($name,$description,$bizrule);
                    break;
                case 'role':
                    $auth->createRole($name,$description,$bizrule);
                    break;
            }
            $this->redirect(array('index'));
        }
        $authType = isset($_GET['authtype'])?$_GET['authtype']:'';
        $this->render('create',array(
                'authType'=>$authType,
        ));
    }
    public function actionDelete() {
        if(Yii::app()->request->isPostRequest && isset($_GET['name'])) {
            $name = urldecode(trim($_GET['name']));
            $auth = Yii::app()->getAuthManager();
            $sql="DELETE FROM {$auth->itemChildTable} WHERE parent=:name1 OR child=:name2";
            $command=$auth->db->createCommand($sql);
            $command->bindValue(':name1',$name);
            $command->bindValue(':name2',$name);
            $command->execute();

            $sql="DELETE FROM {$auth->assignmentTable} WHERE itemname=:name";
            $command=$auth->db->createCommand($sql);
            $command->bindValue(':name',$name);
            $command->execute();

            $sql="DELETE FROM {$auth->itemTable} WHERE name=:name";
            $command=$auth->db->createCommand($sql);
            $command->bindValue(':name',$name);
            $command->execute();

            header('Location: '.$_SERVER['HTTP_REFERER'], true, 302);
            Yii::app()->end();
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    /**
     * Lists all models.
     */
    public function actionIndex() {
        $auth = Yii::app()->getAuthManager();
        $roles = $auth->getRoles();
        $tasks = $auth->getTasks();
        $this->render('index',array(
                'roles'=>$roles,
                'tasks'=>$tasks,
        ));
    }
}
