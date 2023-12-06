
<?php

class Bdparams //данные подключения
{
    protected $bdhost='localhost';
    protected $bdname='buh';
    protected $bduser='root';
    protected $bdpass='';
}

class BdConnect extends Bdparams //подключение к базе
{
    protected $bdcon;
    public function __construct() {
try {
    $this->bdcon = new PDO("mysql:host=$this->bdhost;dbname=$this->bdname", $this->bduser, $this->bdpass);
    $this->bdcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->bdcon->exec("set names utf8");
    } catch(PDOException $ex){
    echo "Ошибка! Нет соединения с базой данных!";
    }

    }
}

class RegUser extends BdConnect // регистрация пользователя
{
    public $loginRez;
    public $loginRez2;
    public $password;

    public function chekInfo($login1,$password_post) {

        $stmt = $this->bdcon->prepare('SELECT id,login_user FROM users WHERE login_user=:login_user LIMIT 1');
        $stmt->bindParam(':login_user', $login1);
        $stmt->execute();

        if ($login1 == '' or $password_post=='') {
            echo "пусто";
            die;
        }

        while ($selectAccount = $stmt->fetch()) {

            if ($login1 == $selectAccount['name_user']) {
                echo "уже есть такой логин";
                die;
            }
        }
       if (empty($this->loginRez)) {
           $this->loginRez2=$login1;
           $this->password=password_hash($password_post, PASSWORD_DEFAULT);
            $this->regAccount();
        };

    }
    public function regAccount() {

        $stmt2 = $this->bdcon->prepare("INSERT INTO users (login_user,pass_user) VALUES (:login_user, :pass_user)");
        $stmt2->bindParam(':login_user', $this->loginRez2);
        $stmt2->bindParam(':pass_user', $this->password);

        if ($stmt2->execute()) {
            header( 'Location: /', true, 303 );
        }
        else
            echo "Ошибка регистрации regAccount";

    }

    public function authUserBeforeReg() {

        if (!empty($this->loginRez2)) {
            $_SESSION['user_name']=$this->loginRez2;
            header( 'Location: /', true, 303 );
        }
        else
            header( 'Location: /error/formerror', true, 303 );
    }
}

class AuthRoom extends BdConnect //авторизация пользователя
{
    public $login_roomTry;
    public $password_roomTry;

    public function chekInfoRoom($login_room,$password_room) {

        $this->login_roomTry=$login_room;
        $this->password_roomTry=$password_room;
        $this->authRoomIn();
        echo $this->password_roomTry;
    }

    public function authRoomIn() {

        $stmtAuth = $this->bdcon->prepare("SELECT * FROM users WHERE login_user=:loginAuth LIMIT 1");
        $stmtAuth->bindParam(':loginAuth', $this->login_roomTry);
        $stmtAuth->execute();

        if (!empty($selectUser = $stmtAuth->fetch())) {

            if (password_verify($this->password_roomTry, $selectUser['pass_user'])) {
                $_SESSION['user_id']=$selectUser['id'];
                echo "<script>self.location='/main';</script>";
            }else {
                $err=1;
                echo "<script>self.location='/err';</script>";
                die;
            }
        }
        else
            $err=1;
        echo "<script>self.location='/err';</script>";
        die;
    }
}

class Statistics extends BdConnect { //внесение и получение данных статистики

    public $month_main;
    public $year_main;

    public function addStatistics($add_date,$add_coming,$add_expenses,$add_type,$balance,$add_comment) {
        $stmt = $this->bdcon->prepare("INSERT INTO statistics (day_s,month_s,year_s,coming,expenses,type_s,balance,comment) VALUES (:add_day,:add_month,:add_year,:add_coming,:add_expenses,:add_type,:balance,:add_comment)");
        $stmt->bindParam(':add_day', $add_date[0]);
        $stmt->bindParam(':add_month', $add_date[1]);
        $stmt->bindParam(':add_year', $add_date[2]);
        $stmt->bindParam(':add_coming', $add_coming);
        $stmt->bindParam(':add_expenses', $add_expenses);
        $stmt->bindParam(':add_type', $add_type);
        $stmt->bindParam(':balance', $balance);
        $stmt->bindParam(':add_comment', $add_comment);

        if ($stmt->execute()) {
            header( 'Location: /main', true, 303 );
        }
        else
            echo "Ошибка";

    }

