<?php

class CommentController extends Controller {
    public function actionGetComment() {
        $domId = @$_POST["domId"];
        $attr = @$_POST["attr"];
        if(!$domId||!$attr) {
            exit;
        }
        $info = explode("_", $attr);
        if(count($info)!=3) {
            exit;
        }
        $type = $info[0];//类型 Dynamicuser::$du_type
        $searchId = $info[1];//说说id 或者相册id
        $commentId = $info[2]; //评论id

        switch ($type) {
            default:
                $comment = null;
                $view = "_default";
                break;
            case 1:
                if($commentId!=0) {
                    $comment = array(Userspeakcomment::model()->getOneComment($commentId));
                }else {
                    $comment = Userspeakcomment::model()->getAllCommentByUsid($searchId);
                }
                $view = "_userspeakcomment";
                break;
            case 2:
                if($commentId!=0) {
                    $comment = array(Albumcomment::model()->getOneComment($commentId));
                }else {
                    $comment = Albumcomment::model()->getAllCommentByUsid($searchId);
                }
                $view = "_albumcomment";
                break;
        }
        $this->renderPartial($view,array(
                "comment"=>$comment,
                "domId"=>$domId,
                "commentId"=>$commentId,
                "searchId"=>$searchId,
                "showNewComment"=>$commentId!=0?false:true
        ));
        exit;
    }
    public function actionCreate() {
        $infoArr = explode("_", $_POST["info"]);
        $punlunDomId = $_POST["punlunDomId"];
        $type = $infoArr[0];//类型

        $searchId = $infoArr[1];//评论对象id 如jw_userspeak表ID
        $replyID = $infoArr[2];//回复者 0为不回复任何人
        $content = $_POST["content"];//评论内容

        switch ($type) {
            default:
                $return = "error";
                break;
            case 1://说说评论
                Userspeakcomment::model()->addComment($searchId, $replyID, $content);
                break;
            case 2://相册评论
                Albumcomment::model()->addComment($searchId, $replyID, $content);
                break;
        }
        //创建返回数据
        $punlunDomArr = explode("_", $punlunDomId);
        $return = $punlunDomArr[0]."_".$punlunDomArr[1]."|".$replyID;
        echo $return;
        exit;
    }
}