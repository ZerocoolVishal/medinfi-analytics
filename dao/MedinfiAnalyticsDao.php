<?php

namespace app\dao;

use app\models\Users;
use app\models\Project;
use app\models\Company;

class MedinfiAnalyticsDao {

    //Returns list of all companies account managers and clients
    public static function getFilterData() {

        $users = Users::find()->all();
        $companyList = Company::find()->all();

        //var_dump($company);

        $res = new \stdClass();
        $res->company = array();
        $res->client = array();
        $res->acm = array();

        foreach ($companyList as $comp) {
            $company = new \stdClass();
            $company->id = $comp->id;
            $company->name = $comp->name;
            $res->company[] = $company;
        }

        foreach ($users as $user) {
            if($user->userType == "client") {
                $client = new \stdClass();
                $client->id = $user->id;
                $client->name = $user->name;
                $res->client[] = $client;
            } 

            if($user->userType == "acm") {
                $acm = new \stdClass();
                $acm->id = $user->id;
                $acm->name = $user->name;
                $res->acm[] = $acm;
            }
        }

        return $res;
    }

    public static function getProjectList() {

        $projectList = Project::find()->all();
        
        $resp = new \stdClass();
        $resp->projectList = array();
        $i = 0;
        foreach ($projectList as $project) {
            $p = new \stdClass();
            $p->id = $project->id;
            $p->name = $project->name;
            $resp->projectList[$i] = $p;
            //echo $project->id;
            //echo $project->name;
            $i++;
        }

        return $resp;
    }

    public static function getProject(int $porjectId) {
        $project = Project::find()->where(['id' => $porjectId])->all();
        if($project) {
            return $project[0];
        } else {
            echo "No project found";
        }
    }
}