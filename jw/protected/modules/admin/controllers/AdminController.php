<?php
class AdminController extends Controller
{
    public $layout = "manage";
    public function actionIndex()
    {
        $this->render("index");
    }
}