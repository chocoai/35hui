package pano
{
	import dibiao.loading;
	
	import flash.display.Bitmap;
	import flash.display.Loader;
	import flash.display.LoaderInfo;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	
	import mx.core.BitmapAsset;
	
	public class PanoThumbnail extends Sprite
	{
		private var imgWidth:Number = 90;//图片宽度
		private var imgHeight:Number = 70;
		private var lineBorder:Number = 1;//边框线粗
		private var textFieldHeight:Number = 20;//标题栏高度
		
		private var border:Sprite = new Sprite();
		private var sp:Sprite = new Sprite();
		
		private var loadImg:loading = new loading();
		/**
		 * panoId全景id
		 * imgUrl缩略图
		 * title标题
		 * changeFun全景切换方法
		 */
		public function PanoThumbnail(panoId:String, imgUrl:String, title:String, changeFun:Function)
		{
			//等待图片
			this.addChild(loadImg);
			loadImg.x = 30;
			loadImg.y = 20;
			
			//先画单个图片容器
			border.graphics.lineStyle(lineBorder,0x000000);
			border.graphics.drawRect(0,0,imgWidth+lineBorder,imgHeight+lineBorder);
			this.addChild(border);	
			border.alpha = 0.5;			
			
						
			
			var loader:Loader = new Loader();
			var imageURLReq:URLRequest = new URLRequest(imgUrl); 
			loader.load(imageURLReq);
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, reSize);
			loader.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR, picLoaderIoError);
			this.addChild(loader);
			loader.x = lineBorder;
			loader.y = lineBorder;
			
			
			sp.graphics.beginFill(0x2a2a2c);
			sp.graphics.drawRect(lineBorder,imgHeight+lineBorder-textFieldHeight,imgWidth,textFieldHeight);
			sp.graphics.endFill();
			sp.alpha = 0.5;
			this.addChild(sp);
			
			var textTitle:TextField = new TextField;
			textTitle.text = title;
			textTitle.textColor = 0xFFFFFF;
			textTitle.y = imgHeight-textFieldHeight;
			textTitle.width = imgWidth;
			textTitle.autoSize = TextFieldAutoSize.CENTER;
			this.addChild(textTitle);
			
			this.addEventListener(MouseEvent.MOUSE_OVER,mouseOver);
			this.addEventListener(MouseEvent.MOUSE_OUT,mouseOut);
			this.addEventListener(MouseEvent.CLICK,function(e:MouseEvent):void{changeFun(panoId)});
			this.buttonMode = true;
			
		}
		protected function reSize(event:Event):void{
			var bp:Bitmap = LoaderInfo(event.target).content as Bitmap;
			bp.height = imgHeight;
			bp.width = imgWidth;
			
			this.removeChild(loadImg);
		}
		private function mouseOver(event:Event):void{
			border.alpha = 1;
			sp.alpha = 1;
		}
		private function mouseOut(event:Event):void{
			border.alpha = 0.5;
			sp.alpha = 0.5;
		}
		private function picLoaderIoError(e:Event):void{
			trace("load img error");
		}

	}
}