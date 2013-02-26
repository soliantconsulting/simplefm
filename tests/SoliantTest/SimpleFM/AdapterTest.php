<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\SimpleFM
 * @copyright Copyright (c) 2007-2013 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace SoliantTest\SimpleFM;

use Soliant\SimpleFM\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-16 at 22:32:15.
 */
class AdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Adapter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Adapter();   
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setHostParams
     * @todo   Implement testSetHostParams().
     */
    public function testSetHostParams()
    {
        $params=array('hostname'=>'127.0.0.1','dbname'=>'testdb','username'=>'root','password'=>'soliant');
        $value = $this->object->setHostParams($params);
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getHostname(),'127.0.0.1');
        $this->assertEquals($this->object->getDbname(),'testdb');
        $this->assertEquals($this->object->getUsername(),'root');
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setCredentials
     * @todo   Implement testSetCredentials().
     */
    public function testSetCredentials()
    {
        $params=array('username'=> 'root' , 'password'=>'soliant');
        $value = $this->object->setCredentials($params);
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getUsername(),'root');           
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setCallParams
     * @todo   Implement testSetCallParams().
     */
    public function testSetCallParams()
    {
        $params=array('layoutname'=> 'tab' , 'commandstring'=>'soliant=consulting');
        $value = $this->object->setCallParams($params);
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getLayoutname(),'tab'); 
        $this->assertEquals($this->object->getCommandstring(),'soliant=consulting');
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getHostname
     * @todo   Implement testGetHostname().
     */
    public function testGetHostname()
    {      	
        $test = $this->object->setHostname('127.0.0.1');
        $this->assertTrue($test instanceof $this->object);
        $this->assertEquals($this->object->getHostname(),'127.0.0.1');
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setHostname
     * @todo   Implement testSetHostname().
     */
    public function testSetHostname()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getUsername
     * @todo   Implement testGetUsername().
     */
    public function testGetUsername()
    {   
    	
    	$test=$this->object->setUsername('root');
    	$this->assertTrue($test instanceof $this->object);
        $this->assertEquals($this->object->getUsername(),'root');   
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setUsername
     * @todo   Implement testSetUsername().
     */
    public function testSetUsername()
    {
    	// Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setPassword
     * @todo   Implement testSetPassword().
     */
    public function testSetPassword()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getDbname
     * @todo   Implement testGetDbname().
     */
    public function testGetDbname()
    {
        $test = $this->object->setDbname('test');
        $this->assertTrue($test instanceof $this->object);
        $this->assertEquals($this->object->getDbname(),'test'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setDbname
     * @todo   Implement testSetDbname().
     */
    public function testSetDbname()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getLayoutname
     * @todo   Implement testGetLayoutname().
     */
    public function testGetLayoutname()
    {
        $value = $this->object->setLayoutname('tab');
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getLayoutname(),'tab'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setLayoutname
     * @todo   Implement testSetLayoutname().
     */
    public function testSetLayoutname()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getCommandstring
     * @todo   Implement testGetCommandstring().
     */
    public function testGetCommandstring()
    {
        $value = $this->object->setCommandstring('A=B&C=D&E=F');
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getCommandstring(),'A=B&C=D&E=F'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getCommandarray
     * @todo   Implement testGetCommandarray().
     */
    public function testGetCommandarray()
    {
        $value = $this->object->setCommandstring('A=B&C=D');
        $this->assertTrue($value instanceof $this->object);
        $arr = $this->object->getCommandarray(); 
        $arr1=array('A' => 'B',
        			'C' => 'D');      
        $this->assertEquals($arr, $arr1);
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setCommandstring
     * @todo   Implement testSetCommandstring().
     */
    public function testSetCommandstring()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setCommandarray
     * @todo   Implement testSetCommandarray().
     */
    public function testSetCommandarray()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getProtocol
     * @todo   Implement testGetProtocol().
     */
    public function testGetProtocol()
    {
         $value = $this->object->setProtocol('https');
         $this->assertTrue($value instanceof $this->object);
         $this->assertEquals($this->object->getProtocol(),'https'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setProtocol
     * @todo   Implement testSetProtocol().
     */
    public function testSetProtocol()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getPort
     * @todo   Implement testGetPort().
     */
    public function testGetPort()
    {
        $value=$this->object->setPort('8080');
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getPort(),'8080'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setPort
     * @todo   Implement testSetPort().
     */
    public function testSetPort()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getFmresultsetUri
     * @todo   Implement testGetFmresultsetUri().
     */
    public function testGetFmresultsetUri()
    {
       
        $value = $this->object->setFmresultsetUri('./abc/fmresult.xml');
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getFmresultsetUri(),'./abc/fmresult.xml'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setFmresultsetUri
     * @todo   Implement testSetFmresultsetUri().
     */
    public function testSetFmresultsetUri()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getFmpxmllayoutUri
     * @todo   Implement testGetFmpxmllayoutUri().
     */
    public function testGetFmpxmllayoutUri()
    {
        $value = $this->object->setFmpxmllayoutUri('./abc/fmlayout.xml');
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getFmpxmllayoutUri(),'./abc/fmlayout.xml'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setFmpxmllayoutUri
     * @todo   Implement testSetFmpxmllayoutUri().
     */
    public function testSetFmpxmllayoutUri()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getRowsbyrecid
     * @todo   Implement testGetRowsbyrecid().
     */
    public function testGetRowsbyrecid()
    {
        $value = $this->object->setRowsbyrecid('1876612984689092');
        $this->assertTrue($value instanceof $this->object);
        $this->assertEquals($this->object->getRowsbyrecid(),'1876612984689092'); 
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setRowsbyrecid
     * @todo   Implement testSetRowsbyrecid().
     */
    public function testSetRowsbyrecid()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::execute
     * @todo   Implement testExecute().
     */
    public function testExecute()
    {
        $url = '/usr/local/zend/apache2/htdocs/SimpleFM/tests/SoliantTest/SimpleFM/TestAssets/projectsampledata.xml';
        $xml = simplexml_load_file($url);
        $sfmresult = array (
            'url' => 'http://Mark:[...]@127.0.0.1/fmi/xml/fmresultset.xml?-db=test&-lay=tab&A=B&C=D&E=F',
            'error'     => null,
            'errortext' => 'file_get_contents(https://127.0.0.1:8080/fmi/xml/fmresultset.xml): failed to open stream: Connection refused',
            'errortype' => 'PHP',
            'count'     => null,
            'fetchsize' => null,
            'rows'      => null
            );
        
        $this->object->setUsername('Mark');
        $this->object->setPassword('soliant');
        $this->object->setDbname('test');
        $this->object->setLayoutname('tab');
        $this->object->setHostname('127.0.0.1');
        $this->object->setPort('8080');
        $this->object->setCommandstring('A=B&C=D&E=F');
        $this->object->setProtocol('https');
        $this->object->setFmpxmllayoutUri('./abc/fmlayout.xml');
        
        $this->assertEquals($this->object->execute(),$sfmresult);
             
    }
    
    public function testParseResult()
    {
        $url = '/usr/local/zend/apache2/htdocs/SimpleFM/tests/SoliantTest/SimpleFM/TestAssets/projectsampledata.xml';
        $xml = simplexml_load_file($url);
        //var_dump($xml);
        $arr = array(
        	     0 => array (
        			'index' => 0,
        			'recid' => 7676,
       				'modid' => 11,
        			'PROJECT ID MATCH FIELD' => '1',
        			'Created By' => 'Tim Thomson',
        			'Creation TimeStamp' => '02/22/2012 17:19:47',
        			'Project Name' => 'Launch web site 9',
        			'Description' => 'myDescription',
        			'Status' => '4',
        			'Status on Screen' => 'Overdue',
        			'Start Date' => '04/13/2011',
        			'Due Date' => '05/02/2012',
        			'Days Remaining' => '0',
       				'Days Elapsed' => '275',
        			'Project Completion' => '.48',
        			'Tag' => 'myTag',
        			'Start Date Project Completion' => '04/13/2011',
        			'Due Date Project Completion' => '05/02/2012',       				
        				'Tasks' => array (
            				'parentindex' => 0,
            				'parentrecid' => 7676,
            				'portalindex' => 0,
           				    'portalrecordcount' => 5,
            					'rows' => array (
									0 => array (
                   				  	 	'index' => 0,
                  						'modid' => 0,
                   						'recid' => 14999,
                   						'Task Name' => 'Site map sketch',
                   						'TASK ID MATCH FIELD' => '2'),
                   					
                					1 => array (
                						'index' => 1,
                    					'modid' => 0,
                   						'recid' => 15000    ,                
                   						'Task Name' => 'Send art to vendor',
                  						'TASK ID MATCH FIELD' => '4'),
                  						
                					2 => array (
                						'index' => 2,
                    					'modid' => 0,
                    					'recid' => 15001,
                   						'Task Name' => 'Review mock ups',
                    					'TASK ID MATCH FIELD' => '5'),
                					3 => array (
                						'index' => 3,
                    					'modid' => 0,
                    					'recid' => 15002,
                   						'Task Name' => 'Write page text',
                   						'TASK ID MATCH FIELD' => '6'),

               						4 => array (
               						'index' => 4,
                    				'modid' => 0,
                    				'recid' => 15003,
                   					'Task Name' => 'New logo art',
                   					'TASK ID MATCH FIELD' => '3')
               						
               						)
            			         )
        			),
        	    
        	     1 => array(
        		    'index' => 1,
        			'recid' => 7677,
        			'modid' => 2,
       				'PROJECT ID MATCH FIELD' => '7',
       				'Created By' => 'Tim Thomson',
       				'Creation TimeStamp' => '02/22/2012 17:19:47',
       				'Project Name' => 'Prototype',
        		    'Description' => 'Build a working prototype of the new product.',
        			'Status' => '',
        			'Status on Screen' => 'Completed',
        			'Start Date' => '',
        			'Due Date' => '',
        			'Days Remaining' => '0',
        		    'Days Elapsed' => '0',
        			'Project Completion' => '',
        			'Tag' => 'manufacturing',
        			'Start Date Project Completion' => '',
        			'Due Date Project Completion' => '',
        			'Tasks' => array (
            				'parentindex' => 1,
            				'parentrecid' => 7677,
            				'portalindex' => 0,
           				    'portalrecordcount' => 5)),
        		    
                 2 => array(
        		    'index' => 2,
        			'recid' => 7678,
       				'modid' => 2,
        			'PROJECT ID MATCH FIELD' => '13',
        			'Created By' => 'Tim Thomson',
        			'Creation TimeStamp' => '02/22/2012 17:19:47',
        			'Project Name' => 'Investor meeting',
        			'Description' => 'This is important.  We need the investors to have confidence.',
        			'Status' => '4',
        			'Status on Screen' => 'Overdue',
        			'Start Date' => '12/12/2011',
        			'Due Date' => '03/22/2012',
        			'Days Remaining' => '0',
       				'Days Elapsed' => '73',
        			'Project Completion' => '.4285714285714286',
        			'Tag' => 'finance',
        			'Start Date Project Completion' => '01/02/2012',
        			'Due Date Project Completion' => '03/22/2012',       				
        				'Tasks' => array (
            				'parentindex' => 2,
            				'parentrecid' => 7678,
            				'portalindex' => 0,
           				    'portalrecordcount' => 5,
            					'rows' => array (
									0 => array (
                   				  	 	'index' => 0,
                  						'modid' => 0,
                   						'recid' => 15004,
                   						'Task Name' => 'Gather requirements',
                   						'TASK ID MATCH FIELD' => '1'),
                   					
                					1 => array (
                						'index' => 1,
                    					'modid' => 0,
                   						'recid' => 15008    ,                
                   						'Task Name' => 'Investor meeting',
                  						'TASK ID MATCH FIELD' => '13'),
                  						
                					2 => array (
                						'index' => 2,
                    					'modid' => 0,
                    					'recid' => 15009,
                   						'Task Name' => 'Final draft of slides',
                    					'TASK ID MATCH FIELD' => '12'),
                    					
                					3 => array (
                						'index' => 3,
                    					'modid' => 0,
                    					'recid' => 15010,
                   						'Task Name' => 'Complete business plan',
                   						'TASK ID MATCH FIELD' => '10'),

               						4 => array (
               							'index' => 4,
                    					'modid' => 0,
                    					'recid' => 15011,
                   						'Task Name' => 'First draft of slides',
                   						'TASK ID MATCH FIELD' => '11'),
                   						
                   					5 => array (
               							'index' => 5,
                    					'modid' => 0,
                    					'recid' => 15012,
                   						'Task Name' => 'Market research',
                   						'TASK ID MATCH FIELD' => '14'),
                   						
                   					6 => array (
               							'index' => 6,
                    					'modid' => 0,
                    					'recid' => 15013,
                   						'Task Name' => 'Competitive analysis',
                   						'TASK ID MATCH FIELD' => '15')
               						
               						)
            			         )
            			         ),
            		          			         
        	     3 => array(
        		    'index' => 3,
        			'recid' => 7707,
        			'modid' => 0,
        			'PROJECT ID MATCH FIELD' => '10',
        			'Created By' => 'Admin',
        			'Creation TimeStamp' => '08/15/2012 23:42:13',
        			'Project Name' => 'myNewProjectName',
        			'Description' => 'myDescription',
        			'Status' => '',
        			'Status on Screen' => 'Completed',
        			'Start Date' => '',
        			'Due Date' => '',
        			'Days Remaining' => '0',
        			'Days Elapsed' => '0',
        			'Project Completion' => '',
       			 	'Tag' => 'myTag',
       			 	'Start Date Project Completion' => '',
       			 	'Due Date Project Completion' => '' ,   				
        				'Tasks' => array (
            				'parentindex' => 3,
            				'parentrecid' => 7707,
            				'portalindex' => 0,
           				    'portalrecordcount' => 5,
            					       						
                        			         )
            			         ),
        	     
        	     4 => array(
        		    'index' => 4,
        			'recid' => 7708,
        			'modid' => 1,
        			'PROJECT ID MATCH FIELD' => '11',
        			'Created By' => 'Admin',
        			'Creation TimeStamp' => '08/16/2012 00:22:48',
        			'Project Name' => 'myNewestProjectName',
        			'Description' => 'myDescription',
        			'Status' => '4',
        			'Status on Screen' => 'Overdue',
        			'Start Date' => '08/16/2012',
        			'Due Date' => '08/17/2012',
        			'Days Remaining' => '0',
        			'Days Elapsed' => '1',
        			'Project Completion' => '.2',
        			'Tag' => 'myTag',
        			'Start Date Project Completion' => '08/16/2012',
        			'Due Date Project Completion' => '08/17/2012'   ,				
        				'Tasks' => array (
            				'parentindex' => 4,
            				'parentrecid' => 7708,
            				'portalindex' => 0,
           				    'portalrecordcount' => 5,
            					'rows' => array (
            					 0 => array (
                   				  	 	'index' => 0,
                  						'modid' => 2,
                   						'recid' => 15099,
                   						'Task Name' => 'Zoink',
                   						'TASK ID MATCH FIELD' => '18'),
               						
               						   ))),); 						     			         
        		        		    
    	$this->assertEquals($this->object->parseResult($xml),$arr);  	
    }
    

    /**
     * @covers Soliant\SimpleFM\Adapter::displayXmlError
     * @todo   Implement testDisplayXmlError().
     */
    public function testDisplayXmlError()
    {
        $url= '/usr/local/zend/apache2/htdocs/SimpleFM/tests/SoliantTest/SimpleFM/TestAssets/sample.xml';
        $xml = simplexml_load_file($url);		
        $errors = libxml_get_errors();
		//$error = XML_ERR_TAG_NAME_MISMATCH;
        var_dump($errors);
        $string = '
----------------------------------------------^
Fatal Error 76: Opening and ending tag mismatch: titles line 4 and title
  Line: 4
  Column: 46
  File: /usr/local/zend/apache2/htdocs/SimpleFM/tests/SoliantTest/SimpleFM/TestAssets/sample.xml

--------------------------------------------

';
        foreach ($errors as $error) {
			$this->assertEquals($this->object->displayXmlError($error,$xml),$string);	
		}
      }  
        
    
    /**
     * @covers Soliant\SimpleFM\Adapter::extractErrorFromPhpMessage
     * @todo   Implement testExtractErrorFromPhpMessage().
     */
    public function testExtractErrorFromPhpMessage()
    {
    	$return = array('error' => '401' , 'errortext' => 'Unauthorized' , 'errortype' => 'HTTP');
        $string = 'HTTP/1.1 401 Unauthorized';
        $this->assertEquals($this->object->extractErrorFromPhpMessage($string) , $return);
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::errorToEnglish
     * @todo   Implement testErrorToEnglish().
     */
    public function testErrorToEnglish()
    {
    	$error = array( 0 => 'No Error', 10 => 'Requested data is missing');
        $this->assertEquals($this->object->errorToEnglish(10),'Requested data is missing');    
    }
}
