<?php

namespace api;

use api\DatabaseCon;


/**
 * Um empreendimento deverá ter: Código, nome, localização, previsão de entrega, quantidade de unidades.
 * O sistema deverá ser capaz de criar automaticamente as unidades de um empreendimento, especificando a quantidade de blocos,
 *  a quantidade de unidades por bloco e um valor para todas as unidades.
 */



class Enterprise extends DatabaseCon
{
    private $id;
    private $name;
    private $localization;
    private $delivery_forecast;
    private $blocs;
    private $units_per_bloc;
    private $unit_value;


    public function createEnterprise($data)
    {

        $databaseCon = new DatabaseCon("enterprises");

        $registered =  $databaseCon->insert([
            "name" => $data->name,
            "localization" => $data->localization,
            "delivery_forecast" => strtotime($data->delivery_forecast),
            "blocs" => $data->blocs,
            "units_per_bloc" => $data->units_per_bloc,
            "unit_value" => $data->unit_value
        ]);

        return $registered;
    }


    public function getAllEnterprises()
    {
        $enterprises = Self::getAll("", "", "", "enterprises");
        return $enterprises;
    }

    public function getEnterprise($idEnterprise)
    {
        $enterprise =  Self::getOne($idEnterprise, "enterprises");
        return $enterprise;
    }




    public function updateEnterprise($idEnterprise, $data)
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


    public function deleteEnterprise($idEnterprise)
    {
        return (new DatabaseCon("enterprises"))->delete("id = $idEnterprise");
    }


}