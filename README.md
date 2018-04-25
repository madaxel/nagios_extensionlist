# TYPO3 Extension: Nagios Extensionlist

Extension for the open-source enterprise content management system [TYPO3](https://typo3.org) to
generate a list of all extensions marked as "*insecure*" for [EXT:nagios](https://github.com/schams-net/nagios).

## Description

[Nagios](https://nagios.org) is the industry standard in open-source server/service/network monitoring.
This extension can be installed in any (compatible) TYPO3 instance to generate a list of TYPO3 extensions,
which have been marked as *insecure* by the TYPO3 Security Team. The extension list is based on the
list at the [TYPO3 Extension Repository (TER)](https://extensions.typo3.org), which can be downloaded
as a scheduler task in TYPO3.

The format of the list generated by this extension can be used by the `check_typo3.sh` script, to check
for insecure TYPO3 instances. See https://schams.net/nagios for further details.

## Documentation

*(not available yet)*

## System Requirements

* TYPO3 version 7.6 or 8.x
* PHP version 5.6 or 7.0

## License

(c) 2018 Michael Schams (schams.net), all rights reserved

This software free software; you can redistribute it and/or modify it under the terms of the GNU General
Public License, either version 2 of the License, or any later version. For the full copyright and license
information, please see the documentation that was distributed with this source code.

The GNU General Public License can be found at:  
http://www.gnu.org/copyleft/gpl.html

## Author

Michael Schams <[schams.net]{https://schams.net)>
