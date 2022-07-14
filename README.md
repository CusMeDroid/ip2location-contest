# IP2Location Contest
Search Website From Domain And Get IP Info With API By IP2Location.

## Demo
*[ip2location](http://cusmedroid.is-best.net/ip2location/)*

# Intro
I created the website info to track where the host is using php, html, css & js language, by retrieving data using API from IP2Location.
> Function $domain = $_GET['domain'];

this is to pull the domain url and change it with $ip = gethostbyname($domain);
> $apiKey = "YOUR API";

> $url = "https://api.ip2location.com/v2/?ip={$ip}&key={$apiKey}&package=WS5";

then see the response to proceed to the data store as history
> isset($data['response']) == 'OK'

On the database I use the domain name as unique so as not to overwrite with the same file name.
