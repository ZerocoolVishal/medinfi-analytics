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
        foreach ($projectList as $project) {
            $p = new \stdClass();
            $p->id = $project->id;
            $p->name = $project->name;
            $resp->projectList[] = $p;
        }

        return $resp;
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

            //Twitter
            /*$p->tw_retweets_target = $project[0]->tw_retweets_target;
            $p->tw_impression_target = $project[0]->tw_impression_target;
            $p->tw_comments_target = $project[0]->tw_comments_target;*/

            //Facebook
            /*$p->fb_likes_share_target = $project[0]->fb_likes_share_target;
            $p->fb_click_target = $project[0]->fb_click_target;
            $p->fb_comments_target = $project[0]->fb_comments_target;*/

            //Medinfi blog
            /*$p->blog_pageview_target = $project[0]->blog_pageview_target;
            $p->blog_bannerclicks_target = $project[0]->blog_bannerclicks_target;
            $p->blog_online_sale_target = $project[0]->blog_online_sale_target;*/

            return $p;
        } else {
            echo "No project found";
        }
    }
}