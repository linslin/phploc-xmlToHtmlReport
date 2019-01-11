<?php
/**
 * PHPLOC xmlToHtmlReport converter
 *
 * @category  PHPLOC-xmlToHtmlReport
 * @package   xmlToHtmlReport
 * @author    Nils Gajsek <nils.gajsek@glanzkinder.com>
 * @copyright 2013-2014 Nils Gajsek
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   1.0
 * @link      https://github.com/linslin
 *
 */

require 'lib/functions.php';


/**
 * Class phpLocXmlToHtml
 */
class phpLocXmlToHtml
{


    // ############################################# class vars ########################################################

    /**
     * Input phploc based
     * @var string
     */
    public $xmlReportFilePath = '';

    /**
     * Report directory. Directory to create report in
     * @var string
     */
    public $reportToDir = 'reports//phploc';

    /**
     * Absolut path of base phplocXmlToHtml.php dir
     * @var string
     */
    public $baseDir = '';

    /**
     * Collected xml elements
     * @var SimpleXMLElement
     */
    private $_reports = null;

    /**
     * The generated html report string
     * @var string
     */
    private $_htmlReport = '';


    // ################################################ class methods ##################################################

    /**
     * Public class constructor
     */
    public function __construct()
    {
        $reflection = new \ReflectionClass(__CLASS__);
        $this->baseDir = dirname(dirname($reflection->getFileName()));
    }


    /**
     * Generate report
     */
    public function generate()
    {
        //run collect
        $this->collectReport();

        //load tmpl
        if (file_exists($this->baseDir.'/app/ressources/template/default.html')) {

            //load html template
            $template = file_get_contents($this->baseDir.'/app/ressources/template/default.html');
            $itemsHtml = '';

            if (!empty($this->_reports)) {
                foreach(xml2array_parse($this->_reports) as $itemId => $itemValue){
                    $itemsHtml .= '<tr><td class="no-border">';
                    $itemsHtml .= htmlentities($itemId);
                    $itemsHtml .= file_exists($this->baseDir .'/app/ressources/img/icons/'.strtolower($itemId).'.png') ? ' <img src="img/icons/'.strtolower($itemId).'.png" alt="'.strtolower($itemId).'" height="35" />' : '';
                    $itemsHtml .= '</td><td>';
                    $itemsHtml .= htmlentities($itemValue);
                    $itemsHtml .= '</td></tr>'."\n";
                }
            } else {
                $itemsHtml = '<tr><td colspan="2">Report is empty</td><tr>';
            }

            //set and put record
            $this->_htmlReport = str_replace("{DEFAULT:REPORT:ITEMS}", $itemsHtml, $template);
            $this->putReport();
        }
    }


    /**
     * Try to collect report
     *
     * @return mixed false|SimpleXMLElement
     */
    private function collectReport()
    {
        //does the report file exist?
        if (file_exists($this->xmlReportFilePath)) {
            $this->_reports = new SimpleXMLElement(file_get_contents($this->xmlReportFilePath)); //open xml report
        } else {
            echo 'No Reports found for phplocXmlToHtml in '.$this->xmlReportFilePath."\n";
        }
    }


    /**
     * Put record
     */
    private function putReport(){
        //create report and copy resources
        file_put_contents($this->reportToDir.'/index.html', $this->_htmlReport);
        recurse_copy($this->baseDir.'/app/ressources/img/', $this->reportToDir.'/img');
    }
}
