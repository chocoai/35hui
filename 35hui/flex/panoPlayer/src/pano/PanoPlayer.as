package pano
{
//	import dibiao.loading;
	
	import flash.display.Loader;
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.FullScreenEvent;
	import flash.events.IOErrorEvent;
	import flash.events.MouseEvent;
	import flash.net.LocalConnection;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.navigateToURL;
	import flash.system.System;
	import flash.utils.getTimer;
	
	import mx.controls.Alert;
	
	public class PanoPlayer extends Sprite
	{
		/**
		 * 最上层的全景
		 */
		public var topVr:MovieClip;
		
		private var panoDomain:String="http://35upload.360dibiao.com/panorama";//前台输入的全景域 如：http://35upload.360dibiao.com/panorama			
		private var playerURL:String = "/pano/mainplay.swf";
		private var playerURLReq:URLRequest
		private var xmlFileName:String = "parameter.xml";//参数文件名称
		
		public var panoIdArray:Array;//所有的全景
		public var panoXArray:Array;//所有的全景的坐标
		
		private var xmlParameter:String = "";//全景的xml参数
		private var loader:Loader = new Loader(); 
		private var vr:MovieClip;
		
		private var sprite:Sprite = new Sprite();
		private var panoWidth:Number = 640,panoHeight:Number = 480;
		
		private var XMLString:String;
		private var XMLUrl:URLRequest;
		private var XMLLoader:URLLoader;
		
		private var double_click_wait:Number = 300; //双击间隔
		private var previousClick:Number = 0; //上一次双击时间
		
		private var swfType:String = "xml";
		
		public var panoId:String;//当前播放的全景
		
		private var clock:Clock = new Clock();
		public var autoPlayNext:AutoPlayNext;
		public var autoRotate:Boolean = true;//是否自动旋转
		
		public var topMask:PlayingThumbnail;
		
		public function PanoPlayer(panoDomain:String, panoId:String, panoWidth:Number, panoHeight:Number)
		{
			this.panoDomain = panoDomain;
			this.playerURL = panoDomain.substr(0,panoDomain.search(/\.com/g)+4)+this.playerURL;
			this.playerURLReq = new URLRequest(this.playerURL); 
			
			
			this.addChild(sprite);
			this.addChild(clock);
			
			clock.x = panoWidth/2-clock.getBackImg().width/2;
			clock.y = panoHeight/2-clock.getBackImg().height/2;
			
			clock.begin();
			
			this.panoId = panoId;
			this.panoWidth = panoWidth;
			this.panoHeight = panoHeight;
			
			setXmlParameter();
			
			//自动播放
			autoPlayNext = new AutoPlayNext(autoPlayNextPano);
			sprite.addEventListener(MouseEvent.MOUSE_UP,doubleClick);
			
		}
		private function doubleClick(event:MouseEvent):void{
			if ((getTimer()-previousClick) <double_click_wait){ 
				//双击全景
				if(stage.displayState=="normal"){
					stage.displayState = "fullScreen";
				}else{
					stage.displayState = "normal";
				}
				
				previousClick = 0;
			} 
			previousClick = getTimer(); 
		}
		/**
		 * 自动播放下一份全景
		 */
		public function autoPlayNextPano():void{
			if(this.panoIdArray.length>1){//最少两张全景的时候才使用自动播放
				for(var i:Number=0;i<this.panoIdArray.length;i++){
					if(this.panoIdArray[i]==this.panoId){
						break;
					}
				}
				i+1>=this.panoIdArray.length?i=0:i=i+1;
				
				clickToNextPanorama(this.panoIdArray[i]);
			}
		}
		/**
		 * 切换下一份全景
		 */
		public function clickToNextPanorama(ClickPanoId:String):void{
			if(this.panoId != ClickPanoId){//id不相等的时候才切换
				this.panoId = ClickPanoId;
				clock.begin();
				setXmlParameter();
				//移动遮罩层
				for(var i:Number=0;i<this.panoIdArray.length;i++){
					if(this.panoIdArray[i]==this.panoId){
						topMask.x = this.panoXArray[i];
						break;
					}
				}
				
			}
		}
		/**
		 * 旋转全景
		 */
		public function rotatePano(pan:Number, tilt:Number, fov:Number,speed:Number=1):void{
			topVr.pano.moveTo(topVr.pano.getPan()+pan, topVr.pano.getTilt()+tilt, topVr.pano.getFov()+fov, speed);
		}
		
		private function setXmlParameter():void{
			swfType = "xml";//默认所有全景都是xml类型的
			loader = new Loader();
			XMLString = this.panoDomain+"/"+this.panoId+"/"+this.xmlFileName;
			XMLUrl = new URLRequest(XMLString);
			XMLLoader = new URLLoader(XMLUrl);
			XMLLoader.addEventListener(IOErrorEvent.IO_ERROR, xmlLoaderIoError);
			XMLLoader.addEventListener(Event.COMPLETE,filterPanoramastr);
		}
		/**
		 *通过XML过滤全景参数
		 */
		private function filterPanoramastr(event:Event):void{
			XML.ignoreProcessingInstructions = false;//忽略处理指令
			var xml:XML = new XML(XMLLoader.data);
			
			var input:String = xml.child("panorama").child("input").toXMLString();
			var regExp:RegExp = /url="/g;
			var replaceStr:String = 'url="'+panoDomain+"/"+panoId+"/";
			input = input.replace(regExp, replaceStr);
			
			xml.child("panorama").@hideabout = 1;
			delete xml.child("panorama").input;
			var newinput:XML = new XML(input); 
			xml.child("panorama").appendChild(newinput);
			
			delete xml.child("panorama").autorotate;
			xml.child("panorama").appendChild(new XML('<autorotate speed="0.100" delay="8.00" returntohorizon="0.000" onlyinfocus="0" startloaded="1" />'));
			
			var w:Number = xml.child("panorama").display.@width;
			var h:Number = xml.child("panorama").display.@height;
			var q:Number = xml.child("panorama").display.@quality;
			
			delete xml.child("panorama").display;
			xml.child("panorama").appendChild(new XML('<display width="'+w+'" height="'+h+'" quality="'+q+'" changemotionquality="0" changestagequality="0" smoothing="0" fullscreenmenu="0" custommenutext="360dibiao.com" custommenulink="" scalemode="stage" scaletofit="1" />'));
			
			
			delete xml.child("panorama").control;
			xml.child("panorama").appendChild(new XML('<control sensitifity="18" simulatemass="0" lockedmouse="0" lockedkeyboard="0" lockedwheel="0" invertwheel="0" speedwheel="1" invertcontrol="0" />'));
			
			var outStr:String = xml.child("panorama").toXMLString(); 
			
			this.xmlParameter = outStr;
			loader.load(playerURLReq);
			loader.contentLoaderInfo.addEventListener(Event.INIT, initHandler);
		}
		
		/**
		 *初始化全景
		 */
		private function initHandler(event:Event):void {
			vr = MovieClip(loader.content);
			if(this.xmlParameter != ""){//直接传递参数文件
				vr.panoramastr = this.xmlParameter;
			}else{
				var panStr:String = vr.panoramastr;
				var regExp:RegExp = /changestagequality="1"/g;
				var replaceStr:String = 'changestagequality="0"';
				panStr = panStr.replace(regExp, replaceStr);//swf全景如果不改变此值，当转动全景时则体验不好
				vr.panoramastr = panStr;
			}
			playerLoaded();
			if(swfType == "xml"){//只有xml全景才能注册点击事件
				this.addEventListener(Event.ENTER_FRAME ,clickPanorama);
			}
			
		}
		private function xmlLoaderIoError(event:Event):void{
			XMLLoader.removeEventListener(IOErrorEvent.IO_ERROR, xmlLoaderIoError);
			
			swfFileLoader();
		}
		private function swfFileLoader():void{
			swfType = "swf";//swf全景
			var swfUrl:String = this.panoDomain+"/"+this.panoId+"/index.swf";
			var swfUrlReq:URLRequest = new URLRequest(swfUrl); 
			
			loader.load(swfUrlReq);
			loader.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR, swfLoaderIoError);
			
			this.xmlParameter = "";
			loader.contentLoaderInfo.addEventListener(Event.INIT, initHandler);
		}
		private function swfLoaderIoError(event:Event):void{
			loader.contentLoaderInfo.removeEventListener(IOErrorEvent.IO_ERROR, swfLoaderIoError);
			Alert.show("参数不对！");
			loader.unloadAndStop();
			clock.complete();
		}
		/**
		 *删除上层的旧全景，让下层得全景显示出来
		 */
		private function removePano(e:Event):void{
			if(sprite.numChildren>1){
				if ((vr!=null) && (vr.pano!=null)) {
					if(swfType!="xml"||(swfType=="xml"&&(vr.pano.completed))){//只有xml全景才可以判断是否完成了，swf全景没有此属性
						sprite.removeEventListener(Event.ENTER_FRAME , removePano);
						
						
						var oldLoader:Loader = Loader(sprite.getChildAt(sprite.numChildren-1));
						
						oldLoader.unloadAndStop(true);
						sprite.removeChildAt(sprite.numChildren-1);//从显示列表中移除最上面的
						
						this.topVr = MovieClip(loader.content);//获取现在在最上面的全景
						
						try {
							new LocalConnection().connect('foo');
							new LocalConnection().connect('foo');
						} catch (e:Error){}
						
						clock.complete();
						playOrStopPano();//查看是否自动播放。
						removeMouseWheel();
					}
					
				}
			}
		}
		
		/**
		 *展示下一份全景。下一份全景一定要放在最底层，等加载完成，才能显示
		 */
		private function playerLoaded():void {
			sprite.addChildAt(loader,0);
			if(sprite.numChildren==1){//第一次加载的时候设置topVr
				this.topVr = MovieClip(loader.content);//获取现在在最上面的全景
				sprite.addEventListener(Event.ENTER_FRAME, defaultRemoveLoadImg);
			}else{
				sprite.addEventListener(Event.ENTER_FRAME , removePano);
			}
//			autoPlayNext.begin();
		}
		/**
		 * 第一次加载的时候移除加载图片
		 */
		private function defaultRemoveLoadImg(event:Event):void{
			if ((topVr!=null) && (topVr.pano!=null)) {
				if(swfType!="xml"||(swfType=="xml"&&(topVr.pano.completed))){
					sprite.removeEventListener(Event.ENTER_FRAME, defaultRemoveLoadImg);
					clock.complete();
					playOrStopPano();
					removeMouseWheel();
				}
			}
		}
		/**
		 * 移除全景上的滚轮事件。此方法只有xml文件可用，swf文件有可能被加密，这样则没有doMouseWheel了。
		 */
		private function removeMouseWheel():void{
			if(swfType=="xml"){
				stage.removeEventListener(MouseEvent.MOUSE_WHEEL, topVr.pano.doMouseWheel);
			}
		}
		/**
		 *点击全景热点事件
		 */
		private function clickPanorama(e:Event):void {
			if ((vr!=null) && (vr.pano!=null)) {
				this.removeEventListener( Event.ENTER_FRAME ,clickPanorama);
				vr.pano.onClickHotspot=function(ClickPanoId:String,obj:Object,url:String,target:String):void{
					var regExp:RegExp = /http.+\#$/g;
					if(url.search(regExp) == -1){//如果url是地址，则要打开地址
						navigateToURL(new URLRequest(url), "_blank");
					}else{
						panoId = ClickPanoId;
						
						setXmlParameter();
					}
				}
			}
		}
		/**
		 * 改变全景状态时触发
		 */
		public function checkFullScreen(e:Event):void{
			if(sprite.numChildren!=0){
				if(stage.displayState == "fullScreen"){
					topVr.pano.setWindowSize(0,0); 
					topVr.pano.moveTo(topVr.pano.getPan()-5,topVr.pano.getTilt());//由于多次快速切换的时候容易出现屏幕大小变了，可屏幕内容没变的情况，所以要适应一个移动的方法
					
					clock.x = stage.stageWidth/2-clock.getBackImg().width/2;
					clock.y = stage.stageHeight/2-clock.getBackImg().height/2;
					stage.addEventListener(MouseEvent.MOUSE_WHEEL, topVr.pano.doMouseWheel);
				}else{
					topVr.pano.setWindowSize(this.panoWidth,this.panoHeight); 
					topVr.pano.moveTo(topVr.pano.getPan()-5,topVr.pano.getTilt());//由于多次快速切换的时候容易出现屏幕大小变了，可屏幕内容没变的情况，所以要适应一个移动的方法
					
					clock.x = panoWidth/2-clock.getBackImg().width/2;
					clock.y = panoHeight/2-clock.getBackImg().height/2;
					stage.removeEventListener(MouseEvent.MOUSE_WHEEL, topVr.pano.doMouseWheel);
				}
			}
		}
		/**
		 * 检查并设置全景是否自动播放,仅限于xml全景。swf全景由于加密，不存在auto属性。
		 */
		public function playOrStopPano():void{
			if ((topVr!=null) && (topVr.pano!=null)&&this.swfType=="xml") {
				if(this.autoRotate){
					autoPlayNext.begin();
					topVr.pano.auto.start();
				}else{
					autoPlayNext.stop();
					topVr.pano.auto.stop();
				}
			}
		}
	}
}