<?php 
/* 
* -------------------------------------------------------------------------------------
* @author: emeza
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.1
*
*/

$register	= get_option('dt_register_note');
$key		= dbmapidata('k');
$domain		= get_option("siteurl");

// Langs
$optionlang	= array(
	"ar-AR" => __d('Arabic (ar-AR)'),
	"bs-BS" => __d('Bosnian (bs-BS)'),
	"bg-BG" => __d('Bulgarian (bg-BG)'),
	"hr-HR" => __d('Croatian (hr-HR)'),
	"cs-CZ" => __d('Czech (cs-CZ)'),
	"da-DK" => __d('Danish (da-DK)'),
	"nl-NL" => __d('Dutch (nl-NL)'),
	"en-US" => __d('English (en-US)'),
	"fi-FI" => __d('Finnish (fi-FI)'),
	"fr-FR" => __d('French (fr-FR)'),
	"de-DE" => __d('German (de-DE)'),
	"el-GR" => __d('Greek (el-GR)'),
	"he-IL" => __d('Hebrew (he-IL)'),
	"hu-HU" => __d('Hungarian (hu-HU)'),
	"is-IS" => __d('Icelandic (is-IS)'),
	"id-ID" => __d('Indonesian (id-ID)'),
	"it-IT" => __d('Italian (it-IT)'),
	"ko-KR" => __d('Korean (ko-KR)'),
	"lb-LB" => __d('Letzeburgesch (lb-LB)'),
	"lt-LT" => __d('Lithuanian (lt-LT)'),
	"zh-CN" => __d('Mandarin (zh-CN)'),
	"fa-IR" => __d('Persian (fa-IR)'),
	"pl-PL" => __d('Polish (pl-PL)'),
	"pt-PT" => __d('Portuguese (pt-PT)'),
	"pt-BR" => __d('Portuguese (pt-BR)'),
	"ro-RO" => __d('Romanian (ro-RO)'),
	"ru-RU" => __d('Russian (ru-RU)'),
	"sk-SK" => __d('Slovak (sk-SK)'),
	"es-ES" => __d('Spanish (es-ES)'),
	"es-MX" => __d('Spanish LA (es-MX)'),
	"sv-SE" => __d('Swedish (sv-SE)'),
	"th-TH" => __d('Thai (th-TH)'),
	"tr-TR" => __d('Turkish (tr-TR)'),
	"tw-TW" => __d('Twi (tw-TW)'),
	"uk-UA" => __d('Ukrainian (uk-UA)'),
	"vi-VN" => __d('Vietnamese (vi-VN)')
);