    public function monitorYear() {

        $rezF = $this->bdcon->query('SELECT `year` FROM years order by id desc limit 1');
        $selectInfoF = $rezF->fetch();
        $year = $selectInfoF['year'] + 1;
           return $year;
    }

    public function addNewYear($new_year) {

        $stmt = $this->bdcon->prepare('SELECT `year` FROM years WHERE `year`=:new_year LIMIT 1');
        $stmt->bindParam(':new_year', $new_year);
        $stmt->execute();

        while ($select_year = $stmt->fetch()) {

            if ($new_year == $select_year['year']) {
                echo "уже есть такой год";
                die;
            }
        }


        $stmt = $this->bdcon->prepare("INSERT INTO `years` (year) VALUES (:new_year)");
        $stmt->bindParam(':new_year', $new_year);

        if ($stmt->execute()) {
            header( 'Location: /settings', true, 303 );
        }
        else
            echo "Ошибка изменения данных";

    }

    public function delData() {
        $stmt = $this->bdcon->prepare('DELETE FROM statistics');
        if ($stmt->execute()) {
            header( 'Location: /settings', true, 303 );
        }
        else
            echo "Ошибка процедуры удаления";
    }


    public function tableStatistics() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $info_all_rez = $this->bdcon->query('SELECT * FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'" order by id DESC');

        $this->month_main = $selectInfoF['month_main'];
        $this->year_main = $selectInfoF['year_main'];

        while ($selectInfo = $info_all_rez->fetch())
        {
            if ($selectInfo['type_s'] == 1) {
                $type = "Переменные";
            }
            if ($selectInfo['type_s'] == 2) {
                $type = "Постоянные";
            }

            if ($selectInfo['balance'] < 0) {
                $balance_color = "red";
            } else {
                $balance_color = "black";
            }

            if ($selectInfo['comment'] == "") {
                $comment_img = "note.png";
                $comment_null = "Не указано...";
            }
            if ($selectInfo['comment'] != "") {
                $comment_img = "note2.png";
                $comment_null = "";
            }

            echo "<tr>
                <th scope='row'>".$selectInfo['day_s'].".".$selectInfo['month_s'].".".$selectInfo['year_s']."</th>
                <td>".$selectInfo['coming']."</td>
                <td>".$selectInfo['expenses']."</td>
                <td><span style='color: ".$balance_color."'>".$selectInfo['balance']."</span></td>
                 <td>
                 <div class='btn-group dropend'>
    <a href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
       <img src='/tpl/img/".$comment_img."' alt=''>
        </a>
    <div class='dropdown-menu dropdown-menu__style'>
        ".$selectInfo['comment'].$comment_null."
        </div>
</div>
                </td>
            </tr>";
        }
    }
    public function mainGrafik() {
        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query_m_1 = 'SELECT sum(balance) FROM statistics WHERE month_s="01" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_1 = $this->bdcon->query($query_m_1)->fetchColumn();

        $query_m_2 = 'SELECT sum(balance) FROM statistics WHERE month_s="02" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_2 = $this->bdcon->query($query_m_2)->fetchColumn();

        $query_m_3 = 'SELECT sum(balance) FROM statistics WHERE month_s="03" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_3= $this->bdcon->query($query_m_3)->fetchColumn();

        $query_m_4 = 'SELECT sum(balance) FROM statistics WHERE month_s="04" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_4 = $this->bdcon->query($query_m_4)->fetchColumn();

        $query_m_5 = 'SELECT sum(balance) FROM statistics WHERE month_s="05" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_5 = $this->bdcon->query($query_m_5)->fetchColumn();

        $query_m_6 = 'SELECT sum(balance) FROM statistics WHERE month_s="06" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_6= $this->bdcon->query($query_m_6)->fetchColumn();

        $query_m_7 = 'SELECT sum(balance) FROM statistics WHERE month_s="07" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_7 = $this->bdcon->query($query_m_7)->fetchColumn();

        $query_m_8 = 'SELECT sum(balance) FROM statistics WHERE month_s="08" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_8 = $this->bdcon->query($query_m_8)->fetchColumn();

        $query_m_9 = 'SELECT sum(balance) FROM statistics WHERE month_s="09" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_9 = $this->bdcon->query($query_m_9)->fetchColumn();

        $query_m_10 = 'SELECT sum(balance) FROM statistics WHERE month_s="10" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_10 = $this->bdcon->query($query_m_10)->fetchColumn();

        $query_m_11 = 'SELECT sum(balance) FROM statistics WHERE month_s="11" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_11 = $this->bdcon->query($query_m_11)->fetchColumn();

        $query_m_12 = 'SELECT sum(balance) FROM statistics WHERE month_s="12" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_m_12 = $this->bdcon->query($query_m_12)->fetchColumn();

        if (empty($sum_m_1)) {
            $sum_m_1 = 0;
        }
        if (empty($sum_m_2)) {
            $sum_m_2 = 0;
        }
        if (empty($sum_m_3)) {
            $sum_m_3 = 0;
        }
        if (empty($sum_m_4)) {
            $sum_m_4 = 0;
        }
        if (empty($sum_m_5)) {
            $sum_m_5 = 0;
        }
        if (empty($sum_m_6)) {
            $sum_m_6 = 0;
        }
        if (empty($sum_m_7)) {
            $sum_m_7= 0;
        }
        if (empty($sum_m_8)) {
            $sum_m_8 = 0;
        }
        if (empty($sum_m_9)) {
            $sum_m_9 = 0;
        }
        if (empty($sum_m_10)) {
            $sum_m_10 = 0;
        }
        if (empty($sum_m_11)) {
            $sum_m_11 = 0;
        }
        if (empty($sum_m_12)) {
            $sum_m_12 = 0;
        }

        return [
            'sum_m_1'=>  $sum_m_1,
            'sum_m_2'=>  $sum_m_2,
            'sum_m_3'=>  $sum_m_3,
            'sum_m_4'=>  $sum_m_4,
            'sum_m_5'=>  $sum_m_5,
            'sum_m_6'=>  $sum_m_6,
            'sum_m_7'=>  $sum_m_7,
            'sum_m_8'=>  $sum_m_8,
            'sum_m_9'=>  $sum_m_9,
            'sum_m_10'=>  $sum_m_10,
            'sum_m_11'=>  $sum_m_11,
            'sum_m_12'=>  $sum_m_12
        ];
    }

