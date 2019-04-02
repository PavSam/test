<?php

include "FileActions_class.php"; include "FileList_class.php"; include "FileUploader_class.php";  // Подключение файлов, содержащие классы
if (!empty($_POST['download'])) // Проверка на наличие значений в массиве $_POST получаемых методом POST
{
    $fileAction = new FileActions(); // Создание объекта fileAction и использование метода FileDownload
    $fileAction->FileDownload($_POST['download_file']);
}
if (!empty($_POST['delete']))
{
    $fileAction = new FileActions();
    $fileAction->FileDelete($_POST['delete_file']);
}
if (!empty($_FILES['userfile'])) // Создание объекта fileUploader и присвоение переменной uploadresult результата метода UploadFile
{
$fileUploader = new FileUploader();
$result = $fileUploader->UploadFile(basename($_FILES['userfile']['name']), $_FILES['userfile']['tmp_name']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">


<!-- Стили CSS:
body - обои бэкграунда;
p - рамка вокруг "Загрузка успешно выполнена!" -->

<style>

body {
  background: url(wallpaper.jpg) no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-position: center center;
}

p {
    border: 3px solid green;
    height: 20px;
    width: 230px;
   }

</style>

<title>Test</title> <!-- Название вкладки в браузере -->

</head>

<body>

<h1 align="center">Download/Delete Test Project</h1> <!-- Основной заголовок -->

<div align="center">
<form action="" method="POST" enctype="multipart/form-data">   <!-- Форма для выбора и загрузки файла -->
    <label> Выберите файл для загрузки: </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="40000000"/> <!-- Значение максимального размера файла. Больше 40 Мб - будет выведена ошибка-->
    <input type="file" name="userfile"/>
    <input type="submit" value="Загрузить файл"/>
</form>
</div>

<br>
<br>

<!-- Вывод результата загрузки -->

<div align="center">
<?php

if (!empty($result))
{
      echo $result;
}
?>
</div>

<br/>
<br/>



<!--
- Проверка наличия файлов в папке, если нет то таблица не будет отображена;
- Scandir возвращает . и ..
          в случае пустой папки - результатом данного условия будет 2;
-->



<?php

if (count(scandir(FileUploader::FILE_DIR))!= 2)
    {
    ?>

<div align="center">
<table border="5" style="width: 80%" > <!-- Создание таблицы, с параметрами толщины размера рамки и ширины -->

       <tr>
       <th>Дата <br> (Загружено: дд/мм/гггг; Время: чч:мм)</th>
       <th>Имя файла</th>
       <th>Размер файла</th>
       <th>Скачать файл</th>
       <th>Удалить файл</th>
       </tr>

            <?php
            $draw = new FileList(); // Использование метода FilesList для построения строк таблицы
            echo $draw->FilesList();
            ?>

        </table>
    </div>

<?php
    }
    ?>

<br/>
<br/>
<br/>

</body>
