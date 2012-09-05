<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'src');
require_once 'ReferralGrabber.php';

/**
 * Simple array compare
 */
function assertEquals($expected, $actual, $message = '') {
    if( $expected != $actual ) {
		$message ? print $message . "\n" : true ;
		print "FAILED asserting that ".json_encode($expected)." is equal to ".json_encode($actual)."\n"; 
    }
}

print "Running test suite\n";

$data = array('source'   => '-',
			  'medium'   => '-',
			  'term'     => '-',
			  'content'  => '-',
			  'campaign' => '-',
			  'gclid'    => '-');

assertEquals($data, ReferralGrabber::parseGoogleCookie(''), 'Empty string');

$data = array('source'   => '-',
			  'medium'   => '(none)',
			  'term'     => '-',
			  'content'  => '-',
			  'campaign' => '-',
			  'gclid'    => '-');

assertEquals($data, ReferralGrabber::parseGoogleCookie('utmcmd=(none)'), 'Single parameter');

$data = array('source'   => 'google',
			  'medium'   => '(none)',
			  'term'     => '-',
			  'content'  => '-',
			  'campaign' => 'camp1',
			  'gclid'    => '-');

assertEquals($data, ReferralGrabber::parseGoogleCookie('utmcsr=google|utmccn=camp1|utmcmd=(none)'), 'Multiple parameters');

$data = array('source'   => 'google',
			  'medium'   => 'cpc',
			  'term'     => '-',
			  'content'  => '-',
			  'campaign' => '-',
			  'gclid'    => '1234567');

assertEquals($data, ReferralGrabber::parseGoogleCookie('utmgclid=1234567'), 'Basic GCLID');

$data = array('source'   => 'google',
			  'medium'   => '(none)',
			  'term'     => '-',
			  'content'  => '-',
			  'campaign' => 'camp1',
			  'gclid'    => '-');

assertEquals($data, ReferralGrabber::parseGoogleCookie('10000000000.0000.1utmcsr=google|utmccn=camp1|utmother2=parameter2|utmcmd=(none)|utmother1=parameter1'), 'Ignore extra junk');

print "Finished running test suite\n";
