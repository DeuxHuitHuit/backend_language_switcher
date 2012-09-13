/**
 * Backend language switcher
 *
 * @author John J. Camilleri
 * @version 0.1
 */
(function($) {
$(document).ready(function() {

	for (i in Symphony.Languages) {
		var lang = Symphony.Languages[i];
		$('nav#nav ul.structure').append(
			// Nav menu item
			$('<li />')
				.addClass('backend_language_switcher')
				.addClass(lang)
				.addClass(lang == Symphony.Author.language ? 'selected' : '')
				.addClass(i == 0 ? 'first' : '' )
				.addClass(i == (Symphony.Languages.length-1) ? 'last' : '' )
				.attr({
					'title':'Change to '+lang,
					'lang':lang
				})
				// Flag image
				.append(
					$('<img />')
						.attr({
							'src':Symphony.Context.get('root')+'/extensions/backend_language_switcher/assets/flags/'+lang+'.png',
							'alt':lang.toUpperCase()
						})
				)
				// Click handler - Construct request to change user language
				.click(function(){
					var li = $(this);
					var lang = li.attr('lang');
					var url = Symphony.Context.get('root') + '/symphony/system/authors/edit/' + Symphony.Author.id + '/';
					var data = {
						'action[save]' 				: true,
						'fields[default_section]'	: Symphony.Author.default_section,
						'fields[email]'				: Symphony.Author.email,
						'fields[first_name]'		: Symphony.Author.first_name,
						'fields[last_name]'			: Symphony.Author.last_name,
						'fields[username]'			: Symphony.Author.username,
						'fields[language]'			: lang
					}
					$.post(url, data, function(data, textStatus){
						// Callback function, reload page
						window.location.reload();
					});
				})
		);
	}
		
});
})(jQuery.noConflict());