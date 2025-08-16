/*          
*The url:www.dhceo.com		  	
*warning:Please respect the author's work
*/
jQuery(document).ready(function(a){a(".card-body content img").each(function(b){_self=a(this);this.parentNode.href||(imgsrc="",imgsrc=_self.attr("data-original")?_self.attr("data-original"):_self.attr("src"),a(this).wrap("<a href='"+imgsrc+"' onclick='return hs.expand(this);' style='box-shadow:none;'></a>"))});hs.graphicsDir="/static/highslide/";hs.outlineType="rounded-white";hs.dimmingOpacity=.8;hs.outlineWhileAnimating=!0;hs.showCredits=!1;hs.captionEval="this.thumb.alt";hs.numberPosition="caption";
hs.align="center";hs.transitions=["expand","crossfade"];hs.addSlideshow({interval:5E3,repeat:!0,useControls:!0,fixedControls:"fit",overlayOptions:{opacity:.75,position:"bottom center",hideOnMouseOut:!0}})});