<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("webservice") || !CModule::IncludeModule("iblock"))
    return;

require_once('fb.php');
require_once('FirePHP.class.php');

// наш новый класс наследуетсЯ от базового IWebService
class CPutParamWS extends IWebService
{
    function putFile( $MassOfByte,  $FileName,  $PosNumber)
    {
        //FB::log('Log there');
        //FB::info('Info message');
        //FB::warn('Warn message');
        //FB::error('Error message');

        //создали/очистили файл и открыли его для записи
        //$handler = fopen($filename, "w");

       // FB::log($handler);

        //fwrite($handler, $MassOfByte);

        //чтобы записать данные реально на диск, нужно либо
        //закрыть файл или выполнить ф-цию fflush()
        //fflush($handler);

        //переместили указатель файла в самое начало
        //fseek($handler, 0);

        //читаем все данные из файла
        //$text = fread($handler, filesize($filename));

        //FB::log($text);

        //завершили работу с файлом
        //fclose($handler);

        FB::log($MassOfByte);
        FB::log($FileName);
        FB::log($PosNumber);

        FB::info($MassOfByte);


        $mess = 'OK';
        //return $mess + $PosNumber + $FileName + $MassOfByte;
        //return $PosNumber;
        return array("id"=>$mess);
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

                        "MassOfByte" => array("varType" => "string", "strict" => "no"),
                        "FileName" => array("varType" => "string", "strict" => "no"),
                        "PosNumber" => array("varType" => "string", "strict" => "no"),
                    ),
                    "output"   => array
                    (
                        //"id" =>array("varType" => "string", "strict" => "no")
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