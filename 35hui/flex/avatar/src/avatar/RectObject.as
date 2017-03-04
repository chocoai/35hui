package avatar
{
	import flash.display.Sprite;
	
	/**
	 * 返回方块
	 */
	public class RectObject extends Sprite
	{
		public var maskRect:Sprite;//遮罩部分
		public var changeSizeRect:Sprite;//改变尺寸部分
		public var line:Sprite;//白色边宽
		
		public function RectObject()
		{
			maskRect = new Sprite();
			maskRect.graphics.beginFill(0x00ff00);
			maskRect.graphics.drawRect(0,0,Param.preview_width,Param.preview_height);
			maskRect.graphics.endFill();
			this.addChild(maskRect);
			maskRect.x = 1;
			maskRect.y = 1;
			
			
			changeSizeRect = new Sprite();
			changeSizeRect.graphics.beginFill(0xffffff);
			changeSizeRect.graphics.drawRect(0,0,8,8);
			changeSizeRect.graphics.endFill();
			this.addChild(changeSizeRect);
			
			changeSizeRect.x = maskRect.width-4;
			changeSizeRect.y = maskRect.height-4;
			
			
			line = new Sprite();
			line.graphics.lineStyle(1,0xffffff,1,true);
			line.graphics.drawRect(0,0,Param.preview_width+2,Param.preview_height+2);
			this.addChild(line);
			
		}
	}
}