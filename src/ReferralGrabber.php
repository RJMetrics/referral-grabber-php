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
		$data['source'] = ReferralGrabber::strExtractBetween($cookieString, 'utmcsr=', '|');
		$data['medium'] = ReferralGrabber::strExtractBetween($cookieString, 'utmcmd=', '|');
		$data['term'] = ReferralGrabber::strExtractBetween($cookieString, 'utmctr=', '|');
		$data['content'] = ReferralGrabber::strExtractBetween($cookieString, 'utmcct=', '|');
		$data['campaign'] = ReferralGrabber::strExtractBetween($cookieString, 'utmccn=', '|');
		$data['gclid'] = ReferralGrabber::strExtractBetween($cookieString, 'utmgclid=', '|');

		//special provision: gclid will be set alone, but always indicates google cpc
		if($data['gclid'] != '-') {
			$data['source'] = 'google';
			$data['medium'] = 'cpc';
		}
		return $data;
	}

	public static function parseHubspotCookie($cookieString) {
		$data = array();
		$data['source'] = ReferralGrabber::strExtractBetween($cookieString, 'ptmcsr=', '|');
		$data['medium'] = ReferralGrabber::strExtractBetween($cookieString, 'ptmcmd=', '|');
		$data['term'] = ReferralGrabber::strExtractBetween($cookieString, 'ptmctr=', '|');
		$data['content'] = ReferralGrabber::strExtractBetween($cookieString, 'ptmcct=', '|');
		$data['campaign'] = ReferralGrabber::strExtractBetween($cookieString, 'ptmccn=', '|');
		$data['gclid'] = ReferralGrabber::strExtractBetween($cookieString, 'ptmgclid=', '|');
		
		//special provision: gclid will be set alone, but always indicates google cpc
		if($data['gclid'] != '-') {
			$data['source'] = 'google';
			$data['medium'] = 'cpc';
		}
		return $data;
	}



}