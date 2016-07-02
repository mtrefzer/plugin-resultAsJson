## **What is phpMussel?**

An ideal solution for shared hosting environments, where it's often not possible to utilise or install conventional anti-virus protection solutions, phpMussel is a PHP script designed to **detect trojans, viruses, malware and other threats** within files uploaded to your system wherever the script is hooked, based on the signatures of [ClamAV](http://www.clamav.net/) and others.

---

## **What's this repository for?**

This repository, "plugin-resultAsJson", is the repository for a phpMussel plugin that allows you receive the detection output in JSON format.

The core phpMussel repository: [phpMussel](https://github.com/Maikuolan/phpMussel).

---

## **How to install?**

Add the following section to your `phpmussel.ini` file and edit accordingly:

```ini
[resultAsJson]
; Output the result as JSON, default = false
use_json=true
; If this value is set, the plugin checks if a request parameter with this name exists. 
; Finding the parameter, the json output is sent. If the parameter is missing
; the usual html response is sent.
; If this value is empty, always json is used for the response.
use_json_flag='phpmussel'
```

Upload the "resultAsJson" directory of this repository and all its contents to the "plugins" directory of your phpMussel installation (the "plugins" directory is a sub-directory of the "vault" directory).

Instead of the html result you receive JSON:

```json
{ 
	"origin" : "IP address",
	"objects_scanned" : 1,
	"detections_count" : 1,
	"scan_errors" : 0,
	"killdata" : "MD5 signature reconstruction (File-HASH:File-Size:File-Name)",
	"detections" : "text whyflagged" 
}
```

That's everything! :-)

---

*This file, "README.md", last edited: 29th June 2016 (2016.06.29).*
