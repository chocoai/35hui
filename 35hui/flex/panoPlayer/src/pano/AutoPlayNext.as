package pano
{
	import flash.events.Event;
	import flash.events.TimerEvent;
	import flash.utils.Timer;

	public class AutoPlayNext
	{
		private var time:Timer;
		private var second:Number = 10;//切换下一张全景的时间
		private var tmp_second:Number;
		private var nextPanoFun:Function;
		public function AutoPlayNext(nextPanoFun:Function)
		{
			this.nextPanoFun = nextPanoFun;
			this.tmp_second = this.second;
			time = new Timer(1000, 0);
			time.addEventListener(TimerEvent.TIMER, progress);
		}
		public function begin():void{
			this.tmp_second = this.second;
			time.start();
			
		}
		public function stop():void{
			time.stop();
		}
		private function progress(event:Event):void{
			this.tmp_second --;
			if(this.tmp_second==0){
				nextPanoFun();
				this.tmp_second = this.second;
			}
			trace("时间："+this.tmp_second);
		}
	}
}