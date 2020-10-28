<?php 
  Header("Cache-control: private, no-cache");
  Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); # Past date
  Header("Pragma: no-cache");
  
  $opts = array('http' => array(
    'method' => "GET",
    'header' =>
    "Content-Type: application/x-www-form-urlencoded\r\n",
  ));
  
  $ActionVal=$_POST["ActionVal"];
  
  if($ActionVal==2)
  {
    $GymName=$_POST["GymName"];
    $context = stream_context_create($opts);
    $result = file_get_contents("http://13.233.29.39:8012/getAllGymByCity/".$GymName."", false, $context);
    $getAllGymByCity = json_decode($result, true);
  
    if(count($getAllGymByCity["data"]) > 0)
     {
       $dataVal=$getAllGymByCity["data"];
       for($i=0;$i<count($dataVal);$i++)
        {
?>

<div class="dt-sc-one-column column blog-thumb with-sidebar">
			<article id="post-322" class="blog-entry post-330 post type-post status-publish format-image has-post-thumbnail hentry category-strength-endurance category-workout post_format-post-format-image">
				<div class="blog-entry-inner">
					<div class="entry-thumb">								 
					<a href="#" title="Aurozen"><img src="<?php echo $dataVal[$i]["gymPhotos"][0]["fileName"];?>" class="attachment-blog-thumb-sidebar size-blog-thumb-sidebar wp-post-image" alt="" title="Aurozen" style="width:500px;height:250px;object-fit:cover;object-position:center center;"/>									

					<div class="blog-overlay"><span class="image-overlay-inside"></span></div>
								  </a>                           
								  <div class="entry-meta">
								  <div class="date">
            <span>4.00</span> 
            <br>Reviews 
          </div>
        </div>					</div>
					<div class="entry-metadata"><p class="tags"><a href="#" rel="category tag"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; <?php echo $dataVal[$i]["gymCity"]; ?></a></p>						
					
					<h4><a href="#" title="Aurozen"><?php echo $dataVal[$i]["gymName"]; ?></a></h4>
						<p style="font-size:16px !important;text-align:left;"><strong>Address - </strong><?php echo trim($dataVal[$i]["gymAddress"]); ?></p>						
					</div>
				</div>
			</article>
		</div>	

<?php } } } ?>