package pano
{
	import flash.display.Sprite;
	
	public class PlayingThumbnail extends Sprite
	{
		/**
		 * 当前选中的缩略图
		 */
		public function PlayingThumbnail()
		{
			this.graphics.lineStyle(2,0xffffff);
			this.graphics.drawRect(0,0,90,70);
		}
	}
}