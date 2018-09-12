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

    /**
     * Adds a new project and adds project weeks according to the duration of peoject
     * 
     * @property data: project data array
     */
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

    /**
     * Creates the project week for project from given launchdate, duration
     * 
     * @property launchDate: launchdate of the project
     * @property  projectDuration: duration of the project in weeks
     * @property project: ID of the project
     */
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

    /**
     * Gives the proojectweek ID from given projectID and launchDate
     */
    static function getProjectWeek($porject, $launchDate) {

        $projectId = $porject;
        $launchDate = $launchDate;
        $launchDate = strtotime($launchDate);

        $projectWeeks = Projectweek::find()->where(['project'=>$projectId])->all();

        foreach($projectWeeks as $projectWeek) {
            if($launchDate >= strtotime($projectWeek->startDate) 
            && $launchDate <= strtotime($projectWeek->endDate)) {
                return $projectWeek;
            }
        }
    }

    /**
     * Adds data to the blog table and creates blogweekmatric table
     * for each projectweek one blogweekmatric will get added
     */
    public static function addBlog(array $data) {

        $blog = new Blog();
        $blog->url = $data['url'];
        $blog->launchDate = $data['launchDate'];
        $blog->project = $data['project'];
        $blog->name = $data['name'];
        $res = $blog->save();
        //echo $res;
        if($res) {
            //Creating a blogweekmatric for that blog
            $project = Project::find()->where(['id'=>$blog->project])->one();
            foreach ($project->projectweeks as $pw) {
                /*echo "<pre>";
                print_r($val);
                echo "</pre>";*/
                $res = self::createBlogWeekMatric($blog->id, $pw->id);
                echo $res;
            }
        }
    }

    /**
     * Create the blogweekmatric for given project ID
     * 
     * @property blogId: ID of the Blog
     * @property projectWeekId: projectweek ID
     * 
     * @return Blog blog;
     */
    static function createBlogWeekMatric($blogId, $projectWeekId) {
        
        $blogweekmatric = new Blogweekmatric();

        $blogweekmatric->blog = $blogId;
        $blogweekmatric->projectWeek = $projectWeekId;
        
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

    /**
     * This method returns the blog from given blog name and projectId
     * 
     * @property blogName: name of the Blog
     * @property projectId: ID of the project
     * 
     * @return Blog blog;
     */
    static function getBlog($blogName, $projectId) {
        $blog = Blog::find()->where(['name'=>$blogName, 'project' => $projectId])->one();
        if($blog) {
            return $blog;
        }
        else {
            return 0;
        }
    }

    /**
     * @property projectId: ID of the project
     * @property blogName: name of the Blog
     * @property date: data of the data capture
     * @property array data: [blog_pageview, blog_bannerclicks, blog_online_sale]
     */
    public static function addBlogWeekMatricData($projectId, $blogName, $date, $data) {
        //TODO: Implement
        //$project = Project::find()->where(['id' => $projectId])->one();

        $blog = self::getBlog($blogName, $projectId);
        $projectWeek = self::getProjectWeek($projectId, $date);

        $blogweekmatric = Blogweekmatric::find()->where(['blog'=>$blog->id, 'projectWeek' => $projectWeek->id])->one();

        $blogweekmatric->blog_pageview = $data['blog_pageview'];
        $blogweekmatric->blog_bannerclicks = $data['blog_bannerclicks'];
        $blogweekmatric->blog_online_sale = $data['blog_online_sale'];
        $res = $blogweekmatric->save();

        echo $res;
        echo "<pre>";
        print_r($blogweekmatric);
        echo "</pre>";

        return $res;

    }

    /**
     * @property projectId: ID of the project
     * @property blogName: name of the Blog
     * @property date: data of the data capture
     * @property array data: [fb_likes_share, fb_click, fb_comments]
     */
    public static function addFacebookWeekmatricData($projectId, $blogName, $date, $data) {
        $blog = self::getBlog($blogName, $projectId);
        $projectWeek = self::getProjectWeek($projectId, $date);

        $blogweekmatric = Blogweekmatric::find()->where(['blog'=>$blog->id, 'projectWeek' => $projectWeek->id])->one();

        $blogweekmatric->fb_likes_share = $data['fb_likes_share'];
        $blogweekmatric->fb_click = $data['fb_click'];
        $blogweekmatric->fb_comments = $data['fb_comments'];
        $res = $blogweekmatric->save();

        echo $res;
        echo "<pre>";
        print_r($blogweekmatric);
        echo "</pre>";

        return $res;
    }

    /**
     * @property projectId: ID of the project
     * @property blogName: name of the Blog
     * @property date: data of the data capture
     * @property array data: [tw_retweets, tw_impression, tw_comments]
     */
    public static function addTwitterWeekmatricData($projectId, $blogName, $date, $data) {
        $blog = self::getBlog($blogName, $projectId);
        $projectWeek = self::getProjectWeek($projectId, $date);

        $blogweekmatric = Blogweekmatric::find()->where(['blog'=>$blog->id, 'projectWeek' => $projectWeek->id])->one();

        $blogweekmatric->tw_retweets = $data['tw_retweets'];
        $blogweekmatric->tw_impression = $data['tw_impression'];
        $blogweekmatric->tw_comments = $data['tw_comments'];
        $res = $blogweekmatric->save();

        echo $res;
        echo "<pre>";
        print_r($blogweekmatric);
        echo "</pre>";

        return $res;
    }

    public static function test() {
        
        echo "Testing addTwitterWeekmatricData<br>";

        $projectId = 11;
        $blogName = "Eczema: Types, Causes & Symptoms";
        $date = "2018-09-10";

        $data['tw_retweets'] = 200;
        $data['tw_impression'] = 300;
        $data['tw_comments'] = 400;

        self::addTwitterWeekmatricData($projectId, $blogName, $date ,$data);
    }

    public static function testcron() {

        echo "Cron testing";
    }
}