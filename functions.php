function fg_meta_output($atts, $content = null) {
	$a = shortcode_atts([
		'show'	=> 'autor,datum,kommentare',
		'class'	=> '',
	], $atts);
	if(!is_single()) return;
	$show = explode(',', $a["show"]);
	$return_string = '<div class="fg_meta_container ' . $a["class"] . '">';
	foreach($show as $item) {
		switch($item) {
			case 'autor':
				$return_string .= '<div class="author">';
				$avatar = get_avatar( get_the_author_meta( 'ID' ), 70 );
				if($avatar) {
					$return_string .= '<div class="author_image">' . $avatar . '</div>';
				}
				$return_string .= '<div class="author_name">von ' . get_the_author_meta('nickname') . '</div></div> <!-- . author -->';
				break;
			case 'datum':
				$return_string .= '<div class="publish_date">' . get_the_date() . '</div>';
				break;
			case 'kommentare':
				if(comments_open()) $return_string .= '<div class="comments_info"><a href="#respond" title="Kommentare des Beitrags anzeigen">' . get_comments_number() . '</a></div>';
		}
	}
	$return_string .= '</div> <!-- .fg_meta_container -->';
	return $return_string;
}
add_shortcode('fg_single_meta', 'fg_meta_output');