    public function editMonth($edit_month) {
        $update_rez = $this->bdcon->prepare('UPDATE `users` SET `month_main` = (:month_main) where id="1"');
        $update_rez->bindParam(':month_main', $edit_month);

        if ($update_rez->execute()) {
            header( 'Location: /main', true, 303 );
        }
        else
            echo "Ошибка";
    }

    public function editYear($year) {
        $update_rez = $this->bdcon->prepare('UPDATE `users` SET `year_main` = (:year_s) where id="1"');
        $update_rez->bindParam(':year_s', $year);

        if ($update_rez->execute()) {
            header( 'Location: /main', true, 303 );
        }
        else
            echo "Ошибка";
    }

    public function yearSelect() {
        $rezU = $this->bdcon->query('SELECT year_main FROM users WHERE id="1"');
        $selectInfoU = $rezU->fetch();

        $rezF = $this->bdcon->query('SELECT `year` FROM years');

        while ($selectInfoF = $rezF->fetch())
        {
            if ($selectInfoF['year'] == $selectInfoU['year_main']) {
                $option_s = "selected";
            }
            else
                $option_s ="";
            echo "<option value='".$selectInfoF['year']."' ".$option_s.">".$selectInfoF['year']."</option>";
        }
    }

    public function monthSelect() {
        $rezU = $this->bdcon->query('SELECT month_main FROM users WHERE id="1"');
        $selectInfoU = $rezU->fetch();

        $rezF = $this->bdcon->query('SELECT `month_num`, `month` FROM `month`');


        while ($selectInfoF = $rezF->fetch())
        {
            if ($selectInfoF['month_num'] == $selectInfoU['month_main']) {
                $option_s = "selected";
            }
            else
                $option_s ="";
            echo "<option value='".$selectInfoF['month_num']."' ".$option_s.">".$selectInfoF['month']."</option>";
        }
    }

