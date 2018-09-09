<?php

namespace app\dao;

use app\models\Users;
use app\models\Project;
use app\models\Company;
use app\models\Client;
use app\models\Projectweek;
use app\models\Blogweekmatric;
use app\models\Blog;

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
            $p->medinfi->total = 10;
            $p->medinfi->target = $project->blog_pageview_target + $project->blog_bannerclicks_target + $project->blog_online_sale_target;
            $p->medinfi->pageViews = array();
            $p->medinfi->bannerClicks = array();
            $p->medinfi->onlineSales = array();

            $p->facebook = new \stdClass();
            //TODO
            $p->facebook->total = 10;
            $p->facebook->target = $project->fb_likes_share_target + $project->fb_click_target + $project->fb_comments_target;
            $p->facebook->likesAndShare = array();
            $p->facebook->clickToSite = array();
            $p->facebook->comments = array();

            $p->twitter = new \stdClass();
            //TODO
            $p->twitter->total = 10;
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

    public static function addProject(array $data) {
        print_r($data);
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
        echo $res." Project created";

        //Adding Projectweek
        self::addProjectweek($project->launchDate, $project->duration, $project->id);
    }

    //creates the projectweek table
    static function addProjectweek($launchDate, $projectDuration, $project) {

        $startDate = $launchDate;
        $duration = $projectDuration;
        $projectId = $project;

        $start = strtotime($startDate);
        $end = strtotime('+6 day', $start);

        //Project Week creation
        for($i = 0; $i < $duration; $i++) {
            
            $projectWeek = new Projectweek();
            $projectWeek->project = $projectId;
            $projectWeek->name = "w$i";
            $projectWeek->startDate = date('Y-m-d', $start);
            $projectWeek->endDate = date('Y-m-d', $end);
            $res = $projectWeek->save();
            print_r($res);

            $start = strtotime('+7 days', $start);
            $end = strtotime('+7 day', $end);
        }
    }

    //Gives the projectweek id
    static function getProjectWeekId($porject, $launchDate) {

        $projectId = $porject;
        $launchDate = $launchDate;
        $launchDate = strtotime($launchDate);

        $projectWeeks = Projectweek::find()->where(['project'=>$projectId])->all();

        foreach($projectWeeks as $projectWeek) {
            if($launchDate >= strtotime($projectWeek->startDate) 
            && $launchDate <= strtotime($projectWeek->endDate)) {
                return $projectWeek->id;
            }
        }
    }

    //Adds data to the blog table and creates blogweekmatric table
    public static function addBlog(array $data) {

        $blog = new Blog();
        $blog->url = $data['url'];
        $blog->launchDate = $data['launchDate'];
        $blog->project = $data['project'];
        $blog->name = $data['name'];
        $res = $blog->save();
        echo $res;

        //Creating a blogweekmatric for that blog
        $res = self::createBlogWeekMatric($blog->project, $blog->id, $blog->launchDate);
        echo $res;
    }

    //Create the blogweekmatric for given project ID
    static function createBlogWeekMatric($projectId, $blogId, $launchDate) {
        
        $blogweekmatric = new Blogweekmatric();

        $blogweekmatric->blog = $blogId;
        $blogweekmatric->projectWeek = self::getProjectWeekId($projectId, $launchDate);
        
        $blogweekmatric->blog_pageview = 0;
        $blogweekmatric->blog_bannerclicks = 0;
        $blogweekmatric->blog_online_sale = 0;

        $blogweekmatric->fb_likes_share = 0;
        $blogweekmatric->fb_click = 0;
        $blogweekmatric->fb_comments = 0;

        $blogweekmatric->tw_retweets = 0;
        $blogweekmatric->tw_impression = 0;
        $blogweekmatric->tw_comments = 0;

        $res = $blogweekmatric->save();
        return $res;
    }

    public static function addBlogWeekMatricData() {
        //TODO: Implement
        $blogweekmatric->blog_pageview = $data['blog_pageview'];
        $blogweekmatric->blog_bannerclicks = $data['blog_bannerclicks'];
        $blogweekmatric->blog_online_sale = $data['blog_online_sale'];
    }

    public static function addFacebookWeekmatricData() {
        //TODO: Impliment
        $blogweekmatric->fb_likes_share = $data['fb_likes_share'];
        $blogweekmatric->fb_click = $data['fb_click'];
        $blogweekmatric->fb_comments = $data['fb_comments'];
    }

    public static function addTwitterWeekmatricData() {
        //TODO: Impliment
        $blogweekmatric->tw_retweets = $data['tw_retweets'];
        $blogweekmatric->tw_impression = $data['tw_impression'];
        $blogweekmatric->tw_comments = $data['tw_comments'];
    }

    public static function test() {
        
        /*$blogweekmatric = Blogweekmatric::find()->where(['id'=>4])->one();

        $blogweekmatric->fb_likes_share = 200;
        $blogweekmatric->fb_click = 200;
        $blogweekmatric->fb_comments = 200;

        $res = $blogweekmatric->save();
        print_r($res);*/

        $data['url'] = "https://www.medinfi.com/blog/importance-of-mouth-rinsing/";
        $data['launchDate'] = "2018-09-09";
        $data['project'] = 11;
        $data['name'] = "Importance of Mouth Rinsing";    

        print_r(self::addBlog($data));
    }
}

//TODO: SELECT * FROM `projectweek` WHERE ('2018-09-20' BETWEEN `startDate` AND `endDate`) AND (`project` = 11)