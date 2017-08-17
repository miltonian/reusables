cd ../
if [ ! -d "custom" ]; then
	# Control will enter here if $DIRECTORY doesn't exist.
	mkdir custom
	cd custom
		mkdir css
		mkdir data
		mkdir images
		mkdir reusables
		mkdir uploads
		mkdir views

	cd css
		mkdir pages
		mkdir views

	cd ../reusables
		mkdir css
		mkdir download
		mkdir images
		mkdir js
		mkdir views
		mkdir zips

		cd css
			mkdir pages
			mkdir views

		cd ../js
			mkdir before

	cd ../../uploads
		mkdir ads
		mkdir icons
		mkdir thumbs_large
		mkdir thumbs_med
		mkdir thumbs_small
		
fi