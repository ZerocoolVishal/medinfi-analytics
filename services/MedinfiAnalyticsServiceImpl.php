<?php

namespace app\services;

use app\models\Users;
use app\models\Project;
use app\models\Company;
use app\dao\MedinfiAnalyticsDao;

class MedinfiAnalyticsServiceImpl {

    public static function getTest() {
        $users = Users::find()->all();
        var_dump($users);
    }

    //Returns list of all companies account managers and clients
    public static function getFilterData() {
        $filterData = MedinfiAnalyticsDao::getFilterData();
        return $filterData;
    }

    //Returns list of all projects
    public static function getProjectList() {
        $projectList = MedinfiAnalyticsDao::getProjectList();
        return $projectList;
    }

    //Returns the project data
    public static function getProject(int $projectId) {
        $project = MedinfiAnalyticsDao::getProject($projectId);
        return $project;
    }
}