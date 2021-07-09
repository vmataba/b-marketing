<?php

namespace app\controllers;

use app\models\AppUser;
use app\models\ContactForm;
use app\models\Institution;
use app\models\LoginForm;
use app\models\User;
use app\modules\BaseModule;
use app\modules\recruitment\models\Job;
use app\modules\recruitment\models\JobApplication;
use app\modules\recruitment\models\JobApplicationAttachment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        BaseModule::deactivateAll();

        $currentUser = User::findOne(Yii::$app->user->id);

        \Yii::$app->name = Institution::hasInstance() ? Institution::getInstance()->institution_code . ' HR Management System' : 'HR Management System';

        /* Inactive user */
        if (!$currentUser->isActive() && $this->route !== 'user/inactive') {
            return $this->redirect(['user/inactive', 'id' => $currentUser->id]);
        }
//        /* User with default password */
//        if ($currentUser->hasDefaultPassword() && $this->route !== 'user/update-password') {
//            return $this->redirect(['user/update-password', 'id' => $currentUser->id]);
//        }

        //Temporary
        return $this->redirect(['/notifications']);

        //return $this->render('index');
    }


    public function actionActivateAccount($access_code) {
        $model = AppUser::find()->where("access_token = '{$access_code}' ")->one();
        if ($model->is_active == 1) {
            Yii::$app->session->setFlash('error', "Error! Trying to activate an account which is already active. Just login using your email address and password you provided during registration");
            return $this->redirect(['login', 'tab' => 'login']);
        }
        $model->is_active = 1;
        $model->save(false);
        $mGroupeMember = new \app\models\IsMember();
        $mGroupeMember->user_id = $model->id;
        $mGroupeMember->group_id = 11;
        $mGroupeMember->is_active = 1;
        $mGroupeMember->save(false);

        $modelSalutation = \app\models\Salutation::findOne($model->salutation);
        $fullname = $modelSalutation->name . ". " . $model->first_name . " " . $model->middle_name . " " . $model->surname;
        $link = Url::to(['/site/activate-account', 'access_code' => $model->access_token], true);
        $mcnotif = \app\models\Cnotification::findOne(6);
        $msg_body = $mcnotif->notification;
        $msg_body = str_replace('{fullname}', $fullname, $msg_body);
        $msg_body = str_replace('{link}', $link, $msg_body);
        \app\models\Notification::logNotification($model->id, $model->email, $mcnotif->subject, $msg_body);
        \app\models\Notification::sendEmail($model->email, $mcnotif->subject, $msg_body);
        Yii::$app->session->set('username', $model->username);
        Yii::$app->session->setFlash('success', "Dear <strong>{$fullname}</strong>, your account has been successfully activated. Now you can proceed with Job Application. Login using your email address as username and password you put during registration ");
        return $this->redirect(['login', 'tab' => 'login']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin($tab = null) {
        $this->layout = 'guest';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'tab' => $tab
        ]);
    }

    public function goHome() {
        $currentUser = User::findOne(\Yii::$app->user->id);
        if ($currentUser->hasDefaultPage()) {
            return $this->redirect(Url::to([$currentUser->getDefaultSystemRoute()->getRoute()]));
        }
        return parent::goHome();
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        if (isset(Yii::$app->getSession()['partialSupportingDocument']['completePath']) && is_file(Yii::$app->getSession()['partialSupportingDocument']['completePath'])) {
            unlink(Yii::$app->getSession()['partialSupportingDocument']['completePath']);
        }
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $currentUser = User::findOne(Yii::$app->user->id);
        if ($currentUser->hasDefaultPassword() && $this->route !== 'user/update-password') {
            return $this->redirect(['user/update-password', 'id' => $currentUser->id]);
        }

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        $currentUser = User::findOne(Yii::$app->user->id);
        if ($currentUser->hasDefaultPassword() && $this->route !== 'user/update-password') {
            return $this->redirect(['user/update-password', 'id' => $currentUser->id]);
        }

        return $this->render('about');
    }

