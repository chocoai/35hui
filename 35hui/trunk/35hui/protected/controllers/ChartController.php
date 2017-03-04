<?php
Yii::import('ext.jpgraph.*');
Yii::import('ext.pChart.*');
class ChartController extends Controller {
    protected $chartBaseDir;
    public function init() {
        parent::init();
        $this->chartBaseDir = Yii::getPathOfAlias('ext.pChart');
    }
    public function actionIndex() {
        echo 'Hello World!';
    }
    /**
     * 经纪人测试雷达图，接受data,size两个参数。例如：/chart/radar?data=4,6,5.5,5,7&size=200x300
     */
    public function actionRadar() {
        if(!isset($_GET['data']) || !isset($_GET['size'])) exit();
        $data = trim($_GET['data']);
        $size = trim($_GET['size']);
        // Dataset definition
        $rdData = array(0,0,0,0,0);
        foreach(explode(',', $data) as $k=>$v) {
            if($k > 4) break;
            $v = (int)$v;
            $rdData[$k] = $v?$v:2;
        }
        $label = array('  房产知识',' 政策行情',' 熟悉楼盘','销售技巧','服务质量');
        // Initialise the graph
        list($x,$y) = explode('x', $size);
        $x = (int)$x;
        $y = (int)$y;
        if($x < 150) $x = 150;
        if($x > 800) $x = 800;
        if($y < 150) $y = 150;
        if($y > 800) $y = 800;
        $Test = new pChart($x, $y);//220x160

        foreach($rdData as $k=>$v)
            $label[$k] .= '('.$v.')';
        $DataSet = new pData;
        @$DataSet->AddPoint($label, "Label");
        @$DataSet->AddPoint($rdData,"Serie1");
        $DataSet->AddSerie("Serie1");
        $DataSet->SetAbsciseLabelSerie("Label");
        $Test->setFontProperties($this->chartBaseDir."/Fonts/simsun.ttc",9);
        $Test->setColorPalette(0, 255, 126, 0);

        $Test->setGraphArea(10,10,$x-10,$y-10);
        $Test->LineWidth=1;
        $Test->drawRadarAxis($DataSet->GetData(),$DataSet->GetDataDescription(),true,20,150,150,150,150,150,150,5);
        $Test->drawFilledRadar($DataSet->GetData(),$DataSet->GetDataDescription(),100,20,20);

        $Test->Stroke();
/*
        require_once ('jpgraph/jpgraph.php');
        require_once ('jpgraph/jpgraph_radar.php');

        // Create the basic radar graph
        $graph = new RadarGraph(400,300);
        $graph->img->SetAntiAliasing();
        $graph->SetFrame(true,'gray',1);//设置边框

        // Set background color and shadow
        $graph->SetColor("white");
        $graph->SetShadow(false);

        // Position the graph
        $graph->SetCenter(0.5,0.5);

        // Setup the axis formatting
        $graph->axis->SetFont(FF_SIMSUN,FS_BOLD);
        $graph->axis->SetColor("gray");

        // Setup the grid lines
        $graph->grid->SetLineStyle("solid");
        $graph->grid->SetColor("gray");
        $graph->grid->Show();
        $graph->HideTickMarks();

        $graph->axis->title->SetFont(FF_SIMSUN,FS_NORMAL,10);
        // Setup graph titles
        $graph->title->SetFont(FF_SIMSUN,FS_NORMAL,10);
        $title = array('房产知识','政策行情','熟悉楼盘','销售技巧','服务质量');

        $graph->SetTitles($title);

        $plot2 = new RadarPlot($rdData);
        //$plot2->SetLegend("李四");
        $plot2->SetLineWeight(2);
        $plot2->SetColor("orange");
        $plot2->SetFill(true);
        $plot2->SetFillColor("orange");

        // Add the plots to the graph
        $graph->Add($plot2);

        // And output the graph
        $graph->Stroke();
 * 
 */
    }
    public function actionPie() {
        if(empty($_GET['data'])){
            exit();
        }
        $Serie1=$Serie2=array();
        foreach(explode(',', $_GET['data']) as $value){
            $vs = explode('|', $value);
            $Serie1[]=(int)$vs[1];
            $Serie2[]=$vs[0];
        }
        require_once ('jpgraph/jpgraph.php');
        require_once ('jpgraph/jpgraph_pie.php');
        require_once ('jpgraph/jpgraph_pie3d.php');

        // Create the Pie Graph.
        $graph = new PieGraph(600,200);
        $graph->img->SetAntiAliasing();

        $theme_class= new VividTheme;
        $graph->SetTheme($theme_class);
        $graph->SetShadow();

        // Set A title for the plot
        $graph->legend->Pos(0.3,0.1);
        $graph->legend->SetColumns(1);
        $graph->legend->SetFont(FF_SIMSUN,FS_NORMAL,10);
        // Create
        $p1 = new PiePlot3D($Serie1);
        $graph->Add($p1);

        //$p1->ShowBorder();
        $p1->SetTheme("pastel");
        $p1->SetCenter(0.22);
        $p1->SetLegends($Serie2);
        $p1->value->SetFont(FF_SIMSUN,FS_NORMAL,10);
        //$p1->ExplodeSlice(1);
        $graph->Stroke();
    }
}
