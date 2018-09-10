<?php

namespace app\controllers;

use app\services\MedinfiAnalyticsServiceImpl;
use app\models\Users;

class MedinfiAnalyticsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    //Admin dashboard
    public function actionAdminDashboard() 
    {
        return $this->render('admin/index');    
    }

    //Admin Settings
    public function actionAdminSettings()
    {
        return $this->render('admin/settings');
    }

    //Acm Dashboard
    public function actionAcmDashboard()
    {
        return $this->render('acm/index.html');
    }

    //Client Dashboard
    public function actionClientDashboard()
    {
        return $this->render('client/index.html');
    }

    //Project List Testing
    /*public function actionGetProjectListTest()
    {
        $jsonResponse = '
        {
            "projectList": [
                {
                    "id": 1,
                    "name": "Project 1"
                },
                {
                    "id": 2,
                    "name": "Project 2"
                },
                {
                    "id": 3,
                    "name": "Project 3"
                },
                {
                    "id": 4,
                    "name": "Project 4"
                }
            ]
        }';
        
        echo $jsonResponse;
    }*/

    //get Filter Data
    /*public function actionGetFilterDataTest() 
    {
        $jsonResponse = '{
            "company": [{
                    "id": 1001,
                    "name": "Johnson & Johnson"
                },
                {
                    "id": 1002,
                    "name": "PepsiCo"
                },
                {
                    "id": 1003,
                    "name": "Pfizer"
                }
            ],
            "client": [{
                    "id": 1001,
                    "name": "Johnson & Johnson"
                },
                {
                    "id": 1002,
                    "name": "PepsiCo"
                },
                {
                    "id": 1003,
                    "name": "Pfizer"
                }
            ],
            "acm": [{
                    "id": 1001,
                    "name": "Nikhil"
                },
                {
                    "id": 1002,
                    "name": "Abdul"
                }
            ]
        }';
        
        echo $jsonResponse;
    }*/

    public function actionGetFilterData() {
        $projectId = 10;
        $res = MedinfiAnalyticsServiceImpl::getFilterData($projectId);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo json_encode($res);
    }

    public function actionGetProject() {
        $q = \Yii::$app->request->get('project_id');
        if(isset($q)) {
            $projectId = $q;
            $project = MedinfiAnalyticsServiceImpl::getProject($projectId);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode($project);
        } else {
            echo "project_id is missing";
        }
    }

    public function actionGetProjectList() {
        $company = \Yii::$app->getRequest()->getQueryParam('company');
        $client = \Yii::$app->getRequest()->getQueryParam('client');
        $acm = \Yii::$app->getRequest()->getQueryParam('acm');
        if(isset($company)) {
            $projectList = MedinfiAnalyticsServiceImpl::getProjectList(['companyId'=>$company]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode($projectList);
        }
        else if(isset($client)) {
            $projectList = MedinfiAnalyticsServiceImpl::getProjectList(['clientId'=>$client]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode($projectList);
        }
        else if(isset($acm)) {
            $projectList = MedinfiAnalyticsServiceImpl::getProjectList(['acmId'=>$acm]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode($projectList);
        }
        else {
            $projectList = MedinfiAnalyticsServiceImpl::getProjectList();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode($projectList);
        }
    }

    public function actionDatabase() {
        //MedinfiAnalyticsServiceImpl::getProjectListOf(['acmId'=>1]);
        echo MedinfiAnalyticsServiceImpl::getTestDatabase();
    }

    //http://localhost/medinfi-analytics/web/?r=medinfi-analytics/add-company&companyName=Demo&contactPerson=vishal&email=demo@demo&mobile=1234567890
    public function actionAddCompany() {

        $companyName = \Yii::$app->getRequest()->getQueryParam('companyName');
        $contactPerson = \Yii::$app->getRequest()->getQueryParam('contactPerson');
        $email = \Yii::$app->getRequest()->getQueryParam('email'); 
        $mobile = \Yii::$app->getRequest()->getQueryParam('mobile');

        if(isset($companyName) && isset($contactPerson) && isset($email) && isset($mobile)) {
            
            $company['companyName'] = $companyName;
            $company['contactPerson'] = $contactPerson;
            $company['email'] = $email;
            $company['mobile'] = $mobile;
            $res = MedinfiAnalyticsServiceImpl::addCompany($company);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo $res;
            
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo "Paramater are missing";
        }
    }

    public function actionAddAcm() {
        $name = \Yii::$app->getRequest()->getQueryParam('name');
        $email = \Yii::$app->getRequest()->getQueryParam('email'); 
        $mobile = \Yii::$app->getRequest()->getQueryParam('mobile');
        $password = \Yii::$app->getRequest()->getQueryParam('password');

        if(isset($name) && isset($password) && isset($email) && isset($mobile)) {
            
            $acm['name'] = $name;
            $acm['email'] = $email;
            $acm['mobile'] = $mobile;
            $acm['password'] = $password;
            $res = MedinfiAnalyticsServiceImpl::addAcm($acm);
            echo $res;
            
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo "Paramater are missing";
        }
    }

    public function actionAddClient() {

        $name = \Yii::$app->getRequest()->getQueryParam('name');
        $email = \Yii::$app->getRequest()->getQueryParam('email');
        $mobile = \Yii::$app->getRequest()->getQueryParam('mobile');
        $password = \Yii::$app->getRequest()->getQueryParam('password');
        $companyId = \Yii::$app->getRequest()->getQueryParam('companyId');
        $brandName = \Yii::$app->getRequest()->getQueryParam('brandName');
        $clientId = \Yii::$app->getRequest()->getQueryParam('clientId');

        $client['name'] = $name;
        $client['email'] = $email;
        $client['mobile'] = $mobile;
        $client['password'] = $password;
        $client['companyId'] = $companyId;
        $client['brandName'] = $brandName;
        $client['clientId'] = $clientId;

        $res = MedinfiAnalyticsServiceImpl::addClient($client);
        print_r($res);
    }

    public function actionAddProject() {

        $request = \Yii::$app->request->post();
        /*if(isset($request)) {
            print_r($request['launchDate']);
        }*/

        /*$name = $request['name'];
        $client = $request['client'];
        
        $tw_retweets_target = $request['tw_retweets_target'];
        $tw_impression_target = $request['tw_impression_target'];
        $tw_comments_target = $request['tw_comments_target'];

        $fb_likes_share_target = $request['fb_likes_share_target'];
        $fb_click_target = $request['fb_click_target'];
        $fb_comments_target = $request['fb_comments_target'];

        $blog_pageview_target = $request['blog_pageview_target'];
        $blog_bannerclicks_target = $request['blog_bannerclicks_target'];
        $blog_online_sale_target = $request['blog_online_sale_target'];

        $duration = $request['duration'];
        $accountManager = $request['accountManager'];
        $launchDate = $request['launchDate'];

        $data['name'] = $name;
        $data['client'] = $client;
        $data['tw_retweets_target'] = $tw_retweets_target;
        $data['tw_impression_target'] = $tw_impression_target;
        $data['tw_comments_target'] = $tw_comments_target;
        $data['fb_likes_share_target'] = $fb_likes_share_target;
        $data['fb_click_target'] = $fb_click_target;
        $data['fb_comments_target'] = $fb_comments_target;
        $data['blog_pageview_target'] = $blog_pageview_target;
        $data['blog_bannerclicks_target'] = $blog_bannerclicks_target;
        $data['blog_online_sale_target'] = $blog_online_sale_target;
        $data['duration'] = $duration;
        $data['accountManager'] = $accountManager;
        $data['launchDate'] = $launchDate;*/

        MedinfiAnalyticsServiceImpl::addProject($request);
    }

    public function actionGetCompanies() {
        $res = MedinfiAnalyticsServiceImpl::getCompanies();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo json_encode($res);
    }

    public function actionAddBlogWeekMatric() {

        MedinfiAnalyticsServiceImpl::addBlogWeekMatric();
    }

    public function actionAddMedinfiBlog() {
        $data['url'] = "https://www.medinfi.com/blog/importance-of-mouth-rinsing/";
        $data['launchDate'] = "2018-09-09";
        $data['project'] = 11;
        $data['name'] = "Importance of Mouth Rinsing";
        echo MedinfiAnalyticsServiceimpl::addBlog($data);
    }

    public function actionTest() {

        $request = \Yii::$app->request->post();
        if(isset($request)) {
             print_r($request['name']);
        }
    }
}