//    public function actionAddUser() {
//        $model = new User();
//
//        $model->username = 'admin';
//        $model->password = \Yii::$app->getSecurity()->generatePasswordHash('12345');
//        $model->auth_key = \Yii::$app->getSecurity()->generateRandomString();
//        $model->access_token = \Yii::$app->getSecurity()->generateRandomString();
//        $model->salutation = 1;
//        $model->first_name = 'Victor';
//        $model->surname = 'Mataba';
//        $model->phone = '+255765909090';
//        $model->email = 'vmataba0@gmail.com';
//        $model->company_level = 1;
//
//        if ($model->validate()) {
//            $model->save();
//            return 'Success';
//        }
//        return \yii\helpers\Json::encode($model->errors);
//    }

    public function actionLogMeOut() {
        if (isset(Yii::$app->getSession()['partialSupportingDocument']['completePath']) && is_file(Yii::$app->getSession()['partialSupportingDocument']['completePath'])) {
            unlink(Yii::$app->getSession()['partialSupportingDocument']['completePath']);
        }
        \Yii::$app->user->logout();
        return $this->redirect(['index']);
    }

    public function actionViewJob($id) {
        $this->layout = 'guest';
        $model = Job::findOne($id);

        return $this->render('recruitment/job/view', [
            'model' => $model
        ]);
    }

    public function actionSetCountryCode($id) {
        $country = \app\models\AppCountry::findOne($id);
        Yii::$app->session['countryCode'] = $country->country_code;
        return $country->country_code;
    }

    /*Test API for fetching attachment Paths*/
    public function actionFetchApplications($key = null) {
        if ($key !== 'AODQ0320EDM230E02ERJFM92ER2FJ29DM2DO2OD') {
            return 'Page not found';
        }
        $applicants = [];

        $applicantUsers = User::find()
            ->where(['app_user_type_id' => User::TYPE_JOB_APPLICANT])
            ->select(['id', 'salutation', 'first_name', 'middle_name', 'surname'])
            ->all();
        foreach ($applicantUsers as $applicantUser) {
            $applicant = [];
            $applicant['id'] = $applicantUser->id;
            $applicant['fullName'] = $applicantUser->getFullName();
            $applications = [];
            $jobApplications = JobApplication::find()
                ->where(['user_id' => $applicantUser->id])
                ->andWhere(['application_status' => JobApplication::STATUS_SUBMITTED])
                ->select(['id', 'application_status'])
                ->all();
            foreach ($jobApplications as $jobApplication) {
                $attachments = JobApplicationAttachment::find()
                    ->where(['job_application_id' => $jobApplication->id])
                    ->select('id,attachment,attachment_name')
                    ->all();
                $applications[] = [
                    'id' => $jobApplication->id,
                    'attachments' => $attachments
                ];
            }
            $applicant['applications'] = $applications;
            $applicants[] = $applicant;
        }

        return Json::encode([
            'summary' => [
                'totalApplicants' => sizeof($applicants)
            ],
            'applicants' => $applicants
        ]);
    }


    public function actionCorrectBirthDates() {
        $fileContents = file_get_contents("temporary-files/correctedBirthDates.json");
        $applications = Json::decode($fileContents);

        $passed = 0;
        $failed = 0;
        foreach ($applications as $key => $application) {

            $userId = (int)$application['UserID'];
            $jobApplicationId = $application['JobApplicationID'];
            $wrongBirthDate = $application['WrongBirthDate'];
            $correctedDate = $application['CorrectedBirthDate'];
            $computedAge = explode(".", AppUser::computeAge($correctedDate) . "");
            $ageYears = (int)$computedAge[0];
            $ageMonths = (int)$computedAge[1];

            $user = AppUser::findOne($userId);
            $jobApplication = JobApplication::findOne($jobApplicationId);


            if ($user != null && $jobApplication != null) {

                $user->birthdate = $correctedDate;
                $jobApplication->age = $ageYears;
                $jobApplication->age_month = $ageMonths;
                if ($user->save(false) && $jobApplication->save(false)) {
                    $passed++;
                } else {
                    $failed++;
                }


            }
        }
        return "Passed: {$passed}, failed: {$failed}. Process Completed";

    }

    public function actionFetchApplicationAttachments() {
        $jobApplications = JobApplication::find()
            ->where(['application_status' => JobApplication::STATUS_SUBMITTED])
            ->all();
        $attachments = [];
        foreach ($jobApplications as $jobApplication) {
            foreach ($jobApplication->getAttachments() as $attachment) {
                $attachments[] = $attachment->attachment;
            }
        }
        return Json::encode([
            'attachments' => $attachments
        ]);

    }

}
