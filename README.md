# PHPLOC-xmlToHtmlReport


## Notice
If errors in phploc Report Types "cli | txt | csv" occur or, if necessary, an HTML report is desired, this extension can be used. 
PHPLOC-xmlToHtmlReport converts xml phploc reports into HTML reports.

## Features

- Create HTML offline report for phploc by using xml phploc report

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
php composer require --prefer-dist linslin/phploc-xmltohtmlreport "*"
```

## Screenshots

![ScreenShot](https://raw.githubusercontent.com/linslin/phploc-xmlToHtmlReport/master/art/screen1.png)


## Run via binary
```
vendor/bin/phpLocXmlToHtml --importFilePath ./test/phploc.xml --outputPath ./test
```

## Run with Phing

1. Modify build.xml and ad ad-hoc: (this is on way you can run this script) Note: run adhoc-task after phploc ;)
```xml
<?xml version="1.0" encoding="UTF-8" ?>
<project name="MyProject" default="hello">

    <!-- ============================================  -->
    <!-- Exemple release                              -->
    <!-- ============================================  -->
    <target name="example">
    
       <!--  create report dir -->
       <mkdir dir="reports/" />
       <mkdir dir="reports/phploc" />
       
        <!-- phploc -->
        <echo msg="--- Start phploc - measuring the size of a PHP project. ---" />
        <phploc reportType="xml" reportName="phpLoc" reportDirectory="${phing.dir}/reports" countTests="true">
            <fileset dir="../app">
                <include name="**/*.php" />
            </fileset>
        </phploc>
        <echo msg="--- End phploc ---" />
    
        <!--  create phploc html report -->
        <phplocXmlToHtml/>
    <target> 
        

    <adhoc-task name="phplocXmlToHtml"><![CDATA[
    class phplocXmlToHtmlTast extends Task {
          function main() {
          
             require_once 'lib/phploc-xmlToHtmlReport/app/phplocXmlToHtml.php';
             $phplocXmlToHtml = new phplocXmlToHtml();
             $phplocXmlToHtml->baseDir = getcwd().'/lib/phploc-xmlToHtmlReport/app'; // absolute/relative path of lib.
             $phplocXmlToHtml->xmlReportFilePath = getcwd().'/reports/phpLoc.xml'; //input dir of phploc xml report
             $phplocXmlToHtml->reportToDir = getcwd().'/reports/html/'; //output of dir of HTML Report
             $phplocXmlToHtml->generate();
          }
      }
    ]]></adhoc-task>
</project> 
```

2. A HTML-Report "index.html" will be created in build/reports/phploc/


## Tested with

- TeamCity CI 8.XX, Phing 2.6.1 & PHPUnit 1.3.2, Atlassian Bamboo 5

## License
PHPLOC-xmlToHtmlReport is released under GNU (GPL-3.0) license.
