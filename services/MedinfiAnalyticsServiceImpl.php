<?php

namespace app\services;

use app\dao\MedinfiAnalyticsDao;

class MedinfiAnalyticsServiceImpl {

    public static function getTestDatabase() {
        MedinfiAnalyticsDao::test();
    }

    //Returns list of all companies account managers and clients
    public static function getFilterData() {
        $filterData = MedinfiAnalyticsDao::getFilterData();
        return $filterData;
    }

    //Returns the project data
    public static function getProject(int $projectId) {
        $project = MedinfiAnalyticsDao::getProject($projectId);
        return $project;
    }

    public static function getProjectList(array $id = null) {
        $projectList = MedinfiAnalyticsDao::getProjectList($id);
        return $projectList;
    }

    public static function addCompany(array $data) {
        MedinfiAnalyticsDao::addCompany($data);
    }
}