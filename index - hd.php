<div class="list-banner list-rounded banner-style-2 banner-has-nav pt-3 pt-md-5">
        <div class="container">

		            <!--全屏s-->
            <div class="owl-carousel owl-theme">   	



			        <?php 
$lunbo = $this->options->imghdp;
$hang = explode(",", $lunbo);
$n=count($hang);
$html="";
for($i=0;$i<$n;$i++){
$this->widget('Widget_Archive@lunbo'.$i, 'pageSize=1&type=post', 'cid='.$hang[$i])->to($ji);
if($ji->fields->thumb){$img=$ji->fields->thumb;}
if($i==0){$no=" sx_no";}else{$no="";}
$html=$html.'<div class="card item list-item list-overlay-content m-0"><div class="media media-21x9"><a class="media-content" href="'.$ji->permalink.'" style="background-image:url('.$ji->fields->img.')" ><span class="overlay"></span></a></div><div class="list-content p-3 p-md-5 text-center"><div class="list-body"><a href="'.$ji->permalink.'" target="_blank" class="h4 text-white h-2x m-0">'.$ji->title.'</a> </div></div></div>';
}
echo $html;
?>


                    </div>
					<!--全屏e-->



        </div>
    </div>