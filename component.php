<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("webservice") || !CModule::IncludeModule("iblock"))
    return;



// наш новый класс наследуется от базового IWebService
class CChangeElement extends IWebService
{
    /*function exchange($iblock, $params)
    {
        define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
        AddMessage2Log(print_r($params, true), "webservice");
        foreach ($params as $value)
        {
            CIBlockElement::SetPropertyValuesEx(
                $value['element'],
                $iblock,
                array($value['code'],$value['val'])
            );
        }

        $mess = 'OK';
        return $mess;
    }*/


    function putFile($MassOfByte,  $FileName,  $PosNumber)
    {
        $mess = 'OK';
        return $mess;

    }


    // метод GetWebServiceDesc возвращает описание сервиса и его методов
    function GetWebServiceDesc()
    {
        $wsdesc = new CWebServiceDesc();
        $wsdesc->wsname = "bitrix.changes"; // название сервиса
        $wsdesc->wsclassname = "CChangeElement"; // название класса
        $wsdesc->wsdlauto = true;
        $wsdesc->wsendpoint = CWebService::GetDefaultEndpoint();
        $wsdesc->wstargetns = CWebService::GetDefaultTargetNS();

        $wsdesc->classTypes = array();
        $wsdesc->structTypes = Array();

        //    $wsdesc->structTypes["arParam"] = array(
        //	"element"=> array("varType" => "integer", "strict" => "no"),
        //    "code" => array("varType" => "string", "strict" => "no"),
        //	"val" => array("varType" => "string", "strict" => "no"),
        //    );
        //     $wsdesc->structTypes["arMessage"] = array(
        //	"result" => array("varType" => "string", "strict" => "no"),
        //	"error" => array("varType" => "string", "strict" => "no"),
        //    );

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
                        array("varType" => "string", "strict" => "no")
                    ),
                    "httpauth" => "Y"
                ),


                //"exchange" => array
                //(
                //   "type"      => "public",
                //   "input"      => array
                //   (
                //     "iblock" => array("varType" => "integer", "strict" => "no"),
                //	   "params" => array("varType" => "ArrayOfArParam","arrType" => "arParam", "strict" => "no"),
                //	  ),
                //	  "output"   => array
                //    (
                //		  array("varType" => "arMessage", "strict" => "no")
                //	   ),
                //	"httpauth" => "N"
                //),
            )
        );

        return $wsdesc;
    }
}

$arParams["WEBSERVICE_NAME"] = "bitrix.changes";
$arParams["WEBSERVICE_CLASS"] = "CChangeElement";
$arParams["WEBSERVICE_MODULE"] = "";

// передаем в компонент описание веб-сервиса
$APPLICATION->IncludeComponent(
    "bitrix:webservice.server",
    "",
    $arParams
);

die();
?>