<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\ToDoList;
use app\models\ToDoListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;

/**
 * ToDoListController implements the CRUD actions for ToDoList model.
 */
class ToDoListController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete', 'upload'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'upload'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                TimestampBehavior::class,
            ]
        );
    }

    /**
     * Lists all ToDoList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ToDoListSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ToDoList model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ToDoList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ToDoList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ToDoList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ToDoList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ToDoList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ToDoList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ToDoList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            header('Content-Type: text/html; charset=UTF-8',true);
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);

                $fileName = Yii::getAlias('@app/web/uploads/'.$model->file->baseName . '.' . $model->file->extension);
                
                $data = \moonland\phpexcel\Excel::import($fileName, ['setIndexSheetByName' => true]);
                $modelToDoList = new ToDoList();
                foreach ($data as $datum){
                    if(!empty($datum)){
                       foreach ($datum as $value){
                           $modelToDoList = new ToDoList([
                              'task' => $value['Задача'],
                              'responsible' => $value['Ответственный'],
                              'term' => date("Y-m-d", strtotime($value['Срок'])),
                              'status' => $value['Статус'],
                           ]);
                           $modelToDoList->save();
                       }
                    }
                }
                unlink(Yii::getAlias('@app/web/uploads/'.$model->file->baseName . '.' . $model->file->extension));

                return $this->redirect(['index']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}
