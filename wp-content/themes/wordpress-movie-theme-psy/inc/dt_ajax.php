<?php
/* POST Episodes ( wp-admin ) AJAX

-------------------------------------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

if(!function_exists('key_links_string')){
	function key_links_string($length = 6) {

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$charactersLength = strlen($characters);

		$randomString = '';

		for ($i = 0; $i < $length; $i++) {

			$randomString .= $characters[rand(0, $charactersLength - 1)];

		}

		return $randomString;

	}

	define('DT_STRING_LINK',key_links_string());

}
function dt_post_episodes_ajax()
{
	if (isset($_GET['episodes_nonce']) and wp_verify_nonce($_GET['episodes_nonce'], 'add_episodes')) {
		if (current_user_can('manage_options')) {
			if (get_option(DT_KEY) !== "valid") {
				if (($_GET["se"] != NULL) && ($_GET["te"] != NULL)) {
					$dtemporada = $_GET["te"];
					$ids = $_GET["se"];
					if (($ids != NULL) && ($dtemporada != NULL)) {
						$urltname = wp_remote_get(tmdburl . "tv/" . $ids . "?&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
						$json2 = wp_remote_retrieve_body($urltname);
						// added By MrQaidi

					$tvshow_postid = get_post_meta($_GET["link"], "tvshow_postid", true);
					$tv_slug = get_post_field('post_name', $tvshow_postid);
					$eps_arr = array();
					// end

						$data2 = json_decode($json2, TRUE);
						$tituloserie = $data2['name'];
						$urltoc = wp_remote_get(tmdburl . "tv/" . $ids . "/season/" . $dtemporada . "?append_to_response=images,trailers&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
						$json1 = wp_remote_retrieve_body($urltoc);
						$data1 = json_decode($json1, TRUE);
						$sdasd = count($data1['episodes']);
						$poster_serie = 'https://image.tmdb.org/t/p/w185' . $data1['poster_path'];
						for ($cont = 1; $cont <= $sdasd; $cont++) {
							$url = wp_remote_get(tmdburl . 'tv/' . $ids . '/season/' . $dtemporada . '/episode/' . $cont . '?append_to_response=images&language=' . tmdblang . '&include_image_language=' . tmdblang . ',null&api_key=' . tmdbkey);
							$json = wp_remote_retrieve_body($url);
							$data = json_decode($json, TRUE);
							$season = $data['season_number'];
							$episode = $data['episode_number'];
							$name = $data['name'];
							$dmtid = 'tv' . DT_STRING_LINK . $data['id'];
							$overview = $data['overview'];
							$year = substr($data['air_date'], 0, 4);
							if ($metadate = $data['air_date']) {
								$air_date = $metadate;
							}
							else {
								$air_date = date('Y-m-d');
							}

							$still_path = 'https://image.tmdb.org/t/p/w780' . $data['still_path'];
							if ($get_img = $data['still_path']) {
								$upload_img = 'https://image.tmdb.org/t/p/w500' . $get_img;
							}

							$crew = $data['crew'];
							$guest_stars = $data['guest_stars'];
							$images = $data['images']["stills"];
							$castor = $img = $cast = $director = $writer = "";
							foreach($crew as $valor) {
								$departamente = $valor['department'];
								if ($valor['profile_path'] == NULL) {
									$valor['profile_path'] = "null";
								}

								if ($departamente == "Directing") {
									$director.= $valor['name'] . ",";
								}

								if ($departamente == "Writing") {
									$writer.= $valor['name'] . ",";
								}
							}
							if(!empty($guest_stars)){
								foreach($guest_stars as $valor1) {
									if ($valor1['profile_path'] == NULL) {
										$valor1['profile_path'] = "null";
									}

									$castor.= $valor1['name'] . ",";
								}								
							}
							
							if(!empty($images)){
								foreach($images as $valor2) {
									$img.= 'https://image.tmdb.org/t/p/w300' . $valor2['file_path'] . "\n";
								}							
							}



							$episode_details = array(
								'post_title' => wp_strip_all_tags(html_entity_decode(($tituloserie) . " " . "Season" . " " . $season . " " . "Episode" . " " . $episode)) ,
								'post_content' => wp_strip_all_tags(html_entity_decode($overview)) ,
								'stars' => $castor,
								'directors' => $director,
								'year' => $year,
								'ids' => $ids,
								'season_number' => $season,
								'episode_number' => $episode,
								'tv_title' => $tituloserie,
								'ep_title' => $name,
								'air_date' => $air_date,
								'imgs' => $img,
								'img_episode' => $still_path,
								'poster_serie' => $poster_serie,
								'dt_string' => $dmtid,
							);		
							
							array_push($eps_arr,$episode_details);
							//sleep for 500 ms
							  sleep(0.50);
							
						}
						

						if(!empty($eps_arr)){
							foreach($eps_arr as $ep_key => $episode ){
								$dt_episodes = array(
									'post_title' => $episode['post_title'] ,
									'post_content' => $episode['post_content'] ,
									'post_status' => 'publish',
									'post_type' => 'episodes',
									'post_author' => 1
								);								
								$post_id = wp_insert_post($dt_episodes);
								wp_set_post_terms($post_id, $episode['stars'], 'gueststar', false);
								wp_set_post_terms($post_id, $episode['directors'], 'director', false);
								wp_set_post_terms($post_id, $episode['year'], 'episodedate', false);
								add_post_meta($post_id, "ids", $episode['ids'] , true);
								add_post_meta($post_id, "temporada", $episode['season_number'] , true);
								add_post_meta($post_id, "episodio", $episode['episode_number'] , true);
								add_post_meta($post_id, "serie", $episode['tv_title'] , true);
								add_post_meta($post_id, "season_number", $episode['season_number'] , true);
								add_post_meta($post_id, "episode_number", $episode['episode_number'], true);
								add_post_meta($post_id, "name", $episode['ep_title'] , true);
								add_post_meta($post_id, "air_date", $episode['air_date'] , true);
								add_post_meta($post_id, "imagenes", $episode['imgs'] , true);
								add_post_meta($post_id, "img_episode", $episode['img_episode'] , true);
								add_post_meta($post_id, "poster_serie", $episode['poster_serie'] , true);
								add_post_meta($post_id, "dt_string", $episode['dt_string'] , true);
								add_post_meta($post_id, "fondo_player", $episode['img_episode'] , true);	
								$ep_number = $episode['episode_number'] - 1;
								$se_number = $dtemporada - 1;
								add_post_meta($tvshow_postid, "_temporadas_" . $se_number . "_episodios_" . $ep_key . "_slug", 'field_58718dccc2bfb', true);
								add_post_meta($tvshow_postid, "temporadas_" . $se_number . "_episodios_" . $ep_key . "_slug", $tv_slug, true);
								add_post_meta($tvshow_postid, "_temporadas_" . $se_number . "_episodios_" . $ep_key . "_titlee", 'field_58718ddac2bfc', true);
								
								add_post_meta($tvshow_postid, "temporadas_" . $se_number . "_episodios_" . $ep_key . "_titlee", $episode['ep_title'], true);								
							}	
						}


						// Start  Added by MrQaidi
						$se_number = $dtemporada - 1;
						update_post_meta($tvshow_postid, "_temporadas", 'field_58718d88c2bf9');
						update_post_meta($tvshow_postid, "_temporadas_" . $se_number . "_episodios", 'field_551980eaa65b6', true);
						update_post_meta($tvshow_postid, "temporadas_" . $se_number . "_episodios", count($eps_arr), true);
						// END

					}

					update_post_meta($_GET["link"], 'clgnrt', '1');
					wp_redirect(get_admin_url() . "edit.php?post_type=seasons");
					exit;
				}
				else {
					echo 'error';
					exit;
				}
			}
			else {
				echo 'invalid license';
				exit;
			}
		}
		else {
			echo 'login';
			exit;
		}
	}

	die();
}

add_action('wp_ajax_episodes_ajax', 'dt_post_episodes_ajax');
add_action('wp_ajax_nopriv_episodes_ajax', 'dt_post_episodes_ajax');
/* POST Episodes ( front-end ) AJAX

/* POST Seasons AJAX

-------------------------------------------------------------------------------

*/

