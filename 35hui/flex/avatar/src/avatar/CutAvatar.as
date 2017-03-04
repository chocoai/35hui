package avatar
{
	import avatarEvent.UploadEvent;
	
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.Sprite;
	import flash.events.MouseEvent;
	import flash.geom.Matrix;
	import flash.geom.Rectangle;
	
	import mx.containers.Canvas;
	import mx.controls.Alert;
	import mx.managers.CursorManager;
	
	public class CutAvatar extends Sprite
	{
		public var avatarBmd:AvatarBmd;
		public var sprite:Sprite;
		private var rectObject:RectObject;
		private var previewPicCanvas:Canvas;//预览图片位置
		private var rotationSize:Number;
		
		[Embed(source="images/changeSize.png")]
		public var ChangeSize:Class;
		
		[Embed(source="images/movePic.png")]
		public var MovePic:Class;
		
		private var mouseOnMaskRect:Boolean = false;//鼠标是否在遮罩层内
		private var mouseOnChangeSizeRect:Boolean = false;//鼠标在改变大小的框内
		
		private var oldX:Number, oldY:Number;//鼠标点击缩放的初始位置
		public var canChangeSize:Boolean = false;//是否可以改变大小
		
		private var blacksp:Sprite;//黑色背景
		public function CutAvatar(param1:AvatarBmd,param2:Canvas)
		{
			this.avatarBmd = param1;
			this.previewPicCanvas = param2;
			this.avatarBmd.addEventListener(UploadEvent.IMAGE_COMPLETE, changeAvatars);
			sprite = new Sprite();
			this.addChild(sprite);
		}
		//开始处理图片
		private function changeAvatars(event:UploadEvent):void{
			this.avatarBmd.removeEventListener(UploadEvent.IMAGE_COMPLETE, changeAvatars);
			var bm:Bitmap = new Bitmap(Param.bitmapData);
			bm = resizeAvatar(bm);
			sprite.addChild(bm);
			
			//添加黑色遮罩层
			blacksp = new Sprite();
			blacksp.graphics.beginFill(0x000000);
			blacksp.graphics.drawRect(0,0,sprite.width, sprite.height);
			blacksp.graphics.endFill();
			blacksp.alpha = 0.5;
			sprite.addChild(blacksp);
			
			
			rectObject = new RectObject();
			sprite.addChild(rectObject);
			
			var maskLoader:Bitmap = new Bitmap(Param.bitmapData);
			maskLoader = resizeAvatar(maskLoader);
			maskLoader.mask = rectObject.maskRect;
			
			var maskSprite:Sprite = new Sprite();
			maskSprite.addChild(maskLoader);
			sprite.addChild(maskSprite);
			
			
			sprite.x = (Param.defaultPic_width-sprite.width)/2;
			sprite.y = (Param.defaultPic_height-sprite.height)/2;
			
			
			initPreviewAndMask();
			
			//对所有显示对象增加监听
			maskSprite.addEventListener(MouseEvent.MOUSE_OVER, maskLoaderMouseOver);
			maskSprite.addEventListener(MouseEvent.MOUSE_OUT, maskLoaderMouseOut);
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, maskLoaderMouseDown);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, maskLoaderMouseUp);
			maskSprite.addEventListener(MouseEvent.MOUSE_MOVE,maskLoaderMouseMove);
			
			rectObject.changeSizeRect.addEventListener(MouseEvent.MOUSE_OVER, changeSizeRectMouseOver);
			rectObject.changeSizeRect.addEventListener(MouseEvent.MOUSE_OUT, changeSizeRectMouseOut);
			rectObject.changeSizeRect.addEventListener(MouseEvent.MOUSE_DOWN, changeSizeRectMouseDown);
			
			sprite.addEventListener(MouseEvent.MOUSE_MOVE, defaultPicCanvasMouseMove);
			
			stage.addEventListener(MouseEvent.MOUSE_UP, stageMouseUp)
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
		
	
		public function bigPicMouseDown(event:MouseEvent):void{
			if(rectObject.width<sprite.width&&rectObject.height<sprite.height){
				var changeWidth:Number = rectObject.maskRect.width+10;
				if(changeWidth<Param.mix_mask_width){
					changeWidth = Param.mix_mask_width;
				}
				//最大
				if(rectObject.width+rectObject.x>sprite.width){
					rectObject.x=rectObject.x-10>=0?rectObject.x-10:0;
					if(rectObject.x==0){
					changeWidth = rectObject.maskRect.width;
					}
				}
				if(rectObject.height+rectObject.y>sprite.height){
					rectObject.y=rectObject.y-10>=0?rectObject.y-10:0;
					if(rectObject.y==0){
					changeWidth = rectObject.maskRect.width;
					}
				}
				changeRectObjectSize(changeWidth);
				setPreview();
			}
		}
		public function smallPicMouseDown(event:MouseEvent):void{
			
			if(rectObject.width>50&&rectObject.height>65){
				var changeWidth:Number = rectObject.maskRect.width-10;
				changeWidth=changeWidth<50?50:changeWidth;
				changeRectObjectSize(changeWidth);
				setPreview();
			}
		}	
		public function changePic(num:Number):void{
			var changeSize:Number = num-rectObject.width;
			//rectObject.width=rectObject.width+changeSize
			var changeWidth:Number =rectObject.width+changeSize;	
			if(changeWidth<Param.mix_mask_width){
				changeWidth = Param.mix_mask_width;
			}
			
			if(rectObject.height==sprite.height&&num>100&&rectObject.y==0){
				changeWidth =rectObject.maskRect.width;
			}
			//最大
			if(rectObject.width+rectObject.x>sprite.width){
				rectObject.x = rectObject.x+changeSize>0?rectObject.x+changeSize:0;			
				if(rectObject.x==0){
					changeWidth =rectObject.maskRect.width;
				}
			}
			if(rectObject.height+rectObject.y>sprite.height){
				rectObject.y = rectObject.y+changeSize>0?rectObject.y+changeSize:0;
				if(rectObject.y==0){
					changeWidth =rectObject.maskRect.width;
				}			
			}
			
			
			changeRectObjectSize(changeWidth);
			
			setPreview();
		}
		private function maskLoaderMouseDown(event:MouseEvent):void{
			
		
			
			if(event.buttonDown&&mouseOnMaskRect){
				var rectg:Rectangle = new Rectangle(0,0,sprite.width-rectObject.width,sprite.height-rectObject.height);
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
			setPreview();
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
		
		private function stageMouseUp(event:MouseEvent):void{
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
				var changeWidth:Number = rectObject.maskRect.width+tmp_x;
				if(changeWidth<Param.mix_mask_width){
					changeWidth = Param.mix_mask_width;
				}
				//最大
				if(rectObject.width+rectObject.x+tmp_x>sprite.width){
					changeWidth = rectObject.maskRect.width;
				}
				if(rectObject.height+rectObject.y+tmp_y>sprite.height){
					changeWidth = rectObject.maskRect.width;
				}
				
				changeRectObjectSize(changeWidth);
				setPreview();
			}
		}
		private function initPreviewAndMask():void{
			if(blacksp.width<rectObject.width&&blacksp.width>Param.mix_mask_width){//图片宽度不够
				changeRectObjectSize(blacksp.width);
			}
			if(blacksp.height<rectObject.maskRect.height&&blacksp.height>Param.mix_mask_width){//图片高度不够
				changeRectObjectSize(blacksp.width);
			}
			setPreview();
		}
		private function changeRectObjectSize(toWidth:Number):void{
			rectObject.maskRect.width = toWidth;
			rectObject.maskRect.scaleY = rectObject.maskRect.scaleX;
			
			rectObject.line.width = rectObject.maskRect.width+3;
			rectObject.line.height = rectObject.maskRect.height+3;
			
			rectObject.changeSizeRect.x = rectObject.maskRect.width-4
			rectObject.changeSizeRect.y = rectObject.maskRect.height-4
				
		}
		private function resizeAvatar(bitmap:Bitmap):Bitmap{
			
			var size:Number = Math.max(Param.defaultPic_width,Param.defaultPic_height);
			var maxSide:Number = Math.max(bitmap.width,bitmap.height);
			if(maxSide==bitmap.width){
				bitmap.width = size;
				bitmap.scaleY =bitmap.scaleX;
			}else{
				bitmap.height = size;
				bitmap.scaleX = bitmap.scaleY;
			}
			this.rotationSize = bitmap.scaleX;
			return bitmap;
		}
		
		
		private function setPreview():void{
			var bitmapData:BitmapData = new BitmapData(rectObject.maskRect.width,rectObject.maskRect.height);
			
			var matrix:Matrix = new Matrix();
			matrix.scale(this.rotationSize, this.rotationSize);
			matrix.translate(-rectObject.x, -rectObject.y);
			var rect:Rectangle = new Rectangle(0,0,rectObject.maskRect.width,rectObject.maskRect.height);
			
			bitmapData.draw(Param.bitmapData, matrix,null,null,rect,true);
			var bmp1:Bitmap = new Bitmap(bitmapData);
			
			while(previewPicCanvas.rawChildren.numChildren>1){
				previewPicCanvas.rawChildren.removeChildAt(previewPicCanvas.rawChildren.numChildren-1);
			}
			previewPicCanvas.rawChildren.addChild(bmp1);
			bmp1.width = Param.preview_width;
			bmp1.height = Param.preview_height;
		}
	}
}