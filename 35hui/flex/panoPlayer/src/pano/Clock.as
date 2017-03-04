package pano
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.TimerEvent;
	import flash.text.TextField;
	import flash.text.TextFormat;
	import flash.utils.Timer;
	
	import mx.controls.Image;
	import mx.controls.Label;
	import mx.controls.Text;
	import mx.core.BitmapAsset;
	
	import org.osmf.events.TimeEvent;
	

	public class Clock extends Sprite
	{
		private var time:Timer = new Timer(100,0);
		private var loadedRect:Sprite;
		private var loadPrcent:Number = 0;//1-100
		private var completeSpeed:int = 1;//快速完成时的速度
		private var loadText:TextField;
		private var loadImg:BitmapAsset;
		
		[Embed(source="images/loader.png")]
		public var LoadImg:Class;
		
		public function Clock()
		{
			loadImg = new LoadImg() as BitmapAsset;
			addChild(loadImg)
			var ldsp:Sprite = new Sprite();
			addChild(ldsp);
			ldsp.x = 31;
			ldsp.y = 38;
			
			loadedRect = new Sprite(); 
			loadedRect.graphics.beginFill(0x3167D2);
			loadedRect.graphics.drawRect(0,0,1,7);
			loadedRect.graphics.endFill();
			ldsp.addChild(loadedRect)
			
			var loadTextFormat:TextFormat=new TextFormat();
			loadTextFormat.size = 18;
			loadTextFormat.bold = true;
			loadTextFormat.color = 0x666666;
			loadText = new TextField();
			loadText.defaultTextFormat = loadTextFormat;
			ldsp.addChild(loadText);
			loadText.x = 185;
			loadText.y = -10;
			
			this.visible = false;
		}
		public function loadProgress(percent:Number):void{
			if(percent<=100){
				this.loadPrcent = percent;
				
				percent = Math.floor(percent);
				loadedRect.width = 176/100*percent;
//				loadedRect.width = 176
				loadText.text = percent+"%";
			}
		}
		private function undateProgress(event:Event):void{
			if(loadPrcent>80){//80到99要慢慢的增长
				
				if(loadPrcent>=99){
					time.stop();
					time.removeEventListener(TimerEvent.TIMER, undateProgress);
				}else{
					loadPrcent += 0.1; 
				}
			}else{
				loadPrcent ++;
			}
			loadProgress(this.loadPrcent);
			
		}
		private function completeRrogress(event:Event):void{//1秒内要把加载条填充完成
			loadPrcent += completeSpeed;
			if(loadPrcent>=100){
				loadPrcent = 100;
				time.stop();
				time.removeEventListener(TimerEvent.TIMER,completeRrogress);
			}
			loadProgress(loadPrcent);
			
			if(loadPrcent == 100){
				this.visible = false;
			}
		}
		public function begin():void{
			this.loadPrcent = 0;
			loadProgress(this.loadPrcent);
			this.visible = true;
				
			if(time.running){
				time.stop();
				time.removeEventListener(TimerEvent.TIMER, undateProgress);
				time.removeEventListener(TimerEvent.TIMER,completeRrogress);
			}
			time.start();
			time.addEventListener(TimerEvent.TIMER, undateProgress);
		}
		public function complete():void{
			var surplus:Number = 100-Math.floor(this.loadPrcent);//剩下的
			
			if(time.running){//如果计时器正在运行，则说明还没有到99
				time.stop();
				time.removeEventListener(TimerEvent.TIMER, undateProgress);
			}
			this.completeSpeed = Math.ceil(surplus/10);
			time.addEventListener(TimerEvent.TIMER,completeRrogress);
			time.start();
		}
		public function getBackImg():Object{
			return loadImg;
		}
	}
}