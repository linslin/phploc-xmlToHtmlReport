# PHPLOC-xmlToHtmlReport
=======================

## Notice
If errors in phploc Report Types "cli | txt | csv" occur or, if necessary, an HTML report is desired, this extension can be used. 
PHPLOC-xmlToHtmlReport converts xml phploc reports into HTML reports.

## Features

- Create HTML offline report for phploc by using xml phploc report

## Screenshots

![ScreenShot](https://raw2.github.com/linslin/phploc-xmlToHtmlReport/development/art/screen1.png)

## Tested with

- TeamCity CI 8.XX, Phing 2.6.1 & PHPUnit 1.3.2

## Install & configuration with Phing

1. Checkout https://github.com/linslin/phploc-xmlToHtmlReport into build/lib/
2. Modify build.xml and ad ad-hoc: (this is on way you can run this script) Note: run adhoc-task after phploc ;)
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
             $phplocXmlToHtml->baseDir = getcwd().'/lib/phploc-xmlToHtmlReport/app';
             $phplocXmlToHtml->xmlReportFilePath = getcwd().'/reports/phpLoc.xml';
             $phplocXmlToHtml->generate();
          }
      }
    ]]></adhoc-task>
</project> 
```

3. A HTML-Report "index.html" will be created in build/reports/phploc/

## License
PHPLOC-xmlToHtmlReport is released under GNU (GPL-3.0) license.