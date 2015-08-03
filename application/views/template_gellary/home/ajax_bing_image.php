<?php 

	foreach($result->d->results as $item)
	{ //echo "<pre>"; print_r($item); exit;
		$item_image=$item->Thumbnail->MediaUrl;
		$media_url=$item->MediaUrl;
		?>
		<img src="<?php echo $item_image; ?>" data-url="<?php echo $media_url; ?>" data-source="bing" data-image-name="<?php echo $item_image; ?>"  />
		<?php 
	}

?>