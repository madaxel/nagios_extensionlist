# TYPO3 Extension: Nagios Extensionlist

This [TYPO3](https://typo3.org) extension generates a list of insecure extensions for [EXT:nagios](https://github.com/schams-net/nagios).

## Description

[Nagios](https://nagios.org) is the industry standard in open-source server/service/network monitoring.
This extension can be installed in any (compatible) TYPO3 instance to generate a list of TYPO3 extensions,
which have been marked as *insecure* by the TYPO3 Security Team. The extension list is based on the
list at the [TYPO3 Extension Repository (TER)](https://extensions.typo3.org), which can be downloaded
as a scheduler task in TYPO3.

The format of the list generated by this extension can be used by the `check_typo3.sh` script, to check
for insecure TYPO3 instances. See https://schams.net/nagios for further details.

## System Requirements

* TYPO3 version 10 LTS
* PHP version 7.2, 7.3, or 7.4

## Installation

*(not documented yet)*

## License

(c) 2018-2022 Michael Schams (schams.net), all rights reserved

This software free software; you can redistribute it and/or modify it under the terms of the GNU General
Public License, either version 2 of the License, or any later version. For the full copyright and license
information, please see the documentation that was distributed with this source code.

The GNU General Public License can be found at:  
https://www.gnu.org/licenses/gpl-3.0.html

## Author

Michael Schams <[schams.net](https://schams.net)>
