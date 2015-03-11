<?php

//функция возвращающая результат обработки ошибок ввода в текстовые поля (можно вводить только числа)
function error_handle($num)
{
    switch($num)
    {
        case(0):
            $field = '"&#1055;&#1083;&#1086;&#1097;&#1072;&#1076;&#1100;"';//Площадь
            break;
        case(3):
            $field = '"&#1055;&#1077;&#1088;&#1080;&#1084;&#1077;&#1090;&#1088;"';//Периметр
            break;
        case(6):
            $field = '"&#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086; &#1091;&#1075;&#1083;&#1086;&#1074;"';
            //Количество углов
            break;
        case(7):
            $field = '"&#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086; &#1090;&#1088;&#1091;&#1073;"';
            //Количество труб
            break;
        case(8):
            $field = '"&#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086; &#1086;&#1089;&#1074;&#1077;&#1090;&#1080;&#1090;'
                . '&#1077;&#1083;&#1100;&#1085;&#1099;&#1093; &#1087;&#1088;&#1080;&#1073;&#1086;&#1088;&#1086;&#1074;"';
            //Количество осветительных приборов
            break;
    }
    echo '<div style="font-family: Arial; font-size: 16pt;">&#1042;&#1099; &#1074;&#1074;&#1077;&#1083;&#1080; &#1085;&#1077;&#1082;&#1086;&#1088;&#1088;&#1077;&#1082;&#1090;'
    . '&#1085;&#1086;&#1077; &#1079;&#1085;&#1072;&#1095;&#1077;&#1085;&#1080;&#1077; &#1074; &#1087;&#1086;&#1083;&#1077; '.$field
            .'</div><br><form action="/calc/" method="GET">
              <input type="submit" value="&#1042;&#1077;&#1088;&#1085;&#1091;&#1090;&#1100;&#1089;&#1103;" />
              </form>';
    //Вы ввели некорректное значение в поле
}

//***блок функций для вычислений выходных значений в зависимости от введённых данных
function calc_square_cost($square, $material)
{
    if ($square < 7)
    {
        switch($material)
        {
            case("matovy"):
                $result = $square * 440;
                break;
            case("satin"):
                $result = $square * 460;
                break;
            case("lak"):
                $result = $square * 450;
                break;
        }
        return $result;
    }
    elseif ($square < 15)
    {
        switch($material)
        {
            case("matovy"):
                $result = $square * 390;
                break;
            case("satin"):
                $result = $square * 410;
                break;
            case("lak"):
                $result = $square * 400;
                break;
        }
        return $result;
    }
    elseif ($square < 30)
    {
        switch($material)
        {
            case("matovy"):
                $result = $square * 360;
                break;
            case("satin"):
                $result = $square * 380;
                break;
            case("lak"):
                $result = $square * 370;
                break;
        }
        return $result;
    }
    elseif ($square < 50)
    {
        switch($material)
        {
            case("matovy"):
                $result = $square * 340;
                break;
            case("satin"):
                $result = $square * 360;
                break;
            case("lak"):
                $result = $square * 350;
                break;
        }
        return $result;
    }
    elseif ($square >= 50)
    {
        switch($material)
        {
            case("matovy"):
                $result = $square * 320;
                break;
            case("satin"):
                $result = $square * 340;
                break;
            case("lak"):
                $result = $square * 330;
                break;
        }
        return $result;
    }
}

function calc_color_cost($square, $color)
{
    switch($color)
    {
        case("white"):
            $result = 0;
            break;
        case("color"):
            $result = $square * 40;
    }
    return $result;
}

function calc_baget_cost($perimetr, $baget)
{
    switch($baget)
    {
        case("plastic"):
            $result = 0;
            break;
        case("aluminium"):
            $result = $perimetr * 50;
            break;
    }
    return $result;
}

function calc_insert_cost($perimetr, $insert)
{
    switch($insert)
    {
        case("no"):
            $result = 0;
            break;
        case("technical"):
            $result = $perimetr * 50;
            break;
        case("artistic"):
            $result = $perimetr * 80;
            break;
    }
    return $result;
}

function calc_corners_cost($amount)
{
    $result = $amount * 150;
    return $result;
}

function calc_pipes_cost($amount)
{
    $result = $amount * 200;
    return $result;
}

function calc_lamps_cost($amount)
{
    $result = $amount * 350;
    return $result;
}
//***

//заполнение массива с именами полей html-формы
$field_num = 1;
while ($field_num < 10)
{
    $fields[] = 'field'.$field_num;
    $field_num = $field_num + 1;
}

foreach($fields as $fields_key => $fields_value)
{
    $key = $fields_key;
}

//заполнение массива результирующих переменных для передачи в функции вычислений
//с одновременной проверкой на корректность введённых в текстовые поля данных
$key = 0;
while ($key < 9)
{
    switch($key)
    {
        case(0):
            $filter = filter_input(INPUT_POST, $fields[$key]);
            if(filter_var($filter, FILTER_VALIDATE_FLOAT) === FALSE)
        {
            return error_handle($key);
        }
        else {
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
        }
            break;
        case(1):
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
            break;
        case(2):
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
            break;
        case(3):
            $filter = filter_input(INPUT_POST, $fields[$key]);
            if(filter_var($filter, FILTER_VALIDATE_FLOAT) === FALSE)
        {
            return error_handle($key);
        }
            else {
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
        }
            break;
        case(4):
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
            break;
        case(5):
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
            break;
        case(6):
            $filter = filter_input(INPUT_POST, $fields[$key]);
            if(filter_var($filter, FILTER_VALIDATE_INT) === FALSE)
        {
            return error_handle($key);
        }
                else {
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
        }
            break;
        case(7):
            $filter = filter_input(INPUT_POST, $fields[$key]);
            if(filter_var($filter, FILTER_VALIDATE_INT) === FALSE)
        {
            return error_handle($key);
        }
                else {
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
        }
            break;
        case(8):
            $filter = filter_input(INPUT_POST, $fields[$key]);
            if(filter_var($filter, FILTER_VALIDATE_INT) === FALSE)
        {
            return error_handle($key);
        }
                else {
            $calc_variables[] = filter_input(INPUT_POST, $fields[$key]);
        }
            break;   
    }
    $key = $key + 1;
}

