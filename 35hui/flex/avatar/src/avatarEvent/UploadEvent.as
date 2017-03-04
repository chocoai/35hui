package avatarEvent
{
	import flash.events.Event;
	
	public class UploadEvent extends Event
	{
		public static const IMAGE_COMPLETE:String = "imageComplete";
		
		public function UploadEvent(type:String)
		{
			super(type);
			return;
		}
	}
}