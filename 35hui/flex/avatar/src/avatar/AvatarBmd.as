package avatar
{
	import avatarEvent.UploadEvent;
	
	import flash.display.BitmapData;
	import flash.display.Loader;
	import flash.display.LoaderInfo;
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.events.IOErrorEvent;
	import flash.utils.ByteArray;

	public class AvatarBmd extends EventDispatcher
	{
		private var loader:Loader;
		public var picValidate:Boolean = true;
		public function AvatarBmd(byteArray:ByteArray)
		{
			loader = new Loader();
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, loaderComplete);
			loader.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR, loadError);
			loader.loadBytes(byteArray);
		}
		private function loaderComplete(event:Event) : void{
			var content:* = loader.content;
			var bitmapData:BitmapData = new BitmapData(content.width,content.height);
			bitmapData.draw(content);  
			
			Param.bitmapData = bitmapData;
			this.dispatchEvent(new UploadEvent(UploadEvent.IMAGE_COMPLETE));
		}
		private function loadError(event:Event):void{
			this.picValidate =false;//错误
		}
	}
}