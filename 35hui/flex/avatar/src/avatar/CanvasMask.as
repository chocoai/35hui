package avatar
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.events.MouseEvent;
	import flash.geom.Rectangle;
	import flash.utils.ByteArray;
	
	import mx.containers.Canvas;
	import mx.managers.CursorManager;
	
	/**
	 * 包含所有的遮罩层
	 */
	public class CanvasMask extends Sprite
	{
		public var rectObject:RectObject;
		public var maskLoader:GetPicFormatLoader;
		
		private var param:Param;
		
		[Embed(source="images/changeSize.png")]
		public var ChangeSize:Class;
		
		[Embed(source="images/movePic.png")]
		public var MovePic:Class;
		
		
		private var mouseOnMaskRect:Boolean = false;//鼠标是否在遮罩层内
		private var mouseOnChangeSizeRect:Boolean = false;//鼠标在改变大小的框内
		public var changeSizeFun:Function;//改变缩略图尺寸方法
		
		private var oldX:Number, oldY:Number;//鼠标点击缩放的初始位置
		public var canChangeSize:Boolean = false;//是否可以改变大小
		public function CanvasMask(param:Param, byteArray:ByteArray, defaultPicCanvas:Canvas ,changeSizeFun:Function )
		{
			this.param = param;
			this.changeSizeFun = changeSizeFun;
			
			rectObject = new RectObject(param);
			
			this.addChild(rectObject);
			
			maskLoader = new GetPicFormatLoader(param, byteArray,changeRectObjectPosition);
			maskLoader.mask = rectObject.maskRect;
			this.addChild(maskLoader);
			
			
			//对所有显示对象增加监听
			maskLoader.addEventListener(MouseEvent.MOUSE_OVER, maskLoaderMouseOver);
			maskLoader.addEventListener(MouseEvent.MOUSE_OUT, maskLoaderMouseOut);
			maskLoader.addEventListener(MouseEvent.MOUSE_DOWN, maskLoaderMouseDown);
			maskLoader.addEventListener(MouseEvent.MOUSE_UP, maskLoaderMouseUp);
			maskLoader.addEventListener(MouseEvent.MOUSE_MOVE,maskLoaderMouseMove);
			
			
			rectObject.changeSizeRect.addEventListener(MouseEvent.MOUSE_OVER, changeSizeRectMouseOver);
			rectObject.changeSizeRect.addEventListener(MouseEvent.MOUSE_OUT, changeSizeRectMouseOut);
			rectObject.changeSizeRect.addEventListener(MouseEvent.MOUSE_DOWN, changeSizeRectMouseDown);
			
			defaultPicCanvas.addEventListener(MouseEvent.MOUSE_MOVE, defaultPicCanvasMouseMove);
			defaultPicCanvas.addEventListener(MouseEvent.MOUSE_UP, defaultPicCanvasMouseUp);
			
		}
		
		private function changeSizeRectMouseOver(event:MouseEvent):void{
			CursorManager.removeAllCursors();
			CursorManager.setCursor(ChangeSize);
		}
		private function changeSizeRectMouseOut(event:MouseEvent):void{
			if(!canChangeSize){
				CursorManager.removeAllCursors();
			}
		}
		private function changeSizeRectMouseDown(event:MouseEvent):void{
			oldX = event.stageX;
			oldY = event.stageY;
			canChangeSize = true;
		}
		private function defaultPicCanvasMouseUp(event:MouseEvent):void{
			if(canChangeSize){
				CursorManager.removeAllCursors();
			}
			canChangeSize = false;
		}
		private function defaultPicCanvasMouseMove(event:MouseEvent):void{
			if(event.buttonDown&&canChangeSize){
				var tmp_x:Number = event.stageX-oldX;
				var tmp_y:Number = event.stageY-oldY;
				oldX = event.stageX;
				oldY = event.stageY;
				
				
				//按照规格来调整大小
				var mxaChange:Number = Math.max(tmp_x,tmp_y);
				if(mxaChange==tmp_x){//按宽来调整
					tmp_y = maskLoader.height*tmp_x/maskLoader.width;
				}else{
					tmp_x = maskLoader.width*tmp_y/maskLoader.height;
				}
				
				var maskChangeX:Number = rectObject.maskRect.width + tmp_x;
				//最小
				if(maskChangeX<40){
					tmp_x = 0;
					tmp_y = 0;
				}
				//最大
				if(rectObject.maskRect.width+rectObject.x+tmp_x>(maskLoader.width+param.getCanvasMaxSize()[0])/2){
					tmp_x = 0;
					tmp_y = 0;
				}
				if(rectObject.maskRect.height+rectObject.y+tmp_y>(maskLoader.height+param.getCanvasMaxSize()[1])/2){
					tmp_x = 0;
					tmp_y = 0;
				}
				
				rectObject.changeSizeRect.x +=  tmp_x;
				rectObject.changeSizeRect.y += tmp_y;
				rectObject.maskRect.width += tmp_x;
				rectObject.maskRect.height += tmp_y;
				
				changeSizeFun();
			}
		}
		
		
		private function maskLoaderMouseOver(event:MouseEvent):void{
			if(!canChangeSize){
				mouseOnMaskRect = true;
				CursorManager.removeAllCursors();
				CursorManager.setCursor(MovePic);
			}
		}
		private function maskLoaderMouseOut(event:MouseEvent):void{
			if(!canChangeSize){
				mouseOnMaskRect = false;
				CursorManager.removeAllCursors();
				rectObject.stopDrag();
			}
		}
		
		private function maskLoaderMouseDown(event:MouseEvent):void{
			if(event.buttonDown&&mouseOnMaskRect){
				var rectg:Rectangle = new Rectangle(param.getDisplayPosition().x,param.getDisplayPosition().y,maskLoader.width-maskLoader.mask.width,maskLoader.height-maskLoader.mask.height);
				rectObject.startDrag(false,rectg);
			}
		}
		private function maskLoaderMouseUp(event:MouseEvent):void{
			rectObject.stopDrag();
		}
		private function maskLoaderMouseMove(event:MouseEvent):void{
			if(!canChangeSize&&!mouseOnMaskRect){
				mouseOnMaskRect = true;
				CursorManager.removeAllCursors();
				CursorManager.setCursor(MovePic);
			}
			changeSizeFun();
		}
		private function changeRectObjectPosition():void{
			rectObject.x = param.getDisplayPosition().x;
			rectObject.y = param.getDisplayPosition().y;
		}
	}
}