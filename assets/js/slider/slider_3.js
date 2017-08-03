class slider_3_classes {

	startslider( images ){
		var num_images = images.length
		$('.slider_3.one').css({ 'background-image': 'url(' + images[0] + ')' })
		$('.slider_3.two').css({ 'background-image': 'url(' + images[1] + ')' })
		if( num_images > 1 ){
			this.wait(images, 1, "one")
		}
	}
	shownext( images, index, classshowing ){
		var num_images = images.length
		$('.slider_3.image').css({'opacity': '1'})
		$('.slider_3.'+classshowing).animate({'opacity': '0'}, function(){
			$('.slider_3.'+classshowing).animate({'z-index': '0'})

			index++
			if( index >= num_images ){
				index=0
			}
			$('.slider_3.'+classshowing).css({ 'background-image': 'url('+images[index]+')' })
			if( classshowing=='one' ){ classshowing='two' }else{ classshowing='one' }
			$('.slider_3.'+classshowing).animate({'z-index': '1'})
			slider_3.wait( images, index, classshowing )
		})
	}
	wait( images, index, classshowing ){
		var num_images = images.length
		setTimeout( function(){
			slider_3.shownext(images, index, classshowing);
		}, 5000 )
	}

}