// Options
$lang		= get_option('dt_api_language');
$tmdbapikey = get_option('dt_api_key');
$tmdbactive	= get_option('dt_activate_api');
$apigenres	= get_option('dt_api_genres');
$apiupload	= get_option('dt_api_upload_poster');
$apirelease	= get_option('dt_api_release_date');
$checked	= 'checked="checked"';
// end PHP data
?>
<div id="dt_importer" class="dt_importer_wrap">
	<header class="dt_importer">
		<div class="box">
			<h1>dbmovies <i>By Doothemes</i></h1>
			<ul>
				<li><a href="https://doothemes.com/forums/" target="_blank"><?php _d('Need Help?'); ?></a></li>
				<li><a href="https://doothemes.com/forums/contacto/" target="_blank"><?php _d('Send us Feedback'); ?></a></li>
				<?php if($register != '1') { ?> 
				<li><a data-action="register" class="register_api"><strong><span class="dashicons dashicons-info"></span> <?php _d('Register API Key'); ?></strong></a></li>
				<?php } ?>
			</ul>
		</div>
	</header><!-- fin header.dt_importer -->
	<div class="dt_importer_contaiter">
		<div class="dt_imp_menu">
			<ul class="tabs">
				<li id="filter_year_li" class="tab-link current" data-tab="tab-1"><?php _d('Filter for year'); ?></li>
				<li id="filter_year_li" class="tab-link" data-tab="tab-0"><?php _d('Search title'); ?></li>
				<li id="single_url_li" class="tab-link" data-tab="tab-2"><?php _d('Import ID'); ?></li>
				<li class="tab-link" data-tab="tab-3"><?php _d('Status'); ?></li>
				<li class="tab-link" data-tab="tab-4"><?php _d('Settings'); ?></li>
			</ul>
			<div id="add_data_post"></div>
		</div><!-- fin div.dt_imp_menu -->
		<div id="api_content" class="content">
			<div id="tab-4" class="tab-content">
				<form method="post" id="dbmovies_settings">
				<div class="settings">
					<fieldset class="form">
						<label for="dbmskey"><?php _d('Dbmovies.org API key'); ?></label>
						<div class="perico">
							<p><input type="text" id="dbmskey" value="<?php echo $key; ?>" readonly></p>
							<p class="desc"><?php _d('Do not share this information, private and non-transferable data'); ?></p>
						</div>
					</fieldset>
					<fieldset class="form">
						<label for=""><?php _d('Enable API TMDb'); ?></label>
						<div class="perico">
							<label><input type="checkbox" <?php echo ($tmdbactive == 'true') ? $checked : ''; ?> name="dt_activate_api" id="dt_activate_api"> <?php _d('Check to enable the API'); ?></label>
							<p class="desc"><?php _d('Set your API on Themoviedb.org API'); ?></p>
						</div>
					</fieldset>
					<fieldset class="form">
						<label for=""><?php _d('Themoviedb.org API key'); ?></label>
						<div class="perico">
							<p><input id="dt_api_key" name="dt_api_key" type="text" value="<?php echo $tmdbapikey; ?>"></p>
							<p class="desc"><?php _d('Add the API key in the text box'); ?></p>
						</div>
					</fieldset>
					<fieldset class="form">
						<label for=""><?php _d('API Language'); ?></label>
						<div class="perico">
							<p>
								<select name="dt_api_language" id="dt_api_language">
								<?php foreach ( $optionlang as $a => $v ) : ?>
								<option value="<?php echo $a; ?>"<?php selected( $lang, $a ); ?>><?php echo $v; ?></option>
								<?php endforeach; ?>
								</select>
							</p>
							<p class="desc"><?php _d('Select language'); ?></p>
						</div>
					</fieldset>
					<fieldset class="form">
						<label for=""><?php _d('API control'); ?></label>
						<div class="perico">
							 <label><input type="checkbox" <?php echo ($apigenres == 'true') ? $checked : ''; ?> name="dt_api_genres" id="dt_api_genres">  <?php _d('Generate genres'); ?></label>
							 <label><input type="checkbox" <?php echo ($apiupload == 'false') ? $checked : ''; ?> name="dt_api_upload_poster" id="dt_api_upload_poster">  <?php _d('Upload poster image'); ?></label>
							 <label><input type="checkbox" <?php echo ($apirelease == 'true') ? $checked : ''; ?> name="dt_api_release_date" id="dt_api_release_date">  <?php _d('Publish content with the release date'); ?></label>
							 <p class="desc"><?php _d('Check to enable.'); ?></p>
						
						</div>
					</fieldset>
					<fieldset class="form">
						<p><input id="save_sdbmvs" type="submit" class="button button-primary" value="<?php _d('Save settings'); ?>"></p>
					</fieldset>
				</div>
				<input type="hidden" name="action" value="dbm_save_settings">
				</form>
			</div>
			<div id="tab-0" class="tab-content">
				<h1 style="margin-top: 0;"><?php _d('Search content'); ?></h1>
				<form id="search_all" class="search_all">
					<div class="box">
						<input type="text" name="query" placeholder="<?php _d('Search a title..'); ?>">
						<button name="search_all_data" type="submit" class="button button-primary"><?php _d('Search'); ?></button>
					</div>
					<label for="page"><input type="number" name="page"></label>
					<label for="movie"><input type="radio" id="movie" name="type" value="movie" required checked> <?php _d('Movies'); ?></label>
					<label for="tvshows"><input type="radio" id="tvshows" name="type" value="tv" required> <?php _d('TV Shows'); ?></label>
					<?php wp_nonce_field('search-all','search-all-nonce') ?>
				</form>
			</div>
			<div id="tab-1" class="tab-content current">
				<section style="padding-left:0">
					<h1 style="margin-top: 0;"><?php _d('Movies'); ?></h1>
					<form id="search_imdb" class="form_importer_dt">
						<p>
						<input type="number" id="imdbyear" name="imdbyear" placeholder="<?php _d('Year'); ?>" min="1930" max="<?php echo date('Y'); ?>" required>
						<input style="margin-right: 0" type="number" id="imdbpage" name="imdbpage" placeholder="<?php _d('Page'); ?>" min="1" required>
						</p>
						<p><input type="submit" class="button button-primary" name="search_data_imdb" value="<?php _d('Get content'); ?>"></p>
						<?php wp_nonce_field('send-imdb','send-imdb-nonce') ?>
					</form>
				</section>
				<section class="right" style="padding-right:0">
					<h1 style="margin-top: 0;"><?php _d('TV Shows'); ?></h1>
					<form id="search_tmdb" class="form_importer_dt">
						<p>
						<input type="number" id="tmdbyear" name="tmdbyear" placeholder="<?php _d('Year'); ?>" min="1930" max="<?php echo date('Y'); ?>" required>
						<input style="margin-right: 0" type="number" id="tmdbpage" name="tmdbpage" placeholder="<?php _d('Page'); ?>" min="1" required>
						</p>
						<p><input type="submit" class="button button-primary" name="search_data_tmdb" value="<?php _d('Get content'); ?>"></p>
						<?php wp_nonce_field('send-tmdb','send-tmdb-nonce') ?>
					</form>
				</section>
				<p class="desc"><?php _d('Get data from Themoviedb.org'); ?></p>
			</div>
			<div id="tab-2" class="tab-content">
				<section>
					<h1 style="margin-top: 0;"><?php _d('Movies'); ?></h1>
					<form id="single_url_imdb" class="form_importer_dt">
						<p><input type="text" name="idmovie" placeholder="<?php _d('ID Movie'); ?>" required></p>
						<p><input type="submit" class="button button-primary" name="send_id_movie" value="<?php _d('Import'); ?>"></p>
						<?php wp_nonce_field('send-movies','send-movies-nonce') ?>
						<p class="desc"><?php _d('Example'); ?>: themoviedb.org/movie/<strong>14564</strong></p>
					</form>
				</section>

				<section class="right">
					<h1 style="margin-top: 0;"><?php _d('TV Shows'); ?></h1>
					<form id="single_url_tmdb" class="form_importer_dt">
						<p><input type="text" name="idtv" placeholder="<?php _d('ID TVShow'); ?>" required></p>
						<p><input type="submit" class="button button-primary" name="send_id_tv" value="<?php _d('Import'); ?>"></p>
						<?php wp_nonce_field('send-series','send-series-nonce') ?>
						<p class="desc"><?php _d('Example'); ?>: themoviedb.org/tv/<strong>1402</strong></p>
					</form>
				</section>
			</div>
			<div id="tab-3" class="tab-content">
				<h1 style="margin-top: 0;"><?php _d('Status of server processes'); ?></h1>
				<div id="result_server"></div>
				<form id="api_status" class="form_importer_dt">
					<?php wp_nonce_field('send-status','send-status-nonce') ?>
					<p><input type="submit" class="button button-primary" value="<?php _d('Check server status'); ?>"></p>
				</form>
			</div>

		</div><!-- fin div.content -->
		<div id="resultado"></div>
		<div class="dbmovies_copy">&copy; <?php echo date('Y'); ?> <a href="https://doothemes.com" target="_blank">doothemes</a></div>
	</div><!-- fin div.dt_importer_contaiter -->
</div><!-- fin div.dt_importer_wrap -->