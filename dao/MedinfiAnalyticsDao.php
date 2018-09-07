<?php

namespace app\dao;

use app\models\Users;
use app\models\Project;
use app\models\Company;
use app\models\Client;

class MedinfiAnalyticsDao {

    //Returns list of all companies account managers and clients
    public static function getFilterData() {

        $users = Users::find()->all();
        $companyList = Company::find()->all();
        $clientList = Client::find()->all();

        $res = new \stdClass();
        $res->company = array();
        $res->client = array();
        $res->acm = array();

        foreach($companyList as $comp) {
            $company = new \stdClass();
            $company->id = $comp->id;
            $company->name = $comp->name;
            $res->company[] = $company;
        }

        foreach($users as $user) {
        
            if($user->userType == "acm") {
                $acm = new \stdClass();
                $acm->id = $user->id;
                $acm->name = $user->name;
                $res->acm[] = $acm;
            }
        }

        foreach($clientList as $client) {
            $cli = new \stdClass();
            $cli->id = $client->id;
            $cli->name = $client->user->name;
            $res->client[] = $cli;
        }

        return $res;
    }

    public static function getCompanies() {
        $res = array();
        $companyList = Company::find()->all();
        foreach($companyList as $company) {
            $com = new \stdClass();
            $com->id = $company->id;
            $com->name = $company->name;
            $res[] = $com;
        }
        return $res;
    }

    static function projectListResp($projectList) {

        $resp = new \stdClass();
        $resp->projectList = array();
        foreach ($projectList as $project) {
            $p = new \stdClass();
            $p->id = $project->id;
            $p->name = $project->name;
            $resp->projectList[] = $p;
        }

        return $resp;
    }

    public static function getProjectList(array $id = null) {

        if(isset($id['clientId'])) {
            $id = $id['clientId'];
            $projectList = Client::find()->where(['id'=>$id])->one()->projects;
            //print_r($projectList);
            return self::projectListResp($projectList);
        }

        else if(isset($id['companyId'])) {
            $id = $id['companyId'];
            $projectList = Company::find()->where(['id'=>$id])->one()->projects;
            //print_r($projectList);
            return self::projectListResp($projectList);
        }

        else if(isset($id['acmId'])) {
            $id = $id['acmId'];
            $projectList = Users::find()->where(['id'=>$id])->one()->projects;
            //print_r($projectList);
            return self::projectListResp($projectList);
        }

        else {
            $projectList = Project::find()->all();
            $resp = self::projectListResp($projectList);
            return $resp;
        }
    }

    public static function getProject(int $porjectId) {

        $project = Project::find()->where(['id'=>$porjectId])->one();
        //var_dump($project);

        if($project) {
            
            $p = new \stdClass();
            $p->id = $project->id;
            $p->name = $project->name;
            $p->launchDate = $project->launchDate;
            $p->duration = $project->duration;

            $p->medinfi = new \stdClass();
            //TODO
            $p->medinfi->total = 1000;
            $p->medinfi->target = $project->blog_pageview_target + $project->blog_bannerclicks_target + $project->blog_online_sale_target;
            $p->medinfi->pageViews = array();
            $p->medinfi->bannerClicks = array();
            $p->medinfi->onlineSales = array();

            $p->facebook = new \stdClass();
            //TODO
            $p->facebook->total = 1000;
            $p->facebook->target = $project->fb_likes_share_target + $project->fb_click_target + $project->fb_comments_target;
            $p->facebook->likesAndShare = array();
            $p->facebook->clickToSite = array();
            $p->facebook->comments = array();

            $p->twitter = new \stdClass();
            //TODO
            $p->twitter->total = 1000;
            $p->twitter->target = $project->tw_retweets_target + $project->tw_impression_target + $project->tw_comments_target;
            $p->twitter->impression = array();
            $p->twitter->retweets = array();
            $p->twitter->comments = array();
            
            return $p;
        } else {
            echo "No project found";
        }
    }

    public static function addCompany(array $data) {
        //var_dump($data);
        $company = new Company();
        $company->name = $data['companyName'];
        $company->contactPerson = $data['contactPerson'];
        $company->email = $data['email'];
        $company->mobile = $data['mobile'];
        $res = $company->save();
        return $res;
    }

    public static function addAcm(array $data) {
        $users = new Users();
        $users->name = $data['name'];
        $users->email = $data['email'];
        $users->mobile = $data['mobile'];
        $users->password = md5($data['password']);
        $users->userType = "acm";
        $users->lastUpdateBy = 1;
        $res = $users->save();
        return $res;
    }

    public static function addClient(array $data) {
        
        $clientUser = new Users();
        $clientUser->name = $data['name'];
        $clientUser->email = $data['email'];
        $clientUser->mobile = $data['mobile'];
        $clientUser->password = md5($data['password']);
        $clientUser->userType = "client";
        $clientUser->lastUpdateBy = 1;
        $clientUser->save();
      
        $client = new Client();
        $client->userId = $clientUser->id;
        $client->companyId = $data['companyId'];
        $client->brandName = $data['brandName'];

        $res = $client->save();
        return $res;
    }

    public static function addProject(array $data = null) {
        //echo "Add project";
        $project = new Project();
        $project->name = $data['name'];
        $project->company = Client::find()->where(['id'=>$data['client']])->one()->company->id;
        $project->client = $data['client'];

        $project->tw_retweets_target = $data['tw_retweets_target'];
        $project->tw_impression_target = $data['tw_impression_target'];
        $project->tw_comments_target = $data['tw_comments_target'];

        $project->fb_likes_share_target = $data['fb_likes_share_target'];
        $project->fb_click_target = $data['fb_click_target'];
        $project->fb_comments_target = $data['fb_comments_target'];

        $project->blog_pageview_target = $data['blog_pageview_target'];
        $project->blog_bannerclicks_target = $data['blog_bannerclicks_target'];
        $project->blog_online_sale_target = $data['blog_online_sale_target'];

        $project->duration = $data['duration'];
        $project->accountManager = $data['accountManager'];
        $project->launchDate = $data['launchDate'];

        $res = $project->save();
        //$client = Client::find()->where(['id'=>2])->one()->company->id;
        //echo $client;
        echo $res;
    }

    public static function test() {
        $client = Client::find()->where(['id'=>1])->one();
        print_r($client->projects);
        //echo json_encode($client->company);
    }
}