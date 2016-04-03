<?void();

$MapSubmitted=0;

if ($USE_GOOGLE_SITEMAPS) {
  $url='www.google.com/webmasters/sitemaps/ping?sitemap='.
	to_url("$URL_HEADER/sitemap.xml");
  if (is_string(@file_get_contents($url)) ||
	is_string(_LOAD_DATA($url)) ) $MapSubmitted=1;
  }

?>