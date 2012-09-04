<?php 

class ReferralGrabber {

	public static function strExtractBetween($haystack, $start, $end) {
	    if (!$haystack || $haystack=="" || !$start || $start=="" || !$end || $end=="") 
		return "-";
	    
	    $iStart = $iEnd = $iOffset = $out = "-";

	    $iStart = strpos($haystack, $start);
	    $iOffset = strpos($start, "=") + 1;
	    if ($iStart > -1) {
		$iEnd = strpos($haystack, $end, $iStart);
		if ($iEnd === FALSE) { 
		    $out = substr($haystack, ($iStart + $iOffset)); 
		} else {
		    $out = substr($haystack, ($iStart + $iOffset), $iEnd - ($iStart + $iOffset)); 
		}
	    }
	    return $out;
	}

	public static function parseGoogleCookie($cookieString) {
		$data = array();
		$data['source'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'utmcsr=', '|');
		$data['medium'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'utmcmd=', '|');
		$data['term'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'utmctr=', '|');
		$data['content'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'utmcct=', '|');
		$data['campaign'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'utmccn=', '|');
		$data['gclid'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'utmgclid=', '|');

		//special provision: gclid will be set alone, but always indicates google cpc
		if($data['gclid'] != '-') {
			$data['source'] = 'google';
			$data['medium'] = 'cpc';
		}
		return $data;
	}

	public static function parseHubspotCookie($cookieString) {
		$data = array();
		$data['source'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'ptmcsr=', '|');
		$data['medium'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'ptmcmd=', '|');
		$data['term'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'ptmctr=', '|');
		$data['content'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'ptmcct=', '|');
		$data['campaign'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'ptmccn=', '|');
		$data['gclid'] = AnalyticsCookieParser::strExtractBetween($cookieString, 'ptmgclid=', '|');
		
		//special provision: gclid will be set alone, but always indicates google cpc
		if($data['gclid'] != '-') {
			$data['source'] = 'google';
			$data['medium'] = 'cpc';
		}
		return $data;
	}



}