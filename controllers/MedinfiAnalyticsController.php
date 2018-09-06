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
        //MedinfiAnalyticsServiceImpl::getTestDatabase();
        MedinfiAnalyticsServiceImpl::getProjectListOf(['acmId'=>1]);
    }

    public function actionTest() {
        $id = \Yii::$app->getRequest()->getQueryParam('id');
        echo "Test : ".$id;
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

    public function actionGetCompanies() {
        $res = MedinfiAnalyticsServiceImpl::getCompanies();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo json_encode($res);
    }
}