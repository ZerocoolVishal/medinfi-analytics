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
    public function actionGetProjectListTest()
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
    }

    //Project List
    public function actionGetProjectList()
    {
        $resp = MedinfiAnalyticsServiceImpl::getProjectList();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo json_encode($resp);
    }

    //get Filter Data
    public function actionGetFilterDataTest() 
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
    }

    public function actionGetFilterData() {
        $projectId = 10;
        $res = MedinfiAnalyticsServiceImpl::getFilterData($projectId);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo json_encode($res);
    }

    //Project dashboard
    public function actionGetProjectTest() {
        
        $jsonResponse = '
        {
            "id" : 1,
            "name" : "name of the project",
            "launchDate" : "24-10-2018",
            "duration" : 3,
            "medinfi" : {
                "name" : "name of the blog",
                "launchDate" : "24-10-2018",
                "total" : 500,
                "target" : 600,
                "pageViews" : [
                    {
                        "achieved" : 200,
                        "target" : 500,
                        "weekData" : [
                            10,
                            20,
                            30
                        ]
                    }
                ]
            },  
            "facebook" : {
                "name" : "name of the post",
                "launchDate" : "24-10-2018",
                "total" : 200,
                "target" : 600
            },
            "twitter" : {
                "name" : "name of the post",
                "launchDate" : "24-10-2018",
                "total" : 300,
                "target" : 600
            }
        }';
        echo $jsonResponse;
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

    public function actionDatabase() {
        MedinfiAnalyticsServiceImpl::getTest();
    }

    public function actionTest() {
        $id = \Yii::$app->getRequest()->getQueryParam('id');
        echo "Test : ".$id;
    }
}
