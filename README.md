# PHPLOC-xmlToHtmlReport


## Notice
If errors in phploc Report Types "cli | txt | csv" occur or, if necessary, an HTML report is desired, this extension can be used. 
PHPLOC-xmlToHtmlReport converts xml phploc reports into HTML reports.

## Features

- Create HTML offline report for phploc by using xml phploc report

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
composer require --prefer-dist linslin/phploc-xmltohtmlreport "*"
```

## Run via binary
```
vendor/bin/phpLocXmlToHtml --importFilePath ./test/phploc.xml --outputPath ./test
```


## Screenshots

![ScreenShot](https://raw.githubusercontent.com/linslin/phploc-xmlToHtmlReport/master/art/screen1.png)




## Tested with

- TeamCity CI 8.XX, Phing 2.6.1 & PHPUnit 1.3.2, Atlassian Bamboo 5

## License
PHPLOC-xmlToHtmlReport is released under GNU (GPL-3.0) license.
