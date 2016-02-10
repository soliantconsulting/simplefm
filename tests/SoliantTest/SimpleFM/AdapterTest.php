<?php

/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\SimpleFM
 * @copyright Copyright (c) 2007-2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */
namespace SoliantTest\SimpleFM;

use Soliant\SimpleFM\Adapter;
use Soliant\SimpleFM\HostConnection;
use Soliant\SimpleFM\Loader\Curl;
use Soliant\SimpleFM\Loader\Mock as MockLoader;
use Soliant\SimpleFM\Parser\FmLayoutParser;
use Soliant\SimpleFM\Parser\FmResultSetParser;
use Soliant\SimpleFM\Result\FmLayout;
use Soliant\SimpleFM\Result\FmResultSet;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-16 at 22:32:15.
 */
class AdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Adapter
     */
    protected $adapterInstance;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $params=array('hostname'=>'localhost','dbname'=>'testdb','username'=>'Admin','password'=>'');
        $hostConnection = new HostConnection(
            $params['hostname'],
            $params['dbname'],
            $params['username'],
            $params['password']
        );
        $this->adapterInstance = new Adapter($hostConnection);
        $this->adapterInstance->setLoader(new MockLoader());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Soliant\SimpleFM\Adapter::__construct
     */
    public function testConstruct()
    {
        $params = array('hostname'=>'localhost','dbname'=>'testdb','username'=>'Admin','password'=>'');
        $hostConnection = new HostConnection(
            $params['hostname'],
            $params['dbname'],
            $params['username'],
            $params['password']
        );
        $adapter1 = new Adapter($hostConnection);
        $adapter2 = new Adapter($hostConnection);
        $this->assertEquals($adapter1, $adapter2);
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getUri
     * @covers Soliant\SimpleFM\Adapter::useLayoutGrammar
     * @covers Soliant\SimpleFM\Adapter::useResultSetGrammar
     */
    public function testUriMethods()
    {
        $this->adapterInstance->useLayoutGrammar();
        $this->assertEquals(FmLayoutParser::GRAMMAR, $this->adapterInstance->getUri());
        $this->adapterInstance->useResultSetGrammar();
        $this->assertEquals(FmResultSetParser::GRAMMAR, $this->adapterInstance->getUri());
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setHostConnection
     * @covers Soliant\SimpleFM\Adapter::getHostConnection
     */
    public function testGetSetHostConnection()
    {
        $connection = new HostConnection('hostName', 'dbName', 'userName', 'password');
        $this->adapterInstance->setHostConnection($connection);
        $this->assertEquals($connection, $this->adapterInstance->getHostConnection());
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setLoader
     * @covers Soliant\SimpleFM\Adapter::getLoader
     */
    public function testGetSetLoader()
    {
        $loader = new MockLoader(file_get_contents(__DIR__ . '/TestAssets/sample_fmresultset_empty.xml'));
        $this->adapterInstance->setLoader($loader);
        $this->assertEquals($loader, $this->adapterInstance->getLoader());
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setLayoutName
     * @covers Soliant\SimpleFM\Adapter::getLayoutName
     */
    public function testGetSetLayoutName()
    {
        $value = $this->adapterInstance->setLayoutName('tab');
        $this->assertTrue($value instanceof $this->adapterInstance);
        $this->assertEquals($this->adapterInstance->getLayoutName(), 'tab');
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setCommandString
     * @covers Soliant\SimpleFM\Adapter::getCommandString
     */
    public function testGetSetCommandString()
    {
        $value = $this->adapterInstance->setCommandString('A=B&C=D&E=F');
        $this->assertTrue($value instanceof $this->adapterInstance);
        $this->assertEquals($this->adapterInstance->getCommandString(), 'A=B&C=D&E=F');
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setCommandArray
     * @covers Soliant\SimpleFM\Adapter::getCommandArray
     * @covers Soliant\SimpleFM\Adapter::getCommandString
     */
    public function testGetSetCommandArray()
    {
        $commandString = 'A=0&C=D';
        $value = $this->adapterInstance->setCommandString($commandString);
        $this->assertTrue($value instanceof $this->adapterInstance);
        $arr = $this->adapterInstance->getCommandArray();
        $arr1=array('A' => 0,
                    'C' => 'D');
        $this->assertEquals($arr, $arr1);
        $this->assertEquals($commandString, $this->adapterInstance->getCommandString());

        // Thanks @garak for https://github.com/soliantconsulting/SimpleFM/pull/32
        $this->adapterInstance->setCommandArray($arr1);
        $this->assertEquals($commandString, $this->adapterInstance->getCommandString());
    }

    /**
     * @covers Soliant\SimpleFM\HostConnection::setProtocol
     * @covers Soliant\SimpleFM\HostConnection::getProtocol
     */
    public function testGetSetProtocol()
    {
         $value = $this->adapterInstance->getHostConnection()->setProtocol('https');
//         $this->assertTrue($value instanceof $this->adapterInstance);
         $this->assertEquals($this->adapterInstance->getHostConnection()->getProtocol(), 'https');
    }

    /**
     * @covers Soliant\SimpleFM\HostConnection::setSslVerifyPeer
     * @covers Soliant\SimpleFM\HostConnection::getSslVerifyPeer
     */
    public function testGetSetSslVerifyPeer()
    {
        $this->adapterInstance->getHostConnection()->setSslVerifyPeer(true);
        $this->assertTrue($this->adapterInstance->getHostConnection()->getSslVerifyPeer());
        $this->adapterInstance->getHostConnection()->setSslVerifyPeer(false);
        $this->assertFalse($this->adapterInstance->getHostConnection()->getSslVerifyPeer());
    }

    /**
     * @covers Soliant\SimpleFM\HostConnection::setPort
     * @covers Soliant\SimpleFM\HostConnection::getPort
     */
    public function testGetSetPort()
    {
        $value=$this->adapterInstance->getHostConnection()->setPort('8080');
//        $this->assertTrue($value instanceof $this->adapterInstance);
        $this->assertEquals($this->adapterInstance->getHostConnection()->getPort(), '8080');
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::setRowsByRecId
     * @covers Soliant\SimpleFM\Adapter::getRowsByRecId
     */
    public function testGetSetRowsbyrecid()
    {
        $value = $this->adapterInstance->setRowsByRecId('1876612984689092');
        $this->assertTrue($value instanceof $this->adapterInstance);
        $this->assertEquals($this->adapterInstance->getRowsByRecId(), true);
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::getCommandUrlDebug
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::getCommandUrlDebug
     */
    public function testGetSetCommandURLDebug()
    {
         $commandURL = 'http://Admin:[...]@localhost:80/fmi/xml/fmresultset.xml?-db=testdb&-lay=&-findany';
         $this->assertEquals($commandURL, $this->adapterInstance->getCommandUrlDebug());
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::execute
     * @covers Soliant\SimpleFM\Adapter::parseFmResultSet
     */
    public function testExecute()
    {
        $file = dirname(__FILE__) . '/TestAssets/projectsampledata.xml';
        /** @var MockLoader $mockLoader */
        /** @var FmResultSet $result */
        $mockLoader = $this->adapterInstance->getLoader();
        $mockLoader->setTestXml(file_get_contents($file));

        // return three records
        $result = $this->adapterInstance->execute();

        $this->assertEquals($result->getCount(), 3);

        // parsed with rowsbyrecid TRUE
        $this->adapterInstance->setRowsByRecId(true);
        $result = $this->adapterInstance->execute();

        $rows = $result->getRows();
        $this->assertEquals(count($rows[7676]['Tasks']), 1);
        $taskNameField = $rows[7676]['Tasks'][0]['rows'][15001]['Task Name'];
        $this->assertEquals($taskNameField, 'Review mock ups');

        // parsed with rowsbyrecid FALSE (the default behavior)
        $this->adapterInstance->setRowsByRecId(false);
        $result = $this->adapterInstance->execute();

        $rows = $result->getRows();
        $nonRepeatingField = $rows[0]['Status'];
        $this->assertEquals($nonRepeatingField, '4');
        $this->assertInternalType('string', $nonRepeatingField);
        $this->assertNotInternalType('array', $nonRepeatingField);

        $rows = $result->getRows();
        $repeatingField = $rows[0]['Repeating Field'];
        $this->assertInternalType('array', $repeatingField);
        $this->assertNotInternalType('string', $repeatingField);

        $rows = $result->getRows();
        $taskNameField = $rows[1]['Tasks'][0]['rows'][2]['Task Name'];
        $this->assertEquals($taskNameField, 'Complete sketches');
        $this->assertInternalType('string', $taskNameField);
        $this->assertNotInternalType('array', $taskNameField);

        $rows = $result->getRows();
        $taskRepeatingField = $rows[1]['Tasks'][0]['rows'][2]['Repeating Field'];
        $this->assertInternalType('array', $taskRepeatingField);
        $this->assertNotInternalType('string', $taskRepeatingField);

    }

    /**
     * @covers Soliant\SimpleFM\Adapter::execute
     * @covers Soliant\SimpleFM\Adapter::parseFmResultSet
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::hasError
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::getLastErrorResult
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::getLastErrorResultFmResultSet
     */
    public function testExecuteWithParseFmResultSet()
    {
        $file = dirname(__FILE__) . '/TestAssets/sample_fmresultset.xml';
        /** @var MockLoader $mockLoader */
        /** @var FmResultSet $result */
        $mockLoader = $this->adapterInstance->getLoader();
        $mockLoader->setTestXml(file_get_contents($file));

        $this->adapterInstance->useResultSetGrammar();
        $result = $this->adapterInstance->execute();
        $this->assertEquals($result->getCount(), 17);

        $this->adapterInstance->setLoader(new Curl());
        $result = $this->adapterInstance->execute();
        $this->assertEquals($result->getErrorType(), 'PHP');
        $this->assertEquals($result->getCount(), null);
    }

    /**
     * @covers Soliant\SimpleFM\Adapter::execute
     * @covers Soliant\SimpleFM\Adapter::parseFmpXmlLayout
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::hasError
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::getLastErrorResult
     * @covers Soliant\SimpleFM\Loader\AbstractLoader::getLastErrorResultFmLayout
     */
    public function testExecuteWithParseFmpXmlLayout()
    {
        $file = dirname(__FILE__) . '/TestAssets/sample_fmpxmllayout.xml';
        /** @var MockLoader $mockLoader */
        /** @var FmLayout $result */
        $mockLoader = $this->adapterInstance->getLoader();
        $mockLoader->setTestXml(file_get_contents($file));

        $this->adapterInstance->useLayoutGrammar();
        $result = $this->adapterInstance->execute();
        $this->assertEquals($result->getLayout()['name'], 'Projects | Web');

        $this->adapterInstance->setLoader(new Curl());
        $result = $this->adapterInstance->execute();
        $this->assertEquals($result->getErrorType(), 'PHP');
        $this->assertEquals($result->getLayout(), []);
    }
}
