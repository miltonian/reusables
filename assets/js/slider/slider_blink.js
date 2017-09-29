class slider_blink_classes {

	startslider( images ){
		var num_images = images.length
		$('.slider_blink.one').css({ 'background-image': 'url(' + images[0]['imagepath'] + ')' })
		$('.slider_blink.two').css({ 'background-image': 'url(' + images[1]['imagepath'] + ')' })
		if( num_images > 1 ){
			this.wait(images, 1, "one")
		}
	}
	shownext( images, index, classshowing ){
		var num_images = images.length
		$('.slider_blink.image').css({'opacity': '1'})
		$('.slider_blink.'+classshowing).animate({'opacity': '0'}, function(){
			$('.slider_blink.'+classshowing).animate({'z-index': '0'})

			index++
			if( index >= num_images ){
				index=0
			}
			$('.slider_blink.'+classshowing).css({ 'background-image': 'url('+images[index]['imagepath']+')' })
			if( classshowing=='one' ){ classshowing='two' }else{ classshowing='one' }
			$('.slider_blink.'+classshowing).animate({'z-index': '1'})
			slider_blink.wait( images, index, classshowing )
		})
	}
	wait( images, index, classshowing ){
		var num_images = images.length
		setTimeout( function(){
			slider_blink.shownext(images, index, classshowing);
		}, 5000 )
	}

}