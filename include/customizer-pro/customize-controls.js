( function( api ) {

	// Extends our custom "log-book" section.
	api.sectionConstructor['log-book'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