    public function daySelect() {

        $rezF = $this->bdcon->query('SELECT `num_day` FROM `days`');

        while ($selectInfoF = $rezF->fetch())
        {
            if ($selectInfoF['num_day'] == date("d")) {
                $option_s = "selected";
            }
            else
                $option_s ="";
            echo "<option value='".$selectInfoF['num_day']."' ".$option_s.">".$selectInfoF['num_day']."</option>";
        }
    }

    public function balanceFil() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query = 'SELECT sum(balance) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum = $this->bdcon->query($query)->fetchColumn();

        return $sum;

    }

    public function comingMonthSum() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query = 'SELECT sum(coming) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum = $this->bdcon->query($query)->fetchColumn();

        if (empty($sum)) {
            $sum = "0";
        }

        return $sum;

    }

    public function expensesMonthSum() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query = 'SELECT sum(expenses) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'"';
        $sumExpenses = $this->bdcon->query($query)->fetchColumn();

        if (empty($sumExpenses)) {
            $sumExpenses = "0";
        }

        return $sumExpenses;

    }

    public function comingMonthSumEnd() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query = 'SELECT sum(coming) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_coming = $this->bdcon->query($query)->fetchColumn();


        $query2 = 'SELECT sum(expenses) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'"';
        $sum_expenses = $this->bdcon->query($query2)->fetchColumn();

        if (empty($sum_coming)) {
            $sum_expenses = "0";
        }
        if (empty($sum_coming)) {
            $sum_expenses = "0";
        }

        return $sum_coming-$sum_expenses;

    }

    public function monthSumTypePostRez() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query = 'SELECT sum(expenses) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'" AND type_s="1"';
        $sum_post = $this->bdcon->query($query)->fetchColumn();

        if (empty($sum_post)) {
            $sum_post = "0";
        }

        return $sum_post;

        }
    public function monthSumTypePerRez() {

        $rezF = $this->bdcon->query('SELECT * FROM users WHERE id="1"');
        $selectInfoF = $rezF->fetch();

        $query = 'SELECT sum(expenses) FROM statistics WHERE month_s="'.$selectInfoF['month_main'].'" AND year_s="'.$selectInfoF['year_main'].'" AND type_s="2"';
        $sum_per = $this->bdcon->query($query)->fetchColumn();

        if (empty($sum_per)) {
            $sum_per = "0";
        }

        return $sum_per;

    }

}

class UserInfo extends BdConnect { //информация, закреплённая за пользователем
    public function userInfoFil() {
        $rez = $this->bdcon->query('SELECT * FROM users WHERE id="1"');

        while ($selectInfo = $rez->fetch())
        {
            return [
                'year_main'=>  $selectInfo['year_main'],
                'month_main'=>  $selectInfo['month_main']
            ];
        }

    }

    public function userInfoAll() {
        $rez = $this->bdcon->query('SELECT * FROM users WHERE id="1"');

        while ($selectInfo = $rez->fetch())
        {
            if ($selectInfo['month_main'] == "01") {
                $user_month = "Январь";
            }
            if ($selectInfo['month_main'] == "02") {
                $user_month = "Февраль";
            }
            if ($selectInfo['month_main'] == "03") {
                $user_month = "Март";
            }
            if ($selectInfo['month_main'] == "04") {
                $user_month = "Апрель";
            }
            if ($selectInfo['month_main'] == "05") {
                $user_month = "Май";
            }
            if ($selectInfo['month_main'] == "06") {
                $user_month = "Июнь";
            }
            if ($selectInfo['month_main'] == "07") {
                $user_month = "Июль";
            }
            if ($selectInfo['month_main'] == "08") {
                $user_month = "Август";
            }
            if ($selectInfo['month_main'] == "09") {
                $user_month = "Сентябрь";
            }
            if ($selectInfo['month_main'] == "10") {
                $user_month = "Октябрь";
            }
            if ($selectInfo['month_main'] == "11") {
                $user_month = "Ноябрь";
            }
            if ($selectInfo['month_main'] == "12") {
                $user_month = "Декабрь";
            }

            return [
                'year_main'=>  $selectInfo['year_main'],
                'month_main'=>  $selectInfo['month_main'],
                'user_month'=>  $user_month
            ];
        }
    }
}

