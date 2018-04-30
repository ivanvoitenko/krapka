/*
	almMasonry

	Function to trigger built-in Ajax Load More Masonry

   @param container  object
   @param items      object
   @param selector   string
   @param init       boolean
   @param filtering  boolean
   @since 3.1
*/

let almMasonryInit = true; // flag

let almMasonry = (container, items, selector, init, filtering) => {

	if(!filtering){

		// First Run
		if(almMasonryInit && init){
			almMasonryInit = false;
			container.imagesLoaded( () => {
				items.fadeIn(250);
				container.masonry({
					itemSelector: selector,
				});
				container.masonry('reloadItems');
			});
		}

		// Standard
		else{
			container.append( items ); // Append new items
			container.imagesLoaded( () => {
				items.show();
				container.masonry( 'appended', items );
			});
		}

	} else{
		// Filtering Reset
		container.masonry('destroy'); // destroy masonry
		almMasonryInit = true; // reset almMasonryInit
		container.append( items );
		almMasonry(container, items, selector, true, false);

	}

};
