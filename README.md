referral-grabber-php
====================

A PHP library for reading a website visitor's referral source information (e.g. what ad campaign, keywords a user clicked to come to my website) from their Google Analytics cookie.  Useful for saving this information when, for example, a new user signs up on your website, to later analyze your customer acquisition channels.

Usage
-----

The [Google Analytics](http://analytics.google.com) tracking script must be installed on the site making the request.  See the [documentation](http://support.google.com/analytics/bin/answer.py?hl=en&answer=1008015&topic=1727146&ctx=topic) for more information on the proper installation of Google Analytics.

Include ```ReferralGrabber.php``` in your PHP code, and then call ```$data = ReferralGrabber::parseGoogleCookie($_COOKIE['__utmz']);```  

The returned ```$data``` array will be a map of the keys ```source```, ```medium```, ```term```, ```content```, ```campaign```, ```gclid``` and their respective values.

Recommendations
--------------- 

Save all of these referrer parameters in your users table.  See our blog post about building a killer marketing dashboard using this data at http://blog.rjmetrics.com/?p=855.


Acknowlegements
-----------------

Thanks to Justin Cutroni for laying the groundwork for this code here http://cutroni.com/blog/2009/03/18/updated-integrating-google-analytics-with-a-crm/.

Terms
-----
See LICENSE file for terms of using this library.

RJMetrics retains creative control, spin-off rights, and theme park approval for Mr. Referral Grabber, Baby Referral Grabber, and any other Referral Grabber family character that might eminate therefrom.

