<?php

namespace app\services;

use app\dao\MedinfiAnalyticsDao;

class MedinfiAnalyticsServiceImpl {

    public static function getTestDatabase() {
        return MedinfiAnalyticsDao::getPorjectWeekMartric(11, "24-09-2018");
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
        $res = MedinfiAnalyticsDao::addCompany($data);
        return $res;
    }

    public static function addAcm(array $data) {
        $res = MedinfiAnalyticsDao::addAcm($data);
        return $res;
    }

    public static function getCompanies() {
        $res = MedinfiAnalyticsDao::getFilterData()->company;
        return $res;
    }

    public static function addClient(array $data) {
        $res = MedinfiAnalyticsDao::addClient($data);
        return $res;
    }

    public static function addProject(array $data) {
        MedinfiAnalyticsDao::addProject($data);
    }

    public static function addBlogWeekMatric(array $data = null) {
        MedinfiAnalyticsDao::addBlogWeekMatric($data);
    }
}