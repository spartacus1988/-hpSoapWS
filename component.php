<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("webservice") || !CModule::IncludeModule("iblock"))
    return;





// наш новый класс наследуетсЯ от базового IWebService
class CAddNewsWS extends IWebService
{

    function putFile($MassOfByte,  $FileName,  $PosNumber)
    {
        $mess = 'OK';
        return $mess;

    }



    // метод GetWebServiceDesc возвращает описание сервиса и его методов
    function GetWebServiceDesc()
    {
        $wsdesc = new CWebServiceDesc();
        $wsdesc->wsname = "bitrix.webservice.addnews"; // название сервиса
        $wsdesc->wsclassname = "CAddNewsWS"; // название класса
        $wsdesc->wsdlauto = true;
        $wsdesc->wsendpoint = CWebService::GetDefaultEndpoint();
        $wsdesc->wstargetns = CWebService::GetDefaultTargetNS();

        $wsdesc->classTypes = array();
        $wsdesc->structTypes = Array();
        //$wsdesc->classes = array();

        $wsdesc->classes = array
        (
            "CChangeElement"=> array
            (
                "putFile" => array
                (
                    "type"      => "public",
                    "input"      => array
                    (

                        "MassOfByte" => array("varType" => "integer", "strict" => "no"),
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






$arParams["WEBSERVICE_NAME"] = "bitrix.webservice.addnews";
$arParams["WEBSERVICE_CLASS"] = "CAddNewsWS";
$arParams["WEBSERVICE_MODULE"] = "";

// передаем в компонент описание веб-сервиса
$APPLICATION->IncludeComponent(
    "bitrix:webservice.server",
    "",
    $arParams
);

die();
?>