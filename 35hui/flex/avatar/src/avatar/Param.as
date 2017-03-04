package avatar
{
	import flash.display.BitmapData;

	public final class Param extends Object
	{
		public static var type:String;//类型，是avatar还是logo 
		public static var saveUrl:String;//保存图片地址
		public static var oldHead:String;//旧头像
		private static var displaySize:Array = new Array;
		
		public static var preview_width:Number = 20;//预览大小
		public static var preview_height:Number = 20;//预览大小
		
		public static var defaultPic_width:Number = 250;//默认大小
		public static var defaultPic_height:Number = 250;//默认大小
		
		public static var mix_mask_width:Number = 40;//最小的遮罩宽度
		
		public static var bitmapData:BitmapData;//用户选择的图片
		public function Param()
		{
			super();
		}
		
		public static function setAttributes(parameter:Object):void{
			
			Param.type = parameter["type"] ? (parameter["type"]) : ("avatar");
			Param.saveUrl = parameter["saveUrl"] ? (parameter["saveUrl"]) : ("http://flex.my360dibiao.com/avatar/bin-debug/upload.php");
			Param.oldHead = parameter["oldHead"] ? (parameter["oldHead"]) : "http://35upload.360dibiao.com/mailpic/131363854126.jpg";
			
			if(Param.type=="avatar"){
				Param.preview_width = 100;
				Param.preview_height = 130;
			}
			if(Param.type=="logo"){
				Param.preview_width = 100;
				Param.preview_height = 100;
			}
		}
		/**
		 * 获得容器最大宽度和高度
		 */
		public static function getCanvasMaxSize():Array{
			return new Array(250,250);
		}
		public static function setDisplayPosition(x:Number,y:Number):void{
			displaySize["x"] = x;
			displaySize["y"] = y;
		}
		public static function getDisplayPosition():Array{
			return Param.displaySize;
		}
	}
}