//функция для выведения соответствия строки показанной в селекторе с номером этого селектора
function determine_var($dfield)
{
    if($dfield === 2)
    {
        $dvar = filter_input(INPUT_POST, 'field2');
        if($dvar === 'matovy')
        {
            $str = '&#1052;&#1072;&#1090;&#1086;&#1074;&#1099;&#1081;';
            return $str;
        }
        elseif($dvar === 'satin')
        {
            $str = '&#1057;&#1072;&#1090;&#1080;&#1085;';
            return $str;
        }
        elseif($dvar === 'lak')
        {
            $str = '&#1051;&#1072;&#1082;&#1086;&#1074;&#1099;&#1081;';
            return $str;
        }
    }
    elseif($dfield === 3)
    {
        $dvar = filter_input(INPUT_POST, 'field3');
        if($dvar === 'white')
        {
            $str = '&#1041;&#1077;&#1083;&#1099;&#1081;';
            return $str;
        }
        elseif($dvar === 'color')
        {
            $str = '&#1062;&#1074;&#1077;&#1090;&#1085;&#1086;&#1081;';
            return $str;
        }
    }
    elseif($dfield === 5)
    {
        $dvar = filter_input(INPUT_POST, 'field5');
        if($dvar === 'plastic')
        {
            $str = '&#1055;&#1083;&#1072;&#1089;&#1090;&#1080;&#1082;';
            return $str;
        }
        elseif($dvar === 'aluminium')
        {
            $str = '&#1040;&#1083;&#1102;&#1084;&#1080;&#1085;&#1080;&#1081;';
            return $str;
        }
        
    }
    elseif($dfield === 6)
    {
        $dvar = filter_input(INPUT_POST, 'field6');
        if($dvar === 'no')
        {
            $str = '&#1085;&#1077;&#1090;';
            return $str;
        }
        elseif($dvar === 'technical')
        {
            $str = '&#1058;&#1077;&#1093;&#1085;&#1080;&#1095;&#1077;&#1089;&#1082;&#1072;&#1103;';
            return $str;
        }
        elseif($dvar === 'artistic')
        {
            $str = '&#1044;&#1077;&#1082;&#1086;&#1088;&#1072;&#1090;&#1080;&#1074;&#1085;&#1072;&#1103;';
            return $str;
        }
    }
}

$calc_result = calc_square_cost($calc_variables[0], $calc_variables[1]) + 
        calc_color_cost($calc_variables[0], $calc_variables[2]) + 
        calc_baget_cost($calc_variables[3], $calc_variables[4]) + 
        calc_insert_cost($calc_variables[3], $calc_variables[5]) + 
        calc_corners_cost($calc_variables[6]) + 
        calc_pipes_cost($calc_variables[7]) + 
        calc_lamps_cost($calc_variables[8]);

$dvar2 = determine_var(2);
$dvar3 = determine_var(3);
$dvar5 = determine_var(5);
$dvar6 = determine_var(6);

$html_head = '<div style="font-family: Arial; font-size: 16pt;">
              <span style="font-weight: bold; text-decoration: underline;">
              &#1042;&#1072;&#1096;&#1080; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077;:</span><br>
              &#1055;&#1083;&#1086;&#1097;&#1072;&#1076;&#1100;: '.$calc_variables[0].' &#1084;<sup>2</sup><br>
              &#1052;&#1072;&#1090;&#1077;&#1088;&#1080;&#1072;&#1083;: '.$dvar2.'<br>
              &#1062;&#1074;&#1077;&#1090;: '.$dvar3.'<br>
              &#1055;&#1077;&#1088;&#1080;&#1084;&#1077;&#1090;&#1088;: '.$calc_variables[3].' &#1084;<br>
              &#1058;&#1080;&#1087; &#1073;&#1072;&#1075;&#1077;&#1090;&#1072;: '.$dvar5.'<br>
              &#1042;&#1089;&#1090;&#1072;&#1074;&#1082;&#1072;: '.$dvar6.'<br>
              &#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;'.
              '&#1090;&#1074;&#1086; &#1091;&#1075;&#1083;&#1086;&#1074;: '.$calc_variables[6].' &#1096;&#1090;.<br>
              &#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;'.
              '&#1090;&#1074;&#1086; &#1090;&#1088;&#1091;&#1073;: '.$calc_variables[7].' &#1096;&#1090;.<br>
              &#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086; &#1086;&#1089;&#1074;&#1077;'.
              '&#1090;&#1080;&#1090;&#1077;&#1083;&#1100;&#1085;'.
              '&#1099;&#1093; &#1087;&#1088;&#1080;&#1073;&#1086;&#1088;&#1086;&#1074;: '.$calc_variables[8].' &#1096;&#1090;.<br>
              <b>________________________________________</b><br>
              <b>&#1057;&#1090;&#1086;&#1080;&#1084;&#1086;&#1089;&#1090;&#1100;: ';

$html_foot = ' &#1088;&#1091;&#1073;.</b><br><form action="/calc/" method="GET">
              <input type="submit" value="&#1047;&#1072;&#1082;&#1088;&#1099;&#1090;&#1100;" />
              </form>
              </div>';

echo $html_head.$calc_result.$html_foot;
