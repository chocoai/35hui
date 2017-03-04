<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/js/piclist/Home_v11.css" rel="stylesheet" type="text/css">
    <script src="/js/piclist/jquery-2.js" type="text/javascript"></script>
</head>
<body>
<div class="PicShow clearfix fl"  >
<div class="lof-slidecontent" id="lofslidecontent45" >
   <div class="preload" style="display: none;"><div></div></div>
    <!-- MAIN CONTENT --> 
    <div class="lof-main-outer" >
        <ul class="lof-main-wapper lof-opacity">
            <?
			if($data){
				foreach($data as $val){?>
					<li style="opacity: 1; display: block;">
					<a target="_blank" title="<?=$val->p_title?>" href="<?php echo $this->createUrl('systembuildinginfo/view',array('id'=>$val->p_sourceid,'tag'=>'album')) ?>">
						<img class="img_SN" src="<?=PIC_URL.Picture::showStandPic($val->p_img,"")?>" alt="<?=$val->p_title?>" title="<?=$val->p_title?>"/>
						<img class="img_LN" src="<?=PIC_URL.Picture::showStandPic($val->p_img,"")?>" alt="<?=$val->p_title?>"/>
						<p class="lof-main-item-desc ddpng"><?=$val->p_title?$val->p_title:""?></p>
					</a>
				</li>
 
			<?	}	
			}else{
			}
			?>
        </ul>  	
    </div>
    <!-- END MAIN CONTENT --> 
    <!-- NAVIGATOR -->
   <div class="lof-navigator-wapper">
        <div class="lof-next" onClick="return false"></div>
        <div class="lof-navigator-outer">
            <ul style="" class="lof-navigator">
            <?
			if($data){
				foreach($data as $val){?>
					<li><img src="<?=PIC_URL.Picture::showStandPic($val->p_img,"_large")?>" alt="<?=$val->p_title?>" title="<?=$val->p_title?>"/></li>
			<?	}	
			}
			?>                      
            </ul>
        </div>
        <div class="lof-previous" onClick="return false"></div>
    </div>

   <script type="text/javascript" src="/js/piclist/Creativf.js"></script>
 </body>    
    