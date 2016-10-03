<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("webservice") || !CModule::IncludeModule("iblock"))
    return;
//require_once('fb.php');
//require_once('FirePHP.class.php');


// наш новый класс наследуетсЯ от базового IWebService
class CPutParamWS extends IWebService
{
    function putFile( $MassOfByte,  $FileName,  $PosNumber)
    {
        //FB::log('Log there');
        //FB::info('Info message');
        //FB::warn('Warn message');
        //FB::error('Error message');

        chdir('C:\Bitrix\www\bitrix\components\es\SoapWsphp');
        //chdir($_SERVER["DOCUMENT_ROOT"]."/image3.jpg");
        $file = fopen('image3.jpg', 'w');
        $rec=fwrite($file,$MassOfByte);
        fclose($file);

        $mess = 'OK';

        return array("id"=>$mess);
    }



    function putFile2( $iblock, $params)
    {

        $arReturn = array('result'=>'OK','error'=>0);
        define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
        AddMessage2Log(print_r($params, true), "webservice");
        foreach ($params as $value)
        {
            CIBlockElement::SetPropertyValuesEx
            (
                $value['element'],
                $iblock,
                array($value['code'],$value['val'])
            );
        }

        $mess = 'OK';
        $arReturn['result'] = $mess;
        $arReturn['error'] = '0';

        return $arReturn;
    }






    // метод GetWebServiceDesc возвращает описание сервиса и его методов
    function GetWebServiceDesc()
    {
        $wsdesc = new CWebServiceDesc();
        $wsdesc->wsname = "bitrix.webservice.putFile"; // название сервиса
        $wsdesc->wsclassname = "CPutParamWS"; // название класса
        $wsdesc->wsdlauto = true;
        $wsdesc->wsendpoint = CWebService::GetDefaultEndpoint();
        $wsdesc->wstargetns = CWebService::GetDefaultTargetNS();
        $wsdesc->classTypes = array();
        $wsdesc->structTypes = Array();
        //$wsdesc->classes = array();
        $wsdesc->classes = array
        (
            "CPutParamWS"=> array
            (
                "putFile" => array
                (
                    "type"      => "public",
                    "input"      => array
                    (
                        "MassOfByte" => array("varType" => "base64Binary", "strict" => "no"),
                        "FileName" => array("varType" => "string", "strict" => "no"),
                        "PosNumber" => array("varType" => "string", "strict" => "no"),
                    ),
                    "output"   => array
                    (
                        "id" =>array("varType" => "string", "strict" => "no")
                    ),
                    "httpauth" => "N"
                ),
            )
        );
        return $wsdesc;
    }
}

$arParams["WEBSERVICE_NAME"] = "bitrix.webservice.putFile";
$arParams["WEBSERVICE_CLASS"] = "CPutParamWS";
$arParams["WEBSERVICE_MODULE"] = "";



// передаем в компонент описание веб-сервиса
$APPLICATION->IncludeComponent(
    "bitrix:webservice.server",
    "",
    $arParams
);
die();
?>