<!DOCTYPE html>
<html>

<head>
    <title>Credit form</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>



    <div class="container">

        <h2>Заповніть форму для обробки заявки на кредитний ліміт</h2>

        <form action="" method="post">

            <div class="form-group">

                <label for="idClient">Ідентифікатор</label>

                <input type="text" class="form-control" id="idClient" name="idClient" placeholder="Ваш ідентифікатор.." required>
            </div>

            <div class="form-group">

                <label for="birthday">День народження</label>

                <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Вкажіть ваш день народження.." required>

            </div>

            <div class="form-group">

                <label for="phone">Телефон</label>

                <input type="tel" class="form-control" id="phone" name="phone" placeholder="0501234567">

            </div>

            <div class="form-group">

                <label for="email">Електронна пошта</label>

                <input type="text" class="form-control" id="email" name="email" placeholder="example@mail.com">

            </div>

            <div class="form-group">

                <label for="address">Адреса</label>

                <input type="text" class="form-control" id="address" name="address" placeholder="Ваша адреса проживання..">

            </div>

            <div class="form-group">

                <label for="monthSalary">Сума доходу</label>

                <input type="text" class="form-control" id="monthSalary" name="monthSalary" placeholder="Вкажіть ваш дохід в місяць..">

            </div>

            <div class="form-group">

                <label for="currSalary">Валюта доходу</label>

                <select class="form-control" id="currSalary" name="currSalary">
                    <option value="UAH">UAH</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>

            </div>

            <div class="form-group">

                <label for="requestLimit">Бажана сума кредитного ліміту</label>

                <input type="text" class="form-control" id="requestLimit" name="requestLimit" placeholder="Вкажіть бажану суму кредитного ліміту.." required>

            </div>

            <br>
            <button type="submit" class="btn btn-default">Відправити заявку</button>

        </form>
    </div>
    </form>
</body>

</html>