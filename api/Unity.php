<?php

namespace api;

use api\DatabaseCon;


//Uma unidade deverá ter: Código, bloco, valor, status.

class Unity extends DatabaseCon
{
     


    public function createUnity($data,$bloc,$enterpriseId)
    {

        $databaseCon = new DatabaseCon("enterprise_units");

        $registered =  $databaseCon->insert([
            "bloc" => $bloc,
            "value" => $data->unit_value,
            "status" => "DISPONÍVEL",
            "enterprise_id" => $enterpriseId
        ]);

        return $registered;
    }


    public function updateUnity($idEnterprise, $data)
    {
        $dataArray = [];

        if (isset($data->name)) {
            $dataArray["name"] = $data->name;
        }
        if (isset($data->localization)) {
            $dataArray["localization"] = $data->localization;
        }
        if (isset($data->delivery_forecast)) {
            $dataArray["delivery_forecast"] =   $data->delivery_forecast;
        }

        return (new DatabaseCon("enterprises"))->update("id = $idEnterprise", $dataArray);
    }


    public function deleteUnity($idEnterprise)
    {
        return (new DatabaseCon("enterprises"))->delete("id = $idEnterprise");
    }


    public function getAllUnitys()
    {
        $enterprises = Self::getAll("", "", "", "enterprises");
        return $enterprises;
    }

    public function getUnity($idEnterprise)
    {
        $enterprise =  Self::getOne($idEnterprise, "enterprises");
        return $enterprise;
    }
}