function dt_post_seasons_ajax()
{
	if (isset($_GET['seasons_nonce']) and wp_verify_nonce($_GET['seasons_nonce'], 'add_seasons')) {
		if (current_user_can('manage_options')) {
			if (($_GET["se"] != NULL)) {
				$ids = $_GET["se"];
				if (($ids != NULL)) {
					$urltname = wp_remote_get(tmdburl . "tv/" . $ids . "?&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
					$json2 = wp_remote_retrieve_body($urltname);
					$data2 = json_decode($json2, TRUE);
					$tituloserie = $data2['name'];
					$sdasd = $data2['number_of_seasons'];
					update_post_meta($_GET["link"], "temporadas", $sdasd);
					for ($cont = 1; $cont <= $sdasd; $cont++) {
						$url = wp_remote_get(tmdburl . 'tv/' . $ids . '/season/' . $cont . '?append_to_response=images&language=' . tmdblang . '&include_image_language=' . tmdblang . ',null&api_key=' . tmdbkey);
						$json = wp_remote_retrieve_body($url);
						$data = json_decode($json, TRUE);
						$name = $data['name'];
						$poster_serie = $data['poster_path'];
						if ($get_img = $data['poster_path']) {
							$upload_poster = 'https://image.tmdb.org/t/p/w185' . $get_img;
						}

						$overview = $data['overview'];
						$year = substr($data['air_date'], 0, 4);
						$fecha = $data['air_date'];
						$season_number = $data['season_number'];
						$my_post = array(
							'post_title' => dt_clear($tituloserie . ": " . __d('Season') . " " . $cont) ,
							'post_content' => dt_clear($overview) ,
							'post_status' => 'publish',
							'post_type' => 'seasons',
							'post_author' => 1
						);
						$post_id = wp_insert_post($my_post);
						add_post_meta($post_id, "ids", ($ids) , true);
						add_post_meta($post_id, "temporada", ($season_number) , true);
						add_post_meta($post_id, "serie", ($tituloserie) , true);
						add_post_meta($post_id, "air_date", ($fecha) , true);
						add_post_meta($post_id, "dt_poster", ($poster_serie) , true);
						update_post_meta($post_id, 'tvshow_postid', $_GET["link"]);
						dt_upload_image($upload_poster, $post_id);
						//sleep for 500 ms
						sleep(0.50);
					}
				}

				update_post_meta($_GET["link"], 'clgnrt', '1');

				// /update_field('temporadas', $old_seasons,$_GET["link"]); // Added By mrqaidi

				wp_redirect(get_admin_url() . "edit.php?post_type=seasons");
				exit;
			}
			else {
				echo 'error';
				exit;
			}
		}
		else {
			echo 'login';
			exit;
		}
	}

	die();
}

add_action('wp_ajax_seasons_ajax', 'dt_post_seasons_ajax');
add_action('wp_ajax_nopriv_seasons_ajax', 'dt_post_seasons_ajax');
