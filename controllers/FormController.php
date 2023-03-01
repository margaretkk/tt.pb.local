<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\FormModel;

class FormController extends Controller
{

    public function form()
    {
        return $this->render('form');
    }

    public function handleForm(Request $request)
    {
        $formModel = new FormModel();

        $body = $request->getBody();

        if ($request->isPost()) {

            $formModel->loadData($body);

            if ($formModel->validate()) {
                $ref = $formModel->handleForm($body);
                echo "Ваш унікальний ідентифікатор заявки: $ref";
            }
        }
    }
}
