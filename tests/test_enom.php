<?php

define('INCLUDE_STEPS', 'unitTest');
require_once dirname(__FILE__) . '/../../../../common/common.js';
require_once dirname(__FILE__) . '/../plugin.enom.php';

$this->settings->set('plugin_enom_Use testing server',  true);

/**
* @package Clientexec
*/
class TestEnom extends UnitTestCase
{
    var $arguments = array(
            'command'                       => 'purchase',
            'uid'                           => '',
            'pw'                            => '',
            'tld'                           => 'com',
            'NumYears'                      => '1',
            'Renewname'                     => '1',
            'RegistrantOrganizationName'    => 'TestOrgName Inc.',
            'RegistrantFirstName'           => 'TestFirstName',
            'RegistrantLastName'            => 'TestLastName',
            'RegistrantEmailAddress'        => 'TestFirstName@mailinator.com',
            'RegistrantPhone'               => '5555555',
            'RegistrantAddress1'            => '123 5th street',
            'RegistrantCity'                => 'New York',
            //'RegistrantStateProvinceChoice' => $params['RegistrantStateProvinceChoice'],
            'RegistrantStateProvince'       => 'NY',
            'RegistrantPostalCode'          => '12345',
            'RegistrantCountry'             => 'US',
        );

    function TestEnom()
    {
        $this->UnitTestCase();
        $this->arguments['sld'] = $this->_generateRandomSLD();
    }

/*    function testGetSupportedTLDs()
    {
        $arguments = array(
            'uid'           => $this->arguments['uid'],
            'pw'            => $this->arguments['pw'],
        );
        $result = plugin_enom_getSupportedTLDs($arguments);
        $this->assertIsA($result, 'Array');
    }

    function testValidatePhone()
    {
        $tests = array(
            array('3452354', 'US', '+1.3452354'),
            array('13452354', 'US', '+1.3452354'),
            array('555-4444', 'US', '+1.5554444'),
            array('234554', 'CO', '+57.234554'),
            array('57234554', 'CO', '+57.234554'),
            array('571-234554', 'CO', '+57.1234554'),
        );
        foreach ($tests as $test) {
            $phone = _plugin_enom_validatePhone($test[0], $test[1]);
            $this->assertTrue($phone == $test[2]);
        }
    }

    function testGetExtAttributesCom()
    {
        $response = plugin_enom_getExtAttributes($this->arguments);
    }

    function testGetExtAttributesCA()
    {
        $arguments = array_merge($this->arguments, array(
            'tld'      => 'ca',
        ));
        $response = plugin_enom_getExtAttributes($arguments);
        print_r($response);
    }
    
    function testRegisterDomainCom()
    {
        $response = plugin_enom_register_domain($this->arguments);
        $this->assertIsA($response, 'array');
        $this->assertTrue(@count($response) == 1);
        $this->assertTrue($response[0] != 0);
    }

    function testRegisterDomainUs()
    {
        $this->arguments = array_merge($this->arguments, array(
            'tld'                   => 'us',
            'ExtendedAttributes'   => array(
                                            'us_nexus'  => 'C11',
                                            'us_purpose'    => 'P3',
                                        ),
        ));
        $response = plugin_enom_register_domain($this->arguments);
        $this->assertIsA($response, 'array');
        $this->assertTrue(@count($response) == 1);
        $this->assertTrue($response[0] != 0);
    }*/

    function testRegisterDomainCoUk()
    {
        $this->arguments = array_merge($this->arguments, array(
            'tld'                   => 'co.uk',
            'ExtendedAttributes'   => array(
                                            'registered_for'  => 'arandomname',
                                            'uk_legal_type'   => 'FCORP',
                                            'NumYears'        => 2,
                                        ),
        ));
        $response = plugin_enom_register_domain($this->arguments);
        $this->assertIsA($response, 'array');
        $this->assertTrue(@count($response) == 1);
        $this->assertTrue($response[0] != 0);
    }

    function _generateRandomSLD()
    {
        $sld = '';
        for ($i = 1; $i <= 15; $i++) {
            $sld .= chr(rand(97,122));
        }

        return $sld;
    }
}

$test = new TestEnom();
$test->run(new Reporter_CE());

?>
